<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairType;
use App\Tool\MyAjax;

class RepairTypeController extends Controller
{
    private $Request;
    private $RepairType;
    
    public function __construct(
        Request $Request,
        RepairType $RepairType
        )
    {
        $this->Request = $Request;
        $this->RepairType = $RepairType;
    }
    
    public function index()
    {
        $user = RepairType::all();
        return response()->json(['total'=>count($user), 'data'=> $user]);
    }
    
    public function validName()
    {
        $name  = $this->Request->query('name');
        $id    = $this->Request->query('id', 0);
        $RepairType= RepairType::query()->where('name', $name)->first();
        $res= $RepairType ? $id == $RepairType->id : true;
        return response()->json($res);
    }
    
    public function add()
    {
        $values = $this->Request->input();
        //do save 
        $RepairType    = RepairType::query()->create($values);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $RepairType->id > 0
        ];
        return response()->json($res);
    }
    
    public function edit($id)
    {
        $values = $this->Request->input();
        //do save 
        $res    = RepairType::query()->find($id)->update($values);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res > 0
        ];
        return response()->json($res);
    }
    
    public function delete($id)
    {
        $res = RepairType::destroy($id);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res > 0
        ];
        return response()->json($res);
    }
    
    public function getSelectData() 
    {
        $repair_type = [];
        foreach (RepairType::all() as $RepairType)
        {
            $repair_type[] = [
                'title' => $RepairType->name,
                'value' => $RepairType->id,
            ];
        }
        return response()->json($repair_type);
    }
}
