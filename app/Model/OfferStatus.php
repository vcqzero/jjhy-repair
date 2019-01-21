<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OfferStatus extends Model
{
    const WAIT_CONFIRM  = 'WAIT_CONFIRM';
    const REFUSE        = 'REFUSEED';
    const CONFIRM       = 'CONFIRMED';
    const FAILED        = 'FAILED';//报价失败，包括订单被其他人报价成功等
    /**
     * tablename
     * @var string
     */
    protected $table = 'offers_status';
    
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * 执行模型是否自动维护时间戳.
     * 默认情况下, Eloquent 会假定
     * 你的表中存在 created_at 和 updated_at 字段. 
     * 如果你不想让 Eloquent 自动管理这俩个列, 
     * 可以在你的模型中将 $timestamps 属性设置为 false:
     * @var bool
     */
    public $timestamps = true;
    
}
