<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RepairOrderStatus extends Model
{
    const STATUS_WAIR_DISTRIBUTE = 'WAIT_DISTRIBUTE';//等待管理员分配
    const STATUS_WAIR_WORKER = 'WAIR_WORKER';//等待维修工抢单
    const STATUS_WORKING    = 'WORKING';//正在维修中
    const STATUS_WAIT_PAY    = 'WAIT_PAY';//管理员同意报价 等待包工头付款
    const STATUS_COMPLETED  = 'COMPLETED';//订单完成
    const STATUS_CLOSED     = 'CLOSED';//订单被取消
    
    /**
     * tablename
     * @var string
     */
    protected $table = 'repair_order_status';
    
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
