@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
@endsection
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('admin/')}}">{!! trans('labels.breadcrumb.home') !!}</a>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <span>{!! trans('labels.class.detail') !!}</span>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <span>{!! trans('labels.breadcrumb.classArticle') !!}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row margin-top-40">
        <div class="col-md-12">
        @include('flash::message')
        <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{trans('labels.classArticle.detail')}}</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">


                            <a href="{{url('api/data')}}" class="btn btn-success btn-outline btn-circle" style="margin-right:50px;">
                                <i class="fa fa-user-plus"></i>
                                <span class="hidden-xs">数据同步</span>
                            </a>


                            <a href="{{url('admin/classArticle/create')}}" class="btn btn-success btn-outline btn-circle">
                                <i class="fa fa-user-plus"></i>
                                <span class="hidden-xs">{{trans('crud.create')}}</span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                            <thead>
                            <tr role="row" class="heading">
                                <th>#</th>

                                <th width="15%"> {{ trans('labels.classArticle.cid') }} </th>
                                <th width="15%"> {{ trans('labels.classArticle.tid') }} </th>
                                <th> {{ trans('labels.classArticle.title') }} </th>
                                <th> {{ trans('labels.classArticle.description') }} </th>
                                <th width="10%"> {{ trans('labels.classArticle.type') }} </th>

                                <th width="15%"> {{ trans('labels.action') }} </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <div class="form-group form-md-line-input">
                                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="cid" id="cid">
                                            <option value="" data-icon="fa-film icon-success">课程分类....</option>
                                            @if($classCate)
                                                @foreach($classCate as $key => $value)
                                                    <option value="{{$value}}" >{{$key}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group form-md-line-input">
                                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="cid" id="cid">
                                            <option value="" data-icon="fa-film icon-success">授课顾问....</option>
                                            @if($adviserArticle)

                                                @foreach($adviserArticle as $key => $value)
                                                    <option value="{{$value}}" >{{$key}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </td>


                                <td>
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group has-success">
                                    <span class="input-group-addon">
                                        <i class="fa fa-book"></i>
                                    </span>
                                            <input type="text" class="form-control form-filter" name="title" placeholder="{{ trans('labels.classArticle.title') }}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-md-line-input">
                                        <div class="input-group has-success">
                                    <span class="input-group-addon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                            <input type="text" class="form-control form-filter" name="description" placeholder="{{ trans('labels.classArticle.description') }}">
                                            <div class="form-control-focus"> </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-md-line-input">
                                        <select class="bs-select form-control form-filter" data-show-subtext="true" name="status">
                                            <option value="" data-icon="fa-film icon-success">课程类型....</option>
                                            @if(trans('strings.classType'))
                                                @foreach(trans('strings.classType') as $status_key => $status_value)
                                                    <option value="{{config('admin.global.status.'.$status_key)}}" > {{$status_value[1]}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </td>


                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> 搜索</button>
                                    </div>
                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i> 重置</button>
                                </td>
                            </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('backend/plugins/datatables/datatables.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/class/class-article.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/plugins/layer/layer.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            TableDatatablesAjax.init();
            $(document).on('click','#destory',function() {
                var num=$(this).attr('num')
                layer.msg('{{trans('alerts.deleteTitle')}}', {
                    time: 0, //不自动关闭
                    btn: ['{{trans('crud.destory')}}', '{{trans('crud.cancel')}}'],
                    icon: 5,
                    yes: function(index){

                        $('form[name="delete_item'+num+'"]').submit();
                        layer.close(index);
                    }
                });
            });
        });
    </script>
@endsection