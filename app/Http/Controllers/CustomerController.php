<?php namespace App\Http\Controllers;

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

class CustomerController extends Controller
{


public function posts()
{
    $posts = \DB::table('posts')->orderBy('id', 'asc');

    $search=Input::get('search',null);


    if($search!=null)
    {

        $posts=$posts->where('title', 'LIKE', '%' . $search . '%')->where('user_id',\Auth::user()->id)->paginate(10);

    }
    else{


        $posts = $posts->where('user_id',\Auth::user()->id)->paginate(10);


    }


    foreach ($posts as $post) {

        $post->category = SubCategories::where('id', $post->category_id)->first();

        if ($post->type == Posts::TYPE_SOURCE) {
            $post->source = Sources::where('id', $post->source_id)->first();
        }
    }

    return view('customer.posts.all', ['posts' => $posts]);

}

    public function create()
    {
        $admins = Utils::getUsersInGroup(Users::TYPE_ADMIN);

        return view('customer.posts.create', ['categories' => Categories::all(), 'admins' => $admins]);
    }

    public function store()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $v = \Validator::make(['title' => Input::get('title'),
            'description' => Input::get('description'),
            'category_id' => Input::get('sub_category')
        ], ['title' => 'required', 'description' => 'required', 'category_id' => 'required']);

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back()->withInput(Input::all());
        }

        $title = Input::get('title');
        $description = Input::get('description');

        if (Input::has('spin')) {
            $arr = Parser::spin(Input::get('title'), Input::get('description'));
            $title = $arr['title'];
            $description = $arr['description'];
        }

        $post_item = new Posts();
        $post_item->author_id = \Auth::user()->id;
        $post_item->user_id = \Auth::user()->id;
        $post_item->title = $title;
        $post_item->slug = Str::slug($title);
        $post_item->featured = Input::has('featured');
        $post_item->category_id = Input::get('sub_category');
        $post_item->description = $description;
        $post_item->type = Posts::TYPE_MANUAL;
        $post_item->render_type = Input::get('render_type');
        $post_item->video_embed_code = Input::get('video_embed_code');
        $post_item->image_parallax = Input::has('image_parallax');
        $post_item->video_parallax = Input::has('video_parallax');
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

                $old_tag = Tags::where('title', $tag)->first();

                if (sizeof($old_tag) > 0) {

                    $pt = new PostTags();
                    $pt->post_id = $post_item->id;
                    $pt->tag_id = $old_tag->id;
                    $pt->save();

                } else {
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

            $gallery = Input::file('image_gallery');

            foreach ($gallery as $index => $g) {
                $file = Utils::imageUpload($g, 'images');
                $i = new GalleryImage();
                $i->post_id = $post_item->id;
                $i->image = $file;
                $i->save();

                if ($index == 0)
                    $featured = $file;
            }

            if (sizeof($gallery) > 0) {
                $post_item->featured_image = $featured;
                $post_item->save();
            }


        }


        Session::flash('success_msg', trans('messages.post_created_success'));
        return redirect()->to('/customer');
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

            return view('customer.posts.edit', ['post' => $post, 'categories' => Categories::all(), 'sub_categories' => SubCategories::where('parent_id', $post->parent_category->id)->get(), 'admins' => $admins]);

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/customer');
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

            $post_item = Posts::where('id', Input::get('id'))->first();
            $post_item->author_id = Input::get('author');
            $post_item->user_id = \Auth::user()->id;
            $post_item->title = Input::get('title');
            $post_item->slug = Str::slug(Input::get('title'));
            $post_item->featured = Input::has('featured');
            $post_item->category_id = Input::get('sub_category');
            $post_item->description = Input::get('description');
            $post_item->render_type = Input::get('render_type');
            $post_item->video_embed_code = Input::get('video_embed_code');
            $post_item->image_parallax = Input::has('image_parallax');
            $post_item->video_parallax = Input::has('video_parallax');
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
            return redirect()->to('/customer');

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/customer');
        }

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
            return redirect()->to('/customer');

        } else {
            Session::flash('error_msg', trans('messages.post_not_found'));
            return redirect()->to('/customer');
        }
    }

    public function profileEdit()
    {

        $id=\Auth::user()->id;


            $user = Users::where('id', $id)->first();
            $countries = \DB::table('countries')->get();


            return view('customer.profile', ['user' => $user, 'countries' => $countries]);

        }

    public function Profileupdate()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Users::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(Users::where('email', Input::get('email'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', 'Email already exists');
                return redirect()->back()->withInput(Input::all());
            }

            if (sizeof(Users::where('name', Input::get('name'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', 'Name already exists');
                return redirect()->back()->withInput(Input::all());
            }

            $data = [
                'name' => Input::get('name'),
                'email' => Input::get('email')
            ];

            $rules = [
                'name' => 'required',
                'email' => 'required|email'
            ];

            if (strlen(Input::get('password')) > 0) {
                $data['password'] = Input::get('password');
                $data['password_confirmation'] = Input::get('password_confirmation');

                $rules['password'] = 'required|confirmed';
                $rules['password_confirmation'] = 'required';
            }

            $v = \Validator::make($data, $rules);

            if ($v->fails()) {
                Session::flash('error_msg', Utils::messages($v));
                return redirect()->back()->withInput(Input::except('avatar'));
            }

            $user = Users::where('id', Input::get('id'))->first();

            $user->name = Input::get('name');
            $user->email = Input::get('email');

            if (strlen(Input::get('password')) > 0) {
                $user->password = \Hash::make(Input::get('password'));
            }

            $user->avatar = Input::hasFile('avatar') ? Utils::imageUpload(Input::file('avatar')) : Input::get('old_avatar');
            $user->birthday = Input::get('dob');
            $user->bio = Input::get('bio');
            $user->gender = Input::get('gender');
            $user->mobile_no = Input::get('mobile_no');
            $user->fb_url = Input::get('fb_url');
            $user->fb_page_url = Input::get('fb_page_url');
            $user->website_url = Input::get('website_url');
            $user->twitter_url = Input::get('twitter_url');
            $user->google_plus_url = Input::get('google_plus_url');
            $user->country = Input::get('country');
            $user->activated = Input::has('activate');



            $user->save();


            $type = Input::get('type', 1);



            Session::flash('success_msg', trans('messages.user_updated_success'));
            return redirect()->to('/customer/profile');
        }

    }





}
