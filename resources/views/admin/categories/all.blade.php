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
        {{trans('messages.categories')}}
        <small>{{trans('messages.manage_categories')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/categories">{{trans('messages.categories')}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.all_categories')}}
                    </div>
                    <div class="actions">
                        <a href="/admin/categories/create" class="btn red">
                            <i class="fa fa-plus"></i> {{trans('messages.create_new_category')}} </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th> {{trans('messages.name')}} </th>
                            <th> {{trans('messages.show_in_menu')}} </th>
                            <th> {{trans('messages.show_in_sidebar')}} </th>
                            <th> {{trans('messages.show_in_footer')}} </th>
                            <th> {{trans('messages.seo_keywords')}} </th>
                            <th> {{trans('messages.seo_description')}} </th>
							<th> {{trans('messages.redirect_type')}} </th>
							<th> {{trans('messages.redirect_url')}} </th>
                            <th>{{trans('messages.edit')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td> {{$category->title}} </td>
                                <td> {{$category->show_in_menu ? trans('messages.yes'):trans('messages.no')}} </td>
                                <td> {{$category->show_in_sidebar ? trans('messages.yes'):trans('messages.no')}} </td>
                                <td> {{$category->show_in_footer ? trans('messages.yes'):trans('messages.no')}} </td>
                                <td> {{$category->seo_keywords }} </td>
                                <td> {{$category->seo_description }} </td>
                                <td>{{$category->redirect_type }}</td>
								<td> <a href="{{$category->redirect_url }}" target="_blank">{{$category->redirect_url }}</a></td>
								<td><a href="/admin/categories/edit/{{$category->id}}"
                                       class="btn btn-warning btn-sm">{{trans('messages.edit')}}</a>
                                </td>
                                <td><a data-href="/admin/categories/delete/{{$category->id}}" data-toggle="modal"
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
                                    {{trans('messages.delete_category')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4>
                                        <i class="fa fa-exclamation-triangle"></i> {{trans('messages.delete_category_desc')}}
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
            <!-- END PORTLET-->
        </div>
    </div>
@stop