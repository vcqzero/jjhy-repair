<div class="weui-cell">
		<div class="weui-cell__hd">
			<i class="fa fa-id-card-o"></i>
		</div>
		<div class="weui-cell__bd">
			<p class="">姓名</p>
		</div>
		<div class="weui-cell__ft">{{ $user->realname }}</div>
	</div>
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<i class="fa fa-phone"></i>
		</div>
		<div class="weui-cell__bd">
			<p>电话</p>
		</div>
		<div class="weui-cell__ft">{{ $user->tel }}</div>
	</div>
	<!-- 所在地区 -->
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<i class="fa fa-map-marker"></i>
		</div>
		<div class="weui-cell__bd">
			<p>所在地区</p>
		</div>
		<div class="weui-cell__ft area-codes"
			data-codes="{{ $user->province . ',' . $user->city . ',' . $user->district }}"></div>
	</div>
	<!-- 技能描述  -->
	<div class="weui-cell weui-cell_access open-popup" data-target="#popup-skill">
		<div class="weui-cell__hd">
			<i class="fa fa-wrench"></i>
		</div>
		<div class="weui-cell__bd">
			<p>技能描述</p>
		</div>
		<div class="weui-cell__ft">{{ str_limit($user->skill->skill, 15, '...') }}</div>
	</div>
	
@include('weixin/account/partial/popup-skill')