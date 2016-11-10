@extends('layouts.admin')
@section('css')
    @include('log-viewer::_template.style')
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
      <li>
          <a href="{{url('admin/')}}">{!! trans('labels.breadcrumb.home') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <a href="{{url('admin/log-viewer')}}">{!! trans('labels.breadcrumb.logList') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <a href="{{url('admin/log-viewer/logs')}}">{!! trans('labels.breadcrumb.logs') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <span>{!! trans('labels.breadcrumb.logDetail') !!}[{{ $log->date }}]</span>
      </li>
  </ul>
</div>
<h1 class="page-header">消息 [{{ $log->date }}]</h1>

<div class="row">
    <div class="col-md-2">
        @include('log-viewer::_partials.menu')
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                消息详情 :

                <div class="group-btns pull-right">
                    <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-xs btn-success">
                        <i class="fa fa-download"></i> 下载
                    </a>
                    <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-toggle="modal">
                        <i class="fa fa-trash-o"></i> 删除
                    </a>
                </div>
            </div>
            <div class="table-responsive margin-bottom-5">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td>文件路径:</td>
                            <td colspan="5">{{ $log->getPath() }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>消息总数 : </td>
                            <td>
                                <span class="label label-primary">{{ $entries->total() }}</span>
                            </td>
                            <td>大小 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->size() }}</span>
                            </td>
                            <td>创建时间 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->createdAt() }}</span>
                            </td>
                            <td>修改时间 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->updatedAt() }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            @if ($entries->hasPages())
                <div class="panel-heading">
                    {!! $entries->render() !!}

                    <span class="label label-info pull-right">
                        Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                    </span>
                </div>
            @endif

            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>消息详情 </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table id="entries" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>环境</th>
                                    <th style="width: 120px;">等级</th>
                                    <th style="width: 65px;">时间</th>
                                    <th>头部</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $key => $entry)
                                    <tr>
                                        <td>
                                            <span class="label label-env">{{ $entry->env }}</span>
                                        </td>
                                        <td>
                                            <span class="level level-{{ $entry->level }}">
                                                {!! $entry->level() !!}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="label label-default">
                                                {{ $entry->datetime->format('H:i:s') }}
                                            </span>
                                        </td>
                                        <td>
                                            <p>{{ $entry->header }}</p>
                                        </td>
                                        <td class="text-right">
                                            @if ($entry->hasStack())
                                                <a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                    <i class="fa fa-toggle-on"></i> 详情
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($entry->hasStack())
                                        <tr>
                                            <td colspan="5" class="stack">
                                                <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                                    {!! preg_replace("/\n/", '<br>', $entry->stack) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            @if ($entries->hasPages())
                <div class="panel-footer">
                    {!! $entries->render() !!}

                    <span class="label label-info pull-right">
                        Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade">
    <div class="modal-dialog">
        <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="{{ $log->date }}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">删除消息文件</h4>
                </div>
                <div class="modal-body">
                    <p>你确定&nbsp<span class="label label-danger">删除</span>&nbsp这个消息&nbsp<span class="label label-primary">{{ $log->date }}</span>  &nbsp文件?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">删除</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.submit(function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
