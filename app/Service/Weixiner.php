<?php
namespace App\Service;

use Illuminate\Support\Facades\Cache;
use App\Tool\MyCurl;
use App\Model\Oauth;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Model\Role;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Object_;
// use Illuminate\Support\Facades\Facade;

class Weixiner
{
    const CACHE_KEY_WEIXIN_TOKEN = 'weixin-token';
    const CACHE_KEY_WEIXIN_JSAPI_TICKET = 'weixin-jsapi-ticket';
    const CACHE_KEY_WEIXIN_USERINFO = 'weixin_userinfo_';
    
    //微信中access_token等内容的失效时间
    const EXPIRES_IN = 7200;
    
    /**
    * 静默状态：用户进入页面即可获取授权
    * 仅可获取到openid
    * 如果是关注用户可通过openid获取user info
    * 对于非关注用户不可获取user info
    */
    const SCOPE_SNSAPI_BASE = 'snsapi_base';
    //用户感知：需要主动点击同意的情况下获取授权
    const SCOPE_SNSAPI_USER_INFO = 'snsapi_userinfo';
    
    private $appid;
    private $secret;

    public function __construct(
        )
    {
        $weixin = config('custome.weixin');
        $this->appid = $weixin['appid'];
        $this->secret= $weixin['secret'];
    }
    
    /**
     * fetch the access_token array 
     *
     * @return string $access_token
     */
    public function getAccessToken($force = false)
    {
        //get access token
        $url = 'http://index.jjhycom.cn/api/access-token';
        $res = MyCurl::get($url);
        $access_token = $res['access_token'];
        return $access_token;
    }
    
    /**
    * 从缓存中获取用户微信信息
    * 
    * @param string $openid 
    * @return \stdClass $userinfo      
    */
    public function getUserInfoFromCached($openid)
    {
        //get access token
        $url = 'http://index.jjhycom.cn/api/userinfo?openid=' . $openid;
        $res = MyCurl::get($url, null, null, false);
        $userinfo = $res->userinfo;
        return $userinfo;
    }
    
    
    public function oauth($openid)
    {
        //如果在数据表中没有记录则需要
        $Oauth = Oauth::query()->where('openid', $openid)->first();
        if (empty($Oauth ->id)) {
            //1 create user
            //empty content
            $values_user = [
                'username'=>$openid,
                'role'    => Role::GUEST,
            ];
            $User    = User::query()->where('username', $openid)->firstOrCreate($values_user);
            // create oauth
            $vaules = [
                'type'      => Oauth::TYPE_WEIXIN,
                'openid'    => $openid,
            ];
            $User->oauth()->create($vaules);
        }else {
            $User = $Oauth->user;
        }
        if(empty($User)) {
            throw new \Exception('请检查oauth是否存在重复->' . $openid);
        }
        Auth::login($User, true);
    }
    
    public function sendMsg(array $data) 
    {
        $url="http://index.jjhycom.cn/api/message";
        $data = json_encode($data);
        $data = ['data'=>$data];
        //post 发送
        $res = MyCurl::post($data, $url);
    }
}

