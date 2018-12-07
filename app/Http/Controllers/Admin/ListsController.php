<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\GalleryImage;
use App\Http\Controllers\Controller;
use App\Libraries\Parser;
use App\Libraries\Utils;
use App\Posts;
use App\PostTags;
use App\Sources;
use App\SubCategories;
use App\Tags;
use App\Users;
use Illuminate\Support\Str;
use Input;
use Session;

class ListsController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:posts.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:posts.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:posts.view', ['only' => ['all']]);
        $this->middleware('has_permission:posts.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        $admins = Utils::getUsersInGroup(Users::TYPE_ADMIN);

        return view('admin.lists.create', ['categories' => Categories::all(), 'admins' => $admins]);
    }

    public function store()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $v = \Validator::make(['title' => Input::get('title'),
            'description' => Input::get('description'),
            'category_id' => Input::get('sub_category'),
            'author' => Input::get('author')
        ], ['title' => 'required', 'description' => 'required', 'category_id' => 'required', 'author' => 'required']);

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back()->withInput(Input::all());
        }

        $title = Input::get('title');
        $description = Input::get('description');

        $encoded_description=json_encode($description);


        if (Input::has('spin')) {
            $arr = Parser::spin(Input::get('title'), Input::get('description'));
            $title = $arr['title'];
            $description = $arr['description'];
        }

        $post_item = new Posts();
        $post_item->author_id = Input::get('author');
        $post_item->title = $title;
        $post_item->slug = Str::slug($title);
        $post_item->featured = Input::has('featured');
        $post_item->category_id = Input::get('sub_category');
        $post_item->description = $description[0];
        $post_item->lists_description = $encoded_description;
        $post_item->type = Posts::TYPE_MANUAL;
        $post_item->render_type = "lists";
        $post_item->rating_box = Input::get('rating_box');
        $post_item->rating_desc = Input::get('rating_desc');
        $post_item->show_in_mega_menu = Input::has('show_in_mega_menu');
        $post_item->show_featured_image_in_post = Input::has('show_featured_image_in_post');
        $post_item->show_author_box = Input::has('show_author_box');
        $post_item->show_author_socials = Input::has('show_author_socials');
        $post_item->views = 0;

        if (Input::hasFile('featured_image')) {
            $post_item->featured_image = Utils::imageUpload(Input::file('featured_image'), 'images');
        }

        $post_item->status = Input::get('status');
        $post_item->save();

        if (strlen(Input::get('tags')) > 0) {

            $tags = explode(',', Input::get('tags'));

            foreach ($tags as $tag) {

                $old_tag=Tags::where('title',$tag)->first();

                if(sizeof($old_tag)>0)
                {

                    $pt = new PostTags();
                    $pt->post_id = $post_item->id;
                    $pt->tag_id = $old_tag->id;
                    $pt->save();

                }

                else {
                    $new_tag = new Tags();
                    $new_tag->title = $tag;
                    $new_tag->slug = Str::slug($tag);
                    $new_tag->save();

                    $pt = new PostTags();
                    $pt->post_id = $post_item->id;
                    $pt->tag_id = $new_tag->id;
                    $pt->save();
                }

            }
        }



        Session::flash('success_msg', trans('messages.post_created_success'));
        return redirect()->to('/admin/lists');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(Posts::where('id', $id)->get()) > 0) {

            $post = Posts::where('id', $id)->first();

            $post->category = SubCategories::where('id', $post->category_id)->first();
            $post->parent_category = Categories::where('id', $post->category->parent_id)->first();

            $post->gallery = GalleryImage::where('post_id', $post->id)->get();

            $post_tags = PostTags::where('post_id', $post->id)->lists('tag_id');

            if (sizeof($post_tags) > 0) {
                $post->tags = Tags::whereIn('id', $post_tags)->lists('title')->toArray();
            } else {
                $post->tags = [];
            }

            if ($post->type == Posts::TYPE_SOURCE)
                $post->source = Sources::where('id', $post->source_id)->first();

            $admins = Utils::getUsersInGroup(Users::TYPE_ADMIN);

            $description=json_decode($post->lists_description);

            return view('admin.lists.edit', ['post' => $post, 'categories' => Categories::all(),'lists_description' => $description, 'sub_categories' => SubCategories::where('parent_id', $post->parent_category->id)->get(), 'admins' => $admins]);

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/admin/lists');
        }

    }

    public function update()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Posts::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(Posts::where('title', Input::get('title'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', trans('messages.post_with_title_exists'));
                return redirect()->back()->withInput(Input::except("featured_image"));
            }

            $encoded_description=json_encode(Input::get('description'));
            $description=Input::get('description');


            $post_item = Posts::where('id', Input::get('id'))->first();
            $post_item->author_id = Input::get('author');
            $post_item->title = Input::get('title');
            $post_item->slug = Str::slug(Input::get('title'));
            $post_item->featured = Input::has('featured');
            $post_item->category_id = Input::get('sub_category');
            $post_item->description = $description[0];
            $post_item->lists_description = $encoded_description;
            $post_item->render_type = "lists";
            $post_item->rating_box = Input::get('rating_box');
            $post_item->rating_desc = Input::get('rating_desc');
            $post_item->show_in_mega_menu = Input::has('show_in_mega_menu');
            $post_item->show_featured_image_in_post = Input::has('show_featured_image_in_post');
            $post_item->show_author_box = (Input::has('dont_show_author_publisher') ? 0 : (Input::has('show_author_box') ? 1 : 0));
            $post_item->show_author_socials = (Input::has('dont_show_author_publisher') ? 0 : (Input::has('show_author_socials') ? 1 : 0));

            $post_item->dont_show_author_publisher = Input::has('dont_show_author_publisher') ? 1 : 0;
            $post_item->show_post_source = Input::has('show_post_source') ? 1 : 0;

            if (Input::hasFile('featured_image')) {
                $post_item->featured_image = Utils::imageUpload(Input::file('featured_image'), 'images');;
            }

            $post_item->status = Input::get('status');
            $post_item->save();

            PostTags::where('post_id', $post_item->id)->delete();

            if (strlen(Input::get('tags')) > 0) {

                $tags = explode(',', Input::get('tags'));

                foreach ($tags as $tag) {

                    $old_tag=Tags::where('title',$tag)->first();

                    if(sizeof($old_tag)>0)
                    {

                        $pt = new PostTags();
                        $pt->post_id = $post_item->id;
                        $pt->tag_id = $old_tag->id;
                        $pt->save();

                    }

                    else {
                        $new_tag = new Tags();
                        $new_tag->title = $tag;
                        $new_tag->slug = Str::slug($tag);
                        $new_tag->save();

                        $pt = new PostTags();
                        $pt->post_id = $post_item->id;
                        $pt->tag_id = $new_tag->id;
                        $pt->save();
                    }
                }
            }

            if (Input::hasFile('image_gallery') && Input::get('render_type') == Posts::RENDER_TYPE_GALLERY) {

                GalleryImage::where('post_id', $post_item->id)->delete();

                $gallery = Input::file('image_gallery');

                foreach ($gallery as $g) {
                    $file = Utils::imageUpload($g, 'images');
                    $i = new GalleryImage();
                    $i->post_id = $post_item->id;
                    $i->image = $file;
                    $i->save();
                }
            }

            $post_gallery_img = GalleryImage::where('post_id', $post_item->id)->first();

            if (!empty($post_gallery_img) && Input::get('render_type') == Posts::RENDER_TYPE_GALLERY) {
                $post_item->featured_image = $post_gallery_img->image;
            }

            $post_item->save();

            Session::flash('success_msg', trans('messages.post_updated_success'));
            return redirect()->to('/admin/lists');

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/admin/lists');
        }

    }

    public function all()
    {

        $posts = \DB::table('posts')->where('render_type',"lists")->orderBy('id', 'asc');

        $search=Input::get('search',null);


        if($search!=null)
        {

            $posts=$posts->where('title', 'LIKE', '%' . $search . '%')->paginate(10);


        }
        else{


            $posts = $posts->paginate(10);



        }


        foreach ($posts as $post) {

            $post->category = SubCategories::where('id', $post->category_id)->first();

            if ($post->type == Posts::TYPE_SOURCE) {
                $post->source = Sources::where('id', $post->source_id)->first();
            }
        }

        return view('admin.lists.all', ['posts' => $posts]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Posts::where('id', $id)->get()) > 0) {

            Posts::where('id', $id)->delete();

            $post_tags = PostTags::where('post_id', $id)->get();

            foreach ($post_tags as $post_tag) {
                Tags::where('id', $post_tag->tag_id)->delete();
            }

            PostTags::where('post_id', $id)->delete();


            Session::flash('success_msg', trans('messages.post_deleted_success'));
            return redirect()->to('/admin/lists/all');

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/admin/lists/all');
        }
    }

}