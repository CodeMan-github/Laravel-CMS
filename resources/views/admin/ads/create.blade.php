@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script src="/assets/plugins/redactor/plugins/imagemanager.js"></script>
    <script src="/assets/plugins/redactor/redactor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#description').redactor({
                imageUpload: '/admin/redactor',
                imageManagerJson: '/admin/redactor/images.json',
                plugins: ['imagemanager'],
                replaceDivs: false,
                convertDivs: false,
                uploadImageFields: {
                    _token: "{{csrf_token()}}"
                }
            });
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
                <a href="/admin/ads">{{trans('messages.ads')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/ads/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-frame"></i>{{trans('messages.create_new_ad')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/ads/create" id="form-username" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label for="code" class="col-sm-3 control-label">{{trans('messages.ad_code')}}</label>

                            <div class="col-sm-8">
                                <textarea cols="10" rows="8" id="code" name="code"
                                          class="form-control">{{old('code')}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="position" class="col-sm-3 control-label">{{trans('messages.position')}}</label>

                            <div class="col-sm-8">
                                <select id="position" class="form-control" name="position">
                                    <option value="{{\App\Ads::TYPE_INDEX_HEADER}}">{{trans('messages.index_page_header')}}</option>
                                    <option value="{{\App\Ads::TYPE_INDEX_FOOTER}}">{{trans('messages.index_page_footer')}}</option>
                                    <option value="{{\App\Ads::TYPE_SIDEBAR}}">{{trans('messages.sidebar')}}</option>
                                    <option value="{{\App\Ads::TYPE_ABOVE_POST}}">{{trans('messages.above_each_post')}}</option>
                                    <option value="{{\App\Ads::TYPE_BELOW_POST}}">{{trans('messages.below_each_post')}}</option>
                                    <option value="{{\App\Ads::TYPE_BETWEEN_CATEGORY_INDEX}}">{{trans('messages.between_category_pages')}}</option>
                                    <option value="{{\App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX}}">{{trans('messages.between_sub_category_pages')}}</option>
                                    <option value="{{\App\Ads::TYPE_BETWEEN_AUTHOR_INDEX}}">{{trans('messages.between_author_pages')}}</option>
                                    <option value="{{\App\Ads::TYPE_BETWEEN_TAG_INDEX}}">{{trans('messages.between_tag_pages')}}</option>
                                    <option value="{{\App\Ads::TYPE_BETWEEN_SEARCH_INDEX}}">{{trans('messages.between_search_pages')}}</option>
                                    <option value="{{\App\Ads::TYPE_ABOVE_PAGE}}">{{trans('messages.above_each_page')}}</option>
                                    <option value="{{\App\Ads::TYPE_BELOW_PAGE}}">{{trans('messages.below_each_page')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i> {{trans('messages.save')}}</button>
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