<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrder;
use App\Model\User;

class RepairOrderController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        return response()->view('admin.repair-order.index');
    }
    
    public function tableData($status)
    {
        $status = strtoupper($status);
        $orders = RepairOrder::query()
        ->where('status', $status)
        ->with('workyard')->with('repair_type')
        ->with('repair_order_grade')->with('repair_order_status')
        ->with('worker')->with('offer')
        ->get();
        return response()->json(['data' => $orders]);
    }
    
    public function view($id) 
    {
        $repairOrder = $this->getRepairOrder($id);
        return view('admin.repair-order.view', ['repairOrder' => $repairOrder]);
    }
    public function distribute($id)
    {
        $repairOrder = $this->getRepairOrder($id);
        
        //获取所有兼职维修工
        $workers = User::query()->whereHas('roles_on_owning', function($query) {
            $query->where('name', 'WORKER')
            ->where([
                'role_user.status'=>'WORKER_ENABLED',
                'role_user.worker_type'=>'FULL_TIME',
            ]);
        })->with('skill')->with('roles_on_owning')->get();
        
        return view('admin.repair-order.distribute', [
            'repairOrder' => $repairOrder,
            'workers' => $workers
        ]);
    }
    public function setCanOffer($id)
    {
        $repairOrder = $this->getRepairOrder($id);
        return view('admin.repair-order.set-can-offer', ['repairOrder' => $repairOrder]);
    }
    public function close($id)
    {
        $repairOrder = $this->getRepairOrder($id);
        return view('admin.repair-order.close', ['repairOrder' => $repairOrder]);
    }
    public function pay($id) 
    {
        $repairOrder = $this->getRepairOrder($id);
        return view('admin.repair-order.pay', ['repairOrder' => $repairOrder]);
    }
    
    private function getRepairOrder($id)
    {
        $repairOrder = RepairOrder::query()
        ->with('repair_type')->with('workyard')
        ->with('repair_order_status')->with('repair_order_grade')
        ->with('user')->with('worker')
        ->find($id);
        return $repairOrder;
    }
}
