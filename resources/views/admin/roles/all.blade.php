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
        {{trans('messages.user_roles')}}
        <small>{{trans('messages.manage_user_roles')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/roles">{{trans('messages.user_roles')}}</a>
            </li>

        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-meadow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-lock"></i>{{trans('messages.all_user_roles')}}
                    </div>
                    <div class="actions">
                        <a href="/admin/roles/create" class="btn red">
                            <i class="fa fa-plus"></i> {{trans('messages.create_new_role')}} </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th>{{trans('messages.id')}}</th>
                            <th>{{trans('messages.role')}}</th>
                            <th>{{trans('messages.permissions')}}</th>
                            <th>{{trans('messages.edit')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td> {{$role->id}} </td>
                                <td> {{ucwords($role->name)}} </td>
                                <td>
                                    @if($role->name == \App\Users::TYPE_ADMIN)
                                        <label class="label label-primary">ALL PERMISSIONS</label>
                                    @else
                                        @foreach($role->permissions as $perm)
                                            {!! $perm['value'].' <br>' !!}
                                        @endforeach
                                    @endif
                                </td>

                                @if($role->name == \App\Users::TYPE_ADMIN)
                                    <td>
                                        <button disabled
                                                class="btn btn-warning btn-sm">{{trans('messages.edit')}}</button>
                                    </td>
                                @else
                                    <td>
                                        <a {{$role->name == \App\Users::TYPE_ADMIN ? 'disabled':''}} href="/admin/roles/edit/{{$role->id}}"
                                           class="btn btn-warning btn-sm">{{trans('messages.edit')}}</a></td>
                                @endif

                                @if($role->name == \App\Users::TYPE_ADMIN)
                                    <td>
                                        <button disabled
                                                class="btn btn-danger btn-sm">{{trans('messages.delete')}}</button>
                                    </td>
                                @else
                                    <td><a data-href="/admin/roles/delete/{{$role->id}}" data-toggle="modal"
                                           data-target="#confirm-delete"
                                           class="btn btn-danger btn-sm">{{trans('messages.delete')}}</a></td>
                                @endif


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{trans('messages.delete_role')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4>
                                        <i class="fa fa-exclamation-triangle"></i> {{trans('messages.delete_role_desc')}}
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