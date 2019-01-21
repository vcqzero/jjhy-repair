<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * tablename
     * @var string
     */
    protected $table = 'users';
    
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * 执行模型是否自动维护时间戳.
     * 默认情况下, Eloquent 会假定
     * 你的表中存在 created_at 和 updated_at 字段. 
     * 如果你不想让 Eloquent 自动管理这俩个列, 
     * 可以在你的模型中将 $timestamps 属性设置为 false:
     * @var bool
     */
    public $timestamps = true;
    
    /**
    * 获取此用户所辖所有workyards
    * 
    * @return Workyard       
    */
    public function workyards()
    {
        return $this->belongsToMany(Workyard::class);
    }
    
    /**
    * 获取此用户所辖workyard
    * 
    * @return Workyard       
    */
    public function workyard()
    {
        return $this->belongsTo(Workyard::class);
    }
    
    /**
    * 获取所有的oauth登录记录
    * 
    * @return Oauth       
    */
    public function oauth()
    {
        return $this->hasMany(Oauth::class);
    }
    
    /**
    * get all offers 
    * 
    * @return Offer        
    */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    
    
    /**
    * 获取 当前使用角色 的模型
    * 
    * @return Role       
    */
    public function role_on_using()
    {
        return $this->belongsTo(Role::class, 'role', 'name')->withDefault();
    }
    
    /**
     * 获取 此用户的所有角色
     *
     * @return Role
     */
    public function roles_on_owning()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role', 'id', 'name')
        ->withPivot(['status', 'worker_type'])
        ->withTimestamps();;
    }
    
    //查询出所有维修的订单
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class, 'worker_id');
    }
    
    /**
    * get skills
    * 
    * @param  
    * @return        
    */
    public function skill()
    {
        return $this->hasOne(Skill::class)->withDefault();
    }
    
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
