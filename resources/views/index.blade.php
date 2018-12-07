@extends('layouts.master')

@section('extra_css')
    <title>{{$settings_general->site_title}}</title>

    <meta name="keywords" content="{{$settings_seo->seo_keywords}}">
    <meta name="description" content="{{$settings_seo->seo_description}}">

    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="{{$settings_general->site_title}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($settings_seo->seo_description)),300)}}"/>
    <meta property="twitter:image" content="{{$settings_general->logo_120}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:url" content="{{$settings_general->site_url}}"/>

    <!--Og tags-->
    <meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="{{$settings_general->site_title}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($settings_seo->seo_description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{$settings_general->site_url}}"/>
    <meta property="og:image" content="{{$settings_general->logo_120}}"/>

@stop

@section('content')
    <div class="container main-wrapper">

        <div class="mag-content clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="ad728-wrapper">
                        @foreach($ads[\App\Ads::TYPE_INDEX_HEADER] as $ad)
                            {!! $ad->code !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content mag-content clearfix">

            <div class="row">
                <div class="col-sm-12">
                    <ul class="tag-list clearfix">
                        <li class="trending">{{trans('messages.hash_trending')}}</li>
                        @foreach($popular_tags as $tag)
                            <li><a href="/tag/{{$tag->slug}}">{{$tag->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @if(sizeof($featured) > 0)
                <div class="row featured-wrapper">
                    <div class="col-md-12">
                        <div class="flexslider">
                            <div class="featured-slider">

                                @for($i=0 ; $i<sizeof($featured);$i = $i+3)
                                    @if(isset($featured[$i]))
                                        <div class="slider-item">
                                            <div class="row">
                                                <div class="col-md-8 omega">
                                                    <div class="featured-big">
                                                        <a href="/{{$featured[$i]->slug}}" class="featured-href">

                                                            @if($featured[$i]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $featured[$i]->render_type == \App\Posts::RENDER_TYPE_GALLERY ||$featured[$i]->render_type == "lists")
                                                                <img src="{{$featured[$i]->featured_image}}"
                                                                     alt="{{$featured[$i]->title}}">
                                                            @endif

                                                            @if($featured[$i]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                                <figure class="image-overlay">
                                                                    {!! $featured[$i]->video_embed_code !!}
                                                                </figure>
                                                            @endif

                                                            <div class="featured-header">
                                                                <span class="category bgcolor{{$i}}">{{$featured[$i]->sub_category->title}}</span>

                                                                <h2>{{$featured[$i]->title}}</h2>


                                                                <p class="simple-share">
                                                                    @if($featured[$i]->type == \App\Posts::TYPE_SOURCE && $featured[$i]->dont_show_author_publisher == 1)
                                                                        {{$featured[$i]->sub_category->title}} -
                                                                    @else
                                                                        by {{$featured[$i]->author->name}} -
                                                                    @endif
                                                                    <span class="article-date">{{$featured[$i]->created_at->diffForHumans()}}</span>
                                                                </p>
                                                            </div>


                                                        </a>

                                                    </div>
                                                </div>

                                                <div class="col-md-4 alpha">
                                                    @if(isset($featured[$i+1]))
                                                        <div class="featured-small featured-top">
                                                            <a href="/{{$featured[$i+1]->slug}}" class="featured-href">

                                                                @if($featured[$i+1]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $featured[$i+1]->render_type == \App\Posts::RENDER_TYPE_GALLERY ||$featured[$i+1]->render_type == "lists")
                                                                    <img src="{{$featured[$i+1]->featured_image}}"
                                                                         alt="{{$featured[$i+1]->title}}">
                                                                @endif

                                                                @if($featured[$i+1]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                                    <figure class="image-overlay">
                                                                        {!! $featured[$i+1]->video_embed_code !!}
                                                                    </figure>
                                                                @endif

                                                                <div class="featured-header">
                                                                    <span class="category bgcolor{{$i+1}}">{{$featured[$i+1]->sub_category->title}}</span>

                                                                    <h2>{{$featured[$i+1]->title}}</h2>

                                                                    <p class="simple-share">
                                                                        @if($featured[$i+1]->type == \App\Posts::TYPE_SOURCE && $featured[$i+1]->dont_show_author_publisher == 1)
                                                                            {{$featured[$i+1]->sub_category->title}} -
                                                                        @else
                                                                            by {{$featured[$i+1]->author->name}} -
                                                                        @endif
                                                                        <span class="article-date">{{$featured[$i+1]->created_at->diffForHumans()}}</span>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if(isset($featured[$i+2]))
                                                        <div class="featured-small">
                                                            <a href="/{{$featured[$i+2]->slug}}" class="featured-href">

                                                                @if($featured[$i+2]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $featured[$i+2]->render_type == \App\Posts::RENDER_TYPE_GALLERY ||$featured[$i+2]->render_type == "lists")
                                                                    <img src="{{$featured[$i+2]->featured_image}}"
                                                                         alt="{{$featured[$i+2]->title}}">
                                                                @endif

                                                                @if($featured[$i+2]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                                    <figure class="image-overlay">
                                                                        {!! $featured[$i+2]->video_embed_code !!}
                                                                    </figure>
                                                                @endif

                                                                <div class="featured-header">
                                                                    <span class="category bgcolor{{$i+2}}">{{$featured[$i+2]->sub_category->title}}</span>

                                                                    <h2>{{$featured[$i+2]->title}}</h2>

                                                                    <p class="simple-share">
                                                                        @if($featured[$i+2]->type == \App\Posts::TYPE_SOURCE && $featured[$i+2]->dont_show_author_publisher == 1)
                                                                            {{$featured[$i+2]->sub_category->title}} -
                                                                        @else
                                                                            by {{$featured[$i+2]->author->name}} -
                                                                        @endif
                                                                        <span class="article-date">{{$featured[$i+2]->created_at->diffForHumans()}}</span>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row main-body">
                <div class="col-md-8">
                    <section class="admag-block">
                        <div class="row">

                            <div class="col-md-12">

                                @foreach($latest_top as $index => $post)
                                    @if($index == 0)
                                        <article class="news-block">

                                            @if($post->render_type == \App\Posts::RENDER_TYPE_IMAGE || $post->render_type == \App\Posts::RENDER_TYPE_GALLERY ||$post->render_type == "lists")
                                                <a href="/{{$post->slug}}" class="overlay-link">
                                                    <figure class="image-overlay">
                                                        <img src="{{$post->featured_image}}" alt="">
                                                    </figure>
                                                </a>
                                            @endif

                                            @if($post->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                <figure class="image-overlay">
                                                    {!! $post->video_embed_code !!}
                                                </figure>
                                            @endif

                                            <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}"
                                               class="category">
                                                {{$post->sub_category->title}}
                                            </a>

                                            <div class="news-details">
                                                <h3 class="news-title">
                                                    <a href="/{{$post->slug}}">
                                                        {{$post->title}}
                                                    </a>
                                                </h3>

                                                <p>{!! str_limit(strip_tags($post->description),300,'...') !!}</p>

                                                <p class="simple-share">

                                                    @if($post->type == \App\Posts::TYPE_SOURCE && $post->dont_show_author_publisher == 1)
                                                        <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}">{{$post->sub_category->title}}</a>
                                                        -
                                                    @else
                                                        by
                                                        <a href="/author/{{$post->author->slug}}"><b>{{$post->author->name}}</b></a>
                                                        -
                                                    @endif

                                                    <span class="article-date"><i
                                                                class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span>
                                                </p>
                                            </div>
                                        </article>
                                    @else
                                        <article class="simple-post clearfix">

                                            <div class="simple-thumb">
                                                @if($post->render_type == \App\Posts::RENDER_TYPE_IMAGE || $post->render_type == \App\Posts::RENDER_TYPE_GALLERY || $post->render_type == "lists")
                                                    <a href="/{{$post->slug}}" class="overlay-link">
                                                        <img src="{{$post->featured_image}}" alt="">

                                                    </a>
                                                @endif

                                                @if($post->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                    <figure class="image-overlay" style="min-height: 0px;">
                                                        {!! $post->video_embed_code !!}
                                                    </figure>
                                                @endif
                                            </div>

                                            <header>
                                                <h3>
                                                    <a href="/{{$post->slug}}">{{$post->title}}</a>
                                                </h3>

                                                <p>{!! str_limit(strip_tags($post->description),200,'...') !!}</p>

                                                <p class="simple-share pull-right">
                                                    <a href="/category/{{$post->category->slug}}">{{$post->category->title}}</a>
                                                    /
                                                    @if($post->type == \App\Posts::TYPE_SOURCE && $post->dont_show_author_publisher == 1)
                                                        <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}">{{$post->sub_category->title}}</a>
                                                        -
                                                    @else
                                                        by
                                                        <a href="/author/{{$post->author->slug}}"><b>{{$post->author->name}}</b></a>
                                                        -
                                                    @endif
                                                    <span><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span>
                                                </p>
                                            </header>
                                        </article>
                                    @endif
                                @endforeach

                            </div>
                            <!-- End mid column -->
                        </div>
                    </section>

                    <!-- BEGIN BLOCK 2 -->
                    <section class="news-text-block">

                        @foreach($category_posts as $index => $category_post)

                            @if(sizeof($category_post->posts) > 3)
                                <div class="row">
                                    <div class="col-md-12">

                                        <h3 class="block-title"><span><a
                                                        href="/category/{{$category_post->slug}}">{{$category_post->title}}</a></span>
                                        </h3>

                                        <article class="news-block big-block">


                                            @if($category_post->posts[0]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $category_post->posts[0]->render_type == \App\Posts::RENDER_TYPE_GALLERY || $category_post->posts[0]->render_type == "lists" )
                                                <a href="/{{$category_post->posts[0]->slug}}" class="overlay-link">
                                                    <figure class="image-overlay">
                                                        <img src="{{$category_post->posts[0]->featured_image}}" alt="">
                                                    </figure>
                                                </a>
                                            @endif

                                            @if($category_post->posts[0]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                <figure class="image-overlay">
                                                    {!! $category_post->posts[0]->video_embed_code !!}
                                                </figure>
                                            @endif


                                            <a href="/category/{{$category_post->slug}}/{{$category_post->posts[0]->sub_category->slug}}"
                                               class="category">
                                                {{$category_post->posts[0]->sub_category->title}}
                                            </a>


                                            <header class="news-details">
                                                <h3 class="news-title">
                                                    <a href="/{{$category_post->posts[0]->slug}}">
                                                        {{$category_post->posts[0]->title}}
                                                    </a>
                                                </h3>

                                                <p>{{str_limit(strip_tags($category_post->posts[0]->description),300)}}</p>

                                                <p class="simple-share">

                                                    @if($category_post->posts[0]->type == \App\Posts::TYPE_SOURCE && $category_post->posts[0]->dont_show_author_publisher == 1)
                                                        <a href="/category/{{$category_post->posts[0]->category->slug}}">{{$category_post->posts[0]->category->title}}</a>
                                                        -
                                                        /
                                                        <a href="/category/{{$category_post->posts[0]->category->slug}}/{{$category_post->posts[0]->sub_category->slug}}">{{$category_post->posts[0]->sub_category->title}}</a>
                                                        -
                                                    @else
                                                        by
                                                        <a href="/author/{{$category_post->posts[0]->author->slug}}"><b>{{$category_post->posts[0]->author->name}}</b></a>
                                                        -
                                                    @endif


                                                    <span class="article-date"><i
                                                                class="fa fa-clock-o"></i> {{$category_post->posts[0]->created_at->diffForHumans()}}</span>
                                                </p>

                                            </header>
                                        </article>
                                    </div>
                                </div>

                                @for($i=1;$i<sizeof($category_post->posts);$i = $i+2)
                                    @if(isset($category_post->posts[$i]))
                                        <div class="row">
                                            <div class="col-md-6">
                                                <article class="news-block small-block">


                                                    @if($category_post->posts[$i]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $category_post->posts[$i]->render_type == \App\Posts::RENDER_TYPE_GALLERY || $category_post->posts[$i]->render_type == "lists")
                                                        <a href="/{{$category_post->posts[$i]->slug}}"
                                                           class="overlay-link">
                                                            <figure class="image-overlay">
                                                                <img src="{{$category_post->posts[$i]->featured_image}}"
                                                                     alt="">
                                                            </figure>
                                                        </a>
                                                    @endif

                                                    @if($category_post->posts[$i]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                        <figure class="image-overlay">
                                                            {!! $category_post->posts[$i]->video_embed_code !!}
                                                        </figure>
                                                    @endif


                                                    <a href="/category/{{$category_post->slug}}/{{$category_post->posts[$i]->sub_category->slug}}"
                                                       class="category">
                                                        {{$category_post->posts[$i]->sub_category->title}}
                                                    </a>
                                                    <header class="news-details">
                                                        <h3 class="news-title">
                                                            <a href="/{{$category_post->posts[$i]->slug}}">
                                                                {{$category_post->posts[$i]->title}}
                                                            </a>
                                                        </h3>

                                                        <p class="simple-share">

                                                            @if($category_post->posts[$i]->type == \App\Posts::TYPE_SOURCE && $category_post->posts[$i]->dont_show_author_publisher == 1)
                                                                <a href="/category/{{$category_post->posts[$i]->category->slug}}">{{$category_post->posts[$i]->category->title}}</a>
                                                                /
                                                                <a href="/category/{{$category_post->posts[$i]->category->slug}}/{{$category_post->posts[$i]->sub_category->slug}}">{{$category_post->posts[$i]->sub_category->title}}</a>
                                                                -
                                                            @else
                                                                by
                                                                <a href="/author/{{$category_post->posts[$i]->author->slug}}"><b>{{$category_post->posts[$i]->author->name}}</b></a>
                                                                -
                                                            @endif


                                                            <span class="article-date"><i
                                                                        class="fa fa-clock-o"></i> {{$category_post->posts[$i]->created_at->diffForHumans()}}</span>
                                                        </p>
                                                    </header>
                                                </article>
                                                <!-- News block -->
                                            </div>

                                            @if(isset($category_post->posts[$i+1]))
                                                <div class="col-md-6">
                                                    <article class="news-block small-block">

                                                        @if($category_post->posts[$i+1]->render_type == \App\Posts::RENDER_TYPE_IMAGE || $category_post->posts[$i+1]->render_type == \App\Posts::RENDER_TYPE_GALLERY || $category_post->posts[$i+1]->render_type == "lists")
                                                            <a href="/{{$category_post->posts[$i+1]->slug}}"
                                                               class="overlay-link">
                                                                <figure class="image-overlay">
                                                                    <img src="{{$category_post->posts[$i+1]->featured_image}}"
                                                                         alt="">
                                                                </figure>
                                                            </a>
                                                        @endif

                                                        @if($category_post->posts[$i+1]->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                            <figure class="image-overlay">
                                                                {!! $category_post->posts[$i+1]->video_embed_code !!}
                                                            </figure>
                                                        @endif

                                                        <a href="/category/{{$category_post->slug}}/{{$category_post->posts[$i+1]->sub_category->slug}}"
                                                           class="category">
                                                            {{$category_post->posts[$i]->sub_category->title}}
                                                        </a>

                                                        <header class="news-details">
                                                            <h3 class="news-title">
                                                                <a href="/{{$category_post->posts[$i+1]->slug}}">
                                                                    {{$category_post->posts[$i+1]->title}}
                                                                </a>
                                                            </h3>

                                                            <p class="simple-share">
                                                                @if($category_post->posts[$i+1]->type == \App\Posts::TYPE_SOURCE && $category_post->posts[$i+1]->dont_show_author_publisher == 1)
                                                                    <a href="/category/{{$category_post->posts[$i+1]->category->slug}}">{{$category_post->posts[$i+1]->category->title}}</a>
                                                                    /
                                                                    <a href="/category/{{$category_post->posts[$i+1]->category->slug}}/{{$category_post->posts[$i+1]->sub_category->slug}}">{{$category_post->posts[$i+1]->sub_category->title}}</a>
                                                                    -
                                                                @else
                                                                    by
                                                                    <a href="/author/{{$category_post->posts[$i+1]->author->slug}}"><b>{{$category_post->posts[$i+1]->author->name}}</b></a>
                                                                    -
                                                                @endif
                                                                <span class="article-date"><i
                                                                            class="fa fa-clock-o"></i> {{$category_post->posts[$i+1]->created_at->diffForHumans()}}</span>
                                                            </p>
                                                        </header>
                                                    </article>
                                                    <!-- News block -->
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endfor
                            @endif
                        @endforeach

                    </section>

                    <!-- END BLOCK 2 -->

                </div>
                <!-- End Left big column -->

                <div class="col-md-4">
                    <aside class="sidebar clearfix">

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

                        <div class="widget searchwidget">
                            <form action="/search" method="GET" class="searchwidget-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                           placeholder="{{trans('messages.search..')}}">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
                                </div>
                            </form>
                        </div>

                                <div class="news-feed">
                                    <h3 class="block-title"><span>{{trans('messages.just_posted')}}</span></h3>
                                    <ul class="widget-content">
                                        @foreach($just_posted as $post)
                                            <li>
                                                <article>
                                                    <h3>
                                                        <a href="/{{$post->slug}}">{{$post->title}}</a>
                                                    </h3>

                                                    <p>
                                                        <span><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span>
                                                    </p>
                                                </article>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                        @if(!empty($settings_social->facebook_box_js))
                            <div class="widget tabwidget">
                                {!! $settings_social->facebook_box_js !!}
                            </div>
                        @endif

                        @if(!empty($settings_social->twitter_box_js))
                            <div class="widget tabwidget">
                                {!! $settings_social->twitter_box_js !!}
                            </div>
                        @endif

                        <div class="widget tagwidget">
                            <h3 class="block-title"><span>{{trans('messages.tags')}}</span></h3>
                            <ul class="tags-widget">
                                @foreach($popular_tags as $tag)
                                    <li><a href="/tag/{{$tag->slug}}">{{$tag->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget reviewwidget">
                            <h3 class="block-title"><span>{{trans('messages.reviews')}}</span></h3>

                            @foreach($review_posts as $review)
                                <article class="widget-post clearfix">
                                    <div class="simple-thumb">

                                        @if($review->render_type == \App\Posts::RENDER_TYPE_IMAGE || $review->render_type == \App\Posts::RENDER_TYPE_GALLERY || $review->render_type == "lists")
                                            <a href="/{{$review->slug}}">
                                                <img src="{{$review->featured_image}}" alt="">
                                            </a>
                                        @endif

                                        @if($review->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                            <figure class="image-overlay" style="min-height: 0px;">
                                                {!! $review->video_embed_code !!}
                                            </figure>
                                        @endif

                                    </div>
                                    <header>
                                        <h3>
                                            <a href="/{{$review->slug}}">{{$review->title}}</a>
                                        </h3>

                                        <p class="simple-share pull-right">
           <span class="read_only_raty"
                 data-score="{{$review->average_rating}}"></span>
                                        </p>
                                    </header>
                                </article>
                            @endforeach
                        </div>

                        @if(sizeof($global_pages) > 0)
                            <div class="widget categorywidget">
                                <h3 class="block-title"><span>{{trans('messages.pages')}}</span></h3>
                                <ul>
                                    @foreach($global_pages as $page)
                                        @if($page->show_in_sidebar == 1)
                                            <li>
                                                <a href="/page/{{$page->slug}}">{{$page->title}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="widget categorywidget" style="direction: ltr">
                            <h3 class="block-title"><span>{{trans('messages.categories')}}</span></h3>
                            <ul>
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

                        @if(!empty($settings_general->mailchimp_form))
                            <div class="widget adwidget subscribewidget">
                                <h3 class="block-title"><span>{{trans('messages.subscribe')}}</span></h3>

                                <p>{{trans('messages.we_dont_spam_loyal')}}</p>

                                {!! $settings_general->mailchimp_form !!}

                            </div>
                        @endif

                    </aside>
                </div>
                <!-- End last column -->
            </div>
            <!-- .main-body -->

            @if(sizeof($video_posts) > 0)
                <section class="admag-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="block-title"><span>{{trans('messages.videos')}}</span></h3>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($video_posts as $index => $video_post)
                            <div class="col-md-4">
                                <article class="featured-small box-news">
                                    <a href="/{{$video_post->slug}}">
                                        {!! $video_post->video_embed_code !!}
                                    </a>
                                    <header class="featured-header">
                                        <a class="category bgcolor2"
                                           href="/category/{{$video_post->category->slug}}/{{$video_post->sub_category->slug}}">{{$video_post->sub_category->title}}</a>

                                        <h2><a href="/{{$video_post->slug}}">{{$video_post->title}}</a></h2>

                                        <p class="simple-share">

                                            @if($video_post->type == \App\Posts::TYPE_SOURCE && $video_post->dont_show_author_publisher == 1)
                                                <a href="/category/{{$video_post->category->slug}}">{{$video_post->category->title}}</a>
                                                /
                                                <a href="/category/{{$video_post->category->slug}}/{{$video_post->sub_category->slug}}">{{$video_post->sub_category->title}}</a>
                                                -
                                            @else
                                                by
                                                <a href="/author/{{$video_post->author->slug}}"><b>{{$video_post->author->name}}</b></a>
                                                -
                                            @endif

                                            <span class="article-date">{{$video_post->created_at->diffForHumans()}}</span>

                                        </p>
                                    </header>
                                </article>
                            </div>
                        @endforeach
                    </div>

                </section>
            @endif

            @if(sizeof($review_posts) > 0)
                <div class="row">

                    <div class="col-md-8">

                        <section class="admag-block">
                            <h3 class="block-title"><span>{{trans('messages.top_reviews')}}</span></h3>

                            <div class="row">
                                @foreach($review_posts as $review)
                                    <div class="col-md-6">
                                        <article class="featured-small box-news">

                                            @if($review->render_type == \App\Posts::RENDER_TYPE_IMAGE || $review->render_type == \App\Posts::RENDER_TYPE_GALLERY || $review->render_type == "lists")
                                                <a href="/{{$review->slug}}">
                                                    <img src="{{$review->featured_image}}" alt="">
                                                </a>
                                            @endif

                                            @if($review->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                                                <figure class="">
                                                    {!! $review->video_embed_code !!}
                                                </figure>
                                            @endif


                                            <header class="featured-header">
                                                <a class="category bgcolor2"
                                                   href="/category/{{$review->category->slug}}/{{$review->sub_category->slug}}">{{$review->sub_category->title}}</a>

                                                <h2><a href="/{{$review->slug}}">{{$review->title}}</a></h2>

                                                <p class="simple-share pull-right">

                                                    @if($review->type == \App\Posts::TYPE_SOURCE && $review->dont_show_author_publisher == 1)
                                                        <a href="/category/{{$review->category->slug}}">{{$review->category->title}}</a>
                                                        /
                                                        <a href="/category/{{$review->category->slug}}/{{$review->sub_category->slug}}">{{$review->sub_category->title}}</a>
                                                        -
                                                    @else
                                                        by
                                                        <a href="/author/{{$review->author->slug}}"><b>{{$review->author->name}}</b></a>
                                                        -
                                                    @endif

                                                    <span class="article-date">{{$review->created_at->diffForHumans()}}</span>
                   <span class="read_only_raty"
                         data-score="{{$review->average_rating}}"></span>
                                                </p>
                                            </header>
                                        </article>
                                    </div>
                                @endforeach
                            </div>

                        </section>
                    </div>

                </div>
            @endif
        </div>

        <div class="col-md-12">
            <div class="ad728-wrapper">
                @foreach($ads[\App\Ads::TYPE_INDEX_FOOTER] as $ad)
                    {!! $ad->code !!}
                @endforeach
            </div>
        </div>
    </div>
@stop

