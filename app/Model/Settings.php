<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //项目创建是否需要审核
    const KEY_NEED_CHECK_WORKYARD_ON_CREAT = 'need_check_workyard_on_create';
    const VALUE_KEY_NEED_CHECK_WORKYARD_ON_CREAT_YES= 'yes';
    const VALUE_KEY_NEED_CHECK_WORKYARD_ON_CREAT_NO= 'no';
    //工人是否可对维修单报价
    const KEY_CAN_OFFFER_REPAIR_ORDER = 'can_offer_repair_order';
    const VALUE_CAN_OFFFER_REPAIR_ORDER_YES= 'yes';
    const VALUE_CAN_OFFFER_REPAIR_ORDER_NO= 'no';
    
    //报价时是否可填写价格
    const KEY_CAN_OFFFER_PRICE          = 'can_offer_price';
    const VALUE_CAN_OFFFER_PRICE_YES    = 'yes';//可以填写价格
    const VALUE_CAN_OFFFER_PRICE_NO     = 'no';//不可填写价格
    
    /**
     * tablename
     * @var string
     */
    protected $table = 'settings';
    
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
    
    /**
    * 创建项目是否需要审核
    * 
    * @return bool       
    */
    public function needCheck()
    {
        $Setting = Settings::query()->where('name', self::KEY_NEED_CHECK_WORKYARD_ON_CREAT)->first();
        
        return $Setting->value == self::VALUE_KEY_NEED_CHECK_WORKYARD_ON_CREAT_YES;
    }
    
    /**
    * 是否可抢单报价
    * 
    * @return bool       
    */
    public function canOffer()
    {
        $Setting = Settings::query()->where('name', self::KEY_CAN_OFFFER_REPAIR_ORDER)->first();
        return $Setting->value == self::VALUE_CAN_OFFFER_REPAIR_ORDER_YES;
    }
    
    /**
    * 报价时是否可填写价格
    * 
    * @return bool       
    */
    public function canOfferPrice()
    {
        $Setting = Settings::query()->where('name', self::KEY_CAN_OFFFER_PRICE)->first();
        return $Setting->value == self::VALUE_CAN_OFFFER_PRICE_YES;
    }
}
