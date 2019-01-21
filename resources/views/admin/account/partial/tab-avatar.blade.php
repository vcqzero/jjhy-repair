<div class="tab-pane" id="tab_1_2">
<div class="util-btn-margin-bottom-5">
@include('admin.partial.button.outline.select-file', ['input_id' => 'select-file'])
@include('admin.partial.button.outline.upload-file', ['id' => 'upload-avatar', 'class'=> 'hide'])
</div>
    <div class="row" >
        <div class="col-md-8">
        <img id="avatar" src="" class="">
        </div>
        <div class="col-md-4">
            <div class="docs-preview clearfix">
              <div class="img-preview preview-lg hide" style="width: 60%; height: auto;">
               <img  src="{{ $user->avatar }}" >
              </div>
              <div class="img-preview preview-md img-circle hide" style="width: 60%; height: auto;">
               <img  src="{{ $user->avatar }}" class="img-circle">
              </div>
            </div>
        </div>
    </div>
</div>