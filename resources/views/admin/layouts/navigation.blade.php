<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler"></div>
            </li>

            <li class="start {{sizeof(Request::segments())==1?'active':''}} ">
                <a href="/admin">
                    <i class="icon-home"></i>
                    <span class="title">{{trans('messages.dashboard')}}</span>
                </a>
            </li>

            @if(\App\Users::hasPermission("categories.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="categories")?'active':''}}">
                    <a href="/admin/categories">
                        <i class="icon-puzzle"></i>
                        <span class="title">{{trans('messages.categories')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("sub_categories.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="sub_categories")?'active':''}}">
                    <a href="/admin/sub_categories">
                        <i class="icon-note"></i>
                        <span class="title">{{trans('messages.sub_categories')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("sources.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="sources")?'active':''}}">
                    <a href="/admin/sources">
                        <i class="icon-feed"></i>
                        <span class="title">{{trans('messages.sources')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("posts.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="posts")?'active':''}}">
                    <a href="/admin/posts">
                        <i class="icon-notebook"></i>
                        <span class="title">{{trans('messages.posts')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("posts.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="lists")?'active':''}}">
                    <a href="/admin/lists">
                        <i class="icon-list"></i>
                        <span class="title">Lists</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("tags.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="tags")?'active':''}}">
                    <a href="/admin/tags">
                        <i class="icon-tag"></i>
                        <span class="title">{{trans('messages.tags')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("ratings.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="ratings")?'active':''}}">
                    <a href="/admin/ratings">
                        <i class="icon-star"></i>
                        <span class="title">{{trans('messages.ratings')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("pages.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="pages")?'active':''}}">
                    <a href="/admin/pages">
                        <i class="icon-docs"></i>
                        <span class="title">{{trans('messages.pages')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("users.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="users")?'active':''}}">
                    <a href="/admin/users">
                        <i class="icon-users"></i>
                        <span class="title">{{trans('messages.users')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("ad_sections.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="ads")?'active':''}}">
                    <a href="/admin/ads">
                        <i class="icon-frame"></i>
                        <span class="title">{{trans('messages.ads_section')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("statistics.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="statistics")?'active':''}}">
                    <a href="/admin/statistics">
                        <i class="icon-bar-chart"></i>
                        <span class="title">{{trans('messages.statistics')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("crons.all"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="crons")?'active':''}}">
                    <a href="/admin/crons">
                        <i class="fa fa-cubes"></i>
                        <span class="title">{{trans('messages.cron_logs')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("roles.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="roles")?'active':''}}">
                    <a href="/admin/roles">
                        <i class="icon-lock"></i>
                        <span class="title">{{trans('messages.user_roles')}}</span>
                    </a>
                </li>
            @endif

            @if(\App\Users::hasPermission("settings.view"))
                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="settings")?'active':''}}">
                    <a href="/admin/settings">
                        <i class="icon-settings"></i>
                        <span class="title">{{trans('messages.settings')}}</span>
                    </a>
                </li>
            @endif

            <li>
                <a href="/logout">
                    <i class="icon-logout"></i>
                    <span class="title">{{trans('messages.logout')}}</span>
                </a>
            </li>

        </ul>
    </div>
</div>