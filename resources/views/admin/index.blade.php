@extends('admin.layouts.master')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin">{{trans('messages.dashboard')}}</a>
            </li>
        </ul>

    </div>

    <h3 class="page-title">
        {{trans('messages.dashboard')}}
        <small>{{trans('messages.reports_statistics')}}</small>
    </h3>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users"></i>{{trans('messages.manage_dashboard')}}
                    </div>
                </div>
                <div class="portlet-body">


                    @include('admin.layouts.notify')

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="core-box">
                                <div class="heading">
                                    <i class="clip-database circle-icon circle-dark-blue"></i>

                                    <h2>{{trans('messages.manage_users_settings')}}</h2>
                                </div>
                                <div class="content">
                                    {{trans('messages.manage_users_settings_desc')}}
                                </div>

                                <br>

                                <div class="btn-group btn-group-justified">
                                    @if(\App\Users::hasPermission("users.add"))
                                        <a class="btn btn-primary" href="/admin/users/create">
                                            {{trans('messages.new_user')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("users.view"))
                                        <a class="btn btn-primary" href="/admin/users/all">
                                            {{trans('messages.all_users')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif
                                </div>
                                <br/>

                                <div class="btn-group btn-group-justified">
                                    @if(\App\Users::hasPermission("settings.view"))
                                        <a class="btn btn-success" href="/admin/settings">
                                            {{trans('messages.settings')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("statistics.view"))
                                        <a class="btn btn-success" href="/admin/statistics">
                                            {{trans('messages.analytics')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("ad_sections.view"))
                                        <a class="btn btn-success" href="/admin/ads">
                                            {{trans('messages.ads')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="core-box">
                                <div class="heading">
                                    <i class="clip-folder circle-icon circle-dark-blue"></i>

                                    <h2>{{trans('messages.content_management')}}</h2>
                                </div>
                                <div class="content">
                                    {{trans('messages.content_management_desc')}}
                                </div>

                                </br>

                                <div class="btn-group btn-group-justified">
                                    @if(\App\Users::hasPermission("posts.add"))
                                        <a class="btn btn-primary" href="/admin/posts/create">
                                            {{trans('messages.create_new_post')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("posts.view"))
                                        <a class="btn btn-primary" href="/admin/posts">
                                            {{trans('messages.all_posts')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif
                                </div>
                                <br/>

                                <div class="btn-group btn-group-justified">
                                    @if(\App\Users::hasPermission("categories.add"))
                                        <a class="btn btn-success" href="/admin/categories/create">
                                            {{trans('messages.new_category')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("categories.view"))
                                        <a class="btn btn-success" href="/admin/categories">
                                            {{trans('messages.categories')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                </div>
                                <br/>

                                <div class="btn-group btn-group-justified">
                                    @if(\App\Users::hasPermission("sources.add"))
                                        <a class="btn btn-default" href="/admin/sources/create">
                                            {{trans('messages.new_category')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif

                                    @if(\App\Users::hasPermission("sources.view"))
                                        <a class="btn btn-default" href="/admin/sources">
                                            {{trans('messages.all_sources')}} <i class="clip-arrow-right-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                {{$sources_count}}
                            </div>
                            <div class="desc">
                                {{trans('messages.no_of_sources')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat yellow-casablanca">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                {{$posts_count}}
                            </div>
                            <div class="desc">
                                {{trans('messages.no_of_posts')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                {{$users_count}}
                            </div>
                            <div class="desc">
                                {{trans('messages.all_users')}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop