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
                <input type="text" class="form-control" name="search" placeholder="{{trans('messages.search..')}}">
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

                    @if($review->render_type == \App\Posts::RENDER_TYPE_IMAGE || $review->render_type == \App\Posts::RENDER_TYPE_GALLERY)
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


    @for($i=2;$i<sizeof($ads[\App\Ads::TYPE_SIDEBAR]);$i++)
        @if(isset($ads[\App\Ads::TYPE_SIDEBAR][$i]))
            <div class="widget adwidget">
                {!! $ads[\App\Ads::TYPE_SIDEBAR][$i]->code !!}
            </div>
        @endif
    @endfor

</aside>
