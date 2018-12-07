@extends('layouts.master')

@section('extra_css')
    @if($settings_general->site_post_as_titles == 1)
        <title>{{$post->title}}</title>
    @else
        <title>{{$settings_general->site_title}}</title>
    @endif

    @if(sizeof($post->tags) > 0)
        <meta name="keywords" content="{{implode(',',$post->tags->lists('title')->toArray())}}">
    @endif

    <meta name="description" content="{{\Illuminate\Support\Str::limit(trim(strip_tags($post->description)),300)}}">
	<meta property="og:image" content="{{$post->featured_image}}"/>
	<meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="{{$post->title}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($post->description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{URL::to($post->slug)}}"/>
    <!--Twitter Card-->
    <meta property="twitter:card" content="summary"/>
    <meta property="twitter:site" content="{{$settings_social->twitter_handle}}"/>
    <meta property="twitter:title" content="{{$post->title}}"/>
    <meta property="twitter:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($post->description)),300)}}"/>
    <meta property="twitter:image" content="{{$post->featured_image}}"/>
    <meta name="twitter:creator" content="{{$settings_social->twitter_handle}}">
    <meta property="twitter:url" content="{{URL::to($post->slug)}}"/>

    <!--Og tags-->
    @foreach($related_posts as $r)
        <meta property="og:see_also" content="{{URL::to($r->slug)}}"/>
    @endforeach

    <meta property="article:published_time" content="{{$post->created_at}}"/>
    <meta property="article:modified_time" content="{{$post->updated_at}}"/>

    @foreach($post->tags as $tag)
        <meta property="article:tag" content="{{$tag->title}}"/>
    @endforeach

    <link rel="stylesheet" href="/plugins/responsive-sharing/css/rrssb.css"/>

    <style type="text/css">
        @import url(http://weloveiconfonts.com/api/?family=fontawesome);
        @import url(http://fonts.googleapis.com/css?family=Montserrat);

        /* fontawesome */
        [class*="fontawesome-"]:before {
            font-family: 'FontAwesome', sans-serif;
        }

        .thumbs a {
            color: grey;
        }

        .up, .down {
            border-radius: 10px;
            float: left;
            font-size: 50px;
            height: 70%;
            line-height: 70px;
            text-align: center;
            transition: all .2s linear;
            width: 90px;
        }

        .up_rating {
            position: absolute;
            left: 40px;
            margin-top: 75px;
            font-size: 28px;
        }

        .down_rating {
            position: absolute;
            left: 135px;
            margin-top: 75px;
            font-size: 28px;
        }

        .down {
            margin-left: 10px;
        }

        .up:hover {
            background: #2ecc71;
            color: #fff;
            cursor: pointer;
        }

        .down:hover {
            background: #e74c3c;
            color: #fff;
            cursor: pointer;
        }

    </style>
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

    <script src="/plugins/responsive-sharing/js/rrssb.min.js"></script>


    <script type="text/javascript">
        $('.up').on('click', function () {
            $('#like_type').val(1);
        });

        $('.down').on('click', function () {
            $('#like_type').val(0);
        });
    </script>

@stop

@section('content')

    @if($post->image_parallax == 1 && $post->render_type == \App\Posts::RENDER_TYPE_IMAGE)
        <div class="parallax-header">

            <!-- Parallax image -->
            <div class="parallax-image" id="parallax-image" data-stellar-ratio="0.5"
                 data-image="{{$post->featured_image}}"></div>

            <!-- Post title and meta -->
            <div class="parallax-wrapper">
                <div class="container">
                    <div class="mag-content parallax-box">
                        <div class="row">
                            <div class="col-md-12 parallax-box">
                                @include('layouts.post_header')
                            </div>
                            <!-- .col-md-12 -->
                        </div>
                        <!-- .row -->
                    </div>
                </div>
                <!-- .container -->

            </div>
            <!-- .parallax-wrapper -->
        </div>
    @endif

    <div class="container main-wrapper">

        @if(!empty($ads[\App\Ads::TYPE_ABOVE_POST]))
            <div class="mag-content clearfix">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ad728-wrapper">

                            {!! $ads[\App\Ads::TYPE_ABOVE_POST]->code !!}

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

                        @if($post->render_type == \App\Posts::RENDER_TYPE_IMAGE)
                            @include('layouts.post_header')
                        @endif

                        @if($post->render_type == \App\Posts::RENDER_TYPE_GALLERY)
                            @include('layouts.post_header')
                        @endif

                        @if($post->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                            @include('layouts.post_header')
                        @endif

                        @if($post->render_type == \App\Posts::RENDER_TYPE_TEXT)
                            @include('layouts.post_header')
                        @endif

                        @if($post->rating_box == 1)
                            <div class="post-review-wrapper clearfix">
                                <div class="post-review-summary clearfix">
                                    <div class="post-review-sum-point">
                                        <h4 id="rate_target">{{\App\Libraries\Utils::doubleTruncate($post->average_rating,1)}}</h4>
                   <span class="article_raty"
                         data-score="{{\App\Libraries\Utils::doubleTruncate($post->average_rating,1)}}"></span>

                                        <p style="text-align: center;">
                                            <small>({{$post->rating_count}}) {{trans('messages.reviews')}}</small>
                                        </p>

                                        <p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#rate_me">
                                                {{trans('messages.rate_now')}}
                                            </button>
                                        </p>

                                    </div>

                                    <div class="post-review-description">
                                        <p>{{$post->rating_desc}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($post->rating_box == 2)
                            <div class="post-review-wrapper clearfix">
                                <div class="post-review-summary clearfix">
                                    <div class="post-review-sum-point" style="height:120px;">

                                        <div class="thumbs">
                                            <a data-toggle="modal"
                                               data-target="#rate_like">
                                                <div class="up fontawesome-thumbs-up"></div>
                                            </a>

                                            <span class="up_rating">{{$post->ups}}</span>

                                            <a data-toggle="modal"
                                               data-target="#rate_like">
                                                <div class="down fontawesome-thumbs-down"></div>
                                            </a>
                                            <span class="down_rating">{{$post->downs}}</span>
                                        </div>
                                    </div>

                                    <div class="post-review-description">
                                        <p>{{$post->rating_desc}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                            @if(isset($lists_description))

                                @foreach($lists_description as $list_description)

                                <div class="post-content clearfix">{!! $list_description !!}</div>

                                @endforeach

                                    <?php echo $lists_description->render(); ?>


@else

                                <div class="post-content clearfix">{!! $post->description !!}</div>
                            @endif


                        @if($post->type == \App\Posts::TYPE_SOURCE)
                            <div class="row" style="margin-bottom:10px;">
                                <a  target="_new" rel="nofollow" href="{{$post->link}}" type="button"
                                   class="pull-right btn btn-success btn-lg">{{trans('messages.read_more')}}</a>

                            </div>
                        @endif

                        @if($post->rating_box == 1)
                            <div class="modal fade" id="rate_me" tabindex="-1" role="dialog"
                                 aria-labelledby="review-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"
                                                id="review-modalLabel">{{trans('messages.rate_this_article')}}</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="/submit_rating" method="POST">

                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <input type="hidden" name="id" value="{{$post->id}}"/>

                                                <div class="form-group form-group-rating">
                                                    <div class="rating-label">
                                                        <p>
                                                            <strong>{{trans('messages.how_do_you_rate_this_article')}}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div id="ratyRating"></div>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="rate_name">{{trans('messages.please_enter_your_name')}}</label>
                                                    <input class="form-control" name="name" id="rate_name"/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="rate_email">{{trans('messages.please_enter_your_email')}}</label>
                                                    <input class="form-control" name="email" id="rate_email"/>
                                                </div>

                                                <div class="review-actions">
                                                    <button type="submit" class="btn btn-success">
                                                        <strong>{{trans('messages.submit_rating')}}</strong></button>
                                                </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($post->rating_box == 2)
                            <div class="modal fade" id="rate_like" tabindex="-1" role="dialog"
                                 aria-labelledby="review-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"
                                                id="review-modalLabel">{{trans('messages.submitdetails_for_like')}}</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="/submit_likes" method="POST">

                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <input type="hidden" name="id" value="{{$post->id}}"/>
                                                <input type="hidden" name="type" id="like_type" value=""/>

                                                <div class="form-group">
                                                    <label for="rate_name">{{trans('messages.please_enter_your_name')}}</label>
                                                    <input class="form-control" name="name" id="rate_name"/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="rate_email">{{trans('messages.please_enter_your_email')}}</label>
                                                    <input class="form-control" name="email" id="rate_email"/>
                                                </div>

                                                <div class="review-actions">
                                                    <button type="submit" class="btn btn-success">
                                                        <strong>{{trans('messages.submit')}}</strong></button>
                                                </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <footer class="post-meta">
                            @if(sizeof($post->tags) > 0)
                                <div class="tags-wrapper">
                                    <ul class="tags-widget clearfix">
                                        <li class="trending">{{trans('messages.tags')}}:</li>
                                        @foreach($post->tags as $tag)
                                            <li><a href="/tag/{{$tag->slug}}">{{$tag->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($post->type == \App\Posts::TYPE_SOURCE && $post->show_post_source == 1)
                                <div class="tags-wrapper">
                                    <ul class="tags-widget clearfix">
                                        <li class="trending">{{trans('messages.source')}}:</li>
                                        <li><a href="{{$source->url}}">{{$source->channel_title}}</a></li>
                                    </ul>
                                </div>
                            @endif

                            @if($settings_social->show_big_sharing == 0)
                                <div class="share-wrapper clearfix">
                                    @if(strlen($settings_social->addthis_js) > 0 && $settings_social->show_sharing == 1)
                                        <div class="addthis_sharing_toolbox"></div>
                                    @endif

                                    @if(strlen($settings_social->sharethis_span_tags) > 0 && strlen($settings_social->sharethis_js) > 0 && $settings_social->show_sharing == 1)
                                        {!! $settings_social->sharethis_span_tags !!}
                                    @endif
                                </div>
                            @else
                                <ul class="rrssb-buttons clearfix">
                                    <li class="rrssb-email">
                                        <a href="mailto:?subject={{$post->title}}body={{$post->description}}">
                                            <span class="rrssb-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                          height="28" viewBox="0 0 28 28">
                                                    <path d="M20.11 26.147c-2.335 1.05-4.36 1.4-7.124 1.4C6.524 27.548.84 22.916.84 15.284.84 7.343 6.602.45 15.4.45c6.854 0 11.8 4.7 11.8 11.252 0 5.684-3.193 9.265-7.398 9.3-1.83 0-3.153-.934-3.347-2.997h-.077c-1.208 1.986-2.96 2.997-5.023 2.997-2.532 0-4.36-1.868-4.36-5.062 0-4.75 3.503-9.07 9.11-9.07 1.713 0 3.7.4 4.6.972l-1.17 7.203c-.387 2.298-.115 3.3 1 3.4 1.674 0 3.774-2.102 3.774-6.58 0-5.06-3.27-8.994-9.304-8.994C9.05 2.87 3.83 7.545 3.83 14.97c0 6.5 4.2 10.2 10 10.202 1.987 0 4.09-.43 5.647-1.245l.634 2.22zM16.647 10.1c-.31-.078-.7-.155-1.207-.155-2.572 0-4.596 2.53-4.596 5.53 0 1.5.7 2.4 1.9 2.4 1.44 0 2.96-1.83 3.31-4.088l.592-3.72z"/>
                                                </svg></span>
                                            <span class="rrssb-text"> &nbsp; Email</span>
                                        </a>
                                    </li>
                                    <li class="rrssb-facebook">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{URL::full()}}"
                                           class="popup">
      <span class="rrssb-icon">
        <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="29" height="29"
             viewBox="0 0 29 29">
            <path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"
                  class="cls-2" fill-rule="evenodd"/>
        </svg>
      </span>
                                            <span class="rrssb-text"> &nbsp; Facebook</span>
                                        </a>
                                    </li>
                                    <li class="rrssb-twitter">
                                        <a href="https://twitter.com/intent/tweet?text={{$post->title}}{{URL::full()}}"
                                           class="popup">
                                            <span class="rrssb-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                          height="28" viewBox="0 0 28 28">
                                                    <path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62c-3.122.162-6.22-.646-8.86-2.32 2.702.18 5.375-.648 7.507-2.32-2.072-.248-3.818-1.662-4.49-3.64.802.13 1.62.077 2.4-.154-2.482-.466-4.312-2.586-4.412-5.11.688.276 1.426.408 2.168.387-2.135-1.65-2.73-4.62-1.394-6.965C5.574 7.816 9.54 9.84 13.802 10.07c-.842-2.738.694-5.64 3.434-6.48 2.018-.624 4.212.043 5.546 1.682 1.186-.213 2.318-.662 3.33-1.317-.386 1.256-1.248 2.312-2.4 2.942 1.048-.106 2.07-.394 3.02-.85-.458 1.182-1.343 2.15-2.48 2.71z"/>
                                                </svg></span>
                                            <span class="rrssb-text"> &nbsp; Twitter</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Buttons end here -->
                            @endif

                            <div class="row">
                                <div class="post-nav-wrapper clearfix">
                                    <div class="col-md-6 omega">
                                        <div class="previous-post">
                                            <div class="post-nav-label">
                                                <i class="fa fa-angle-left"></i>
                                                {{trans('messages.previous_post')}}
                                            </div>
                                            @if(!empty($post->prev))
                                                <a href="/{{$post->prev->slug}}"
                                                   class="post-nav-title">{{$post->prev->title}}</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 alpha">
                                        <div class="next-post">
                                            <div class="post-nav-label">
                                                {{trans('messages.next_post')}}
                                                <i class="fa fa-angle-right"></i>
                                            </div>
                                            @if(!empty($post->next))
                                                <a href="/{{$post->next->slug}}"
                                                   class="post-nav-title">{{$post->next->title}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- .post-nav-wrapper -->
                            </div>

                            @if($post->show_author_box == 1)
                                <div class="author-box clearfix">
                                    <div class="author-avatar">
                                        <a href="/author/{{$post->author->slug}}">
                                            <img alt="" src="{{$post->author->avatar}}" class="avatar"
                                                 height="110"
                                                 width="110">
                                        </a>
                                    </div>
                                    <div class="author-info">
                                        <h3><a href="/author/{{$post->author->slug}}">{{$post->author->name}}</a>
                                        </h3>

                                        <p class="author-bio">
                                            {{$post->author->bio}}
                                        </p>

                                        @if($post->show_author_socials == 1)
                                            <div class="author-contact">
                                                @if(strlen($post->author->email)>0)
                                                    <a href="mailto:{{$post->author->email}}"><i
                                                                class="fa fa-envelope fa-lg"
                                                                title="Email"></i></a>
                                                @endif
                                                @if(strlen($post->author->website_url)>0)
                                                    <a href="{{$post->author->website_url}}" target="_blank"><i
                                                                class="fa fa-globe fa-lg"
                                                                title="Website"></i></a>
                                                @endif

                                                @if(strlen($post->author->fb_url)>0)
                                                    <a href="{{$post->author->fb_url}}" target="_blank"><i
                                                                class="fa fa-facebook fa-lg"
                                                                title="Facebook"></i></a>
                                                @endif

                                                @if(strlen($post->author->twitter_url)>0)
                                                    <a href="{{$post->author->twitter_url}}" target="_blank"><i
                                                                class="fa fa-twitter fa-lg"
                                                                title="Twitter"></i></a>
                                                @endif

                                                @if(strlen($post->author->google_plus_url)>0)
                                                    <a href="{{$post->author->google_plus_url}}" rel="publisher"
                                                       target="_blank"><i title="Google+"
                                                                          class="fa fa-google-plus fa-lg"></i></a>
                                                @endif

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </footer>

                    </article>

                    @if(sizeof($related_posts) > 0)
                        <div class="related-posts clearfix">
                            <h3 class="block-title"><span>{{trans('messages.related_posts')}}</span></h3>

                            @for($i=0;$i<sizeof($related_posts);$i=$i+2)
                                <div class="row">

                                    @if(isset($related_posts[$i]))
                                        <div class="col-md-6">
                                            <article class="news-block small-block">
                                                <a href="/{{$related_posts[$i]->slug}}" class="overlay-link">
                                                    @if($related_posts[$i]->render_type == \App\Posts::RENDER_TYPE_IMAGE)
                                                        <figure class="image-overlay">
                                                            <img src="{{$related_posts[$i]->featured_image}}" alt="">
                                                        </figure>
                                                    @else
                                                        <figure class="image-overlay">
                                                            <img src="{{$related_posts[$i]->featured_image}}" alt="">
                                                        </figure>
                                                    @endif
                                                </a>
                                                <a href="/category/{{$related_posts[$i]->category->slug}}/{{$related_posts[$i]->sub_category->slug}}"
                                                   class="category">
                                                    {{$related_posts[$i]->sub_category->title}}
                                                </a>
                                                <header class="news-details">
                                                    <h3 class="news-title">
                                                        <a href="/{{$related_posts[$i]->slug}}">
                                                            {{$related_posts[$i]->title}}
                                                        </a>
                                                    </h3>

                                                    <p class="simple-share">

                                                        @if($related_posts[$i]->type == \App\Posts::TYPE_SOURCE && $related_posts[$i]->dont_show_author_publisher == 1)
                                                            <a href="/category/{{$related_posts[$i]->category->slug}}">{{$related_posts[$i]->category->title}}</a>
                                                            /
                                                            <a href="/category/{{$related_posts[$i]->category->slug}}/{{$related_posts[$i]->sub_category->slug}}">{{$related_posts[$i]->sub_category->title}}</a>
                                                            -
                                                        @else
                                                            by
                                                            <a href="/author/{{$related_posts[$i]->author->slug}}"><b>{{$related_posts[$i]->author->name}}</b></a>
                                                            -
                                                        @endif

                                                        <span class="article-date"><i
                                                                    class="fa fa-clock-o"></i> {{$related_posts[$i]->created_at->diffForHumans()}}</span>
                                                    </p>
                                                </header>
                                            </article>
                                        </div>
                                    @endif

                                    @if(isset($related_posts[$i+1]))
                                        <div class="col-md-6">
                                            <article class="news-block small-block">
                                                <a href="/{{$related_posts[$i+1]->slug}}" class="overlay-link">
                                                    @if($related_posts[$i+1]->render_type == \App\Posts::RENDER_TYPE_IMAGE)
                                                        <figure class="image-overlay">
                                                            <img src="{{$related_posts[$i+1]->featured_image}}" alt="">
                                                        </figure>
                                                    @else
                                                        <figure class="image-overlay">
                                                            <img src="{{$related_posts[$i+1]->featured_image}}" alt="">
                                                        </figure>
                                                    @endif
                                                </a>
                                                <a href="/category/{{$related_posts[$i+1]->category->slug}}/{{$related_posts[$i+1]->sub_category->slug}}"
                                                   class="category">
                                                    {{$related_posts[$i+1]->sub_category->title}}
                                                </a>
                                                <header class="news-details">
                                                    <h3 class="news-title">
                                                        <a href="/{{$related_posts[$i+1]->slug}}">
                                                            {{$related_posts[$i+1]->title}}
                                                        </a>
                                                    </h3>

                                                    <p class="simple-share">

                                                        @if($related_posts[$i+1]->type == \App\Posts::TYPE_SOURCE && $related_posts[$i+1]->dont_show_author_publisher == 1)
                                                            <a href="/category/{{$related_posts[$i+1]->category->slug}}">{{$related_posts[$i+1]->category->title}}</a>
                                                            /
                                                            <a href="/category/{{$related_posts[$i+1]->category->slug}}/{{$related_posts[$i+1]->sub_category->slug}}">{{$related_posts[$i+1]->sub_category->title}}</a>
                                                            -
                                                        @else
                                                            by
                                                            <a href="/author/{{$related_posts[$i+1]->author->slug}}"><b>{{$related_posts[$i+1]->author->name}}</b></a>
                                                            -
                                                        @endif

                                                        <span class="article-date"><i
                                                                    class="fa fa-clock-o"></i> {{$related_posts[$i+1]->created_at->diffForHumans()}}</span>
                                                    </p>
                                                </header>
                                            </article>
                                        </div>
                                    @endif

                                </div>
                            @endfor

                        </div>
                    @endif

                    @if(!empty($ads[\App\Ads::TYPE_BELOW_POST]))
                        <div class="row">
                            <div class="col-md-12">
                                {!! $ads[\App\Ads::TYPE_BELOW_POST]->code !!}
                            </div>
                        </div>
                    @endif

                    @if($settings_comments->comment_system == \App\Posts::COMMENT_DISQUS)
                        <div id="comments" class="comments-wrapper clearfix">
                            <h3 class="block-title"><span>{{trans('messages.comments')}}</span></h3>

                            {!! $settings_comments->disqus_js !!}

                        </div>
                    @endif

                    @if($settings_comments->comment_system == \App\Posts::COMMENT_FACEBOOK)
                        <div id="comments" class="comments-wrapper clearfix">
                            <h3 class="block-title"><span>{{trans('messages.comments')}}</span></h3>

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

