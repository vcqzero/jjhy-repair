<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Model\User;

class WorkyardAminController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        return response()->view('admin.workyard-admin.index');
    }
    
    public function tableData($status)
    {
        $status = strtoupper($status);
        $workers = User::query()->whereHas('roles_on_owning', function($query) use($status) {
            $query->where('name', 'WORKYARD_ADMIN')->where('role_user.status', $status);
        })->with('workyards')->with('roles_on_owning')->get();
        return response()->json(['data'=>$workers]);
    }
    
    public function view($id)
    {
        $user= User::query()->with('workyards')->find($id);
        return response()->view('admin.workyard-admin.view', ['user'=>$user]);
    }
    
    public function forbid($id)
    {
        $user= User::query()->find($id);
        return response()->view('admin.workyard-admin.forbid', ['user'=>$user]);
    }
}
