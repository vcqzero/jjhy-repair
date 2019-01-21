<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Workyard extends Model
{
    const STATUS_WAIT_CHECK = 'WAIT_CHECK';//待审核
    const STATUS_CHECK_FAILED = 'CHECK_FAILED';//审核失败
    const STATUS_ENABLED = 'ENABLED';//正常
    const STATUS_FORBIDDEN= 'FORBIDDEN';//被禁用
    
    protected $table = 'workyards';
    
    /**
     * 不可被批量赋值的属性。
     * 为空，代表可批量赋值
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
    * get all users of this workyard
    * 
    * @param  
    * @return User       
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    /**
    * 获取所有审核记录
    * 
    * @param  
    * @return CheckedWorkyard       
    */
    public function checkWorkyardRecords()
    {
        return $this->hasMany(CheckWorkyardRecord::class);
    }
    
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class);
    }
    
    public function workyard_status()
    {
        return $this->belongsTo(WorkyardStatus::class, 'status', 'name');
    }
    
    /**
    * 检查是否可添加
    * 
    * @return bool      
    */
    public function canAdd()
    {
        $user = Auth::user();
        $role = $user->role;
        if($role === Role::SUPER_USER) return true;
        if($role != Role::WORKYARD_ADMIN) return false;
        $worker_role = $user->roles_on_owning()->where('name', 'WORKYARD_ADMIN')->first();
        $worker_role_status = $worker_role->pivot->status;
        if($worker_role_status != 'WORKYARD_ADMIN_ENABLED') return false;
        return true;
    }
    
}
