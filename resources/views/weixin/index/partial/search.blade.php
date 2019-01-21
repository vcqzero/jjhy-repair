<form action="/weixin" method="get" class="" id="index_search">
	<ul class="page__bd" style="margin-top: 0;">
		<li class="search">
			<div class="weui-flex search-bar">
				<p class="weui-flex__item search_content">
    				<span class="margin-right-5"><i class="fa fa-map-marker"></i></span>
    				<span class="search-address-area margin-right-30"></span>
    				<span class="margin-right-5"><i class="fa fa-wrench"></i></span>
    				<span>类型：{{ $repair_type_name ?? '全部' }}</span>
				</p>
				<span class="search-icon"><i class="fa fa-angle-down"></i></span>
<!-- 				<img src="/_weixin/images/icon_nav_search_bar.png" alt="搜索"> -->
			</div>
			<div class="page__category js_categoryInner" data-height="45"
				style="display: none">
				<div class="weui-cells page__category-content"
					style="margin-top: 0;">
					<input type="hidden" name="address_area" value="{{ $address_area }}">
					<input type="hidden" name="repair_type_id">
					@include('weixin/partial/input/input', [ 
					'label'=>'所在地区',
					'name'=>'address_area_name', 
					'placeholder'=>'请选择地区', 
					])
					@include('weixin/partial/input/input', [ 
					'label'=>'设备',
					'name'=>'repair_type_name', 
					'placeholder'=>'筛选设备', 
					'value'=> $repair_type_name
					]) 
					<div class="weui-cell">
						<div class="weui-cell__bd">
							<button type="submit" class="weui-btn  weui-btn_primary">搜索</button>
							<a href="/weixin" class="weui-btn  weui-btn_default">清空筛选</a>
						</div>
					</div>
				</div>
			</div>
		</li>
	</ul>
</form>