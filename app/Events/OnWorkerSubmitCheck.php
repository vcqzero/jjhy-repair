<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Model\User;

//当维修工程师提交审核
class OnWorkerSubmitCheck
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $worker;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $worker)
    {
        //
        $this->worker = $worker;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
