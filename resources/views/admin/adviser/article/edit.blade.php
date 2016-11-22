@extends('layouts.admin')
@section('content')
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
	        <span>{!! trans('labels.breadcrumb.adviserEdit') !!}</span>
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
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.adviserEdit') !!}</span>
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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/adviserArticle/'.$adviserArticle['id'])}}">
              		{!! csrf_field() !!}
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" value="{{$adviserArticle['id']}}">
                  <div class="form-body">


                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="adviser_img">{{trans('labels.classArticle.adviserImg')}}</label>
                          <div class="col-md-3">
                              <div class="row fileupload-buttonbar" style="padding-left:15px;">
                                  <div class="thumbnail col-sm-6">
                                      <img id="weixin_show" style="height:150px;margin-top:10px;margin-bottom:10px;"  src="{{$adviserArticle['adviser_img']}}" data-holder-rendered="true">
                                      <input type="hidden" id="adviser_img" name="adviser_img" value="{{$adviserArticle['adviser_img']}}">

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
                          <label class="col-md-2 control-label" for="cid">{{trans('labels.classArticle.cid')}}</label>
                          <div class="col-md-2">
                              <select class="bs-select form-control form-filter" data-show-subtext="true" name="cid" id="cid">
                                  <option value="{{$adviserArticle['cid']}}" data-icon="fa-film icon-success">@if($adviserArticle['area']=="")顾问分类....@endif{{$adviserArticle['name']}}</option>
                                  @if($adviserCate)

                                      @foreach($adviserCate as $key => $value)
                                          <option value="{{$value}}" >{{$key}}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="area">{{trans('labels.adviserArticle.area')}}</label>
                          <div class="col-md-2">
                              <select class="bs-select form-control form-filter" data-show-subtext="true" name="area" id="area">
                                  <option value="{{$adviserArticle['area']}}" data-icon="fa-film icon-success">@if($adviserArticle['area']=="")所属地区....@endif{{$adviserArticle['area']}}</option>
                                  @if(trans('strings.area'))
                                      @foreach(trans('strings.area') as $status_key => $status_value)
                                          <option value="{{$status_value[1]}}" data-icon="{{$status_value[0]}}"> {{$status_value[1]}}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>




                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="cnName">{{trans('labels.adviserArticle.cnName')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="cnName" name="cnName" placeholder="{{trans('labels.adviserArticle.cnName')}}" value="{{$adviserArticle['cnName']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="enName">{{trans('labels.adviserArticle.enName')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="enName" name="enName" placeholder="{{trans('labels.adviserArticle.enName')}}" value="{{$adviserArticle['enName']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="job">{{trans('labels.adviserArticle.job')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="job" name="job" placeholder="{{trans('labels.adviserArticle.job')}}" value="{{$adviserArticle['job']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="keyword">{{trans('labels.adviserArticle.keyword')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="keyword" name="keyword" placeholder="{{trans('labels.adviserArticle.keyword')}}" value="{{$adviserArticle['keyword']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="description">{{trans('labels.adviserArticle.description')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="description" name="description" placeholder="{{trans('labels.adviserArticle.description')}}" value="{{$adviserArticle['description']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>




                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.adviserArticle.sex')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="boy" name="sex" value="{{config('admin.global.sex.boy')}}" class="md-radiobtn" @if($adviserArticle['sex']==config('admin.global.sex.boy')) checked @endif >
                                      <label for="boy">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.sex.boy.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="girl" name="sex" value="{{config('admin.global.sex.girl')}}" class="md-radiobtn" @if($adviserArticle['sex']==config('admin.global.sex.girl')) checked @endif>
                                      <label for="girl">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.sex.girl.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>



                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.adviserArticle.gold')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="no" name="gold" value="{{config('admin.global.gold.no')}}" class="md-radiobtn" @if($adviserArticle['gold']==config('admin.global.gold.no')) checked @endif>
                                      <label for="no">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.gold.no.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="yes" name="gold" value="{{config('admin.global.gold.yes')}}" class="md-radiobtn" @if($adviserArticle['gold']==config('admin.global.gold.yes')) checked @endif>
                                      <label for="yes">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.gold.yes.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.adviserArticle.email')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.adviserArticle.email')}}" value="{{$adviserArticle['email']}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="phone">{{trans('labels.adviserArticle.phone')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="{{trans('labels.adviserArticle.phone')}}" value="{{$adviserArticle['phone']}}">
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
          url: '/admin/adviserArticle/uploadFile',
          sequentialUploads: true,
      }).bind('fileuploadprogress', function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $("#weixin_progress").css('width',progress + '%');
          $("#weixin_progress").html(progress + '%');
      }).bind('fileuploaddone', function (e, data) {

          $("#adviser_img").val(data.result.result);

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