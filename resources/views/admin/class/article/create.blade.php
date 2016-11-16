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
            <span>{!! trans('labels.class.detail') !!}</span>
            <i class="fa fa-angle-right"></i>
        </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.classCreate') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.classCreate') !!}</span>
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
                          <label class="col-md-2 control-label" for="name">{{trans('labels.classArticle.faceImg')}}</label>
                          <div class="col-md-6">
                              <div class="row fileupload-buttonbar" style="padding-left:15px;">
                                  <div class="thumbnail col-sm-6">
                                      <img id="face_show" style="width:90%;height:150px;margin-top:10px;margin-bottom:10px;"  src="" data-holder-rendered="true">
                                      <input type="hidden" id="face_img"  name="face_img" value="">

                                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="10" aria-valuemax="100" aria-valuenow="0" style="height:20px;margin-bottom:5px;">
                                          <div id="face_progress" class="progress-bar progress-bar-success" ></div>
                                      </div>
                                      <div class="caption" align="center" style="padding:5px;">
                                            <span id="face_upload" class="btn btn-primary fileinput-button">
                                            <span>上传</span>
                                            <input type="file" id="face_image" name="face_image" multiple>
                                            </span>
                                          <a id="face_cancle" href="javascript:void(0)" class="btn btn-warning" role="button" onclick="cancleUpload('face')" style="display:none">删除</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>









                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="cid">{{trans('labels.classArticle.cid')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="cid" name="cid" placeholder="{{trans('labels.classArticle.cid')}}" value="{{old('name')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="title">{{trans('labels.classArticle.title')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('labels.classArticle.title')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.classArticle.type')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="type1" name="type" value="{{config('admin.global.type.video')}}" class="md-radiobtn"  checked >
                                      <label for="type1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.type.video.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="type2" name="type" value="{{config('admin.global.type.audio')}}" class="md-radiobtn" >
                                      <label for="type2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.type.audio.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input" id="video_input" >
                          <label class="col-md-2 control-label" for="title">{{trans('labels.classArticle.video')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="url" name="url" placeholder="{{trans('labels.classArticle.video')}}" >
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input" style="display: none;" id="audio_input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.classArticle.audio')}}</label>
                          <div class="col-md-3">
                              <div class="row fileupload-buttonbar" style="padding-left:15px;">
                                  <div class="thumbnail col-sm-6">
                                      <img id="mp3_show" style="height:150px;margin-top:10px;margin-bottom:10px;"  src="" data-holder-rendered="true">

                                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="10" aria-valuemax="100" aria-valuenow="0" style="height:20px;margin-bottom:5px;">
                                          <div id="mp3_progress" class="progress-bar progress-bar-success" ></div>
                                      </div>
                                      <div class="caption" align="center" style="padding:5px;">
                                            <span id="mp3_upload" class="btn btn-primary fileinput-button">
                                            <span>上传</span>
                                            <input type="file" id="mp3_image" name="mp3_image" multiple>
                                            </span>
                                          <a id="mp3_cancle" href="javascript:void(0)" class="btn btn-warning" role="button" onclick="cancleUpload('mp3')" style="display:none">删除</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>




                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.classArticle.preClass')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="preClass1" name="pre_class" value="{{config('admin.global.preClass.no')}}" class="md-radiobtn"  checked >
                                      <label for="preClass1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.preClass.no.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="preClass2" name="pre_class" value="{{config('admin.global.preClass.yes')}}" class="md-radiobtn">
                                      <label for="preClass2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.preClass.yes.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input" id="predate" style="display: none;">
                          <label class="col-md-2 control-label" for="description">{{trans('labels.classArticle.preDate')}}</label>
                          <div class="col-md-2">
                              <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                  <input type="text" class="form-control form-filter input-sm"   id="pre_date" name="pre_date">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                              </div>
                          </div>
                      </div>







                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="description">{{trans('labels.classArticle.description')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="description" name="description" placeholder="{{trans('labels.classArticle.description')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="content">{{trans('labels.classArticle.content')}}</label>
                          <div class="col-md-8">

                              <textarea cols="80" id="content" name="content" rows="10">

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

<script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>


<script type="text/javascript">


  $(function() {

      $('.input-group.date').datepicker({
          autoclose: true
      });

      CKEDITOR.replace( 'content' );




      $("#face_image").fileupload({
          dataType: 'json',
          url: '/admin/classArticle/uploadFile',
          sequentialUploads: true,

      }).bind('fileuploadprogress', function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $("#face_progress").css('width',progress + '%');
          $("#face_progress").html(progress + '%');
      }).bind('fileuploaddone', function (e, data) {

          $("#face_show").attr("src",data.result.result);

          $("#face_img").val(data.result.result);

          $("#face_progress").css({display:"none"});
          $("#face_upload").css({display:"none"});
          $("#face_cancle").css({display:""});

      });


      $("#mp3_image").fileupload({
          dataType: 'json',
          url: '/admin/classArticle/uploadFile',
          sequentialUploads: true,

      }).bind('fileuploadprogress', function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $("#mp3_progress").css('width',progress + '%');
          $("#mp3_progress").html(progress + '%');
      }).bind('fileuploaddone', function (e, data) {

          $("#mp3_show").attr("src",data.result.result);


          $("#url").val(data.result.result);

          $("#mp3_progress").css({display:"none"});
          $("#mp3_upload").css({display:"none"});
          $("#mp3_cancle").css({display:""});

      });




      /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });



      $("#preClass1").bind('click',function () {
          $('#predate').hide();
          $('#pre_date').val("");

      });
      $("#preClass2").bind('click',function () {

          $('#predate').show();
          $('#pre_date').val("");

      })





    $("#type1").bind('click',function () {
        $('#video_input').show();
        $('#audio_input').hide();
        $('#url').val('');
    });
    $("#type2").bind('click',function () {
        $('#audio_input').show();
        $('#video_input').hide();

        $('#url').val('');
    })
  });
</script>
@endsection