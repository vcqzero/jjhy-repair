<?php

namespace App\Listeners;

use App\Events\OnRepairOrderCreated;
use App\Service\Weixiner;
use App\Model\RepairOrderStatus;
use App\Model\RepairOrder;
use App\Model\User;

class PushRepairOrderCreatedWeixinMessageToWorker
{
    const MSG_ID = '4pTmJJ3wscZvJO63b_a7wkW4psrL10klKG9CltHkEuM';
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
     * @param  OnRepairOrderCreated  $event
     * @return void
     */
    public function handle(OnRepairOrderCreated $event)
    {
        $repairOrder = $event->repairOrder;
        //如果该订单不可抢单，返回
        if ($repairOrder->status == RepairOrderStatus::STATUS_WAIR_DISTRIBUTE) return ;
        
        //查找出项目所在地所有维修工程师
        //分别向每位工程师发送信息
        $workyard = $repairOrder->workyard;
        $city = $workyard->city;
        $workers = User::query()->whereHas('roles_on_owning', function($query) {
            $query->where('name', 'WORKER')->where('role_user.status', 'WORKER_ENABLED');
        })->where(['city'=>$city, 'role' => 'WORKER'])->get();
        
        foreach ($workers as $worker) 
        {
            $oauth = $worker->oauth()->where('type', 'WEIXIN')->first();
            $openid= $oauth->openid;
            $this->sendWeiXinMsg($openid, $repairOrder);
        }
    }
    
    /**
     *
     *
     * @param string $openid
     * @param RepairOrder $repairOrder
     * @return
     */
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
            "url" =>"http://fuwu.jjhycom.cn/weixin",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '有新项目提交报修单',
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
                    "value" =>'请查看报修详情，进行接单',
                    "color" =>"#173177",
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
