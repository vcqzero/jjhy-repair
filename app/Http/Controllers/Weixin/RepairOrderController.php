<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrder;
use App\Model\RepairOrderStatus;

class RepairOrderController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        // DEBUG INFORMATION END
        return response()->view('weixin.repair-order.index');
    }
    
    //获取分页数据
    //需要在url中query参数中增加page=1的参数
    public function paginateCompleted()
    {
        //如果直接返回分页对象，则框架自动将分页对象
        //生成json格式，具体可查看文档
        $RepairOrders = RepairOrder::query()
        ->where('status', RepairOrderStatus::STATUS_COMPLETED)
        ->latest()
        ->simplePaginate(3);
        //一般情况下可返回视图文件
        return response()->view('weixin.repair-order.partial.tab-completed', ['repairOrders' => $RepairOrders ]);
    }
    
    public function paginateClosed()
    {
        //如果直接返回分页对象，则框架自动将分页对象
        //生成json格式，具体可查看文档
        $RepairOrders = RepairOrder::query()
        ->where('status', RepairOrderStatus::STATUS_CLOSED)
        ->latest()
        ->simplePaginate(3);
        //一般情况下可返回视图文件
        return response()->view('weixin.repair-order.partial.tab-completed', ['repairOrders' => $RepairOrders ]);
    }
    
    public function add()
    {
        //get repair type data
        return response()->view('weixin.repair-order.add');
    }
    
    public function edit($id)
    {
        $RepairOrder = RepairOrder::query()->find($id);
        
        return response()->view('weixin.repair-order.edit', ['RepairOrder' => $RepairOrder]);
    }
    
    public function workerView($id)
    {
        $repairOrder= RepairOrder::query()->find($id);
        return response()->view('weixin.index.partial.view-repair-order', ['repairOrder' => $repairOrder]);
    }
    
    //goto take order success page
    public function takeOrderSuccess()
    {
        return response()->view('weixin.repair-order.take-order-success');
    }
    
    //goto take order success page
    public function completeOrderSuccess()
    {
        return response()->view('weixin.repair-order.complete-order-success');
    }
}
