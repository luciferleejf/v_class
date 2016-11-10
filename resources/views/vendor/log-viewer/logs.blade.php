@extends('layouts.admin')

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
          <span>{!! trans('labels.breadcrumb.logs') !!}</span>
      </li>
  </ul>
</div>
<div class="portlet light portlet-fit bordered margin-top-40">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-green"></i>
            <span class="caption-subject font-green bold uppercase">日志列表</span>
        </div>
    </div>
    <div class="portlet-body">
        {!! $rows->render() !!}
        <div class="table-scrollable">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    @foreach($headers as $key => $header)
                        <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                    @if ($key == 'date')
                        <span class="label label-info">{{ $header }}</span>
                    @else
                        <span class="level level-{{ $key }}">
                            {!! log_styler()->icon($key) . ' ' . $header !!}
                        </span>
                    @endif

                    </th>
                    @endforeach
                    <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $date => $row)
                    <tr>
                        @foreach($row as $key => $value)
                        <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                            @if ($key == 'date')
                                <span class="label label-info">{{ $value }}</span>
                            @elseif ($value == 0)
                                <span class="level level-empty">{{ $value }}</span>
                            @else
                                <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                    <span class="level level-{{ $key }}">{{ $value }}</span>
                                </a>
                            @endif
                        </td>
                        @endforeach
                        <td class="text-center">
                            <a href="{{ route('log-viewer::logs.show', [$date]) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{ route('log-viewer::logs.download', [$date]) }}" class="btn btn-xs btn-success">
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-log-date="{{ $date }}">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {!! $rows->render() !!}
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade">
    <div class="modal-dialog">
        <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">删除文件</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">删除文件</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            $("a[href=#delete-log-modal]").click(function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                    'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

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
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
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

            deleteLogModal.on('hidden.bs.modal', function(event) {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@stop
