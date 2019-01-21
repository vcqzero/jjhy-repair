<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Workyard;
use App\Tool\MyAjax;
use Illuminate\Support\Facades\Auth;
use App\Model\CheckWorkyardRecord;
use Illuminate\Support\Facades\DB;
use App\Model\Settings;
use App\Filter\WorkyardFilter;
use App\Filter\CheckWorkyardRecordFilter;

class WorkyardController extends Controller
{
    private $Request;
    private $Workyard;
    private $Settings;
    private $CheckWorkyardRecord;
    private $WorkyardFilter;
    private $CheckWorkyardRecordFilter;
    
    public function __construct(
        Request $Request, 
        CheckWorkyardRecord $CheckWorkyardRecord,
        Workyard $Workyard, 
        Settings $Settings,
        WorkyardFilter $WorkyardFilter,
        CheckWorkyardRecordFilter $CheckWorkyardRecordFilter
        )
    {
        $this->Request = $Request;
        $this->CheckWorkyardRecord = $CheckWorkyardRecord;
        $this->Workyard = $Workyard;
        $this->Settings = $Settings;
        $this->WorkyardFilter = $WorkyardFilter;
        $this->CheckWorkyardRecordFilter = $CheckWorkyardRecordFilter;
    }
    
    public function validName()
    {
        $name  = $this->Request->query('name');
        $id    = $this->Request->query('id', 0);
        $Workyard= Workyard::query()->where('name', $name)->first();
        $res= $Workyard ? $id == $Workyard->id : true;
        return response()->json($res);
    }
    
    /**
    * add new workyard
    */
    public function add(Workyard $Workyard)
    {
        if($Workyard->canAdd() == false) {
            $res = [
                MyAjax::SUBMIT_SUCCESS => false
            ];
            return response()->json($res);
        }
        $user_id = Auth::id();
        //1 workyard table
        $values = $this->Request->input();
        
        //address
        $values = $this->processAddressArea($values);
        
        //do filter
        $values = $this->WorkyardFilter->filter($values);
        
        //add other data
        $values['created_by'] = Auth::id();
        
        //do or not need check
        $needCheck = $this->Settings->needCheck();
        $status = $needCheck ? Workyard::STATUS_WAIT_CHECK : Workyard::STATUS_ENABLED;
        $values['status'] = $status;
        //do save
        $Workyard    = Workyard::query()->create($values);
        
        //2 user_workyard table
        //insert user_workyard
        $Workyard->users()->attach($user_id);
        
        //3 user table
        $user = Auth::user();
        $user->workyard_id = $Workyard->id;
        $res = $user->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $Workyard->id > 0
        ];
        return response()->json($res);
    }
    
    public function forbid($id)
    {
        $Workyard = Workyard::query()->find($id);
        $status   = $Workyard->status == Workyard::STATUS_ENABLED ? Workyard::STATUS_FORBIDDEN : Workyard::STATUS_ENABLED;
        $Workyard ->status = $status;
        $res = $Workyard->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }
    
    public function check($id)
    {
        try{
            DB::beginTransaction();
            $Workyard = Workyard::query()->find($id);
            //update workyard
            $status   = strtoupper($this->Request->input('status'));
            $Workyard ->status = $status;
            $Workyard->save();
            //add checkWorkyardRecords
            $values = [
                'workyard_id' => $id,
                'status' => $status,
                'desc' => $this->Request->input('desc'),
                'checked_by' => Auth::user()->username,
            ];
            //filter
            $values = $this->CheckWorkyardRecordFilter->filter($values);
            //  do save
            $Workyard->checkWorkyardRecords()->create($values);
            DB::commit();
            $res = true;
        }catch (\Exception $e ) {
            $res = $e->getMessage();
            DB::rollBack();
        }
        
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res === true,
            MyAjax::SUBMIT_MSG => $res,
        ];
        return response()->json($res);
    }
    
    public function edit($id) 
    {
        $values = $this->Request->input();
        //address
        $values = $this->processAddressArea($values);
        //filter
        $values = $this->WorkyardFilter->filter($values);
        //update
        $res = Workyard::query()->find($id)->update($values);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res === true,
            MyAjax::SUBMIT_MSG => $res,
        ];
        return response()->json($res);
    }
    
    private function processAddressArea($values)
    {
        //address
        $address_area = $values['address_area'];
        $address_area = explode(',', $address_area);
        $values['province'] = $address_area[0] ?? '';
        $values['city']     = $address_area[1] ?? '';
        $values['district'] = $address_area[2] ?? '';
        return $values;
    }
    
}
