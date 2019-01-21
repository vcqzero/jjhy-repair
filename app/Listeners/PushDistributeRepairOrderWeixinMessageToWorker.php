<?php

namespace App\Listeners;

use App\Events\DistributeRepairOrder;
use App\Service\Weixiner;

/**
* 当订单被管理员分配，不进行抢单时，
* 发送分配信息给维修工
* 
*/
class PushDistributeRepairOrderWeixinMessageToWorker
{
    const MSG_ID = '4pTmJJ3wscZvJO63b_a7wkW4psrL10klKG9CltHkEuM';
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
     * @param  DistributeRepairOrder  $event
     * @return void
     */
    public function handle(DistributeRepairOrder $event)
    {
        $RepairOrder = $event->RepairOrder;
        $oauth = $RepairOrder->worker->oauth()->where('type', 'WEIXIN')->first();
        $openid= $oauth->openid;
        $this->sendWeiXinMsg($openid, $RepairOrder);
    }
    
    private function sendWeiXinMsg($openid, $repairOrder)
    {
        //拼接发送消息内容
        $contact_user   = $repairOrder->contact_user;
        $contact_tel    = $repairOrder->contact_tel;
        $workyard_name  = $repairOrder->workyard->name;
        $repair_type_name = $repairOrder->repair_type->name;
        $desc = $repairOrder->desc;
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
            "url" =>"http://fuwu.jjhycom.cn/weixin/worker/repair-order",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '接单成功！',
//                     "color"=>"#173177"
                ],
                'keyword1'=>[
                    'value'=> $workyard_name,//报修单位
                ],
                'keyword2'=>[
                    'value'=> date('Y-m-d H:i:s'),//报修时间
                ],
                'keyword3'=>[
                    'value'=> $contact_user,//报修人
                ],
                'keyword4'=>[
                    'value'=> $contact_tel,//手机号码
                ],
                'keyword5'=>[
                    'value'=> $repair_type_name . ':' . $desc,//故障描述
                ],
                'remark'=>[
                    "value" =>'请联系项目，开始维修工作',
//                     "color" =>"#173177",
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
