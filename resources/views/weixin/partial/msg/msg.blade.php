<?php 
use App\Model\Website;

$website = Website::query()->where('website', 'admin')->first();
?>
<div class="weui-msg">
  <div class="weui-msg__icon-area">
  @switch($type)
  	@case('success')
      	<i class="weui-icon-success weui-icon_msg"></i>
      	@break
      	
  	@case('info')
      	<i class="weui-icon-info weui-icon_msg"></i>
      	@break
      	
  	@case('warn')
      	<i class="weui-icon-warn weui-icon_msg"></i>
      	@break
      	
  	@case('warn_primary')
      	<i class="weui-icon-warn weui-icon_msg-primary"></i>
      	@break
      	
  	@case('waiting')
	@default
      	<i class="weui-icon-waiting weui-icon_msg"></i>
      	@break
  @endswitch
  
  </div>
  <div class="weui-msg__text-area">
    <h2 class="weui-msg__title">{{ $title }}</h2>
    <p class="weui-msg__desc">{{ $desc }}</p>
  </div>
  <div class="weui-msg__opr-area">
    <p class="weui-btn-area">
      <a href="{{ $action['primary']['href'] }}" class="weui-btn weui-btn_primary">{{ $action['primary']['title'] }}</a>
      @if( !empty($action['defualt']) )
      <a href="{{ $action['defualt']['href'] }}" class="weui-btn weui-btn_default">{{ $action['defualt']['title'] }}</a>
      @endif
    </p>
  </div>
  <div class="weui-msg__extra-area">
    <div class="weui-footer">
      <p class="weui-footer__text">{{ $website->record }}</p>
    </div>
  </div>
</div>