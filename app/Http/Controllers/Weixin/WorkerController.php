<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function repairOrder()
    {
        return  response()->view('weixin.worker.repair-order');
    }
    
    public function addInfo()
    {
        return  response()->view('weixin.worker.add-info');
    }
    
    public function edit()
    {
        return  response()->view('weixin.worker.edit');
    }
    
    //goto addCertificate page
    public function addCertificate()
    {
        return response()->view('weixin.worker.add-certificate');
    }
    
    //goto viewCertificate page
    public function viewCertificate()
    {
        $user = Auth::user();
        $certificates = $user->certificates;
        return response()->json(['certificates'=>$certificates]);
    }
    
    public function addInfoSuccess()
    {
        return response()->view('weixin.worker.add-info-success');
    }
    
}
