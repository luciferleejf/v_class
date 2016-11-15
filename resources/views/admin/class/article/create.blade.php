@extends('layouts.admin')
@section('content')

<style>
.uploader button{width:190px;height:30px;text-align: center;}


</style>

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/user')}}">{!! trans('labels.breadcrumb.userList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.userCreate') !!}</span>
	    </li>
	</ul>
</div>
<div class="row margin-top-40">
  <div class="col-md-12">
      <!-- BEGIN SAMPLE FORM PORTLET-->
      <div class="portlet light bordered">
          <div class="portlet-title">
              <div class="caption font-green-haze">
                  <i class="icon-settings font-green-haze"></i>
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.userCreate') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
          		@if (isset($errors) && count($errors) > 0 )
					    <div class="alert alert-danger">
					        <button class="close" data-close="alert"></button>
					        @foreach($errors->all() as $error)
					            <span class="help-block"><strong>{{ $error }}</strong></span>
					        @endforeach
					    </div>
					    @endif
              <form id="form" role="form" class="form-horizontal" method="POST" action="{{url('admin/classArticle')}}" enctype="multipart/form-data">
              		{!! csrf_field() !!}
                  <div class="form-body">



                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.classArticle.cid')}}</label>
                          <div class="col-md-3">
                              <div class="row fileupload-buttonbar" style="padding-left:15px;">
                                  <div class="thumbnail col-sm-6">
                                      <img id="weixin_show" style="height:150px;margin-top:10px;margin-bottom:10px;"  src="" data-holder-rendered="true">
                                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="10" aria-valuemax="100" aria-valuenow="0" style="height:20px;margin-bottom:5px;">
                                          <div id="weixin_progress" class="progress-bar progress-bar-success" ></div>
                                      </div>
                                      <div class="caption" align="center" style="padding:5px;">
                                            <span id="weixin_upload" class="btn btn-primary fileinput-button">
                                            <span>上传</span>
                                            <input type="file" id="weixin_image" name="weixin_image" multiple>
                                            </span>
                                          <a id="weixin_cancle" href="javascript:void(0)" class="btn btn-warning" role="button" onclick="cancleUpload('weixin')" style="display:none">删除</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>




                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.classArticle.cid')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.classArticle.cid')}}" value="{{old('name')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.classArticle.title')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.classArticle.title')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.classArticle.type')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="status1" name="status" value="{{config('admin.global.type.video')}}" class="md-radiobtn" @if(old('status') == config('admin.global.sex.boy')) checked @endif>
                                      <label for="status1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.type.video.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status2" name="status" value="{{config('admin.global.type.audio')}}" class="md-radiobtn" @if(old('status') === config('admin.global.sex.girl')) checked @endif>
                                      <label for="status2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.type.audio.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.classArticle.description')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.classArticle.description')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.classArticle.phone')}}</label>
                          <div class="col-md-8">

                              <textarea cols="80" id="editor" name="editor" rows="10">

                              </textarea>


                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-10">
                              <a href="{{url()->previous()}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="draggable" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
@endsection
@section('js')




<script type="text/javascript">


  $(function() {
    CKEDITOR.replace( 'editor' );

      $("#weixin_image").fileupload({
          dataType: 'json',
          url: '/admin/classArticle/uploadFile',
          sequentialUploads: true,
          data : $( '#postForm').serialize(),
      }).bind('fileuploadprogress', function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $("#weixin_progress").css('width',progress + '%');
          $("#weixin_progress").html(progress + '%');
      }).bind('fileuploaddone', function (e, data) {

          $("#weixin_show").attr("src","__PUBLIC__/"+data.result);
          $("#weixin_upload").css({display:"none"});
          $("#weixin_cancle").css({display:""});

      });

      /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });
  });
</script>
@endsection