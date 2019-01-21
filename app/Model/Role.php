<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const GUEST= 'GUEST';
    const SUPER_USER= 'SUPER_USER';
    const WORKER = 'WORKER';
    const WORKYARD_ADMIN = 'WORKYARD_ADMIN';
    /**
     * tablename
     * @var string
     */
    protected $table = 'roles';
    
    /**
    * 正在使用当前role的所有用户
    * one to one
    * 
    * @return User        
    */
    public function users_using_this_role()
    {
        return $this->hasMany(User::class, 'role', 'name');
    }
    
    /**
    * 拥有此角色的所有用户
    * many to many
    * 
    * @return User       
    */
    public function users_own_this_role()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role', 'user_id', 'name', 'id')->withPivot('status')->withTimestamps();
    }
}
