@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/select2/select2.css">
    <link rel="stylesheet" href="/assets/plugins/select2/select2-bootstrap.css">
    <style type="text/css">
        .select2-container {
            border: 1px solid #cecece !important;
        }
    </style>
@stop

@section('extra_js')
    <script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#permissions").select2();
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
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/roles/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-lock"></i>{{trans('messages.create_new_role')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/roles/create" id="form-username" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">{{trans('messages.role')}}</label>

                            <div class="col-sm-8">
                                <input id="role" name="role" class="form-control" value="{{old('role')}}"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="permissions"
                                   class="col-sm-3 control-label">{{trans('messages.permissions')}}</label>

                            <div class="col-sm-8">
                                <select id="permissions" multiple="multiple" class="form-control" name="permissions[]">
                                    @foreach($permissions_groups as $group)
                                        <optgroup label="{{$group['name']}}">
                                            @foreach($group['permissions'] as $permission)
                                                <option value="{{$permission['key']}}">{{$permission['value']}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple"><i
                                                class="fa fa-check"></i> {{trans('messages.save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@stop