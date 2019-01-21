<div class="weui-form-preview__item">
  <label class="weui-form-preview__label">所属项目</label>
  <span class="weui-form-preview__value">{{ $repairOrder->workyard->name }}</span>
</div>
<div class="weui-form-preview__item popup-show-address-area"
data-codes="{{ $repairOrder->workyard->province . ',' . $repairOrder->workyard->city . ',' . $repairOrder->workyard->district }}"
>
  <label class="weui-form-preview__label">项目地区</label>
  <span class="weui-form-preview__value"></span>
</div>
<div class="weui-form-preview__item">
  <label class="weui-form-preview__label">具体地址</label>
  <span class="weui-form-preview__value">{{ $repairOrder->workyard->address }}</span>
</div>