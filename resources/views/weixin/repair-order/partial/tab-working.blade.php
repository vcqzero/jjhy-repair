@foreach ($repairOrders as $repairOrder)
<div class="weui-form-preview">
    <!-- status -->
  	@include('weixin/repair-order/partial/preview-status', ['repairOrder' => $repairOrder])
  <div class="weui-form-preview__bd">
    <!-- status -->
  	@include('weixin/repair-order/partial/preview-order', ['repairOrder' => $repairOrder])
    <!-- 维修项目 -->
  	@include('weixin/repair-order/partial/preview-repair-type', ['repairOrder' => $repairOrder])
    <!-- 紧急程度 -->
  	@include('weixin/repair-order/partial/preview-grade', ['repairOrder' => $repairOrder])
    <!-- 提交时间 -->
  	@include('weixin/repair-order/partial/preview-created-at', ['repairOrder' => $repairOrder])
    <!-- 故障描述 -->
  	@include('weixin/repair-order/partial/preview-desc', ['repairOrder' => $repairOrder])
    <!-- 接单时间 -->
  	@include('weixin/repair-order/partial/preview-confirmed-at', ['repairOrder' => $repairOrder])
  	<!-- 维修工 -->
  	@include('weixin/repair-order/partial/preview-worker', ['repairOrder' => $repairOrder])
  </div>
  <div class="weui-form-preview__ft">
    <a
	class="weui-form-preview__btn weui-form-preview__btn_default preview-contact"
	href="tel:{{ $repairOrder->worker->tel }}">联系工程师</a>
    <a 
    class="weui-form-preview__btn weui-form-preview__btn_primary repair_complete" 
    href="javascript:"
    data-repair-order-id = "{{ $repairOrder->id }}"
    >维修完成</a>
  </div>
</div>
@endforeach 
@include('weixin/repair-order/partial/popup-submit-comment')
