<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkerType extends Model
{
    const PART_TIME   = 'PART_TIME';
    const FULL_TIME   = 'FULL_TIME';
    
    /**
     * tablename
     * @var string
     */
    protected $table = 'worker_types';
}
