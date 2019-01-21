<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkyardStatus extends Model
{
    const STATUS_WAIT_CHECK = 'WAIT_CHECK';//待审核
    const STATUS_CHECK_FAILED = 'CHECK_FAILED';//审核失败
    const STATUS_ENABLED = 'ENABLED';//正常
    const STATUS_FORBIDDEN= 'FORBIDDEN';//被禁用
    
    protected $table = 'workyard_status';
    
    public function workyards()
    {
        return $this->hasMany(Workyard::class, 'status', 'name');
    }
}
