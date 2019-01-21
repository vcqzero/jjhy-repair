<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrder;
use App\Filter\RepairOrderFilter;
use Illuminate\Support\Facades\Auth;
use App\Tool\MyAjax;
use App\Model\RepairOrderStatus;
use App\Model\Settings;
use App\Model\OfferStatus;
use Illuminate\Support\Facades\DB;
use App\Events\DistributeRepairOrder;
use App\Events\OnRepairOrderCreated;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Tool\MyDownload;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class RepairOrderController extends Controller
{
    private $Request;
    private $RepairOrderFilter;
    private $Settings;
    private $RepairOrder;
    public function __construct(
        Request $Request,
        RepairOrderFilter $RepairOrderFilter,
        Settings $Settings,
        RepairOrder $RepairOrder
        )
    {
        $this->Request = $Request;
        $this->RepairOrderFilter = $RepairOrderFilter;
        $this->Settings = $Settings;
        $this->RepairOrder = $RepairOrder;
    }
    
    //新增维修单
    public function add(RepairOrder $RepairOrder)
    {
        $workyard_id = $this->Request->input('workyard_id');
        //can add
        if($RepairOrder->canAdd($workyard_id) == false) {
            $res = [
                MyAjax::SUBMIT_SUCCESS => false
            ];
            return response()->json($res);
        }
        //通过验证
        $user_id     = Auth::id();
        $values = $this->Request->input();
        $values = $this->RepairOrderFilter->filter($values);
        //生成订单
        $values['order']  = $this->RepairOrder->generateOrder();
        //根据是否可抢单报价确认状态
        $canOffer = $this->Settings->canOffer();
        $values['status'] = $canOffer ? RepairOrderStatus::STATUS_WAIR_WORKER : RepairOrderStatus::STATUS_WAIR_DISTRIBUTE;
        //创建人
        $values['created_by'] = $user_id;
        //save
        $RepairOrder = RepairOrder::query()->create($values);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $RepairOrder->id > 0
        ];
        if($res) event(new OnRepairOrderCreated($RepairOrder));
        return response()->json($res);
    }
    //编辑维修单
    public function edit($id)
    {
        $values = $this->Request->input();
        $values = $this->RepairOrderFilter->filter($values);
        $res = RepairOrder::query()->find($id)->update($values);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res > 0
        ];
        return response()->json($res);
    }
    
    //管理员和项目管理员关闭订单
    public function close($id)
    {
        $RepairOrder = RepairOrder::query()->find($id);
        $RepairOrder->status = RepairOrderStatus::STATUS_CLOSED;
        $res = $RepairOrder->save();
        return response()->json($res);
    }
    //订单维修完成，标记为完成
    public function complete($id)
    {
        $comment_star= (int)$this->Request->query('comment_star');
        $RepairOrder = RepairOrder::query()->find($id);
        $RepairOrder->status = RepairOrderStatus::STATUS_COMPLETED;
        $RepairOrder->comment_star= $comment_star;
        $RepairOrder->completed_at= date('Y-m-d H:i:s');
        $res = $RepairOrder->save();
        return response()->json($res);
    }
    
    //评价订单 ，完成定单
    public function comment($id)
    {
        $comment_star= (int)$this->Request->input('comment_star');
        $comment_desc= (int)$this->Request->input('comment_desc');
        $RepairOrder = RepairOrder::query()->find($id);
        $RepairOrder->status = RepairOrderStatus::STATUS_COMPLETED;
        $RepairOrder->comment_star= $comment_star;
        $RepairOrder->comment_desc= $comment_desc;
        $RepairOrder->completed_at= date('Y-m-d H:i:s');
        $res = $RepairOrder->save();
        return response()->json($res);
    }
    
    //管理员分配维修工程师
    public function distribute($id)
    {
        //并设置指定的维修工程师
        $worker_id = (int)$this->Request->input('worker_id');
        //修改订单信息增加指定的维修工程师
        $repairOrder =RepairOrder::query()->find($id);
        $res = $this->doDistribute($worker_id, $repairOrder);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        if($res) event(new DistributeRepairOrder($repairOrder));
        return response()->json($res);
    }
    
    //指定维修工
    private function doDistribute($worker_id, $repairOrder)
    {
        try{
            DB::beginTransaction();
            //指定维修工程师，将订单状态改为working
            $repairOrder->worker_id = $worker_id;
            $repairOrder->status = RepairOrderStatus::STATUS_WORKING;
            $repairOrder->confirmed_at= date('Y-m-d H:i:s');
            $repairOrder->save();
            //将其他等待确认的报价失效
            $value = [
                'status'=>OfferStatus::FAILED
            ];
            $repairOrder->offers()->where('status', OfferStatus::WAIT_CONFIRM)->update($value);
            $res = true;
            DB::commit();
            
        }catch (\Exception $e ){
            DB::rollBack();
            $res = false;
        }
        return $res;
    }
    //管理员设置订单为可抢单
    public function setCanOffer($id)
    {
        $repairOrder =RepairOrder::query()->find($id);
        $repairOrder->status = RepairOrderStatus::STATUS_WAIR_WORKER;
        $res = $repairOrder->save();
        return response()->json($res);
    }
    
    //直接进行接单，不用报价，接单成功之后，直接变成维修人
    //和管理员确认一个意思
    public function takeOrder($id)
    {
        $worker_id = Auth::id();
        //修改订单信息增加指定的维修工程师
        $repairOrder =RepairOrder::query()->find($id);
        $res = $this->doDistribute($worker_id, $repairOrder);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        if($res) event(new DistributeRepairOrder($repairOrder));
        return response()->json($res);
    }
    
    //export
    public function export()
    {
        //获取筛选过的数据
        $repairOrders = $this->getExportData();
        //准备sepreadSheet
        $spreadsheet = new Spreadsheet();
        //设置保存文件名称
        $file_name = '维修工程师考勤表';
        //设置文件属性
        $spreadsheet->getProperties()->setTitle($file_name);
        
        $sheet = $spreadsheet->getActiveSheet();
        //设置sheet title
        $sheet->setTitle('考勤表');
        $writer = new Xlsx($spreadsheet);
        //设置保存文件名称
        $file_name = public_path('storage/export/' . $file_name . '.xlsx');
        
        //表格填充数据
        //设置表头
        $row = 1;//表头在第一行
        $head_datas = $this->getSheetHead();
        $columnIndex = 1;//从第一行 第一列 输出表头信息
        foreach ($head_datas as $head_data)
        {
            $sheet->setCellValueByColumnAndRow($columnIndex, $row, $head_data);
            $columnIndex++;
        }
        //输出表格内容
        $row = 2;//从第二行开始输出
        foreach ($repairOrders as $repairOrder)
        {
            $columnIndex = 1;//从第二行开始输出
            //获取应该输出的内容
            $row_datas = $this->getSheetRowData($repairOrder);
            //将内容输出到表格中
            foreach ($row_datas as $row_data)
            {
                $cell = $sheet->getCellByColumnAndRow($columnIndex, $row)->setDataType(DataType::TYPE_STRING);
//                 $sheet->setCellValueByColumnAndRow($columnIndex, $row, $row_data);
                $cell->setValue($row_data);
                $columnIndex++;
            }
            $row++;//本行输出完成，输出下一行
        }
        
        //将数据保存到文件中
        $writer ->save($file_name);
        //下载文件
        MyDownload::download($file_name);
    }
    
    /**
    * 获取要导出的数据
    * 
    * @return RepairOrder $repairOrders 集合      
    */
    private function getExportData()
    {
        //维修工
        $worker_id = $this->Request->query('worker_id');
        //所属项目
        $workyard_id= $this->Request->query('workyard_id');
        //维修开始 接单时间段
        $confirmed_at_range= $this->Request->query('confirmed_at_range');
        if($confirmed_at_range) {
            $confirmed_at_range= $this->progressdDateRane($confirmed_at_range);
            $confirmed_at_start= $confirmed_at_range['start'];
            $confirmed_at_end  = $confirmed_at_range['end'];
        }
        
        //维修完成时间段
        $completed_at_range= $this->Request->query('completed_at_range');
        $completed_at_start= null;
        $completed_at_end  = null;
        if($completed_at_range) {
            $completed_at_range= $this->progressdDateRane($completed_at_range);
            $completed_at_start= $completed_at_range['start'];
            $completed_at_end  = $completed_at_range['end'];
        }
        
        //维修评论
        $comment_star= $this->Request->query('comment_star');
        
        $repairOrders = RepairOrder::query()
        ->with('worker')->with('workyard')->with('repair_type')
        ->when($worker_id, function($query) use($worker_id) {
            $query->where('worker_id', $worker_id);
        })
        ->when($workyard_id, function($query) use($workyard_id) {
            $query->where('workyard_id', $workyard_id);
        })
        ->when($confirmed_at_range, function($query) use($confirmed_at_start, $confirmed_at_end) {
            $query->whereDate('confirmed_at', '>=', $confirmed_at_start)
            ->whereDate('confirmed_at', '<=', $confirmed_at_end);
        })
        ->when($completed_at_range, function($query) use($completed_at_start, $completed_at_end) {
            $query->whereDate('completed_at', '>=', $completed_at_start)
            ->whereDate('completed_at', '<=', $completed_at_end);
        })
        ->when($comment_star, function($query) use($comment_star) {
            $query->where('comment_star', $comment_star);
        })
        ->get();
        
        return $repairOrders;
    }
    
    /**
    * 处理前端bootstrap range 获得的数据
    * 得到日期段的开始 和 结束时间
    * 
    * @param string $range
    * @return array [start, end]       
    */
    private function progressdDateRane($range)
    {
        //eg:range = 2019/01/05-2019/01/20
        $range = explode('-', $range);
        $start = trim($range[0]);
        $end = trim($range[1]);
        return [
            'start' => $start,
            'end' => $end
        ];
    }
    
    /**
    * 获取导出表格某一行数据内容
    * 
    * @param RepairOrder $repairOrder
    * @return  array       
    */
    private function getSheetRowData(RepairOrder $repairOrder)
    {
        return [
            $repairOrder->order .' ' ?? '-',
            $repairOrder->worker->realname ?? '-',
            $repairOrder->workyard->name ?? '-',
            $repairOrder->repair_type->name ?? '-',//维修项目
            $repairOrder->desc ?? '-',//故障描述
            $repairOrder->confirmed_at ?? '-',
            $repairOrder->completed_at ?? '-',
            $repairOrder->comment_star ? $repairOrder->comment_star . '星' : '-' ,
            $repairOrder->comment_desc . ' ' ?? '-' ,
        ];
    }
    
    /**
    * 获取导出数据excel表中的表头数据
    * 
    * @return array $headData       
    */
    private function getSheetHead()
    {
        return [
            '维修单号',
            '工程师',
            '项目名称',
            '维修设备',
            '故障描述',
            '接单时间',
            '完工时间',
            '维修评价',
            '评价内容',
        ];
    }
}
