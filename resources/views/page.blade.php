@extends('layouts.master')

@section('extra_css')
    @if($settings_general->site_post_as_titles == 1)
        <title>{{$page->title}}</title>
    @else
        <title>{{$settings_general->site_title}}</title>
    @endif

    <meta name="keywords" content="{{$page->seo_keywords}}">

    <meta name="description" content="{{\Illuminate\Support\Str::limit(trim(strip_tags($page->description)),300)}}">

    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="{{$page->title}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($page->description)),300)}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:image" content="{{$settings_general->logo_120}}"/>
    <meta property="twitter:url" content="{{URL::to('/page/'.$page->slug)}}"/>

    <!--Og tags-->
    <meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="{{$page->title}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($page->description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{URL::to($page->slug)}}"/>
    <meta property="og:image" content="{{$settings_general->logo_120}}"/>

    <meta property="article:published_time" content="{{$page->created_at}}"/>
    <meta property="article:modified_time" content="{{$page->updated_at}}"/>

@stop

@section('extra_js')
    @if(strlen($settings_social->addthis_js) > 0 && $settings_social->show_sharing == 1)
        {!! $settings_social->addthis_js !!}
    @endif

    @if(strlen($settings_social->sharethis_js) > 0 && $settings_social->show_sharing == 1)
        {!! $settings_social->sharethis_js !!}
    @endif

    @if($settings_comments->comment_system == \App\Posts::COMMENT_FACEBOOK)
        {!! $settings_comments->fb_js !!}
    @endif
@stop

@section('content')

    <div class="container main-wrapper">

        @if(!empty($ads[\App\Ads::TYPE_ABOVE_PAGE]))
            <div class="mag-content clearfix">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ad728-wrapper">

                            {!! $ads[\App\Ads::TYPE_ABOVE_PAGE]->code !!}

                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="main-content mag-content clearfix">

            <div class="row blog-content">

                <div class="col-md-8">

                    @include('admin.layouts.notify')

                    <article class="post-wrapper clearfix">

                        <header class="post-header">
                            <h1 class="post-title">
                                {{$page->title}}
                            </h1><!-- .post-title -->

                            <p class="simple-share">
                                <span>by <a href="/author/{{$page->author->slug}}"><b>{{$page->author->name}}</b></a></span>
                            <span><span class="article-date"><i
                                            class="fa fa-clock-o"></i> {{$page->created_at->diffForHumans()}}</span></span>
                                <span><i class="fa fa-eye"></i> {{$page->views}} views</span>

                                @if($settings_comments->fb_comment_count == 1)
                                    @if($settings_comments->comment_system == \App\Posts::COMMENT_FACEBOOK)
                                        <span class="comments-count">
                                        <i class="fb-comments-count" data-href="{{URL::full()}}"></i>comments
                                        </span>
                                    @endif
                                @endif

                                @if($settings_comments->disqus_comment_count == 1)
                                    @if($settings_comments->comment_system == \App\Posts::COMMENT_DISQUS)
                                        <a class="comments-count" href="{{URL::full()}}#disqus_thread">0</a>
                                    @endif
                                @endif

                            </p>

                        </header>

                        <div class="post-content clearfix">{!! $page->description !!}</div>

                        <footer class="post-meta">

                            <div class="share-wrapper clearfix">
                                @if(strlen($settings_social->addthis_js) > 0 && $settings_social->show_sharing == 1)
                                    <div class="addthis_sharing_toolbox"></div>
                                @endif

                                @if(strlen($settings_social->sharethis_span_tags) > 0 && strlen($settings_social->sharethis_js) > 0 && $settings_social->show_sharing == 1)
                                    {!! $settings_social->sharethis_span_tags !!}
                                @endif
                            </div>

                            <div class="author-box clearfix">
                                <div class="author-avatar">
                                    <a href="/author/{{$page->author->slug}}">
                                        <img alt="" src="{{$page->author->avatar}}" class="avatar"
                                             height="110"
                                             width="110">
                                    </a>
                                </div>
                                <div class="author-info">
                                    <h3><a href="/author/{{$page->author->slug}}">{{$page->author->name}}</a></h3>

                                    <p class="author-bio">
                                        {{$page->author->bio}}
                                    </p>

                                    <div class="author-contact">
                                        @if(strlen($page->author->email)>0)
                                            <a href="mailto:{{$page->author->email}}"><i
                                                        class="fa fa-envelope fa-lg"
                                                        title="Email"></i></a>
                                        @endif
                                        @if(strlen($page->author->website_url)>0)
                                            <a href="{{$page->author->website_url}}" target="_blank"><i
                                                        class="fa fa-globe fa-lg"
                                                        title="Website"></i></a>
                                        @endif

                                        @if(strlen($page->author->fb_url)>0)
                                            <a href="{{$page->author->fb_url}}" target="_blank"><i
                                                        class="fa fa-facebook fa-lg"
                                                        title="Facebook"></i></a>
                                        @endif

                                        @if(strlen($page->author->twitter_url)>0)
                                            <a href="{{$page->author->twitter_url}}" target="_blank"><i
                                                        class="fa fa-twitter fa-lg"
                                                        title="Twitter"></i></a>
                                        @endif

                                        @if(strlen($page->author->google_plus_url)>0)
                                            <a href="{{$page->author->google_plus_url}}" rel="publisher"
                                               target="_blank"><i title="Google+"
                                                                  class="fa fa-google-plus fa-lg"></i></a>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </footer>

                    </article>

                    @if(!empty($ads[\App\Ads::TYPE_BELOW_PAGE]))
                        <div class="row">
                            <div class="col-md-12">
                                {!! $ads[\App\Ads::TYPE_BELOW_PAGE]->code !!}
                            </div>
                        </div>
                    @endif

                    @if($settings_comments->comment_system == \App\Posts::COMMENT_DISQUS)
                        <div id="comments" class="comments-wrapper clearfix">
                            <h3 class="block-title"><span>Comments</span></h3>

                            {!! $settings_comments->disqus_js !!}

                        </div>
                    @endif

                    @if($settings_comments->comment_system == \App\Posts::COMMENT_FACEBOOK)
                        <div id="comments" class="comments-wrapper clearfix">
                            <h3 class="block-title"><span>Comments</span></h3>

                            <div class="fb-comments" data-href="{{URL::full()}}"
                                 data-numposts="{{empty($settings_comments->fb_num_posts)?5:$settings_comments->fb_num_posts}}"></div>

                        </div>
                    @endif


                </div>

                <div class="col-md-4">
                    @include('layouts.sidebar')
                </div>
            </div>

        </div>
    </div>
@stop

