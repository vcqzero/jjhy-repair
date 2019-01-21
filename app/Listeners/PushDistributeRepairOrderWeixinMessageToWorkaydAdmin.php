<?php

namespace App\Listeners;

use App\Events\DistributeRepairOrder;
use App\Service\Weixiner;

/**
* 当管理员为某订单指定维修工时，
* 给订单创建人发送确认消息
*/
class PushDistributeRepairOrderWeixinMessageToWorkaydAdmin
{
    const MSG_ID = 'FDCkM_X57YRI3SY-peBrteMRNsxX8HVyp3SGw8FVGkc';
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
        $oauth = $RepairOrder->user->oauth()->where('type', 'WEIXIN')->first();
        $openid= $oauth->openid;
        $this->sendWeiXinMsg($openid, $RepairOrder);
    }
    
    private function sendWeiXinMsg($openid, $repaird_order)
    {
        $worker   = $repaird_order->worker;
        $worker_name = $worker->realname;
        $worker_tel  = $worker->tel;
        $repair_type_name = $repaird_order->repair_type->name;
        $order = $repaird_order->order;
        //拼接发送消息内容
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
            "url" =>"http://fuwu.jjhycom.cn/weixin/repair-order",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '您的报修申请已有维修工程师接单！',
                ],
                'keyword1'=>[
                    'value'=> $order,//服务单号
                ],
                'keyword2'=>[
                    'value'=> '报修受理成功',//状态
                ],
                'keyword3'=>[
                    'value'=> $worker_name,//工程师
                ],
                'keyword4'=>[
                    'value'=> $worker_tel,//手机号码
                ],
                'keyword5'=>[
                    'value'=> date('Y-m-d H:i:s'),//时间
                ],
                'remark'=>[
                    "value" =>'请联系工程师进行维修！',
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
