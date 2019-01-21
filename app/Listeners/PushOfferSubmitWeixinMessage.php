<?php

namespace App\Listeners;

use App\Events\OfferSubmit;
use App\Service\Weixiner;

/**
* 监听维修工报价时间
* 当维修工对维修订单进行报价之后
* 发送微信消息给项目管理员
*/
class PushOfferSubmitWeixinMessage
{
    //维修模板id
    const MSG_ID = 'C3_ih8nrPIuV8u-3LHrT5j5NJv9rasKnvRpX595QBec';
    
    private  $weixiner;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Weixiner $weixiner)
    {
        
        $this->weixiner = $weixiner;
    }

    /**
     * Handle the event.
     *
     * @param  OfferSubmit  $event
     * @return void
     */
    public function handle(OfferSubmit $event)
    {
        //获取维修工提交的报价单实例
        $offer = $event->offer;
        $order = $offer->repair_order->order;
        $oauth = $offer->repair_order->user->oauth()->where('type', 'WEIXIN')->first();
        $openid= $oauth->openid;
        $this->sendWeiXinMsg($openid, $order);
    }
    
    private function sendWeiXinMsg($openid, $order)
    {
        //拼接发送消息内容
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
            "url" =>"http://fuwu.jjhycom.cn/weixin/repair-order",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '有新的维修工报价',
                ],
                'keyword1'=>[
                    'value'=> $order,
                ],
                'keyword2'=>[
                    'value'=> date('Y-m-d H:i:s'),
                ],
                'remark'=>[
                    "value" =>'请尽快进行审核',
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
    
}
