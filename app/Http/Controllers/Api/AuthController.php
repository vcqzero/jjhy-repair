<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tool\MyAjax;

class AuthController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function login()
    {
        $identity = $this->Request->only(['username', 'password']);
        $remember = $this->Request->input('remember', '');
        $remember = !empty($remember);
        $res = Auth::attempt($identity, $remember);
        
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res,
        ];
        return response()->json($res);
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin/login');
    }
}
