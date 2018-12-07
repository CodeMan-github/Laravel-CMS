<?php namespace App\Http\Controllers;

use App;
use App\Ads;
use App\Categories;
use App\GalleryImage;
use App\Groups;
use App\Libraries\Utils;
use App\Pages;
use App\PostLikes;
use App\PostRatings;
use App\Posts;
use App\PostTags;
use App\SubCategories;
use App\Tags;
use App\Users;
use App\UsersGroups;
use Carbon\Carbon;
use DB;
use Feed;
use Input;
use Session;
use URL;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('migrate');

        Session::flash('success_msg', 'Successfully migrated new database columns , Login below to continue ');

        return redirect()->to('/login');
    }

    public function index()
    {
        $featured_ids = Posts::where('featured', 1)->where('render_type', '!=', Posts::RENDER_TYPE_TEXT)->orderBy('created_at', 'desc')->where('status', Posts::STATUS_PUBLISHED)->limit(6)->lists('id');

        $this->data['ads'][Ads::TYPE_INDEX_HEADER] = Ads::where('position', Ads::TYPE_INDEX_HEADER)->get();
        $this->data['ads'][Ads::TYPE_INDEX_FOOTER] = Ads::where('position', Ads::TYPE_INDEX_FOOTER)->get();
        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();

        $this->data['featured'] = Posts::whereIn('id', $featured_ids)->get();

        foreach ($this->data['featured'] as $post) {
            $post->author = Users::where('id', $post->author_id)->first();
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
        }

        $this->data['just_posted'] = Posts::orderBy('created_at', 'desc')->whereNotIn('id', $featured_ids)->where('render_type', Posts::RENDER_TYPE_TEXT)->where('status', Posts::STATUS_PUBLISHED)->limit(14)->get();

        $this->data['latest_top'] = Posts::orderBy('created_at', 'desc')->where('render_type', '!=', Posts::RENDER_TYPE_TEXT)->orderBy('views', 'desc')->whereNotIn('id', array_merge($featured_ids->toArray(), $this->data['just_posted']->lists('id')->toArray()))->where('status', Posts::STATUS_PUBLISHED)->limit(5)->get();

        foreach ($this->data['latest_top'] as $post) {
            $post->author = Users::where('id', $post->author_id)->first();
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
        }

        $categories = Categories::where('show_on_home', 1)->orderBy('created_at', 'desc')->get();

        $this->data['category_posts'] = [];

        foreach ($categories as $category) {
            $sub_categories_ids = SubCategories::where('parent_id', $category->id)->lists('id');

            $posts = Posts::orderBy('created_at', 'desc')->where('render_type', '!=', Posts::RENDER_TYPE_TEXT)->whereNotIn('id', array_merge(array_merge($featured_ids->toArray(), $this->data['just_posted']->lists('id')->toArray()), $this->data['latest_top']->lists('id')->toArray()))->whereIn('category_id', $sub_categories_ids)->where('status', Posts::STATUS_PUBLISHED)->limit(7)->get();

            foreach ($posts as $post) {
                $post->author = Users::where('id', $post->author_id)->first();
                $post->sub_category = SubCategories::where('id', $post->category_id)->first();
                $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
            }

            $category->posts = $posts;

            $this->data['category_posts'][] = $category;
        }

        $this->data['video_posts'] = Posts::orderBy('created_at', 'desc')->orderBy('views', 'desc')->where('render_type', '!=', Posts::RENDER_TYPE_TEXT)->where('rating_box', 0)->where('render_type', Posts::RENDER_TYPE_VIDEO)->where('status', Posts::STATUS_PUBLISHED)->limit(20)->get();

        foreach ($this->data['video_posts'] as $post) {
            $post->author = Users::where('id', $post->author_id)->first();
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
        }


        return view('index', $this->data);
    }

    public function page($page_slug)
    {
        $page = Pages::where('slug', $page_slug)->first();

        if (empty($page)) {
            return $this->throw404();
        }

        $page->next = Pages::where("id", ">", $page->id)->first();
        $page->prev = Pages::where("id", "<", $page->id)->orderBy('created_at', 'desc')->first();
        $page->author = Users::where('id', $page->author_id)->first();

        $related_pages = Pages::where('id', '!=', $page->id)->orderBy('created_at', 'desc')->where('status', Posts::STATUS_PUBLISHED)->where('description', 'LIKE', '%' . $page->description . '%')->limit(6)->get();

        foreach ($related_pages as $p) {
            $p->author = Users::where('id', $p->author_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_ABOVE_PAGE] = Ads::where('position', Ads::TYPE_ABOVE_PAGE)->orderByRaw("RAND()")->first();
        $this->data['ads'][Ads::TYPE_BELOW_PAGE] = Ads::where('position', Ads::TYPE_BELOW_PAGE)->orderByRaw("RAND()")->first();
        $this->data['page'] = $page;
        $this->data['related_pages'] = $related_pages;

        return view('page', $this->data);
    }

    public function byAuthor($author_slug)
    {

        $author = Users::where('slug', $author_slug)->first();

        if (empty($author)) {
            return $this->throw404();
        }

        $group_id = UsersGroups::where('user_id', $author->id)->pluck('group_id');

        $author->group = Groups::where('id', $group_id)->first();

        $posts = Posts::where('author_id', $author->id)
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.status', Posts::STATUS_PUBLISHED)
            ->select('posts.*')
            ->paginate(15);;

        foreach ($posts as $post) {
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_BETWEEN_AUTHOR_INDEX] = Ads::where('position', Ads::TYPE_BETWEEN_AUTHOR_INDEX)->orderByRaw("RAND()")->first();
        $this->data['author'] = $author;
        $this->data['posts'] = $posts;

        return view('author', $this->data);
    }

    public function byCategory($category_slug)
    {

        $category = Categories::where('slug', $category_slug)->first();

        if (empty($category)) {
            return $this->throw404();
        }

        $sub_cat_ids = SubCategories::where('parent_id', $category->id)->lists('id');

        if (sizeof($sub_cat_ids) > 0) {
            $posts = Posts::orderBy('posts.created_at', 'desc')
                ->where('posts.status', Posts::STATUS_PUBLISHED)
                ->whereIn('posts.category_id', $sub_cat_ids)
                ->select('posts.*')
                ->paginate(15);
        } else {
            $posts = [];
        }

        foreach ($posts as $post) {
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
            $post->author = Users::where('id', $post->author_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_BETWEEN_CATEGORY_INDEX] = Ads::where('position', Ads::TYPE_BETWEEN_CATEGORY_INDEX)->orderByRaw("RAND()")->first();
        $this->data['posts'] = $posts;
        $this->data['category'] = $category;

        return view('category', $this->data);
    }

    public function bySearch()
    {

        $search_term = Input::get('search');

        $posts = Posts::where('title', 'LIKE', '%' . $search_term . '%')->where('description', 'LIKE', '%' . $search_term . '%')->orderBy('created_at', 'desc')->where('status', Posts::STATUS_PUBLISHED)->paginate(15);

        foreach ($posts as $post) {
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
            $post->author = Users::where('id', $post->author_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_BETWEEN_SEARCH_INDEX] = Ads::where('position', Ads::TYPE_BETWEEN_SEARCH_INDEX)->orderByRaw("RAND()")->first();
        $this->data['posts'] = $posts;
        $this->data['search_term'] = $search_term;

        return view('search', $this->data);
    }

    public function byTag($tag_slug)
    {

        $tag = Tags::where('slug', $tag_slug)->first();

        if (empty($tag)) {
            return $this->throw404();
        }

        $post_ids = PostTags::where('tag_id', $tag->id)->lists('post_id');

        if (sizeof($post_ids) > 0) {
            $posts = Posts::orderBy('posts.created_at', 'desc')
                ->where('posts.status', Posts::STATUS_PUBLISHED)
                ->whereIn('posts.id', $post_ids)
                ->select('posts.*')
                ->paginate(15);
        } else {
            $posts = [];
        }

        foreach ($posts as $post) {
            $post->sub_category = SubCategories::where('id', $post->category_id)->first();
            $post->category = Categories::where('id', $post->sub_category->parent_id)->first();
            $post->author = Users::where('id', $post->author_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_BETWEEN_TAG_INDEX] = Ads::where('position', Ads::TYPE_BETWEEN_TAG_INDEX)->orderByRaw("RAND()")->first();
        $this->data['posts'] = $posts;
        $this->data['tag'] = $tag;

        return view('tag', $this->data);
    }

    public function bySubCategory($category_slug, $sub_category_slug)
    {

        $sub_category = SubCategories::where('slug', $sub_category_slug)->first();

        if (empty($sub_category)) {
            return $this->throw404();
        }

        $category = Categories::where('id', $sub_category->parent_id)->first();

        if (empty($category)) {
            return $this->throw404();
        }

        $posts = Posts::orderBy('posts.created_at', 'desc')
            ->where('posts.status', Posts::STATUS_PUBLISHED)
            ->where('posts.category_id', $sub_category->id)
            ->select('posts.*')
            ->paginate(15);

        foreach ($posts as $post) {
            $post->author = Users::where('id', $post->author_id)->first();
        }

        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();
        $this->data['ads'][Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX] = Ads::where('position', Ads::TYPE_BETWEEN_SUBCATEGORY_INDEX)->orderByRaw("RAND()")->first();
        $this->data['posts'] = $posts;
        $this->data['category'] = $category;
        $this->data['sub_category'] = $sub_category;

        return view('sub_category', $this->data);
    }

    public function submitLike()
    {
        $post_id = Input::get('id');
        $type = Input::get('type');

        if ($post_id < 0) {
            Session::flash('error_msg', trans('messages.internal_server_error'));
            return redirect()->back();
        } else {

            $post_rating = PostLikes::where('email', Input::get('email'))->where('post_id', $post_id)->first();

            if ($type == 1 || $type == 0) {

                if (!empty($post_rating)) {
                    $post_rating->rating = $type;
                    $post_rating->approved = 1;
                    $post_rating->save();
                } else {
                    $post_rating = new PostLikes();
                    $post_rating->post_id = $post_id;
                    $post_rating->name = Input::get('name');
                    $post_rating->email = Input::get('email');
                    $post_rating->rating = $type;
                    $post_rating->approved = 1;
                    $post_rating->save();
                }

                Session::flash('success_msg', trans('messages.thanks_for_rating'));
                return redirect()->back();
            }
        }
    }

    public function submitRating()
    {
        $post_id = Input::get('id');

        if (!Input::has('star') || !Input::has('name') || !Input::has('email') || !Input::has('id')) {
            Session::flash('error_msg', trans('messages.all_field_required_to_submit_rating'));
            return redirect()->back();
        } else {

            $post_rating = PostRatings::where('email', Input::get('email'))->where('post_id', $post_id)->first();

            if (!empty($post_rating)) {
                $post_rating->rating = Input::get('star');
                $post_rating->approved = 1;
                $post_rating->save();
            } else {
                $post_rating = new PostRatings();
                $post_rating->post_id = $post_id;
                $post_rating->name = Input::get('name');
                $post_rating->email = Input::get('email');
                $post_rating->rating = Input::get('star');
                $post_rating->approved = 1;
                $post_rating->save();
            }

            Session::flash('success_msg', trans('messages.thanks_for_rating'));
            return redirect()->back();
        }
    }

    public function article($slug)
    {
        $this->data['ads'][Ads::TYPE_ABOVE_POST] = Ads::where('position', Ads::TYPE_ABOVE_POST)->orderByRaw("RAND()")->first();
        $this->data['ads'][Ads::TYPE_BELOW_POST] = Ads::where('position', Ads::TYPE_BELOW_POST)->orderByRaw("RAND()")->first();
        $this->data['ads'][Ads::TYPE_SIDEBAR] = Ads::where('position', Ads::TYPE_SIDEBAR)->get();

        $post = Posts::where('slug', $slug)->first();

        if (empty($post)) {
            return $this->throw404();
        }

        Posts::where('slug', $slug)->update(['views' => $post->views + 1]);

        $post->author = Users::where('id', $post->author_id)->first();
        $post->sub_category = SubCategories::where('id', $post->category_id)->first();
        $post->category = Categories::where('id', $post->sub_category->parent_id)->first();

        if ($post->rating_box == 1) {
            $all_ratings = PostRatings::orderBy('created_at', 'desc')->where('post_id', $post->id)->where('approved', 1)->lists('rating');

            if (sizeof($all_ratings) > 0) {

                $total = 0;

                foreach ($all_ratings as $rating) {
                    $total = $total + $rating;
                }

                $post->average_rating = (float)($total / sizeof($all_ratings));
                $post->rating_count = sizeof($all_ratings);

            } else {
                $post->average_rating = 0;
                $post->rating_count = 0;
            }
        }

        if ($post->rating_box == 2) {
            $ups = PostLikes::where('post_id', $post->id)->where('rating', 1)->count();
            $downs = PostLikes::where('post_id', $post->id)->where('rating', 0)->count();


            $post->ups = $ups;
            $post->downs = $downs;

        }

        if ($post->render_type == Posts::RENDER_TYPE_GALLERY) {
            $post->gallery = GalleryImage::where('post_id', $post->id)->get();
        }

        $tag_ids = PostTags::where('post_id', $post->id)->get();

        if (sizeof($tag_ids->lists('tag_id')) > 0)
            $post->tags = Tags::whereIn('id', $tag_ids->lists('tag_id'))->get();
        else
            $post->tags = [];

        foreach ($tag_ids as $tag) {
            PostTags::where('post_id', $post->id)->where('tag_id', $tag->id)->update(['views' => $tag->views + 1]);
        }

        foreach ($post->tags as $tag) {
            Tags::where('id', $tag->id)->update(['views' => $tag->views + 1]);
        }

        $post->next = Posts::where("id", ">", $post->id)->first();
        $post->prev = Posts::where("id", "<", $post->id)->orderBy('created_at', 'desc')->first();

        $related_posts = Posts::where('id', '!=', $post->id)->orderBy('created_at', 'desc')->where('status', Posts::STATUS_PUBLISHED)->where('description', 'LIKE', '%' . $post->description . '%')->whereIn('render_type', [Posts::RENDER_TYPE_IMAGE, Posts::RENDER_TYPE_VIDEO])->limit(6)->get();

        foreach ($related_posts as $p) {
            $p->author = Users::where('id', $p->author_id)->first();
            $p->sub_category = SubCategories::where('id', $p->category_id)->first();
            $p->category = Categories::where('id', $p->sub_category->parent_id)->first();
        }

        $this->data['post'] = $post;

        if ($post->type == Posts::TYPE_SOURCE)
            $this->data['source'] = App\Sources::where('id', $post->source_id)->first();

        $this->data['related_posts'] = $related_posts;


        if (strlen($post->lists_description) > 0) {
            $lists_description = json_decode($post->lists_description);

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Create a new Laravel collection from the array data
            $itemCollection = collect($lists_description);
            // Define how many items we want to be visible in each page
            $perPage = 1;

            if(($currentPage - 1) == -1){
                $currentPage = 0;
            }else{
                $currentPage= $currentPage-1;
            }

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice($currentPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath(\Request::url());


            return view('article', ['lists_description' => $paginatedItems], $this->data);

        }




        return view('article', $this->data);
    }

    public function rss()
    {

        $settings_general = Utils::getSettings("general");
        $settings_seo = Utils::getSettings("seo");

        if ($settings_general->generate_rss_feeds != 1) {
            return $this->throw404();
        }

        $feed = Feed::feed('2.0', 'UTF-8');

        $feed->channel(array('title' => $settings_general->site_title, 'description' => $settings_seo->seo_description, 'link' => $settings_general->site_url));

        $posts = Posts::join('sources', 'posts.source_id', '=', 'sources.id')
            ->orderBy('sources.priority', 'asc')
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.status', Posts::STATUS_PUBLISHED)
            ->select('posts.*')->limit(50)->get();

        foreach ($posts as $post) {
            $author = Users::where('id', $post->author_id)->first();

            if ($post->type == Posts::TYPE_SOURCE) {
                if ($settings_general->include_sources == 1) {
                    $feed->item(['title' => $post->title,
                            'description|cdata' => $post->description,
                            'link' => URL::to($post->slug),
                            'guid' => URL::to($post->slug),
                            'author' => $author->email . "($author->name)"
                        ]
                    );
                }
            } else {
                $feed->item(['title' => $post->title,
                        'description|cdata' => $post->description,
                        'link' => URL::to($post->slug),
                        'guid' => URL::to($post->slug),
                        'author' => $author->email . "($author->name)"
                    ]
                );
            }


        }

        return response($feed, 200, array('Content-Type' => 'text/xml'));
    }

    public function show($id)
    {

        $post = Posts::where('slug', $id)->first();


        return view('show', ['post_link' => $post->link], $this->data);

    }

    public function categoryRss($slug)
    {
        $settings_general = Utils::getSettings("general");
        $settings_seo = Utils::getSettings("seo");

        if ($settings_general->generate_rss_feeds != 1) {
            return $this->throw404();
        }

        $feed = Feed::feed('2.0', 'UTF-8');

        $feed->channel(array('title' => $settings_general->site_title, 'description' => $settings_seo->seo_description, 'link' => $settings_general->site_url));

        $category = Categories::where('slug', $slug)->first();

        $sub_ids = SubCategories::where('parent_id', $category->id)->lists('id');

        if (sizeof($sub_ids) > 0) {
            $posts = Posts::orderBy('posts.created_at', 'desc')
                ->where('posts.status', Posts::STATUS_PUBLISHED)
                ->whereIn('posts.category_id', $sub_ids->toArray())
                ->select('posts.*')->get();
        } else {
            $posts = [];
        }

        foreach ($posts as $post) {
            $author = Users::where('id', $post->author_id)->first();

            if ($post->type == Posts::TYPE_SOURCE) {
                if ($settings_general->include_sources == 1) {
                    $feed->item(['title' => html_entity_decode($post->title),
                            'description|cdata' => strip_tags($post->description),
                            'link' => URL::to($post->slug),
                            'guid' => $post->id,
                            'author' => $author->name,
                            'media:content | cdata' => $post->featured_image,
                            'media:text' => $post->title
                        ]
                    );
                }
            } else {
                $feed->item(['title' => html_entity_decode($post->title),
                        'description|cdata' => strip_tags($post->description),
                        'link' => URL::to($post->slug),
                        'guid' => $post->id,
                        'author' => $author->name,
                        'media:content | cdata' => $post->featured_image,
                        'media:text' => $post->title
                    ]
                );
            }


        }

        return response($feed, 200, array('Content-Type' => 'text/xml'));
    }

    public function subCategoryRss($category_slug, $subcategory_slug)
    {
        $settings_general = Utils::getSettings("general");
        $settings_seo = Utils::getSettings("seo");

        if ($settings_general->generate_rss_feeds != 1) {
            return $this->throw404();
        }

        $feed = Feed::feed('2.0', 'UTF-8');

        $feed->channel(array('title' => $settings_general->site_title, 'description' => $settings_seo->seo_description, 'link' => $settings_general->site_url));

        $subcategory = SubCategories::where('slug', $subcategory_slug)->first();

        if (!empty($subcategory)) {
            $posts = Posts::orderBy('posts.created_at', 'desc')
                ->where('posts.status', Posts::STATUS_PUBLISHED)
                ->where('posts.category_id', $subcategory->id)
                ->select('posts.*')->get();
        } else {
            $posts = [];
        }

        foreach ($posts as $post) {
            $author = Users::where('id', $post->author_id)->first();

            if ($post->type == Posts::TYPE_SOURCE) {
                if ($settings_general->include_sources == 1) {
                    $feed->item(['title' => $post->title,
                            'description|cdata' => $post->description,
                            'link' => URL::to($post->slug),
                            'guid' => $post->id,
                            'author' => $author->name,
                            'media:content | cdata' => $post->featured_image,
                            'media:text' => $post->title
                        ]
                    );
                }
            } else {
                $feed->item(['title' => $post->title,
                        'description|cdata' => $post->description,
                        'link' => URL::to($post->slug),
                        'guid' => $post->id,
                        'author' => $author->name,
                        'media:content | cdata' => $post->featured_image,
                        'media:text' => $post->title
                    ]
                );
            }


        }

        return response($feed, 200, array('Content-Type' => 'text/xml'));
    }

    public function sitemap()
    {
        $settings_general = Utils::getSettings("general");

        if ($settings_general->generate_sitemap == 1) {

            // create new sitemap object
            $sitemap = App::make("sitemap");

            // get all posts from db
            $posts = DB::table('posts')->orderBy('created_at', 'desc')->limit(100)->get();

            // add every post to the sitemap
            foreach ($posts as $post) {
                $sitemap->add(URL::to('/') . "/" . $post->slug, $post->updated_at, '1', 'weekly', null, $post->title);
            }

            $pages = DB::table('pages')->orderBy('created_at', 'desc')->get();

            // add every page to the sitemap
            foreach ($pages as $page) {
                $sitemap->add(URL::to('/') . "/" . $page->slug, $page->updated_at, '1', 'weekly', null, $page->title);
            }

            $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();

            // add every category to the sitemap
            foreach ($categories as $category) {

                $sub_categories = SubCategories::where('parent_id', $category->id)->get();

                $sitemap->add(URL::to('/') . "/category/" . $category->slug, $category->updated_at, '1', 'weekly', null, $category->title);

                foreach ($sub_categories as $sub_category) {
                    $sitemap->add(URL::to('/') . "/category/" . $category->slug . "/" . $sub_category->slug, $category->updated_at, '1', 'weekly', null, $category->title);
                }
            }

            return $sitemap->render('xml');
        }
    }

}
