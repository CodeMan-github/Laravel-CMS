@extends('admin.layouts.master')

@section('extra_js')
    <script type="text/javascript">
        $(document).ready(function () {

            var category_el = $('#category');

            $('#pullFeeds').on('click', function () {

                var url_el = $('#url');

                if (url_el.val().length <= 0) {
                    toastr.error('URL field is required', 'Error');
                }

                $.ajax({
                    url: '/admin/sources/pull_feeds',
                    data: {'url': url_el.val()},
                    success: function (response) {

                        if (response.result = 1) {
                            $('#pullTitle').html(response.data.title);
                            $('#pullDescription').html(response.data.description);
                        } else {
                            toastr.error(response.message, 'Error');
                        }


                        return false;
                    },
                    error: function (response) {
                        toastr.error('Internal Server Error . Please refresh and try again', 'Error');
                    }
                });

                return false;

            });


            category_el.on('change', function () {
                $.ajax({
                    url: "/admin/api/get_sub_categories_by_category/" + $('#category').val(),
                    success: function (sub_categories) {

                        var $sub_category_select = $('#sub_category');
                        $sub_category_select.find('option').remove();

                        $.each(sub_categories, function (key, value) {
                            $sub_category_select.append('<option value=' + value['id'] + '>' + value['title'] + '</option>');
                        });
                    },
                    error: function (response) {
                    }
                });
            });

            category_el.trigger('change');
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
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/sources/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.create_new_source')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>


                <div class="portlet-body form">

                    <form action="/admin/sources/create" id="form-username" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">{{trans('messages.url')}}</label>

                            <div class="col-sm-8">
                                <input id="url" class="form-control" type="text" name="url"
                                       placeholder="{{trans('messages.enter_feed_url')}}" value="{{old('url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="priority" class="col-sm-3 control-label">{{trans('messages.priority')}}</label>

                            <div class="col-sm-8">
                                <input id="priority" type="number" name="priority" value="1" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-sm-3 control-label">{{trans('messages.category')}}</label>

                            <div class="col-sm-8">
                                <select id="category" name="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sub_category"
                                   class="col-sm-3 control-label">{{trans('messages.sub_category')}}</label>

                            <div class="col-sm-8">
                                <select id="sub_category" name="sub_category" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">{{trans('messages.status')}}</label>

                            <div class="col-sm-8">
                                <select id="status" class="form-control" name="status">
                                    <option value="{{\App\Posts::STATUS_PUBLISHED}}">{{trans('messages.published')}}</option>
                                    <option value="{{\App\Posts::STATUS_HIDDEN}}">{{trans('messages.hidden')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="fetch_full_text"
                                           type="checkbox"> {{trans('messages.fetch_full_text')}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="use_auto_spin"
                                           type="checkbox"> {{trans('messages.use_auto_spin')}}
                                </label>
                                <span class="help-block"> {{trans('messages.will_only_work_with_english_locale')}}</span>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-8">
                                <label>
                                    <input name="auto_update" id="auto_update"
                                           type="checkbox"> {{trans('messages.auto_update')}} </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"> </label>

                            <div class="col-sm-8">
                                <label>
                                    <input checked name="dont_show_author_publisher" id="dont_show_author_publisher"
                                           type="checkbox"> {{trans('messages.dont_show_author_publisher')}} </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"> </label>

                            <div class="col-sm-8">
                                <label>
                                    <input checked name="show_post_source" id="show_post_source"
                                           type="checkbox"> {{trans('messages.show_source_in_credits')}} </label>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-8">
                                <h3 id="pullTitle"></h3>

                                <p id="pullDescription"></p>
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-2">
                                    <button type="submit" class="btn purple"><i
                                                class="fa fa-check"></i> {{trans('messages.save')}}</button>
                                </div>
                                <div class="col-md-3">
                                    <button id="pullFeeds" class="btn blue"> {{trans('messages.test_random_post')}}
                                    </button>
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