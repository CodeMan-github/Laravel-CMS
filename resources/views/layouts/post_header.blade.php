<header class="post-header">
    <h1 class="post-title">
        {{$post->title}}
    </h1><!-- .post-title -->
    <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}"
       class="category bgcolor3">
        {{$post->sub_category->title}}
    </a>

    <p class="simple-share">

        @if($post->type == \App\Posts::TYPE_SOURCE && $post->dont_show_author_publisher == 1)
            <span><a href="/category/{{$post->category->slug}}">{{$post->category->title}}</a>
            /
            <a href="/category/{{$post->category->slug}}/{{$post->sub_category->slug}}">{{$post->sub_category->title}}</a></span>
        @else
            <span>by <a href="/author/{{$post->author->slug}}"><b>{{$post->author->name}}</b></a></span>
        @endif


                            <span><span class="article-date"><i
                                            class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}}</span></span>
        <span><i class="fa fa-eye"></i> {{$post->views}} {{trans('messages.views')}}</span>

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

    @if(strlen($post->featured_image) >0 && $post->show_featured_image_in_post == 1)
        <figure class="image-overlay">
            <img src="{{$post->featured_image}}" alt="{{$post->title}}">
        </figure>
    @endif

    @if($post->render_type == \App\Posts::RENDER_TYPE_VIDEO)
        <figure class="image-overlay">
            {!! $post->video_embed_code !!}
        </figure>
    @endif

    @if($post->render_type == \App\Posts::RENDER_TYPE_GALLERY && isset($post->gallery) && sizeof($post->gallery)>0 )

        <figure class="image-overlay">
            <div class="flexslider slider-one">
                <div class="featured-slider">

                    @foreach($post->gallery as $img)
                        <div class="slider-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{$img->image}}" alt="{{$post->title}}">
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </figure>
    @endif
</header>
