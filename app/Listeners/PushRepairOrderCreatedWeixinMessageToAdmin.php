<?php

namespace App\Listeners;

use App\Events\OnRepairOrderCreated;
use App\Service\Weixiner;
use App\Model\RepairOrder;

class PushRepairOrderCreatedWeixinMessageToAdmin
{
    //https://mp.weixin.qq.com/advanced/tmplmsg?action=tmpl_preview&t=tmplmsg/preview&id=OPENTM417779788&token=216266834&lang=zh_CN
    const MSG_ID = '4pTmJJ3wscZvJO63b_a7wkW4psrL10klKG9CltHkEuM';//报修受理通知
    private $admin_openids = [
        'oy38vxD8aqaLV5pajqoR1kqA1Hqc',//邢烟酒
        'oy38vxJlama09hJXcr9jsUob25Rg',//秦崇
    ];
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
        $repairOrder    = $event->repairOrder;
        $openids        = $this->admin_openids;
        foreach ($openids as $openid) {
            $this->sendWeiXinMsg($openid, $repairOrder);
        }
    }
    
    /**
    * 
    * 
    * @param string $openid
    * @param RepairOrder $repairOrder 订单
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
//             "url" =>"http://fuwu.jjhycom.cn/weixin/repair-order",//点击打开的页面
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
                    "value" =>'请登录管理后台，查看更多信息',
                    "color" =>"#173177",
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
