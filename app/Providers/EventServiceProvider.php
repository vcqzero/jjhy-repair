<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        //当有新维修单创建
        'App\Events\OnRepairOrderCreated' => [
            //给系统管理员发送信息
            //给维修工程师发送信息
            'App\Listeners\PushRepairOrderCreatedWeixinMessageToAdmin',
            'App\Listeners\PushRepairOrderCreatedWeixinMessageToWorker',
        ],
        
        //当维修工程师成功提交报价时
        'App\Events\OfferSubmit' => [
            //给项目管理员发送信息
            'App\Listeners\PushOfferSubmitWeixinMessage',
        ],
        //当维修工程师提交的报价被确认
        'App\Events\OfferConfirm' => [
            //给维修工程师发送信息
            'App\Listeners\PushOfferConfirmWeixinMessage',
        ],
        
        //当维修单被系统管理员指派维修工程师时
        'App\Events\DistributeRepairOrder' => [
            //给维修工程师发送信息
            'App\Listeners\PushDistributeRepairOrderWeixinMessageToWorker',
            //给项目管理员发送信息
            'App\Listeners\PushDistributeRepairOrderWeixinMessageToWorkaydAdmin',
        ],
        
        //当维修工程师提交申请
        'App\Events\OnWorkerSubmitCheck' => [
            //给维修工程师发送信息
            'App\Listeners\PushWorkerSubmitCheckMessageToAdmin',
        ],
        
        //当处理维修工程师申请
        'App\Events\OnAdminCheckWorker' => [
            //给维修工程师发送信息
            'App\Listeners\PushOnAdminCheckWorkerMessageToWorker',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
