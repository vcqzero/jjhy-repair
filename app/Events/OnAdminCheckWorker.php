<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class OnAdminCheckWorker
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $worker;//审核的对象
    public $status;//审核结果
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($worker, $status)
    {
        $this->worker = $worker;
        $this->status = $status;
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
