<div class="weui-form-preview__item">
          <label class="weui-form-preview__label">我的报价</label>
          <span class="weui-form-preview__value">{{ $offer->price > 0 ? $offer->price : '-' }} ￥</span>
        </div>
<div class="weui-form-preview__item">
          <label class="weui-form-preview__label">报价工期</label>
          <span class="weui-form-preview__value">{{ $offer->days }} 天</span>
        </div>