<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Workyard;

class WorkyardController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function add()
    {
        $User = Auth::user();
        return  response()->view('weixin.workyard.add', ['User'=>$User]);
    }
    
    public function edit($id)
    {
        $Workyard = Workyard::query()->find($id);
        return  response()->view('weixin.workyard.edit', ['Workyard'=>$Workyard]);
    }
    
}
