<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">

        <div class="page-logo">
            <a href="/">
                <img src="{{$logo}}" alt="logo" class="logo-default"/>
            </a>

            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-user">

                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile">{{Auth::user()->name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-default">

                        <li>
                            <a href="/customer/logout">
                                <i class="icon-key"></i> {{trans('messages.logout')}} </a>
                        </li>
                    </ul>

                </li>

                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="/customer/logout" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>