<header class="header-wrapper clearfix">

    <div class="header" id="header">
        <div class="container">
            <div class="mag-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Mobile Menu Button -->
                        <a class="navbar-toggle collapsed" id="nav-button" href="#mobile-nav">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a><!-- .navbar-toggle -->

                        <!-- Main Nav Wrapper -->
                        <nav class="navbar mega-menu">
                            <a class="logo" href="/" title="{{$settings_general->site_title}}"
                               rel="home">
                                <img src="{{$settings_general->logo_120}}"/>
                            </a><!-- .logo -->

                            <!-- Navigation Menu -->
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">

                                    @foreach($global_cats as $index => $cat)

                                        @if($cat->show_in_menu == 1)

                                            @if($cat->show_as_mega_menu == 1)
                                                <li class="dropdown mega-full menu-color{{$index}}">
                                                    <a href="/category/{{$cat->slug}}" class="dropdown-toggle"
                                                       data-toggle="dropdown"
                                                       role="button" aria-expanded="false">{{$cat->title}}</a>

                                                    <ul class="dropdown-menu fullwidth">
                                                        <li>
                                                            <!-- Tababble Menu -->
                                                            <div class="tabbable tab-hover tabs-left">
                                                                <ul class="nav nav-tabs tab-hover">
                                                                    @foreach($cat->sub_categories as $index => $sub_category)
                                                                        <li>
                                                                            @if($index == 0)
                                                                                <a href="#category_{{$sub_category->id}}"
                                                                                   data-href="/category/{{$cat->slug}}/{{$sub_category->slug}}"
                                                                                   data-toggle="tab"
                                                                                   class="first go_page">{{$sub_category->title}}</a>
                                                                            @else
                                                                                <a href="#category_{{$sub_category->id}}"
                                                                                   data-href="/category/{{$cat->slug}}/{{$sub_category->slug}}"
                                                                                   data-toggle="tab"
                                                                                   class="go_page">{{$sub_category->title}}</a>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <!-- .nav .nav-tabs .tab-hover -->

                                                                <div class="tab-content">

                                                                    @foreach($cat->sub_categories as $index => $sub_category)
                                                                        <div class="tab-pane {{$index == 0?'active':''}}"
                                                                             id="category_{{$sub_category->id}}">
                                                                            @foreach($sub_category->mega_menu_posts as $post)
                                                                                <div class="mega-menu-news">


                                                                                    <div class="mega-menu-img">

                                                                                        @if($post->render_type == \App\Posts::RENDER_TYPE_IMAGE || $post->render_type == \App\Posts::RENDER_TYPE_GALLERY)
                                                                                            <a href="/{{$post->slug}}">
                                                                                                <img class="entry-thumb"
                                                                                                     src="{{$post->featured_image}}"
                                                                                                     alt="{{$post->title}}"
                                                                                                     title="{{$post->title}}">
                                                                                            </a>
                                                                                        @endif

                                                                                        @if($post->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                                                            <figure class="image-overlay">
                                                                                                {!! $post->video_embed_code !!}
                                                                                            </figure>
                                                                                        @endif


                                                                                    </div>
                                                                                    <!-- .mega-menu-img-->

                                                                                    <div class="mega-menu-detail">
                                                                                        <h4 class="entry-title">
                                                                                            <a href="/{{$post->slug}}">{{$post->title}}</a>
                                                                                        </h4><!-- .entry-title -->

                                                                                        @if($post->rating_box == 1)
                                                                                            <p class="simple-share">
                                                                                        <span class="read_only_raty"
                                                                                              data-score="{{$post->average_rating}}"></span>
                                                                                            </p><!-- .simple-share -->
                                                                                        @endif
                                                                                    </div>
                                                                                    <!-- .mega-menu-detail-->

                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="dropdown menu-color{{$index}}">
                                                    @if(sizeof($cat->sub_categories) > 0)
                                                        <a href="/category/{{$cat->slug}}" class="dropdown-toggle"
                                                           data-toggle="dropdown" role="button"
                                                           aria-expanded="false">{{$cat->title}}</a>
                                                    @else
                                                        <a href="/category/{{$cat->slug}}" {{sizeof($cat->sub_categories) > 0 ? 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"':''}}>{{$cat->title}}</a>
                                                    @endif


                                                    <ul class="dropdown-menu">
                                                        @foreach($cat->sub_categories as $sub_cat)
                                                            <li>
                                                                <a href="/category/{{$cat->slug}}/{{$sub_cat->slug}}">{{$sub_cat->title}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>


                                            @endif


                                        @endif

                                    @endforeach

                                </ul>
                            </div>

                            <div class="header-right">

                                <div class="social-icons">

                                    <a href="/customer/login"> <input type="submit" value="Create Article" class="button btn btn-primary" style="border-radius: 25px;" > </a>

                                @if(strlen($settings_social->fb_page_url) > 0)
                                        <a href="{{$settings_social->fb_page_url}}" data-toggle="tooltip"
                                           data-placement="bottom" title="Facebook"><i
                                                    class="fa fa-facebook fa-lg"></i></a>
                                    @endif

                                    @if(strlen($settings_social->twitter_url) > 0)
                                        <a href="{{$settings_social->twitter_url}}" data-toggle="tooltip"
                                           data-placement="bottom" title="Twitter"><i
                                                    class="fa fa-twitter fa-lg"></i></a>
                                    @endif

                                    @if(strlen($settings_social->google_plus_page_url) > 0)
                                        <a href="{{$settings_social->google_plus_page_url}}" data-toggle="tooltip"
                                           data-placement="bottom" title="Google+"><i
                                                    class="fa fa-google-plus fa-lg"></i></a>
                                    @endif

                                    @if(strlen($settings_social->skype_username) > 0)
                                        <a href="skype:{{$settings_social->skype_username}}" data-toggle="tooltip"
                                           data-placement="bottom" title="Skype"><i
                                                    class="fa fa-skype fa-lg"></i></a>
                                    @endif

                                    @if(strlen($settings_social->youtube_channel_url) > 0)
                                        <a href="{{$settings_social->youtube_channel_url}}" data-toggle="tooltip"
                                           data-placement="bottom" title="Youtube"><i
                                                    class="fa fa-youtube fa-lg"></i></a>
                                    @endif

                                    @if(strlen($settings_social->vimeo_channel_url) > 0)
                                        <a href="{{$settings_social->vimeo_channel_url}}" data-toggle="tooltip"
                                           data-placement="bottom" title="vimeo"><i
                                                    class="fa fa-vimeo fa-lg"></i></a>
                                        @endif

                                                <!-- Only for Fixed Sidebar Layout -->
                                        <a href="#" class="fixed-button navbar-toggle" id="fixed-button">
                                            <i></i>
                                            <i></i>
                                            <i></i>
                                            <i></i>
                                        </a><!-- .fixed-button -->
                                </div>
                                <!-- .social-icons -->
                            </div>
                            <!-- .header-right -->

                        </nav>
                        <!-- .navbar -->

                        <div id="sb-search" class="sb-search">
                            <form action="/search" method="GET">
                                <input class="sb-search-input" placeholder="{{trans('messages.search..')}}" type="text"
                                       value="" name="search" id="search">
                                <input class="sb-search-submit" type="submit" value="">
                                    <span class="sb-icon-search fa fa-search" data-toggle="tooltip"
                                          data-placement="bottom" title="Search"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .container -->
    </div>
    <!-- .header -->

</header>