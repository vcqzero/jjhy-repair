<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrder;
use App\Events\OnRepairOrderCreated;
use App\Tool\MyCurl;
use App\Events\DistributeRepairOrder;
use App\Model\User;
use App\Events\OnWorkerSubmitCheck;
use App\Events\OnAdminCheckWorker;
use App\Model\RoleStatus;

class TestController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        $this->testOnAdminCheckWorker();
    }
    
    public function getUserinfo($openid)
    {
        //get access token
        $url = 'http://index.jjhycom.cn/api/userinfo?openid=' . $openid;
        $res = MyCurl::get($url);
        
        // DEBUG INFORMATION START
        echo '------debug start------<br/>';
        echo "<pre>";
        var_dump(__METHOD__ . ' on line: ' . __LINE__);
        var_dump($res);
        echo "</pre>";
        exit('------debug end------');
        // DEBUG INFORMATION END
        
    }
    
    public function getController()
    {
        $controller = $this->Request->route()->getActionName();
    }
    
    public function testSendToAdmin()
    {
        $id = 29;
        $RepairOrder = RepairOrder::query()->find($id);
        event(new OnRepairOrderCreated($RepairOrder));
        // DEBUG INFORMATION START
        echo '------debug start------<br/>';
        echo "<pre>";
        var_dump(__METHOD__ . ' on line: ' . __LINE__);
        var_dump('testSendToAdmin ok');
        echo "</pre>";
        exit('------debug end------');
        // DEBUG INFORMATION END
    }
    
    public function testOnDistribte()
    {
        $id = 30;
        $repairOrder= RepairOrder::query()->find($id);
        event(new DistributeRepairOrder($repairOrder));
        
        // DEBUG INFORMATION START
        echo '------debug start------<br/>';
        echo "<pre>";
        var_dump(__METHOD__ . ' on line: ' . __LINE__);
        var_dump('testOnDistribte ok');
        echo "</pre>";
        exit('------debug end------');
        // DEBUG INFORMATION END
    }
    
    public function testOnWorkerSubmitCheck()
    {
        $id = 40;
        $worker= User::query()->find($id);
        event(new OnWorkerSubmitCheck($worker));
        
        // DEBUG INFORMATION START
        echo '------debug start------<br/>';
        echo "<pre>";
        var_dump(__METHOD__ . ' on line: ' . __LINE__);
        var_dump('testOnWorkerSubmitCheck ok');
        echo "</pre>";
        exit('------debug end------');
        // DEBUG INFORMATION END
    }
    
    public function testOnAdminCheckWorker()
    {
        $id = 40;
        $worker= User::query()->find($id);
        $status= RoleStatus::WORKER_FAILED_CHECK;
        event(new OnAdminCheckWorker($worker, $status));
        
        // DEBUG INFORMATION START
        echo '------debug start------<br/>';
        echo "<pre>";
        var_dump(__METHOD__ . ' on line: ' . __LINE__);
        var_dump('testOnAdminCheckWorker ok');
        echo "</pre>";
        exit('------debug end------');
        // DEBUG INFORMATION END
    }
    
}
