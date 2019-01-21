<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Offer;
use App\Model\OfferStatus;
use Illuminate\Support\Facades\DB;
use App\Model\RepairOrder;
use App\Model\RepairOrderStatus;
use App\Tool\MyAjax;
use Illuminate\Support\Facades\Auth;
use App\Events\OfferSubmit;
use App\Events\OfferConfirm;

class OfferController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    //项目管理员同意维修工报价
    public function confirm($offer_id, $repair_order_id)
    {
        try{
            DB::beginTransaction();
            //1 update offer
            $offer = Offer::query()->find($offer_id);
            $offer->status = OfferStatus::CONFIRM;
            $res = $offer->save();
            //2 update repair-order
            $repair_order = RepairOrder::query()->find($repair_order_id);
            $repair_order->offer_id = $offer_id;
            $repair_order->worker_id = $offer->user->id;
            $repair_order->confirmed_at= date('Y-m-d H:i:s');
            $repair_order->status = RepairOrderStatus::STATUS_WORKING;
            $res = $repair_order->save();
            //3 将其他等待确认的报价失效
            $value = [
                'status'=>OfferStatus::FAILED
            ];
            $repair_order->offers()->where('status', OfferStatus::WAIT_CONFIRM)->update($value);
            DB::commit();
        }catch (\Exception $e ){
            DB::rollBack();
            $res = false;
        }
        if($res) event(new OfferConfirm($offer));
        return response()->json($res);
    }
    
    //项目管理员拒绝维修工报价
    public function refuse($id)
    {
        $offer = Offer::query()->find($id);
        $offer->status = OfferStatus::REFUSE;
        $res = $offer->save();
        return response()->json($res);
    }
    
    //维修工修改报价
    public function edit($id)
    {
        $offer = Offer::query()->find($id);
        $price = $this->Request->input('price');
        $days  = $this->Request->input('days');
        if($price) $offer->price = $price;
        $offer->days  = $days;
        $res = $offer->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }
    
    //维修工取消报价
    public function cancel($id)
    {
        $offer = Offer::query()->find($id);
        $offer->status = OfferStatus::FAILED;
        $res = $offer->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        return response()->json($res);
    }
    
    //维修工进行报价
    public function add(Offer $OfferModel)
    {
        //获取信息
        $price = $this->Request->input('price', 0);
        $days  = $this->Request->input('days');
        $repair_order_id= $this->Request->input('repair_order_id');
        
        //需要进行层次验证
        if($OfferModel->canOffer($repair_order_id) == false) {
            $res = [
                MyAjax::SUBMIT_SUCCESS => false
            ];
            return response()->json($res);
        }
        
        //验证完成，进行保存
        $offer = new Offer();
        $offer->price = $price;
        $offer->days  = $days;
        $offer->repair_order_id= $repair_order_id;
        $offer->user_id = Auth::id();
        $offer->status  = OfferStatus::WAIT_CONFIRM;
        $res = $offer->save();
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res
        ];
        MyAjax::close($res);
        //发送事件
        event(new OfferSubmit($offer));
        exit();
    }
}
