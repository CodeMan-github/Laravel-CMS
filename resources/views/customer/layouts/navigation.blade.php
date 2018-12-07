<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler"></div>
            </li>





                <li class="{{(isset(Request::segments()[1]) && Request::segments()[1]=="posts")?'active':''}}">
                    <a href="/customer">
                        <i class="icon-notebook"></i>
                        <span class="title">{{trans('messages.posts')}}</span>
                    </a>
                </li>

            <li class="{{(isset(Request::segments()[2]) && Request::segments()[2]=="profile")?'active':''}}">
                <a href="/customer/profile">
                    <i class="icon-user"></i>
                    <span class="title">Profile</span>
                </a>
            </li>






            <li>
                <a href="/customer/logout">
                    <i class="icon-logout"></i>
                    <span class="title">{{trans('messages.logout')}}</span>
                </a>
            </li>

        </ul>
    </div>
</div>