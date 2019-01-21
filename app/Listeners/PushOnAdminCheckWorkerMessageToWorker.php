<?php

namespace App\Listeners;

use App\Events\OnWorkerSubmitCheck;
use App\Service\Weixiner;
use App\Events\OnAdminCheckWorker;
use App\Model\RoleStatus;

//当维修工程师提交审核，给管理员发送信息
class PushOnAdminCheckWorkerMessageToWorker
{
    const MSG_ID = '7NuLvkgI0lzhKtXL-ws5mvAfrst4HSqSA389C2vYSiY';//审核结果通知
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
    public function handle(OnAdminCheckWorker $event)
    {
        $worker = $event->worker;//维修工程师
        $status = $event->status;//审核结果
        $oauth = $worker->oauth()->where('type', 'WEIXIN')->first();
        $openid= $oauth->openid;
        $this->sendWeiXinMsg($openid, $status);
    }
    
    /**
     *
     *
     * @param string $openid
     * @param RepairOrder $repairOrder
     * @return
     */
    private function sendWeiXinMsg($openid, $status)
    {
        //拼接发送消息内容
        if($status == RoleStatus::WORKER_ENABLED) {
            //审核通过
            $keyword1 = '审核通过';
            $remark = '您可以维修接单了';
            $url    = "http://fuwu.jjhycom.cn/weixin";//点击打开的页面
        }else {
            //审核未通过
            $keyword1 = '审核未通过';
            $remark = '请重新提交审核信息';
            $url    = "http://fuwu.jjhycom.cn/weixin/account";//点击打开的页面
        }
        $data = [
            'touser' => $openid,//接受方openid
            'template_id'=>self::MSG_ID,
            "url" =>$url,
            'data'=>[
                'first'=>[
                    'value'=> '您的维修工审核结果如下：',
                ],
                'keyword1'=>[
                    'value'=> $keyword1,//审核结果
                ],
                'keyword2'=>[
                    'value'=> date('Y-m-d H:i:s'),//审核时间
                ],
                'keyword3'=>[
                    'value'=> '',//备注
                ],
                'remark'=>[
                    "value" => $remark,
                ],
            ]
        ];
        $this->weixiner->sendMsg($data);
    }
}
