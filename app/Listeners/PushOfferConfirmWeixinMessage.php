<?php

namespace App\Listeners;

use App\Events\OfferConfirm;
use App\Service\Weixiner;

/**
* 当维修工提交的报价被确认之后
* 向维修工发送确认信息
* 
*/
class PushOfferConfirmWeixinMessage
{
    const MSG_ID = 'YN5qSWqDCNro2rn-It7s9cG4Dc-Lv7BHagbY5jba7Nk';
    private $weixiner;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Weixiner $weixiner)
    {
        $this->weixiner= $weixiner;
    }

    /**
     * Handle the event.
     *
     * @param  OfferConfirm  $event
     * @return void
     */
    public function handle(OfferConfirm $event)
    {
        $offer = $event->offer;
        $oauth = $offer->repair_order->user->oauth()->where('type', 'WEIXIN')->first();
        $openid= $oauth->openid;
        $this->sendWeiXinMsg($openid, $offer);
    }
    
    private function sendWeiXinMsg($openid, $offer)
    {
        $repaird_order  = $offer->repair_order;
        $contact_user   = $repaird_order->contact_user;
        $contact_tel    = $repaird_order->contact_tel;
        $workyard_name  = $repaird_order->workyard->name;
        $repair_type_name = $repaird_order->repair_type->name;
        //拼接发送消息内容
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
            "url" =>"http://fuwu.jjhycom.cn/weixin/worker/repair-order",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '您有新维修单',
                ],
                'keyword1'=>[
                    'value'=> $repair_type_name,//类别
                ],
                'keyword2'=>[
                    'value'=> $workyard_name,//报修单位
                ],
                'keyword3'=>[
                    'value'=> $workyard_name,//报修部门
                ],
                'keyword4'=>[
                    'value'=> $contact_user,//报修人
                ],
                'keyword5'=>[
                    'value'=> $contact_tel,//手机号码
                ],
                'remark'=>[
                    "value" =>'请尽快联系项目管理员，进行维修',
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
