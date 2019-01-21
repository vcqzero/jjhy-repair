<li class="dropdown dropdown-user dropdown-dark">
    <a href="javascript:;"
    	class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
    	data-close-others="true"> 
    <span class="username username-hide-on-mobile">{{ $identity->username }}</span>
    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
    <img alt="" class="img-circle" src="{{ $identity->avatar ? $identity->avatar : '/storage/avatar/user_avatar.png' }}" />
    </a>
	<ul class="dropdown-menu dropdown-menu-default">
		<li>
    		<a href="/account">
    		<i class="icon-user"></i> 个人中心
    		</a>
		</li>
		
		<li class="divider"></li>
		
<!-- 		<li> -->
<!-- 			<a href="page_user_lock_1.html">  -->
<!-- 				<i class="icon-lock"></i> 锁定屏幕 -->
<!-- 			</a> -->
<!-- 		</li> -->
		
		<li><a href="/api/auth/logout"> <i class="icon-key"></i> 安全退出</a></li>
	</ul>
</li>