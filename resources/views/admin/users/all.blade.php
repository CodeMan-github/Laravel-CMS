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
        {{trans('messages.users')}}
        <small>{{trans('messages.manage_users')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/users">{{trans('messages.users')}}</a>
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
                        <i class="icon-user"></i>{{trans('messages.all_users')}}
                    </div>
                    <div class="actions">
                        <a href="/admin/users/create" class="btn red">
                            <i class="fa fa-plus"></i> {{trans('messages.create_new_user')}} </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th>{{trans('messages.avatar')}}</th>
                            <th>{{trans('messages.name')}}</th>
                            <th>{{trans('messages.email')}}</th>
                            <th>{{trans('messages.created_on')}}</th>
                            <th>{{trans('messages.type')}}</th>
                            <th>{{trans('messages.edit')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><img style="width:80px;" src="{{$user->avatar}}"/></td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->created_at->diffForHumans()}} </td>
                                @if($user->slug=='customer')
                                    <td><label class="label label-info"><b>CUSTOMER</b></label>
                                @else
                                    <td><label class="label label-info"><b>{{strtoupper($user->type->name)}}</b></label>
                                        @endif
                                </td>
                                    @if($user->slug=='customer')
                                        <td><a
                                               class="btn btn-warning btn-sm">DISABLED</a></td>                                    @else
                                <td><a href="/admin/users/edit/{{$user->id}}"
                                       class="btn btn-warning btn-sm">{{trans('messages.edit')}}</a></td>
                                    @endif
                                <td><a data-href="/admin/users/delete/{{$user->id}}" data-toggle="modal"
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
                                    {{trans('messages.delete_user')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4>
                                        <i class="fa fa-exclamation-triangle"></i> {{trans('messages.delete_user_desc')}}
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