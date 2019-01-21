<!-- 维修评价 -->
<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">维修评价</label> <span
		class="weui-form-preview__value">
		@switch($repairOrder->comment_star)
			@case(5)
				<p><span class="commet-star-fill">★★★★★</span></p>
			@break;
			@case(4)
				<p><span class="commet-star-fill">★★★★</span></p>
			@break;
			@case(3)
				<p><span class="commet-star-fill">★★★</span></p>
			@break;
			@case(2)
				<p><span class="commet-star-fill">★★</span></p>
			@break;
			@case(1)
				<p><span class="commet-star-fill">★</span></p>
			@break;
		@endswitch
		</span>
</div>
