<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zend\Config\Reader\Xml;
use App\Service\Weixiner;

class WeixinController extends Controller
{
    private $Request;
    
    public function __construct(
        Request $Request
        )
    {
        $this->Request = $Request;
    }
    
    //当微信开启自动上报用户位置之后
    //会将用户信息推送到此地址
    //保存用户位置信息到服务器
    //docs https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140841
    public function storeWeixinLocation(Weixiner $Weixiner)
    {
        $xml = file_get_contents('php://input');
        if(empty($xml)) exit();
        $reader = new Xml();
        $xml    = $reader->fromString($xml);
        $openid = $xml['FromUserName'];
        $Weixiner->setUserLocation($openid, $xml);
    }
}
