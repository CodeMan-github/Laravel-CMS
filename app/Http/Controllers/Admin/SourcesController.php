<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Libraries\Parser;
use App\Libraries\Utils;
use App\Posts;
use App\PostTags;
use App\Sources;
use App\SubCategories;
use App\Tags;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Input;
use Sabre\Xml\LibXMLException;
use Session;

class SourcesController extends Controller
{
    function __construct()
    {
        $this->middleware('has_permission:sources.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:sources.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:sources.view', ['only' => ['all']]);
        $this->middleware('has_permission:sources.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        return view('admin.sources.create', ['categories' => Categories::all()]);
    }

    public function store()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('url')) {
            Session::flash('error_msg', trans('messages.feed_url_required'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('sub_category')) {
            Session::flash('error_msg', trans('messages.sub_category_required'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!filter_var(Input::get('url'), FILTER_VALIDATE_URL)) {
            Session::flash('error_msg', trans('messages.invalid_url_should_start_with'));
            return redirect()->back()->withInput(Input::all());
        }

        $url = Input::get('url');

        try {
            $feed = Parser::xml($url);
        } catch (LibXMLException $e) {
            Session::flash('error_msg', trans('messages.invalid_source_url_only_rss_or_atom_allowed'));
            return redirect()->back()->withInput(Input::all());
        }

        $source = new Sources();
        $source->url = Input::get('url');
        $source->priority = Input::get('priority');
        $source->category_id = Input::get('sub_category');
        $source->channel_title = isset($feed['channel']['title']) ? $feed['channel']['title'] : '';
        $source->channel_link = isset($feed['channel']['link']) ? $feed['channel']['link'] : '';
        $source->channel_description = isset($feed['channel']['description']) ? $feed['channel']['description'] : '';
        $source->channel_language = isset($feed['channel']['language']) ? $feed['channel']['language'] : '';
        $source->channel_pubDate = isset($feed['channel']['pubDate']) ? $feed['channel']['pubDate'] : '';
        $source->channel_lastBuildDate = isset($feed['channel']['lastBuildDate']) ? $feed['channel']['lastBuildDate'] : '';
        $source->channel_generator = isset($feed['channel']['generator']) ? $feed['channel']['generator'] : '';
        $source->auto_update = Input::has('auto_update') ? 1 : 0;
        $source->items_count = isset($feed['channel']['item']) ? sizeof($feed['channel']['item']) : 0;
        $source->dont_show_author_publisher = Input::has('dont_show_author_publisher') ? 1 : 0;
        $source->show_post_source = Input::has('show_post_source') ? 1 : 0;
        $source->fetch_full_text = Input::has('fetch_full_text') ? 1 : 0;
        $source->use_auto_spin = Input::has('use_auto_spin') ? 1 : 0;
        $source->save();

        //Posts::where('source_id', $source->id)->delete();



        if (isset($feed['channel']['item'])) {
            foreach ($feed['channel']['item'] as $item) {

                if (!is_null($item['title']) && !is_null($item['description']) && !is_null($item['pubDate']) && !is_null($item['link'])) {

                    if ($source->fetch_full_text == 1) {
                        $item['description'] = Parser::fetchFull($item['link'], $item['description']);
                    }

                    if ($source->use_auto_spin == 1) {
                        $arr = Parser::spin($item['title'], $item['description']);
                        $item['title'] = $arr['title'];
                        $item['description'] = $arr['description'];
                    }

                    //If same title not present then only insert
                    if (sizeof(Posts::where('slug', Str::slug($item['title']))->get()) <= 0) {

                        list($item['render_type'], $item['featured_image']) = Parser::setImgAndRenderType($item['description'], $item['video_embed_code'], $item['featured_image']);

                        $post_item = new Posts();
                        $post_item->author_id = \Auth::user()->id;
                        $post_item->title = $item['title'];
                        $post_item->save();

                        $post_item->slug = (is_null(Str::slug($item['title'])) || empty(Str::slug($item['title']))) ? $post_item->id : Str::slug($item['title']);
                        $post_item->link = $item['link'];
                        $post_item->featured = 0;
                        $post_item->category_id = Input::get('sub_category');
                        $post_item->type = Posts::TYPE_SOURCE;
                        $post_item->render_type = $item['render_type'];
                        $post_item->source_id = $source->id;
                        $post_item->description = $item['description'];
                        $post_item->featured_image = $item['featured_image'];
                        $post_item->video_embed_code = $item['video_embed_code'];
                        $post_item->rating_box = 0;
                        $post_item->status = Input::get('status');
                        $post_item->created_at = $item['pubDate'];
                        $post_item->dont_show_author_publisher = Input::has('dont_show_author_publisher') ? 1 : 0;
                        $post_item->show_post_source = Input::has('show_post_source') ? 1 : 0;
                        $post_item->show_author_box = Input::has('dont_show_author_publisher') ? 0 : 1;
                        $post_item->show_author_socials = Input::has('dont_show_author_publisher') ? 0 : 1;
                        $post_item->views = 1;
                        $post_item->save();

                        if (strlen($post_item->featured_image) > 0) {

                            $img = \Image::make($post_item->featured_image);

                            // resize the image to a width of 300 and constrain aspect ratio (auto height)
                            $img->resize(400, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            $path = $post_item->featured_image;
                            $ext = pathinfo($path, PATHINFO_EXTENSION);

                            $timestamp = uniqid();
                            $name = $timestamp . "_file." . $ext;

                            $img->save(public_path('/uploads/').$name, 75);

                            $post_item->featured_image = '/uploads/'.$name;
                            $post_item->save();
                        }

                        if (isset($item['categories'])) {
                            $this->createTags($item['categories'], $post_item->id);
                        }
                    }
                }
            }
        }

//        \DB::statement("UPDATE posts SET show_in_mega_menu = 1 WHERE category_id = ".$source->category_id."
//                AND CHAR_LENGTH(featured_image) > 1 ORDER BY RAND() LIMIT 4");
//
//        //Reset featured posts
//        Posts::where('featured', 1)->update(['featured' => 0]);
//
//        //Set new featured posts
//        \DB::statement("UPDATE posts SET featured = 1 WHERE render_type = 'image' OR render_type = 'video'  ORDER BY RAND() LIMIT 6");

        Session::flash('success_msg', trans('messages.source_created_success'));
        return redirect()->to('/admin/sources/all');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(Sources::where('id', $id)->get()) > 0) {

            $source = Sources::where('id', $id)->first();

            $source->category = SubCategories::where('id', $source->category_id)->first();
            $source->parent_category = Categories::where('id', $source->category->parent_id)->first();

            return view('admin.sources.edit', ['source' => $source, 'categories' => Categories::all()]);

        } else {
            Session::flash('error_msg', trans('messages.source_not_found'));
            return redirect()->to('/admin/sources/all');
        }

    }

    public function refresh($id = null)
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back();
        }

        if (!is_null($id) && sizeof(Sources::where('id', $id)->get()) > 0) {

            $source = Sources::where('id', $id)->first();

            try {
                $feed = Parser::xml($source->url);
            } catch (LibXMLException $e) {
                Session::flash('error_msg', trans('messages.invalid_source_url_only_rss_or_atom_allowed'));
                return redirect()->back();
            }

            //Posts::where('source_id', $id)->delete();

            if (isset($feed['channel']['item'])) {
                foreach ($feed['channel']['item'] as $item) {

                    if (!is_null($item['title']) && !is_null($item['description']) && !is_null($item['pubDate']) && !is_null($item['link'])) {

                        $exists_post = Posts::where('slug', Str::slug($item['title']))->first();

                        if ($source->fetch_full_text == 1) {
                            $item['description'] = Parser::fetchFull($item['link'], $item['description']);
                        }

                        if ($source->use_auto_spin == 1) {
                            $arr = Parser::spin($item['title'], $item['description']);
                            //$item['title'] = $arr['title'];
                            $item['description'] = $arr['description'];
                        }

                        list($item['render_type'], $item['featured_image']) = Parser::setImgAndRenderType($item['description'], $item['video_embed_code'], $item['featured_image']);

                        if (empty($exists_post)) {

                            $post_item = new Posts();
                            $post_item->author_id = \Auth::user()->id;
                            $post_item->title = $item['title'];
                            $post_item->save();

                            $post_item->slug = (is_null(Str::slug($item['title'])) || empty(Str::slug($item['title']))) ? $post_item->id : Str::slug($item['title']);
                            $post_item->link = $item['link'];
                            $post_item->featured = 0;
                            $post_item->category_id = $source->category_id;
                            $post_item->type = Posts::TYPE_SOURCE;
                            $post_item->render_type = $item['render_type'];
                            $post_item->source_id = $source->id;
                            $post_item->description = $item['description'];
                            $post_item->featured_image = $item['featured_image'];
                            $post_item->video_embed_code = $item['video_embed_code'];
                            $post_item->dont_show_author_publisher = $source->dont_show_author_publisher;
                            $post_item->show_post_source = $source->show_post_source;
                            $post_item->show_author_box = $source->dont_show_author_publishe;
                            $post_item->show_author_socials = $source->dont_show_author_publishe;
                            $post_item->rating_box = 0;
                            $post_item->created_at = $item['pubDate'];
                            $post_item->views = 1;
                            $post_item->save();

                            if (strlen($post_item->featured_image) > 0) {

                                $img = \Image::make($post_item->featured_image);

                                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                                $img->resize(400, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });

                                $path = $post_item->featured_image;
                                $ext = pathinfo($path, PATHINFO_EXTENSION);

                                $timestamp = uniqid();
                                $name = $timestamp . "_file." . $ext;

                                $img->save(public_path('/uploads/').$name, 75);

                                $post_item->featured_image = '/uploads/'.$name;
                                $post_item->save();
                            }

                            if (isset($item['categories'])) {
                                $this->createTags($item['categories'], $post_item->id);
                            }

                        } else {
                            $exists_post->render_type = $item['render_type'];
                            $exists_post->link = $item['link'];
                            $exists_post->description = $item['description'];
                            $exists_post->video_embed_code = $item['video_embed_code'];
                            $exists_post->featured_image = $item['featured_image'];
                            $exists_post->created_at = $item['pubDate'];
                            $exists_post->save();

                            if (strlen($exists_post->featured_image) > 0) {

                                $img = \Image::make($exists_post->featured_image);

                                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                                $img->resize(400, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });

                                $path = $exists_post->featured_image;
                                $ext = pathinfo($path, PATHINFO_EXTENSION);

                                $timestamp = uniqid();
                                $name = $timestamp . "_file." . $ext;

                                $img->save(public_path('/uploads/').$name, 75);

                                $exists_post->featured_image = '/uploads/'.$name;
                                $exists_post->save();
                            }

                            if (isset($item['categories'])) {
                                $this->createTags($item['categories'], $exists_post->id);
                            }
                        }


                    }
                }
            }

            $source->save();

//            \DB::statement("UPDATE posts SET show_in_mega_menu = 1 WHERE category_id = ".$source->category_id."
//                AND CHAR_LENGTH(featured_image) > 1 ORDER BY RAND() LIMIT 4");
//
//            //Reset featured posts
//            Posts::where('featured', 1)->update(['featured' => 0]);
//
//            //Set new featured posts
//            \DB::statement("UPDATE posts SET featured = 1 WHERE render_type = 'image' OR render_type = 'video'  ORDER BY RAND() LIMIT 6");


            Session::flash('success_msg', trans('messages.source_updated_success'));
            return redirect()->to('/admin/sources/all');

        } else {
            Session::flash('error_msg', trans('messages.source_not_found'));
            return redirect()->to('/admin/sources/all');
        }
    }

    public function update()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Sources::where('id', Input::get('id'))->get()) > 0) {

            if (!Input::has('sub_category')) {
                Session::flash('error_msg', trans('messages.sub_category_required'));
                return redirect()->back()->withInput(Input::all());
            }

            if (!filter_var(Input::get('url'), FILTER_VALIDATE_URL)) {
                Session::flash('error_msg', trans('messages.invalid_url_should_start_with'));
                return redirect()->back()->withInput(Input::all());
            }

            $source = Sources::where('id', Input::get('id'))->first();

            $source->url = Input::get('url');
            $source->priority = Input::get('priority');
            $source->category_id = Input::get('sub_category');
            $source->auto_update = Input::has('auto_update') ? 1 : 0;
            $source->dont_show_author_publisher = Input::has('dont_show_author_publisher') ? 1 : 0;
            $source->show_post_source = Input::has('show_post_source') ? 1 : 0;
            $source->fetch_full_text = Input::has('fetch_full_text') ? 1 : 0;
            $source->use_auto_spin = Input::has('use_auto_spin') ? 1 : 0;
            $source->save();

            $posts = Posts::where('source_id', $source->id)->get();

            foreach ($posts as $post) {
                $post->category_id = $source->category_id;
                $post->dont_show_author_publisher = $source->dont_show_author_publisher;
                $post->show_post_source = $source->show_post_source;
                $post->save();
            }

            Session::flash('success_msg', trans('messages.source_updated_success'));
            return redirect()->to('/admin/sources/all');

        } else {
            Session::flash('error_msg', trans('messages.source_not_found'));
            return redirect()->to('/admin/sources/all');
        }

    }

    public function createTags($tags, $post_id)
    {
        $post_tags = PostTags::where('post_id', $post_id)->get();

        foreach ($post_tags as $post_tag) {
            Tags::where('id', $post_tag->tag_id)->delete();
        }

        PostTags::where('post_id', $post_id)->delete();


        foreach ($tags as $tag) {

            $old_tag=Tags::where('title',$tag)->first();

            if(sizeof($old_tag)>0)
            {

                $pt = new PostTags();
                $pt->post_id = $post_id;
                $pt->tag_id = $old_tag->id;
                $pt->save();

            }

            else {
                $new_tag = new Tags();
                $new_tag->title = $tag;
                $new_tag->slug = Str::slug($tag);
                $new_tag->save();

                $pt = new PostTags();
                $pt->post_id = $post_id;
                $pt->tag_id = $new_tag->id;
                $pt->save();
            }
        }
        

    }

    public function pullFeeds()
    {

        if (!Input::has('url')) {
            return response()->json(['result' => 0, 'message' => trans('messages.feed_url_required')]);
        }

        if (!filter_var(Input::get('url'), FILTER_VALIDATE_URL)) {
            return response()->json(['result' => 0, 'message' => trans('messages.invalid_url_should_start_with')]);
        }

        $url = Input::get('url');

        $feed = Parser::xml($url);

        $data = [];

        if (sizeof(isset($feed['channel']['item']) > 0)) {

            $first_feed = $feed['channel']['item'][rand(0, sizeof($feed['channel']['item']) - 1)];

            $data['title'] = isset($first_feed['title']) ? $first_feed['title'] : '';
            $data['description'] = isset($first_feed['description']) ? $first_feed['description'] : '';

        }

        return response()->json(['result' => 1, 'data' => $data]);

    }


    public function all()
    {

        $sources = Sources::all();

        foreach ($sources as $source) {
            $source->category = SubCategories::where('id', $source->category_id)->first();
            $source->parent_category = Categories::where('id', $source->category->parent_id)->first();
        }

        return view('admin.sources.all', ['sources' => $sources]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Sources::where('id', $id)->get()) > 0) {

            Posts::where('source_id', $id)->delete();
            Sources::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.source_deleted_success'));
            return redirect()->to('/admin/sources/all');

        } else {
            Session::flash('error_msg', trans('messages.source_not_found'));
            return redirect()->to('/admin/sources/all');
        }
    }

}