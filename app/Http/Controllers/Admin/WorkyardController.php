<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Workyard;

class WorkyardController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        return response()->view('admin.workyard.index');
    }
    
    public function tableData($status)
    {
        //根据不同status确认数据
        $status = strtoupper($status);
        $where  = [
            'status' => $status
        ];
        //处理筛选数据
        //地区筛选
        $address_area = $this->Request->query('address-area');
        $address_area = explode(',', $address_area);
        $province = $address_area[0] ?? 0;
        $city     = $address_area[1] ?? 0;
        $district = $address_area[2] ?? 0;
        if($province)   $where['province'] = $province;
        if($city)       $where['city'] = $city;
        if($district)   $where['district'] = $district;
        
        //进行查询
        $Workyards = Workyard::query()->where($where)->get();
        return response()->json(['data'=> $Workyards]);
    }
    
    public function add()
    {
        return response()->view('admin.workyard.add');
    }
    public function view($id)
    {
        $Workyard = Workyard::query()->find($id);
        return response()->view('admin.workyard.view', ['Workyard'=>$Workyard]);
    }
    public function edit($id)
    {
        $Workyard = Workyard::query()->find($id);
        return response()->view('admin.workyard.edit',  ['Workyard'=>$Workyard]);
    }
    
    public function forbid($id)
    {
        $Workyard = Workyard::query()->find($id);
        $forbid   = $Workyard->status == Workyard::STATUS_ENABLED;
        return response()->view('admin.workyard.forbid', ['Workyard'=>$Workyard, 'forbid'=>$forbid]);
    }
    public function check($id)
    {
        $Workyard = Workyard::query()->find($id);
        return response()->view('admin.workyard.check', ['Workyard'=>$Workyard]);
    }
}
