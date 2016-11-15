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
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/adviserArticle')}}">
              		{!! csrf_field() !!}
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.adviserArticle.cnName')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.adviserArticle.cnName')}}" value="{{old('name')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.adviserArticle.enName')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.adviserArticle.enName')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>


                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.adviserArticle.sex')}}</label>
                          <div class="col-md-10">
                              <div class="md-radio-inline">
                                  <div class="md-radio">
                                      <input type="radio" id="status1" name="status" value="{{config('admin.global.sex.boy')}}" class="md-radiobtn" @if(old('status') == config('admin.global.sex.boy')) checked @endif>
                                      <label for="status1">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.sex.boy.1')}} </label>
                                  </div>
                                  <div class="md-radio">
                                      <input type="radio" id="status2" name="status" value="{{config('admin.global.sex.girl')}}" class="md-radiobtn" @if(old('status') === config('admin.global.sex.girl')) checked @endif>
                                      <label for="status2">
                                          <span></span>
                                          <span class="check"></span>
                                          <span class="box"></span> {{trans('strings.sex.girl.1')}} </label>
                                  </div>

                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.adviserArticle.email')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.adviserArticle.email')}}" value="{{old('email')}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="email">{{trans('labels.adviserArticle.phone')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="email" name="email" placeholder="{{trans('labels.adviserArticle.phone')}}" value="{{old('email')}}">
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
    /*modal事件监听*/
    $(".modal").on("hidden.bs.modal", function() {
         $(".modal-content").empty();
    });
  });
</script>
@endsection