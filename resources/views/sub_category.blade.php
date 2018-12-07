@extends('layouts.master')

@section('extra_css')
    <title>{{trans('messages.category')}} : {{$sub_category->title}}</title>

    <meta name="keywords" content="{{$settings_seo->seo_keywords}}">
    <meta name="description" content="{{$settings_seo->seo_description}}">

    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="Category : {{$sub_category->title}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($sub_category->seo_description)),300)}}"/>
    <meta property="twitter:image" content="{{$settings_general->logo_120}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:url" content="{{$settings_general->site_url}}"/>

    <!--Og tags-->
    <meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="Category : {{$sub_category->title}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($sub_category->seo_description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{$settings_general->site_url}}"/>
    <meta property="og:image" content="{{$settings_general->logo_120}}"/>

    <meta property="article:tag" content="{{$category->seo_keywords}}"/>
@stop

@section('content')
    <div class="container main-wrapper">
        <div class="main-content mag-content clearfix">

            <div class="row blog-content">
                <div class="col-md-8">
                    <h3 class="tag-title"><span class="social-rss">
                            <a href="/rss/{{$category->slug}}/{{$sub_category->slug}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="RSS">
                                <i class="fa fa-rss"></i>
                            </a>
                        </span>{{trans('messages.category')}} : <span>{{$sub_category->title}}</span></h3>

                    @if(sizeof($posts) == 0)
                        <h4>{{trans('messages.no_posts_for_category')}} - {{$sub_category->title}}</h4>

                        @if(!empty($ads[\App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX]))
                            <div class="widget adwidget">
                                {!! $ads[\App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX]->code !!}
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
                                        <a href="/category/{{$category->slug}}">{{$category->title}}</a>
                                        /
                                        <a href="/category/{{$category->slug}}/{{$sub_category->slug}}">{{$sub_category->title}}</a> -
                                    @else
                                        by
                                        <a href="/author/{{$post->author->slug}}"><b>{{$post->author->name}}</b></a>
                                        -
                                    @endif
                                    <span><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span>
                                </p>

                                <h3>
                                    <a href="/{{$post->slug}}">{{$post->title}}</a>
                                </h3>

                                <p class="excerpt">
                                    {!! str_limit(strip_tags($post->description),250,'...') !!}
                                </p>
                            </header>
                        </article>

                        @if($index == ceil((sizeof($posts)/2)))
                            @if(!empty($ads[\App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX]))
                                <div class="widget adwidget">
                                    {!! $ads[\App\Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX]->code !!}
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

                <div class="col-md-4">
                    @include('layouts.sidebar')
                </div>
            </div>

        </div>
    </div>
@stop

