<footer class="footer source-org vcard copyright clearfix" id="footer" role="contentinfo">
    <div class="footer-main">
        <div class="fixed-main">
            <div class="container">
                <div class="mag-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="footer-block clearfix">
                                <p class="clearfix">
                                    <a class="logo" href="/"
                                       title="{{$settings_general->site_title}}" rel="home">
                                        <img src="{{$settings_general->logo_120}}"/>
                                    </a><!-- .logo -->
                                </p>

                                <p class="description">
                                    {{$settings_seo->seo_description}}
                                </p>

                                <ul class="social-list clearfix">
                                    @if(strlen($settings_social->fb_page_url) > 0)
                                        <li class="social-facebook">
                                            <a href="{{$settings_social->fb_page_url}}" data-toggle="tooltip"
                                               data-placement="bottom" title=""
                                               data-original-title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(strlen($settings_social->twitter_url) > 0)
                                        <li class="social-twitter" data-toggle="tooltip" data-placement="bottom"
                                            title=""
                                            data-original-title="Twitter">
                                            <a href="{{$settings_social->twitter_url}}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(strlen($settings_social->google_plus_page_url) > 0)
                                        <li class="social-gplus">
                                            <a href="{{$settings_social->google_plus_page_url}}" data-toggle="tooltip"
                                               data-placement="bottom" title=""
                                               data-original-title="Google+">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(strlen($settings_social->skype_username) > 0)
                                        <li class="social-skype">
                                            <a href="skype:{{$settings_social->skype_username}}" data-toggle="tooltip"
                                               data-placement="bottom" title=""
                                               data-original-title="Skype">
                                                <i class="fa fa-skype"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if(strlen($settings_social->youtube_channel_url) > 0)
                                        <li class="social-youtube">
                                            <a href="{{$settings_social->youtube_channel_url}}" data-toggle="tooltip"
                                               data-placement="bottom" title=""
                                               data-original-title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if($settings_general->generate_rss_feeds == 1)
                                        <li class="social-rss">
                                            <a href="/rss.xml" data-toggle="tooltip" data-placement="bottom" title=""
                                               data-original-title="RSS">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Footer Block -->
                        </div>

                        <div class="col-md-2">
                            <div class="footer-block clearfix">
                                <h3 class="footer-title">{{trans('messages.categories')}}</h3>
                                <ul class="footer-menu">
                                    @foreach($global_cats as $cat)
                                        @if($cat->show_in_sidebar == 1)
                                            <li>
                                                <a href="/category/{{$cat->slug}}">{{$cat->title}} <span
                                                            class="count">{{$cat->post_count}}</span></a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Footer Block -->
                        </div>

                        <div class="col-md-2">
                            <div class="footer-block clearfix">
                                <h3 class="footer-title">{{trans('messages.pages')}}</h3>
                                <ul class="footer-menu">
                                    @if(sizeof($global_pages) > 0)
                                        @foreach($global_pages as $page)
                                            @if($page->show_in_footer == 1)
                                                <li>
                                                    <a href="/page/{{$page->slug}}">{{$page->title}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- Footer Block -->
                        </div>

                        <div class="col-md-2">
                            <div class="footer-block clearfix">
                                <h3 class="footer-title">{{trans('messages.tags')}}</h3>
                                <ul class="tags-widget">
                                    @foreach($popular_tags as $tag)
                                        <li><a href="/tag/{{$tag->slug}}">{{$tag->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Footer Block -->
                        </div>

                        <div class="col-md-2">
                            <div class="footer-block clearfix">
                                @if(!empty($settings_general->mailchimp_form))
                                    <h3 class="footer-title">{{trans('messages.subscribe')}}</h3>

                                    <p>{{trans('messages.we_dont_spam_loyal')}}</p>

                                    <!-- Begin MailChimp Signup Form -->
                                    <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
                                    <style type="text/css">
                                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                    </style>
                                    <div id="mc_embed_signup" style="background:#373737 !important;">
                                        <form action="//theviralweb.us11.list-manage.com/subscribe/post?u=c520fddc4d1f9211c7e8e2cff&id=6f2bdbeb70" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                            <div id="mc_embed_signup_scroll">
                                                <label for="mce-EMAIL">Subscribe to our mailing list</label>
                                                <input type="email" style="width:200px;color:black;" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                <div style="position: absolute; left: -5000px;"><input type="text" name="b_c520fddc4d1f9211c7e8e2cff_6f2bdbeb70" tabindex="-1" value=""></div>
                                                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                            </div>
                                        </form>
                                    </div>

                                    <!--End mc_embed_signup-->
                                @else
                                    @if(!empty($settings_social->twitter_box_js))
                                        <div class="widget tabwidget">
                                            {!! $settings_social->twitter_box_js !!}
                                        </div>
                                    @else
                                        @if(!empty($settings_social->facebook_box_js))
                                            <div class="widget tabwidget">
                                                {!! $settings_social->facebook_box_js !!}
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            <!-- Footer Block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom clearfix">
        <div class="fixed-main">
            <div class="container">
                <div class="mag-content">
                    <div class="row">
                        <div class="col-md-6">
                            <p>{{trans('messages.copyright')}} {{$settings_general->site_title}} © {{trans('messages.year')}}. {{trans('messages.all_rights_reserved')}}</p>
                        </div>

                        <div class="col-md-6">
                            <div class="social-icons pull-right">

                                @if(strlen($settings_social->fb_page_url) > 0)
                                    <a href="{{$settings_social->fb_page_url}}"><i class="fa fa-facebook"></i></a>
                                @endif

                                @if(strlen($settings_social->twitter_url) > 0)
                                    <a href="{{$settings_social->twitter_url}}"><i class="fa fa-twitter"></i></a>
                                @endif

                                @if($settings_general->generate_rss_feeds == 1)
                                    <a href="/rss.xml"><i class="fa fa-rss"></i></a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
