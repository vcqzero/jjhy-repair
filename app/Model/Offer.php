<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    /**
     * tablename
     * @var string
     */
    protected $table = 'offers';
    
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
    
    public function offer_status()
    {
        return $this->belongsTo(OfferStatus::class, 'status', 'name');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
    * 获取本次报价所属哪个项目
    * 
    * @return RepairOrder        
    */
    public function repair_order()
    {
        return $this->belongsTo(RepairOrder::class);
    }
    
    /**
    * 获取报价成功的维修项目
    * 
    * @return RepairOrder       
    */
    public function repair_order_confirm()
    {
        return $this->hasOne(RepairOrder::class)->withDefault();
    }
    
    /**
    * 验证是否可进行报价
    * 
    * @param  int $repair_order_id
    * @return bool        
    */
    public function canOffer($repair_order_id) {
        $user = Auth::user();
        //如果订单状态不是wait_worker
        $repair_order = RepairOrder::query()->find($repair_order_id);
        if($repair_order->status !== RepairOrderStatus::STATUS_WAIR_WORKER) return false;
        
        //如果用户角色不是worker
        if($user->role !== Role::WORKER) return false;
        
        //如果维修工的角色不是正常状态
        $worker_role = $user->roles_on_owning()->where('name', 'WORKER')->first();
        $worker_role_status = $worker_role->pivot->status;
        if($worker_role_status !== RoleStatus::WORKER_ENABLED) return false;
        
        //如果已经进行过报价
        $offers = $user->offers()->where(['repair_order_id' => $repair_order_id, 'status'=> 'WAIT_CONFIRM'])->get();
        if(count($offers)) return false;
        
        return true;
    }
}
