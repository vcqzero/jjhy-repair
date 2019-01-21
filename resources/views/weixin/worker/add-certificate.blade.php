@extends('weixin.layout.layout') @section('title', '上传保险单')
@section('pageName', 'AddCertificatePage') @section('pageGroup', 'Worker')
@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
			<div class="weui-cells__title">2：请上传保险单图片</div>
			<div class="weui-cells weui-cells_form">
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<div class="weui-uploader">
							<div class="weui-uploader__hd">
								<p class="weui-uploader__title">图片上传</p>
								<div class="weui-uploader__info"><span id="image-count">0</span>/5</div>
							</div>
							<div class="weui-uploader__bd">
								<ul class="weui-uploader__files" id="view-images">
								</ul>
								<div class="weui-uploader__input-box">
									<input id="" class="weui-uploader__input upload-image"
									type="file"
									accept="image/*" multiple="multiple">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="show-success-msg" class="weui-cells__title text-primary hidden">上传成功,请等待审核！</div>
			<div class="weui-gallery gallery-view hidden" style="display: block">
              <span class="weui-gallery__img gallery-img" 
              ></span>
              <div class="weui-gallery__opr">
                <a href="javascript:" class="weui-gallery__del gallery-delete">
                  <i class="weui-icon-delete weui-icon_gallery-delete"></i>
                </a>
              </div>
			</div>
			<!-- actions -->
			<div class="weui-btn-area">
            	<button type="button" class="weui-btn weui-btn_primary btn-upload-complete">上传完成</button>
            	<a href="/weixin/account" class="weui-btn weui-btn_default">返回</a>
            </div>
		</div>
	</div>
</div>
@endsection
