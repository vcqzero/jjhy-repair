<div class="weui-cells__title">当前身份：{{ $User->role_on_using->desc }}</div>

<div class="weui-cells">
  <a 
  class="weui-cell weui-cell_access" 
  id="account-change-role" 
  href="javascript:;"
  data-role="{{ $User->role }}"
  >
  	<div class="weui-cell__hd"><i class="fa fa-user"></i> </div>
    <div class="weui-cell__bd">
      <p>身份切换</p>
    </div>
    @if($User->role == 'WORKER')
    <div class="weui-cell__ft">切换至：项目管理员</div>
    @else
    <div class="weui-cell__ft">切换至：维修工程师</div>
    @endif
  </a>
</div>