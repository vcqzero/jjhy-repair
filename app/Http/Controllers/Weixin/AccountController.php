<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service\Weixiner;
use App\Model\Oauth;
use App\Model\Settings;

class AccountController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index(Weixiner $Weixiner, Settings $Settings)
    {
        $User  = Auth::user();
        $oauth = $User->oauth()->where('type', Oauth::TYPE_WEIXIN)->first();
        $openid= $oauth->openid;
        
        $weixin_userinfo = $Weixiner->getUserInfoFromCached($openid);
        //如果没有用户信息或者过期了
        //重新进行登录即可
        if(empty($weixin_userinfo)) {
            Auth::logout();
            return redirect()->refresh();
        }
        
        $User->weixin_userinfo = $weixin_userinfo;
        
        return  response()->view('weixin.account.index', ['User'=>$User]);
    }
}
