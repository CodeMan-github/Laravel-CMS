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
        {{trans('messages.tags')}}
        <small>{{trans('messages.manage_tags')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <a href="/admin/tags">{{trans('messages.tags')}}</a>
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
                        <i class="icon-tag"></i>{{trans('messages.all_tags')}}
                    </div>
                </div>

                <figure class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{trans('messages.id')}}</th>
                            <th>{{trans('messages.title')}}</th>
                            <th>{{trans('messages.slug')}}</th>
                            <th>{{trans('messages.view')}}</th>
                            <th>{{trans('messages.posts_count')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $t)
                            <tr>
                                <td> {{$t->id}} </td>
                                <td> {{$t->title}} </td>
                                <td> {{$t->slug}} </td>
                                <td> {{$t->views}} </td>
                                <td> {{$t->post_count}} </td>
                                <td><a data-href="/admin/tags/delete/{{$t->id}}" data-toggle="modal"
                                       data-target="#confirm-delete"
                                       class="btn btn-danger btn-sm">{{trans('messages.delete')}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <?php echo $tags->render(); ?>


                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{trans('messages.delete_tag')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4><i class="fa fa-exclamation-triangle"></i> {{trans('messages.delete_tag_desc')}}
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
                </figure>
            </div>
        </div>
    </div>
@stop