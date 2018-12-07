@extends('layouts.master')

@section('extra_css')
    <title>{{trans('messages.search')}} : {{$search_term}}</title>

    <meta name="keywords" content="{{$settings_seo->seo_keywords}}">
    <meta name="description" content="{{$settings_seo->seo_description}}">

    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="Search : {{$search_term}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($settings_seo->seo_description)),300)}}"/>
    <meta property="twitter:image" content="{{$settings_general->logo_120}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:url" content="{{$settings_general->site_url}}"/>

    <!--Og tags-->
    <meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="Search : {{$search_term}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($settings_seo->seo_description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{$settings_general->site_url}}"/>
    <meta property="og:image" content="{{$settings_general->logo_120}}"/>
@stop

@section('content')
    <div class="container main-wrapper">
        <div class="main-content mag-content clearfix">

            <div class="row blog-content">
                <div class="col-md-8">
                    <h3 class="tag-title">{{trans('messages.search')}} : <span>{{$search_term}}</span></h3>

                    <div class="search-div clearfix">
                        <form class="searchwidget-form" action="/search" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="{{trans('messages.search..')}}">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                  </span>
                            </div>
                        </form>
                    </div>

                    @if(sizeof($posts) == 0)
                        <h4>{{trans('messages.no_results_found_for_this_search_term')}} - {{$search_term}}</h4>

                        @if(!empty($ads[\App\Ads::TYPE_BETWEEN_SEARCH_INDEX]))
                            <div class="widget adwidget">
                                {!! $ads[\App\Ads::TYPE_BETWEEN_SEARCH_INDEX]->code !!}
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
                                        <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}">{{$post->sub_category->title}}</a> -
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
                            @if(!empty($ads[\App\Ads::TYPE_BETWEEN_SEARCH_INDEX]))
                                <div class="widget adwidget">
                                    {!! $ads[\App\Ads::TYPE_BETWEEN_SEARCH_INDEX]->code !!}
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

