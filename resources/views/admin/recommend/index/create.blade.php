@extends('layouts.admin')
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/recommend')}}">{!! trans('labels.recommend.detail') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.addRecommend') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.addRecommend') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/recommend')}}">
              		{!! csrf_field() !!}
                  <div class="form-body">

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="img">{{trans('labels.recommend.img')}}</label>
                          <div class="col-md-3">
                              <div class="row fileupload-buttonbar" style="padding-left:15px;">
                                  <div class="thumbnail col-sm-10">
                                      <img id="weixin_show" style="height:150px;margin-top:10px;margin-bottom:10px;width:90%;"  src="{{url('/backend/img/upload.jpg')}}" data-holder-rendered="true">
                                      <input type="hidden" id="img" name="img" >

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
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.recommend.show')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="no" name="show" value="{{config('admin.global.show.no')}}" class="md-radiobtn" checked >
                                      <label for="no">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.show.no.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="yes" name="show" value="{{config('admin.global.show.yes')}}" class="md-radiobtn" >
                                      <label for="yes">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.show.yes.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="sort">{{trans('labels.recommend.sort')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.recommend.sort')}}" value="">
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

      $("#weixin_image").fileupload({
          dataType: 'json',
          url: '/admin/upload/uploadFile',
          sequentialUploads: true,

      }).bind('fileuploadprogress', function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $("#weixin_progress").css('width',progress + '%');
          $("#weixin_progress").html(progress + '%');
      }).bind('fileuploaddone', function (e, data) {

          $("#img").val(data.result.result);

          $("#weixin_show").attr("src",data.result.result);


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