<?php

namespace App\Listeners;

use App\Events\OnWorkerSubmitCheck;
use App\Service\Weixiner;

//当维修工程师提交审核，给管理员发送信息
class PushWorkerSubmitCheckMessageToAdmin
{
    const MSG_ID = '2sz5Dv3LFqwL880PBWgU9H_rZpn1fq23BRy9-5_D4Xs';
    private $admin_openids = [
        'oy38vxD8aqaLV5pajqoR1kqA1Hqc',//邢烟酒
        'oy38vxJlama09hJXcr9jsUob25Rg',//秦崇
    ];
    private $weixiner;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Weixiner $weixiner)
    {
        //
        $this->weixiner = $weixiner;
    }

    /**
     * Handle the event.
     *
     * @param  OnWorkerSubmitCheck  $event
     * @return void
     */
    public function handle(OnWorkerSubmitCheck $event)
    {
        //提交审核的维修工程师信息
        $worker = $event->worker;
        foreach ($this->admin_openids as $openid) {
            $this->sendWeiXinMsg($openid, $worker);
        }
    }
    
    /**
     *
     *
     * @param string $openid
     * @param RepairOrder $repairOrder
     * @return
     */
    private function sendWeiXinMsg($openid, $worker)
    {
        //拼接发送消息内容
        $worker_name = $worker->realname;
        $worker_tel  = $worker->tel;
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
//             "url" =>"http://fuwu.jjhycom.cn/weixin",//点击打开的页面
            'data'=>[
                'first'=>[
                    'value'=> '维修工程师审核',
                ],
                'keyword1'=>[
                    'value'=> '维修工程师审核',//申请类型
                ],
                'keyword2'=>[
                    'value'=> $worker_name,//申请人姓名
                ],
                'keyword3'=>[
                    'value'=> $worker_tel,//申请人电话
                ],
                'keyword4'=>[
                    'value'=> date('Y-m-d H:i:s'),//申请时间
                ],
                'keyword5'=>[
                    'value'=> '请尽快审核维修工信息',//申请内容
                ],
                'remark'=>[
                    "value" =>'',
                    "color" =>"#173177",
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
