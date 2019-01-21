<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tool\MyAjax;
use App\Model\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Model\Role;
use App\Model\RoleStatus;

class AccountController extends Controller
{

    private $Request;

    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }

    public function edit()
    {
        $name = $this->Request->input('name');
        $vaule = $this->Request->input('value');
        
        // save
        $id = Auth::id();
        $user = User::query()->find($id);
        $user->$name = $vaule;
        $res = $user->save();
        // response
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }

    public function validPassword()
    {
        $old_password = $this->Request->query('old-password');
        $user = Auth::user();
        $hash = $user->password;
        $res = Hash::check($old_password, $hash);
        return response()->json($res);
    }

    public function password()
    {
        $password = $this->Request->input('password');
        $password = Hash::make($password);
        $id = Auth::id();
        $user = User::query()->find($id);
        $user->password = $password;
        $res = $user->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }

    public function avatar()
    {
        $name = 'avatar';
        $id = Auth::id();
        $path = 'avatar/' . $id;
        Storage::deleteDirectory('public/' . $path);
        $path = $this->Request->file($name)->store($path, 'public');
        $avatar = Storage::url($path);
        // save
        $user = User::query()->find($id);
        $user->$name = $avatar;
        $res = $user->save();
        // response
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }

    public function createRole($role)
    {
        $role = strtoupper($role);
        $user = Auth::user();
        $user->role = strtoupper($role);
        $res = $user->save();
        // 如果新增的是worker则需要设置worker状态
        if ($role == Role::WORKER) {
            $status = RoleStatus::WORKER_WAIT_INIT;
        } else {
            $status = RoleStatus::WORKYARD_ADMIN_ENABLED;
        }
        $value = [
            'status' => $status
        ];
        $res = $user->roles_on_owning()->attach($role, $value);
        return response()->json($res);
    }

    /**
     * update user
     * add role_user if not
     *
     * @param string $role            
     */
    public function changeRole()
    {
        $user = Auth::user();
        //get the role change to
        $role = $user->role == Role::WORKER ? Role::WORKYARD_ADMIN : Role::WORKER;
        $user->role = $role;
        $res = $user->save();
        
        // attach role_user if not attached before
        // query if atthached
        $count = $user->roles_on_owning()->where('name', $role)->count();
        
        if ($count > 0) return response()->json($res);
        
        if ($role == Role::WORKER) {
            $status = RoleStatus::WORKER_WAIT_INIT;
        } else {
            $status = RoleStatus::WORKYARD_ADMIN_ENABLED;
        }
        $value = [
            'status' => $status
        ];
        $res = $user->roles_on_owning()->attach($role, $value);
        
        return response()->json($res);
    }
}
