<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleStatus extends Model
{
    const WORKER_ENABLED   = 'WORKER_ENABLED';
    const WORKER_FORBIDDEN = 'WORKER_FORBIDDEN';
    const WORKER_WAIT_INIT = 'WORKER_WAIT_INIT';//等待初始化，完成初始化才开进行报单  
    const WORKER_ADD_CERTIFICATE = 'WORKER_ADD_CERTIFICATE';//等待上传证书 
    const WORKER_WAIT_CHECK = 'WORKER_WAIT_CHECK';//已添加资料等待审核
    const WORKER_FAILED_CHECK = 'WORKER_FAILED_CHECK';//审核失败
    
    const WORKYARD_ADMIN_ENABLED  = 'WORKYARD_ADMIN_ENABLED';//
    const WORKYARD_ADMIN_FORBIDDEN= 'WORKYARD_ADMIN_FORBIDDEN';//  
    
    /**
     * tablename
     * @var string
     */
    protected $table = 'role_status';
}
