<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Offer;
use App\Model\RepairOrder;
use Illuminate\Support\Facades\Auth;
use App\Model\Settings;

class OfferController extends Controller
{
    private $Request;
    private $Settings;
    public function __construct(
        Request $Request,
        Settings $Settings
        )
    {
        $this->Request = $Request;
        $this->Settings= $Settings;
    }
    
    public function add($repair_order_id)
    {
        $repairOrder = RepairOrder::query()->find($repair_order_id);
        $can_offer_price = $this->Settings->canOfferPrice();
        return response()->view('weixin.offer.add', [
            'repairOrder' => $repairOrder,
            'can_offer_price' => $can_offer_price,
        ]);
    }
    
    public function edit($id)
    {
        $offer = Offer::query()->find($id);
        $can_offer_price = $this->Settings->canOfferPrice();
        return response()->view('weixin.offer.edit', [
            'offer'=>$offer,
            'can_offer_price' => $can_offer_price,
        ]);
    }
    
    //获取分页数据
    //需要在url中query参数中增加page=1的参数
    public function paginateCompleted()
    {
        //如果直接返回分页对象，则框架自动将分页对象
        //生成json格式，具体可查看文档
        $user = Auth::user();
        $repairOrders = $user->repairOrders()
        ->where('status', 'COMPLETED')
        ->latest()
        ->simplePaginate(3);
        //一般情况下可返回视图文件
        return response()->view('weixin.offer.partial.tab-completed', ['repairOrders' => $repairOrders]);
    }
    
    public function paginateFailed()
    {
        //如果直接返回分页对象，则框架自动将分页对象
        //生成json格式，具体可查看文档
        $offers = Offer::query()->whereIn('status', ['FAILED', 'REFUSEED'])->simplePaginate(3);
        //一般情况下可返回视图文件
        return response()->view('weixin.offer.partial.tab-failed', ['offers' => $offers]);
    }
    
    //报价成功页面
    public function success()
    {
        return response()->view('weixin.offer.success');
    }
}
