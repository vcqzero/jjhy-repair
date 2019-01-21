<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RepairOrder extends Model
{
    /**
     * tablename
     * @var string
     */
    protected $table = 'repair_orders';
    
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
    
    //创建该订单的用户
    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault();
    }
    
    public function repair_type()
    {
        return $this->belongsTo(RepairType::class)->withDefault();
    }
    
    public function workyard()
    {
        return $this->belongsTo(Workyard::class)->withDefault();
    }
    
    public function repair_order_status()
    {
        return $this->belongsTo(RepairOrderStatus::class, 'status', 'name');
    }
    
    public function repair_order_grade()
    {
        return $this->belongsTo(RepairOrderGrade::class, 'grade', 'name');
    }
    
    /**
     * 获取该维修单的所有报价
     * 和下面的offer区别开
     *
     * @return Offer
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    
    /**
    * 获取该维修单确认的报价
    * 
    * @return Offer       
    */
    public function offer()
    {
        return $this->belongsTo(Offer::class)->withDefault();
    }
    
    //获取指定的维修工
    //可以通过判断是否存在offer来区分是系统派单还是正常报价
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id')->withDefault();
    }
    
    /**
    * 生成一个维修单号
    * 
    * @param int $user_id  
    * @param int $workyard_id  
    * @return string      
    */
    public function generateOrder()
    {
        //订单规则
        $order = '1';//业务规则 1 代表着维修订单
        $order .= date('ymdHis');//年后两位 + 月 + 日
        $order .= mt_rand(100, 999);
        return $order;
    }
    
    /**
    * 判断是否可新增维修单
    * 
    * @param int $workyard_id 
    * @return bool       
    */
    public function canAdd($workyard_id)
    {
        $workyard = Workyard::query()->find($workyard_id);
        if($workyard->status != 'ENABLED') return false;
        
        $user = Auth::user();
        //用户角色
        $role = $user->role;
        if($role != 'WORKYARD_ADMIN') return false;
        $worker_role = $user->roles_on_owning()->where('name', 'WORKYARD_ADMIN')->first();
        $worker_role_status = $worker_role->pivot->status;
        if($worker_role_status != 'WORKYARD_ADMIN_ENABLED') return false;
        return true;
    }
}
