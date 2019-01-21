<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Model\User;
use App\Model\RepairOrder;
use App\Model\RepairOrderStatus;

class WorkerController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        return response()->view('admin.worker.index');
    }
    
    public function tableData($status)
    {
        $status = strtoupper($status);
        $workers = User::query()->whereHas('roles_on_owning', function($query) use($status) {
            $query->where('name', 'WORKER')->where('role_user.status', $status);
        })->with('skill')->with('roles_on_owning')->get();
        return response()->json(['data'=>$workers]);
    }
    
    public function view($id)
    {
        $worker = User::query()->with('skill')->find($id);
        return response()->view('admin.worker.view', ['worker'=>$worker]);
    }
    
    public function forbid($id)
    {
        $worker = User()::query()->find($id);
        return response()->view('admin.worker.forbid', ['worker'=>$worker]);
    }
    
    public function type($type, $id)
    {
        return response()->view('admin.worker.type', ['id'=>$id, 'type' => $type]);
    }
    
    //goto check page
    public function check($id)
    {
        $worker = User::query()->find($id);
        return response()->view('admin.worker.check', ['worker'=>$worker]);
    }
    
    //goto workerJob
    public function workerJob()
    {
        return response()->view('admin.worker.worker-job');
    }
    
    //workerJobTableData
    public function workerJobTableData()
    {
        //paginator
        $page       = $this->Request->query('pageNumber');//每页显示数量
        $pageSize   = $this->Request->query('pageSize');//从第几项数据开始，可以确定页码数
        $sort       = $this->Request->query('sortName');//排序
        $order      = $this->Request->query('sortOrder');//排序
        //query
        $workyard_id = $this->Request->query('workyard_id');//查询workyard_id
        $worker_id   = $this->Request->query('worker_id');//查询worker_id
        $comment_star= $this->Request->query('comment_star');//查询comment_star=
        
        //paginator
        $paginator = RepairOrder::query()
        ->where('status', RepairOrderStatus::STATUS_COMPLETED)//查询所有已完成的订单
        ->with('workyard')->with('repair_type')
        ->with('repair_order_grade')->with('repair_order_status')
        ->with('worker')->with('offer')
        //查询 workyard_id
        ->when($workyard_id, function($query) use($workyard_id) {
            //进行搜索
            $query  ->where('workyard_id', $workyard_id);
        })
        //查询 worker_id
        ->when($worker_id, function($query) use($worker_id) {
            //进行搜索
            $query  ->where('worker_id', $worker_id);
        })
        //查询 $comment_star
        ->when($comment_star, function($query) use($comment_star) {
        //进行搜索
            $query->where('comment_star', $comment_star);
        })
        ->orderBy($sort, $order)
        ->paginate($pageSize, ['*'], 'pageNumber');
        
        //bootstrap table response
        $total     = $paginator->total();
        $data      = [
            'total'=> $total,
            'rows' => $paginator->items()
        ];
        return response()->json($data);
    }
}
