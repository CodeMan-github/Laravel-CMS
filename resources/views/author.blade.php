@extends('layouts.master')

@section('extra_css')
    <title>{{trans('messages.author')}} : {{$author->name}}</title>

    <meta name="keywords" content="{{$settings_seo->seo_keywords}}">
    <meta name="description" content="{{\Illuminate\Support\Str::limit(trim(strip_tags($author->bio)),300)}}">

    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="Author : {{$author->name}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($author->bio)),300)}}"/>
    <meta property="twitter:image" content="{{$author->avatar}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:url" content="{{$settings_general->site_url}}"/>

    <!--Og tags-->
    <meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="Author : {{$author->name}}"/>
    <meta property="og:description" content="{{\Illuminate\Support\Str::limit(trim(strip_tags($author->bio)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{$settings_general->site_url}}"/>
    <meta property="og:image" content="{{$author->avatar}}"/>
@stop

@section('content')
    <div class="container main-wrapper">
        <div class="main-content mag-content clearfix" data-stickyparent>

            <div class="row blog-content">
                <div class="col-md-4" data-stickycolumn>
                    <aside class="sidebar">
                        <div class="widget author-widget">
                            <div class="author-thumb">
                                <a href="/author/{{$author->slug}}">
                                    <img alt="{{$author->name}}" src="{{$author->avatar}}" class="avatar">
                                </a>
                            </div>
                            <div class="author-meta">
                                <h3 class="author-title">
                                    <a href="/author/{{$author->slug}}">{{$author->name}}</a>
                                </h3>

                                <p class="author-position">{{ucfirst($author->group->name)}}</p>

                                <p class="author-bio">{{$author->bio}}</p>

                                <div class="author-page-contact">
                                    @if(strlen($author->email)>0)
                                        <a href="mailto:{{$author->email}}"><i
                                                    class="fa fa-envelope fa-lg"
                                                    title="Email"></i></a>
                                    @endif
                                    @if(strlen($author->website_url)>0)
                                        <a href="{{$author->website_url}}" target="_blank"><i
                                                    class="fa fa-globe fa-lg"
                                                    title="Website"></i></a>
                                    @endif

                                    @if(strlen($author->fb_url)>0)
                                        <a href="{{$author->fb_url}}" target="_blank"><i
                                                    class="fa fa-facebook fa-lg"
                                                    title="Facebook"></i></a>
                                    @endif

                                    @if(strlen($author->twitter_url)>0)
                                        <a href="{{$author->twitter_url}}" target="_blank"><i
                                                    class="fa fa-twitter fa-lg"
                                                    title="Twitter"></i></a>
                                    @endif

                                    @if(strlen($author->google_plus_url)>0)
                                        <a href="{{$author->google_plus_url}}" rel="publisher"
                                           target="_blank"><i title="Google+"
                                                              class="fa fa-google-plus fa-lg"></i></a>
                                    @endif
                                </div>

                            </div>


                        </div>


                        @if(isset($ads[\App\Ads::TYPE_SIDEBAR][0]))
                            <div class="widget adwidget">
                                {!! $ads[\App\Ads::TYPE_SIDEBAR][0]->code !!}
                            </div>
                        @endif

                        @if(isset($ads[\App\Ads::TYPE_SIDEBAR][1]))
                            <div class="widget adwidget">
                                {!! $ads[\App\Ads::TYPE_SIDEBAR][1]->code !!}
                            </div>
                        @endif

                    </aside>
                </div>
                <div class="col-md-8">
                    <h3 class="block-title"><span>By {{$author->name}}</span></h3>

                    @if(sizeof($posts) == 0)
                        <h4>{{trans('messages.no_posts_for_author')}} - {{$author->name}}</h4>

                        @if(!empty($ads[\App\Ads::TYPE_BETWEEN_AUTHOR_INDEX]))
                            <div class="widget adwidget">
                                {!! $ads[\App\Ads::TYPE_BETWEEN_AUTHOR_INDEX]->code !!}
                            </div>
                        @endif
                    @endif

                    @foreach($posts as $index => $post)
                        <article class="simple-post simple-big clearfix">
                            <div class="simple-thumb">

                                <a href="/{{$post->slug}}">
                                    <img src="{{$post->featured_image}}" alt="">
                                </a>
                            </div>
                            <header>
                                <p class="simple-share">

                                    @if($post->type == \App\Posts::TYPE_SOURCE && $post->dont_show_author_publisher == 1)
                                        <a href="/category/{{$post->category->slug}}">{{$post->category->title}}</a>
                                        /
                                        <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}">{{$post->sub_category->title}}</a>
                                        -
                                    @else
                                        by
                                        <a href="/author/{{$author->slug}}"><b>{{$author->name}}</b></a>
                                        -
                                    @endif

                                    <span><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span>
                                </p>

                                <h3>
                                    <a href="/{{$post->slug}}">{{$post->title}}</a>
                                </h3>

                                <p class="excerpt">
                                    {!! str_limit(strip_tags($post->description),300,'...') !!}
                                </p>
                            </header>
                        </article>

                        @if($index == ceil((sizeof($posts)/2)))
                            @if(!empty($ads[\App\Ads::TYPE_BETWEEN_AUTHOR_INDEX]))
                                <div class="widget adwidget">
                                    {!! $ads[\App\Ads::TYPE_BETWEEN_AUTHOR_INDEX]->code !!}
                                </div>
                            @endif
                        @endif

                    @endforeach

                    <div class="load-more">
                        @if(!empty($posts) && sizeof($posts) > 0)
                            {!! $posts->render() !!}
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>
@stop

