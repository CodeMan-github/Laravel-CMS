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
        {{trans('messages.ads_section')}}
        <small>{{trans('messages.manage_ads')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/ads">{{trans('messages.ads_section')}}</a>
            </li>

        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-meadow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle"></i>{{trans('messages.all_ads')}}
                    </div>
                    <div class="actions">
                        <a href="/admin/ads/create" class="btn red">
                            <i class="fa fa-plus"></i> {{trans('messages.create_new_ad')}} </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <table class="table table-striped table-bordered table-hover" id="datatable_advanced">
                        <thead>
                        <tr>
                            <th>{{trans('messages.id')}}</th>
                            <th>{{trans('messages.code')}}</th>
                            <th>{{trans('messages.position')}}</th>
                            <th>{{trans('messages.edit')}}</th>
                            <th>{{trans('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ads as $ad)
                            <tr>
                                <td> {{$ad->id}} </td>
                                <td> {{$ad->code}} </td>

                                @if($ad->position == \App\Ads::TYPE_INDEX_HEADER)
                                    <td> {{trans('messages.index_page_header')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_INDEX_FOOTER)
                                    <td> {{trans('messages.index_page_footer')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_SIDEBAR)
                                    <td> {{trans('messages.sidebar')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_ABOVE_POST)
                                    <td> {{trans('messages.above_each_post')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BELOW_POST)
                                    <td> {{trans('messages.below_each_post')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BETWEEN_CATEGORY_INDEX)
                                    <td> {{trans('messages.between_category_pages')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX)
                                    <td> {{trans('messages.between_sub_category_pages')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BETWEEN_AUTHOR_INDEX)
                                    <td> {{trans('messages.between_author_pages')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BETWEEN_TAG_INDEX)
                                    <td> {{trans('messages.between_tag_pages')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BETWEEN_SEARCH_INDEX)
                                    <td> {{trans('messages.between_search_pages')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_ABOVE_PAGE)
                                    <td> {{trans('messages.above_each_page')}} </td>
                                @endif

                                @if($ad->position == \App\Ads::TYPE_BELOW_PAGE)
                                    <td> {{trans('messages.below_each_page')}} </td>
                                @endif

                                <td><a href="/admin/ads/edit/{{$ad->id}}"
                                       class="btn btn-warning btn-sm">{{trans('messages.edit')}}</a>
                                </td>
                                <td><a data-href="/admin/ads/delete/{{$ad->id}}" data-toggle="modal"
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
                                    {{trans('messages.delete_ad')}}
                                </div>
                                <div class="modal-body" style="background-color:#FFB848; color:#ffffff;">
                                    <h4><i class="fa fa-exclamation-triangle"></i>{{trans('messages.delete_ad_desc')}}
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