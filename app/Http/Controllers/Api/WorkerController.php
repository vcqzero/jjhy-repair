<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tool\MyAjax;
use App\Model\RoleStatus;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Role;
use App\Model\WorkerType;
use Illuminate\Support\Facades\Storage;
use App\Events\OnWorkerSubmitCheck;
use App\Events\OnAdminCheckWorker;

class WorkerController extends Controller
{
    private $Request;
    
    public function __construct(
        Request $Request
        )
    {
        $this->Request = $Request;
    }
    
    public function add()
    {
        $address_area   = $this->Request->input('address_area');
        $realname       = $this->Request->input('realname');
        $tel            = $this->Request->input('tel');
        try{
           DB::beginTransaction();  
           //update user
           $user = Auth::user();
           $values = [
               'realname' => $realname,
               'tel' => $tel,
           ];
           $values = $this->processAddressArea($values, $address_area);
           $user->update($values);
           
           //skill
           $skill = $this->Request->input('skill');
           $values = [
               'skill'=>$skill
           ];
           $user->skill()->create($values);
           
           
           //update role status
           $role  = $user->role;
           $values = [
               'status'=>RoleStatus::WORKER_ADD_CERTIFICATE,
               'worker_type'=>WorkerType::PART_TIME,
           ];
           $user->roles_on_owning()->updateExistingPivot($role, $values);
           DB::commit();
           $res = true;
        }catch (\Exception $e ){
            $res = false;
           DB::rollBack();
        }
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }
    
    public function edit()
    {
        $address_area = $this->Request->input('address_area');
        $realname   = $this->Request->input('realname');
        $tel        = $this->Request->input('tel');
        try{
           DB::beginTransaction();  
           //update user
           $user = Auth::user();
           $values = [
               'realname' => $realname,
               'tel' => $tel,
           ];
           $values = $this->processAddressArea($values, $address_area);
           $user->update($values);
           
           //skill
           $skill      = $this->Request->input('skill');
           $values = [
               'skill'=>$skill
           ];
           $user->skill()->update($values);
           
           DB::commit();
           $res = true;
        }catch (\Exception $e ){
            $res = $e->getMessage();
           DB::rollBack();
        }
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res === true,
            MyAjax::SUBMIT_MSG => $res ,
        ];
        return response()->json($res);
    }
    
    //管理员禁用维修工
    public function forbid($id)
    {
        $worker = User::query()->find($id);
        $role   = $worker->roles_on_owning()->where('name', 'WORKER')->first();
        $status = $role->pivot->status;
        $set = [
            'status' => $status == RoleStatus::WORKER_ENABLED ? RoleStatus::WORKER_FORBIDDEN : RoleStatus::WORKER_ENABLED
        ];
        $res = $worker->roles_on_owning()->updateExistingPivot(Role::WORKER, $set);
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }
    
    //改变维修工兼职还是全职
    public function type($type, $id)
    {
        $user = User::query()->find($id);
        $value = [
            'worker_type' => $type,
        ];
        $res = $user->roles_on_owning()->updateExistingPivot(Role::WORKER, $value);
        return response()->json($res > 0);
    }
    
    private function processAddressArea($values, $address_area)
    {
        //address
        $address_area = explode(',', $address_area);
        $values['province'] = $address_area[0] ?? '';
        $values['city']     = $address_area[1] ?? '';
        $values['district'] = $address_area[2] ?? '';
        return $values;
    }
    
    // addCertificate
    public function addCertificate()
    {
        $name = 'certificate';
        $path = 'certificate';
        //将文件保存到文件中
        $path = $this->Request->file($name)->store($path, 'public');
        $url = Storage::url($path);
        
        //然后保存到数据库中
        $id = Auth::id();
        $worker = User::query()->find($id);
        $values = [
            'url' => $url,
        ];
        $worker->certificates()->create($values);
        //修改工人状态为待审核
        $values = [
            'status'=>RoleStatus::WORKER_WAIT_CHECK
        ];
        $worker->roles_on_owning()->updateExistingPivot(Role::WORKER, $values);
        $res = [
            'url' => $url
        ];
        if($res) event(new OnWorkerSubmitCheck($worker));
        return response()->json($res);
    }
    
    //删除文件
    public function deleteCertificate()
    {
        //从文件系统中删除
        $url = $this->Request->input('url');
        $path = str_replace('/storage/', '', $url);
        Storage::disk('public')->delete($path);
        //从数据库中删除
        $id = Auth::id();
        $worker = User::query()->find($id);
        $worker->certificates()->where('url', $url)->delete();
        return response()->json(true);
    }
    
    //审核维修工程师
    public function check($id)
    {
        $worker = User::query()->find($id);
        $status = strtoupper($this->Request->input('status'));
        $values = [
            'status'=>$status
        ];
        $worker->roles_on_owning()->updateExistingPivot(Role::WORKER, $values);
        //如果审核失败，需要将已上传的保险信息删除
        if($status == RoleStatus::WORKER_FAILED_CHECK) {
            $certificates = $worker->certificates;
            foreach ($certificates as $certificate) 
            {
                $url = $certificate->url;
                //从文件系统中删除
                $path = str_replace('/storage/', '', $url);
                Storage::disk('public')->delete($path);
                //从数据库中删除
                $worker->certificates()->where('url', $url)->delete();
            }
        }
        event(new OnAdminCheckWorker($worker, $status));
        return response()->json(true);
    }
}
