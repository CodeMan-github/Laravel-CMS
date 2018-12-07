@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" type="text/css" href="/assets/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
@stop

@section('extra_js')
    <script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript"
            src="/assets/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript"
            src="/assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            Metronic.handleTables();
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{trans('messages.cron_jobs_section')}}
        <small>{{trans('messages.manage_cron_jobs')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/crons">{{trans('messages.cron_jobs_section')}}</a>
            </li>

        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-meadow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cubes"></i>{{trans('messages.all_crons')}}
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <a role="button" href="/admin/crons/run" class="btn btn-large btn-primary">Run Cron Job Manually</a>

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th>{{trans('messages.id')}}</th>
                            <th>{{trans('messages.cron_started_on')}}</th>
                            <th>{{trans('messages.cron_completed_on')}}</th>
                            <th>{{trans('messages.what')}}</th>
                            <th>{{trans('messages.result')}}</th>
                            <th>{{trans('messages.view')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($crons as $cron)
                            <tr>
                                <td> {{$cron->id}} </td>
                                <td> {{$cron->cron_started_on}} </td>
                                <td> {{$cron->cron_completed_on}} </td>
                                <td> {!! str_limit(strip_tags($cron->what),200,'...') !!} </td>
                                <td> {!! $cron->result == 1 ? "<label class='label label-success'>Success</label>":"<label class='label label-danger'>Error</label>"  !!} </td>

                                <td><a href="/admin/crons/view/{{$cron->id}}"
                                       class="btn btn-info btn-sm">{{trans('messages.view_logs')}}</a>
                                </td>
                                <td><a data-href="/admin/crons/delete/{{$cron->id}}" data-toggle="modal"
                                       data-target="#confirm-delete"
                                       class="btn btn-danger btn-sm">{{trans('messages.delete')}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{trans('messages.delete_cron')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4><i class="fa fa-exclamation-triangle"></i>{{trans('messages.delete_cron_desc')}}
                                    </h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal"> {{trans('messages.cancel')}} </button>
                                    <a class="btn btn-danger btn-ok"> {{trans('messages.delete')}} </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop