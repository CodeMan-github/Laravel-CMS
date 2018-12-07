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
        {{trans('messages.sources')}}
        <small>{{trans('messages.manage_sources')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/sources">{{trans('messages.sources')}}</a>
            </li>
        </ul>
    </div>

    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet box green-meadow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle"></i>{{trans('messages.all_sources')}}
                    </div>
                    <div class="actions">
                        <a href="/admin/sources/create" class="btn red">
                            <i class="fa fa-plus"></i> {{trans('messages.create_new_source')}} </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th>{{trans('messages.url')}}</th>
                            <th>{{trans('messages.priority')}}</th>
                            <th>{{trans('messages.category')}}</th>
                            <th>{{trans('messages.sub_category')}}</th>
                            <th>{{trans('messages.channel_title')}}</th>
                            <th>{{trans('messages.auto_update')}}</th>
                            <th>{{trans('messages.refresh')}}</th>
                            <th>{{trans('messages.edit')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sources as $source)
                            <tr>
                                <td> {{$source->url}} </td>
                                <td> {{$source->priority}} </td>
                                <td> {{$source->parent_category->title}} </td>
                                <td> {{$source->category->title}} </td>
                                <td> {{$source->channel_title}} </td>
                                @if($source->auto_update == 1)
                                    <td><label class="label label-success label-sm">{{trans('messages.on')}}</label>
                                    </td>
                                @else
                                    <td><label class="label label-warning label-sm">{{trans('messages.off')}}</label>
                                    </td>
                                @endif
                                <td><a href="/admin/sources/refresh/{{$source->id}}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> {{trans('messages.refresh')}}</a>
                                </td>
                                <td><a href="/admin/sources/edit/{{$source->id}}"
                                       class="btn btn-warning btn-sm">{{trans('messages.edit')}}</a>
                                </td>
                                <td><a data-href="/admin/sources/delete/{{$source->id}}" data-toggle="modal"
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
                                    {{trans('messages.delete_source')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4>
                                        <i class="fa fa-exclamation-triangle"></i> {{trans('messages.delete_source_desc')}}
                                    </h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal">{{trans('messages.cancel')}}</button>
                                    <a class="btn btn-danger btn-ok">{{trans('messages.delete')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop