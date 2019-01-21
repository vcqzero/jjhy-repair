<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Weixiner;

class AuthController extends Controller
{
    private $Request;
    private $Weixiner;
    public function __construct(Request $Request, Weixiner $Weixiner)
    {
        $this->Request = $Request;
        $this->Weixiner= $Weixiner;
    }
    
    /**
    * 用户验证失败之后，并且是访问的微信链接
    * 进入此方法
    * 向微信请求用户的验证
    * 
    * @return void       
    */
    public function index()
    {
        //进行oauth认证
        $scope = 'snsapi_userinfo';
        $state = 1001;
        $url   = 'http://index.jjhycom.cn/api/oauth';
        $url   = "$url?scope=$scope&state=$state";
        return redirect()->away($url);
    }
    
    /**
    * 用户同意微信授权之后，进入此控制器
    * 
    * @return void       
    */
    public function oatuh()
    {
        $openid= $this->Request->query('openid');;
        $this->Weixiner->oauth($openid);
        return redirect('/weixin/');
    }
}
