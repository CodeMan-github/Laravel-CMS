@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script src="/assets/plugins/redactor/plugins/imagemanager.js" data-cfasync='false'></script>
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



            $('#{{\App\Posts::COMMENT_DISQUS}}_div').hide();

            $('#comment_system').on('change', function () {
                $selected = $('#comment_system option:selected').val();


                if ($selected == "{{\App\Posts::COMMENT_FACEBOOK}}") {
                    $('#{{\App\Posts::COMMENT_FACEBOOK}}_div').show();

                    $('#{{\App\Posts::COMMENT_DISQUS}}_div').hide();

                }

                if ($selected == "{{\App\Posts::COMMENT_DISQUS}}") {
                    $('#{{\App\Posts::COMMENT_DISQUS}}_div').show();

                    $('#{{\App\Posts::COMMENT_FACEBOOK}}_div').hide();

                }

            });

            $('#comment_system').trigger('change');

        });
        $('#delete_news_days').change(function () {
            $('#delete_news_days_href').attr('href', '/admin/settings/delete_manually/' + $(this).val());
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{trans('messages.settings')}}
        <small>{{trans('messages.manage_settings')}} <a role="button" class="btn btn-primary btn-sm"
                                                        href="/admin/update_application">{{trans('messages.update_application')}}</a>
        </small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/settings">{{trans('messages.settings')}}</a>
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
                        <i class="icon-settings"></i>{{trans('messages.change_settings')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body">

                    @include('admin.layouts.notify')

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_general" data-toggle="tab">
                                {{trans('messages.general')}} </a>
                        </li>
                        <li>
                            <a href="#tab_seo" data-toggle="tab">
                                {{trans('messages.seo')}} </a>
                        </li>
                        <li>
                            <a href="#tab_comments" data-toggle="tab">
                                {{trans('messages.comments')}} </a>
                        </li>
                        <li>
                            <a href="#tab_social" data-toggle="tab">
                                {{trans('messages.social')}} </a>
                        </li>

                        <li>
                            <a href="#tab_old_news" data-toggle="tab">
                                {{trans('messages.delete_old_new')}} </a>
                        </li>

                        <li>
                            <a href="#tab_custom_js" data-toggle="tab">
                                {{trans('messages.custom_js')}} </a>
                        </li>

                        <li>
                            <a href="#tab_custom_css" data-toggle="tab">
                                {{trans('messages.custom_css')}} </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="tab_general">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_general" id="form-username" method="post"
                                          class="form-horizontal form-bordered" enctype="multipart/form-data">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="site_url"
                                                   class="col-sm-3 control-label">{{trans('messages.site_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="site_url" class="form-control" type="text" name="site_url"
                                                       placeholder="{{URL::to('/')}}"
                                                       value="{{old('site_url',$general->site_url)}}"/>
                                                <span class="help-block"> {{trans('messages.site_url_should_start_with_etc')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="site_title"
                                                   class="col-sm-3 control-label">{{trans('messages.site_title')}}</label>

                                            <div class="col-sm-8">
                                                <input id="site_title" class="form-control" type="text"
                                                       name="site_title"
                                                       placeholder="{{trans('messages.enter_site_title')}}"
                                                       value="{{old('site_title',$general->site_title)}}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="analytics_code"
                                                   class="col-sm-3 control-label">{{trans('messages.google_analytics_code')}}</label>

                                            <div class="col-sm-8">
                                <textarea id="analytics_code" class="form-control" name="analytics_code"
                                          placeholder="{{trans('messages.enter_google_analytics_code')}}">{{old('analytics_code',$general->analytics_code)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mailchimp_form"
                                                   class="col-sm-3 control-label">{{trans('messages.mailchimp_signup_form')}}</label>

                                            <div class="col-sm-8">
                                <textarea id="mailchimp_form" class="form-control" name="mailchimp_form"
                                          placeholder="{{trans('messages.enter_mailchimp_signup_form_code')}} ">{{old('mailchimp_form',$general->mailchimp_form)}}</textarea>
                                                <span class="help-block"> {{trans('messages.know_more_abt_mailchimp')}}
                                                    <a
                                                            href="http://kb.mailchimp.com/lists/signup-forms/add-a-signup-form-to-your-website">{{trans('messages.here')}}</a></span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="logo_76"
                                                   class="col-sm-3 control-label">{{trans('messages.logo_76_76')}}</label>

                                            <div class="col-sm-8">
                                                <input id="logo_76" class="form-control" name="logo_76" type="file"/>
                                            </div>
                                        </div>

                                        @if(strlen($general->logo_76)>0)
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <input type="hidden" name="logo_76_value"
                                                           value="{{$general->logo_76}}"/>
                                                    <img src="{{$general->logo_76}}"/>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="logo_120"
                                                   class="col-sm-3 control-label">{{trans('messages.logo_120_120')}}</label>

                                            <div class="col-sm-8">
                                                <input id="logo_120" class="form-control" name="logo_120" type="file"/>
                                            </div>
                                        </div>

                                        @if(strlen($general->logo_120)>0)
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <input type="hidden" name="logo_120_value"
                                                           value="{{$general->logo_120}}"/>
                                                    <img src="{{$general->logo_120}}"/>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="logo_152"
                                                   class="col-sm-3 control-label">{{trans('messages.logo_152_152')}}</label>

                                            <div class="col-sm-8">
                                                <input id="logo_152" class="form-control" name="logo_152" type="file"/>
                                            </div>
                                        </div>

                                        @if(strlen($general->logo_152)>0)
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <input type="hidden" name="logo_152_value"
                                                           value="{{$general->logo_152}}"/>
                                                    <img src="{{$general->logo_152}}"/>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="favicon"
                                                   class="col-sm-3 control-label">{{trans('messages.upload_favicon')}}</label>

                                            <div class="col-sm-8">
                                                <input type="hidden" name="favicon_value"
                                                       value="{{$general->favicon}}"/>
                                                <input id="favicon" class="form-control" name="favicon" type="file"/>
                                            </div>
                                        </div>

                                        @if(strlen($general->favicon)>0)
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <img src="{{$general->favicon}}"/>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">

                                            <label for="timezone"
                                                   class="col-sm-3 control-label">{{trans('messages.timezone')}}</label>

                                            <div class="col-md-8">
                                                <label>
                                                    <select class="form-control" id="timezone" name="timezone">
                                                        @foreach($timezones as $timezone)
                                                            <option {{$general->timezone == $timezone->code ?'selected':''}} value="{{$timezone->code}}">{{$timezone->code}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="locale"
                                                   class="col-sm-3 control-label">{{trans('messages.locale')}}</label>

                                            <div class="col-md-8">
                                                <label>
                                                    <select class="form-control" id="locale" name="locale">
                                                        @foreach($locales as $locale)
                                                            <option {{$general->locale == $locale->code?'selected':''}} value="{{$locale->code}}">{{$locale->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$general->site_post_as_titles == 1?'checked':''}}
                                                           name="site_post_as_titles"
                                                           type="checkbox"> {{trans('messages.post_title_as_site_title')}}
                                                </label>
                                                <span class="help-block"> {{trans('messages.post_title_as_site_title_help')}} </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$general->generate_sitemap == 1?'checked':''}}
                                                           name="generate_sitemap"
                                                           type="checkbox"> {{trans('messages.generate_sitemap')}}
                                                </label>
                                                <span class="help-block"> {{trans('messages.generate_sitemap_help')}} {{URL::to('/').'/sitemap.xml'}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$general->generate_rss_feeds == 1?'checked':''}}
                                                           name="generate_rss_feeds"
                                                           type="checkbox"> {{trans('messages.generate_rss_feeds')}}
                                                </label>
                                                <span class="help-block"> {{trans('messages.generate_rss_feeds_help')}} {{URL::to('/').'/rss.xml'}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$general->include_sources == 1 ? 'checked':''}}
                                                           name="include_sources"
                                                           type="checkbox"> {{trans('messages.include_post_from_sources')}}
                                                </label>
                                                <span class="help-block"> {{trans('messages.include_post_from_sources_help')}} </span>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_seo">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_seo" id="form-username" method="post"
                                          class="form-horizontal form-bordered">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="seo_keywords"
                                                   class="col-sm-3 control-label">{{trans('messages.seo_keywords')}}</label>

                                            <div class="col-sm-8">
                                <textarea id="seo_keywords" class="form-control" name="seo_keywords"
                                          placeholder="{{trans('messages.enter_seo_keywords')}}">{{old('seo_keywords',$seo->seo_keywords)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="seo_description"
                                                   class="col-sm-3 control-label">{{trans('messages.seo_description')}}</label>

                                            <div class="col-sm-8">
                                <textarea id="seo_description" class="form-control" name="seo_description"
                                          placeholder="{{trans('messages.enter_seo_description')}}">{{old('seo_description',$seo->seo_description)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="google_verify"
                                                   class="col-sm-3 control-label">{{trans('messages.google_webmaster_domain_verify')}}</label>

                                            <div class="col-sm-8">
                                                <input id="google_verify" class="form-control" type="text"
                                                       name="google_verify"
                                                       placeholder="{{trans('messages.google_webmaster_domain_verify_holder')}}"
                                                       value="{{old('google_verify',$seo->google_verify)}}"/>
                                                <span class="help-block"> {{trans('messages.google_webmaster_domain_verify_help')}}</span>
                                                <label class="label label-success">&#x3C;meta name=&#x22;google-site-verification&#x22;
                                                    content=&#x22;QsHIQMfsdaassq1kr8irG33KS7LoaJhZY8XLTdAQ7PA&#x22; /&#x3E;</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bing_verify"
                                                   class="col-sm-3 control-label">{{trans('messages.bing_webmaster_domain_verify')}}</label>

                                            <div class="col-sm-8">
                                                <input id="bing_verify" class="form-control" type="text"
                                                       name="bing_verify"
                                                       placeholder="{{trans('messages.bing_webmaster_domain_verify_holder')}}"
                                                       value="{{old('bing_verify',$seo->bing_verify)}}"/>
                                                <span class="help-block"> {{trans('messages.bing_webmaster_domain_verify_help')}}</span>
                                                <label class="label label-success">&#x3C;meta name=&#x22;msvalidate.01&#x22;
                                                    content=&#x22;5A3A378F55B7518E3733ffS784711DC0&#x22; /&#x3E;</label>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_comments">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_comments" id="form-username" method="post"
                                          class="form-horizontal form-bordered" enctype="multipart/form-data">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="comment_system"
                                                   class="col-sm-3 control-label">{{trans('messages.select_commenting_system')}}</label>

                                            <div class="col-sm-8">
                                                <select class="form-control" id="comment_system" name="comment_system">

                                                    <option {{($comments->comment_system == \App\Posts::COMMENT_FACEBOOK)?'selected':''}}
                                                            value="{{\App\Posts::COMMENT_FACEBOOK}}">{{trans('messages.facebook')}}
                                                    </option>
                                                    <option {{($comments->comment_system == \App\Posts::COMMENT_DISQUS)?'selected':''}}
                                                            value="{{\App\Posts::COMMENT_DISQUS}}">{{trans('messages.disqus')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="{{\App\Posts::COMMENT_FACEBOOK}}_div">

                                            <div class="form-group">
                                                <label for="fb_js"
                                                       class="col-sm-3 control-label">{{trans('messages.fb_commenting_js_code')}}</label>

                                                <div class="col-sm-8">
                                <textarea id="fb_js" class="form-control" name="fb_js"
                                          placeholder="{{trans('messages.fb_commenting_js_code_holder')}}">{{old('fb_js',$comments->fb_js)}}</textarea>
                                                    <span class="help-block"><a
                                                                href="https://developers.facebook.com/docs/plugins/comments#code-generator">{{trans('messages.click_here')}}</a> {{trans('messages.fb_commenting_js_code_help')}}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="fb_num_posts"
                                                       class="col-sm-3 control-label">{{trans('messages.no_of_posts')}}</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="fb_num_posts" class="form-control"
                                                           name="fb_num_posts"
                                                           placeholder="{{trans('messages.no_of_posts_to_display')}}"
                                                           value="{{old('fb_num_posts',$comments->fb_num_posts)}}"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <label>
                                                        <input {{$comments->fb_comment_count == 1 ? 'checked':''}}
                                                               name="fb_comment_count"
                                                               type="checkbox"> {{trans('messages.show_comment_count')}}
                                                    </label>

                                                </div>
                                            </div>


                                        </div>

                                        <div id="{{\App\Posts::COMMENT_DISQUS}}_div">

                                            <div class="form-group">
                                                <label for="disqus_js"
                                                       class="col-sm-3 control-label">{{trans('messages.disqus_js_code')}}</label>

                                                <div class="col-sm-8">
                                <textarea id="disqus_js" class="form-control" name="disqus_js"
                                          placeholder="{{trans('messages.disqus_js_code')}}">{{old('disqus_js',$comments->disqus_js)}}</textarea>
                                                    <span class="help-block">{{trans('messages.disqus_js_code_help')}}
                                                        <a
                                                                href="https://disqus.com/"> {{trans('messages.click_here')}} </a> {{trans('messages.for_more_info_disqus')}}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-8">
                                                    <label>
                                                        <input {{$comments->disqus_comment_count == 1 ?'checked':'' }}
                                                               name="disqus_comment_count"
                                                               type="checkbox"> {{trans('messages.show_comment_count')}}
                                                    </label>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$comments->show_comment_box == 1 ?'checked':'' }}
                                                           name="show_comment_box"
                                                           type="checkbox"> {{trans('messages.show_comment_box')}}
                                                </label>

                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_social">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_social" id="form-username" method="post"
                                          class="form-horizontal form-bordered" enctype="multipart/form-data">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="fb_page_url"
                                                   class="col-sm-3 control-label">{{trans('messages.facebook_page_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="fb_page_url" class="form-control" type="text"
                                                       name="fb_page_url"
                                                       placeholder="{{trans('messages.enter_facebook_page_url')}}"
                                                       value="{{old('fb_page_url',$social->fb_page_url)}}"/>
                                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter_url"
                                                   class="col-sm-3 control-label">{{trans('messages.twitter_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="twitter_url" class="form-control" type="text"
                                                       name="twitter_url"
                                                       placeholder="{{trans('messages.enter_twitter_url')}}"
                                                       value="{{old('twitter_url',$social->twitter_url)}}"/>
                                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter_handle"
                                                   class="col-sm-3 control-label">{{trans('messages.twitter_handle')}}</label>

                                            <div class="col-sm-8">
                                                <input id="twitter_handle" class="form-control" type="text"
                                                       name="twitter_handle"
                                                       placeholder="{{trans('messages.enter_twitter_handle')}}"
                                                       value="{{old('twitter_handle',$social->twitter_handle)}}"/>
                                                <span class="help-block"> {{trans('messages.twitter_handle_help')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="google_plus_page_url"
                                                   class="col-sm-3 control-label">{{trans('messages.google_page_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="google_plus_page_url" class="form-control" type="text"
                                                       name="google_plus_page_url"
                                                       placeholder="{{trans('messages.google_page_url_holder')}}"
                                                       value="{{old('google_plus_page_url',$social->google_plus_page_url)}}"/>
                                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="skype_username"
                                                   class="col-sm-3 control-label">{{trans('messages.skype_username')}}</label>

                                            <div class="col-sm-8">
                                                <input id="skype_username" class="form-control" type="text"
                                                       name="skype_username"
                                                       placeholder="{{trans('messages.enter_skype_username')}}"
                                                       value="{{old('skype_username',$social->skype_username)}}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube_channel_url"
                                                   class="col-sm-3 control-label">{{trans('messages.youtube_channel_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="youtube_channel_url" class="form-control" type="text"
                                                       name="youtube_channel_url"
                                                       placeholder="{{trans('messages.enter_youtube_channel_url')}}"
                                                       value="{{old('youtube_channel_url',$social->youtube_channel_url)}}"/>
                                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}} </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="vimeo_channel_url"
                                                   class="col-sm-3 control-label">{{trans('messages.vimeo_channel_url')}}</label>

                                            <div class="col-sm-8">
                                                <input id="vimeo_channel_url" class="form-control" type="text"
                                                       name="vimeo_channel_url"
                                                       placeholder="{{trans('messages.enter_vimeo_channel_url')}}"
                                                       value="{{old('vimeo_channel_url',$social->vimeo_channel_url)}}"/>
                                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="addthis_js"
                                                   class="col-sm-3 control-label">{{trans('messages.addthis_js_code')}}</label>

                                            <div class="col-sm-8">
                                                <textarea id="addthis_js" class="form-control" name="addthis_js"
                                                          placeholder="{{trans('messages.paste_addthis_js_code')}}">{{old('addthis_js',$social->addthis_js)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sharethis_js"
                                                   class="col-sm-3 control-label">{{trans('messages.sharethis_span_tags')}}</label>

                                            <div class="col-sm-8">
                                                <textarea id="sharethis_span_tags" class="form-control"
                                                          name="sharethis_span_tags"
                                                          placeholder="{{trans('messages.paste_sharethis_span_tags')}}">{{old('sharethis_span_tags',$social->sharethis_span_tags)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sharethis_js"
                                                   class="col-sm-3 control-label">{{trans('messages.sharethis_js_code')}}</label>

                                            <div class="col-sm-8">
                                                <textarea id="sharethis_js" class="form-control" name="sharethis_js"
                                                          placeholder="{{trans('messages.paste_sharethis_js_code')}}">{{old('sharethis_js',$social->sharethis_js)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="facebook_box_js"
                                                   class="col-sm-3 control-label">{{trans('messages.facebook_box_html_js')}}</label>

                                            <div class="col-sm-8">
                                                <textarea id="facebook_box_js" class="form-control"
                                                          name="facebook_box_js"
                                                          placeholder="{{trans('messages.paste_facebook_box_html_js')}}">{{old('facebook_box_js',$social->facebook_box_js)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter_box_js"
                                                   class="col-sm-3 control-label">{{trans('messages.twitter_box_html_js')}}</label>

                                            <div class="col-sm-8">
                                                <textarea id="twitter_box_js" class="form-control" name="twitter_box_js"
                                                          placeholder="{{trans('messages.paste_twitter_js')}}">{{old('twitter_box_js',$social->twitter_box_js)}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$social->show_sharing == 1?'checked':''}}
                                                           name="show_sharing"
                                                           type="checkbox"> {{trans('messages.show_sharing_on_posts')}}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$social->show_big_sharing == 1?'checked':''}}
                                                           name="show_big_sharing"
                                                           type="checkbox"> {{trans('messages.show_big_sharing')}}
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_old_news">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/delete_old_news" id="form-username" method="post"
                                          class="form-horizontal form-bordered">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="delete_news_days"
                                                   class="col-sm-3 control-label">{{trans('messages.delete_news_days')}}</label>

                                            <div class="col-sm-8">
                                                <input id="delete_news_days" class="form-control"
                                                       name="delete_news_days"
                                                       placeholder="{{trans('messages.enter_no_of_days')}}"
                                                       value="{{old('delete_news_days',$old_news->days)}}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-8">
                                                <label>
                                                    <input {{$old_news->auto_update == 1?'checked':''}}
                                                           name="old_news_days_check"
                                                           type="checkbox"> {{trans('messages.old_news_days_check')}}
                                                </label>
                                            </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-2">
                                                        <button type="submit" class="btn purple"><i
                                                                    class="fa fa-check"></i>
                                                            {{trans('messages.save')}}
                                                        </button>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <a id="delete_news_days_href"
                                                           href="/admin/settings/delete_manually/{{$old_news->days}}" role="button"
                                                           class="btn btn-primary"><i class="fa fa-refresh"></i>
                                                            {{trans('messages.delete_now')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_custom_js">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_custom_js" id="form-username" method="post"
                                          class="form-horizontal form-bordered">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="custom_js"
                                                   class="col-sm-3 control-label">{{trans('messages.custom_js_code')}}</label>

                                            <div class="col-sm-8">
                                                <textarea rows="10" cols="10" id="custom_js" class="form-control"
                                                          name="custom_js"
                                                          placeholder="{{trans('messages.custom_js_code')}}">{{$custom_js->custom_js}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab_custom_css">

                            <div class="row">
                                <div class="col-md-12">

                                    <form action="/admin/settings/update_custom_css" id="form-username" method="post"
                                          class="form-horizontal form-bordered">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                        <div class="form-group">
                                            <label for="custom_css"
                                                   class="col-sm-3 control-label">{{trans('messages.custom_css_code')}}</label>

                                            <div class="col-sm-8">
                                                <textarea rows="10" cols="10" id="custom_css" class="form-control"
                                                          name="custom_css"
                                                          placeholder="{{trans('messages.custom_css_code')}}">{{$custom_css->custom_css}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn purple"><i class="fa fa-check"></i>
                                                        {{trans('messages.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@stop