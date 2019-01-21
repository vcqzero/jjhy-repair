<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    //goto login page
    public function index()
    {
        $post = $this->Request->request;
        $query= $this->Request->query;
        $user = Auth::user();
        
        return response()->view('admin.account.index', ['user'=> $user]);
    }
}
