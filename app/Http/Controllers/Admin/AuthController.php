<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    //goto login page
    public function login($id=null)
    {
        $post = $this->Request->request;
        $query= $this->Request->query;
        return response()->view('admin.auth.login');
    }
}
