<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RoleStatus;
use App\Model\User;
use App\Model\Role;

class WorkyardAdminController extends Controller
{
    private $Request;
    
    public function __construct(
        Request $Request
        )
    {
        $this->Request = $Request;
    }
    
    //禁用或启用
    public function forbid($id)
    {
        $worker = User::query()->find($id);
        $role   = $worker->roles_on_owning()->where('name', Role::WORKYARD_ADMIN)->first();
        $status = $role->pivot->status;
        $set = [
            'status' => $status == RoleStatus::WORKYARD_ADMIN_ENABLED ? RoleStatus::WORKYARD_ADMIN_FORBIDDEN : RoleStatus::WORKYARD_ADMIN_ENABLED
        ];
        $res = $worker->roles_on_owning()->updateExistingPivot(Role::WORKYARD_ADMIN, $set);
        return response()->json($res > 0);
    }
}
