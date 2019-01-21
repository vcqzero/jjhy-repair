<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Model\RepairOrder;

class DistributeRepairOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $RepairOrder;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RepairOrder $RepairOrder)
    {
        $this->RepairOrder = $RepairOrder;
    }
}
