<?php

namespace App\Console\Commands;

use App\Categories;
use App\CronJobs;
use App\Groups;
use App\Libraries\Parser;
use App\Libraries\Utils;
use App\Posts;
use App\PostTags;
use App\Sources;
use App\SubCategories;
use App\Tags;
use App\Users;
use App\UsersGroups;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Intervention\Image;

class UpdateSources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-sources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sources';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Update Sources here



        $sources = Sources::all();

        $what = "";

        $result = 1;

        $cron_started_on = Carbon::now();

        $what .= "<h2>Cron Job Started On " . $cron_started_on . " </h2> <br>";
        $what .= "<h4>Sources to update (" . sizeof($sources) . ") </h4> <br><br>";

        foreach ($sources as $index => $source) {

            $new_count = 0;
            $updated_count = 0;

            $what .= ($index + 1) . ". Updating source " . $source->title . "(" . $source->url . ") <br><br>";

            $url = $source->url;

            try {
                $feed = Parser::xml($url);
            } catch (\Exception $e) {
                $result = 0;
                $what .= "<label class='label label-warning'> Unable to fetch data from source reason below  </label> <br><br>";
                $what .= "<div class='well'> " . $e->getMessage() . "  </div> <br><br>";
            }


            $source->channel_language = isset($feed['channel']['language']) ? $feed['channel']['language'] : '';
            $source->channel_pubDate = isset($feed['channel']['pubDate']) ? $feed['channel']['pubDate'] : '';
            $source->channel_lastBuildDate = isset($feed['channel']['lastBuildDate']) ? $feed['channel']['lastBuildDate'] : '';
            $source->channel_generator = isset($feed['channel']['generator']) ? $feed['channel']['generator'] : '';
            $source->items_count = isset($feed['channel']['item']) ? $source->items_count + sizeof($feed['channel']['item']) : $source->items_count;
            $source->save();

            if (isset($feed['channel']['item']) && $source->auto_update == 1) {



                //Posts::where('source_id', $source->id)->delete();

                foreach ($feed['channel']['item'] as $item) {

                    if (!is_null($item['title']) && !is_null($item['description']) && !is_null($item['pubDate']) && !is_null($item['link'])) {


                        if (sizeof(Posts::where('slug', Str::slug($item['title']))->get()) <= 0) {


                            if ($source->fetch_full_text == 1) {
                                $item['description'] = Parser::fetchFull($item['link'], $item['description']);
                            }

                            if ($source->use_auto_spin == 1) {
                                $arr = Parser::spin($item['title'], $item['description']);
                                //$item['title'] = $arr['title'];
                                $item['description'] = $arr['description'];
                            }

                            $new_count += 1;

						if(is_array($item['description'])){
							$item['description'] = "";
						}


                            list($item['render_type'], $item['featured_image']) = Parser::setImgAndRenderType($item['description'], $item['video_embed_code'], $item['featured_image']);

                            $user_group = Groups::where('name', Users::TYPE_ADMIN)->first();

                            $find_id = UsersGroups::where('group_id', $user_group->id)->pluck('user_id');

                            $first_admin = Users::where('id', $find_id)->first();


                            $post_item = new Posts();
                            $post_item->author_id = $first_admin->id;
                            $post_item->title = $item['title'];
                            $post_item->save();

                            $post_item->slug = (is_null(Str::slug($item['title'])) || empty(Str::slug($item['title']))) ? $post_item->id : Str::slug($item['title']);

                            $post_item->link = $item['link'];
                            $post_item->category_id = $source->category_id;
                            $post_item->featured = 0;
                            $post_item->type = Posts::TYPE_SOURCE;
                            $post_item->render_type = $item['render_type'];
                            $post_item->source_id = $source->id;
                            $post_item->description = is_array($item['description'])?'':$item['description'];
                            $post_item->featured_image = $item['featured_image'];
                            $post_item->video_embed_code = $item['video_embed_code'];
                            $post_item->dont_show_author_publisher = $source->dont_show_author_publisher;
                            $post_item->show_post_source = $source->show_post_source;
                            $post_item->show_author_box = $source->dont_show_author_publisher == 1 ? 0 : 1;
                            $post_item->show_author_socials = $source->dont_show_author_publisher == 1 ? 0 : 1;
                            $post_item->rating_box = 0;
                            $post_item->created_at = $item['pubDate'];
                            $post_item->views = 1;
                            $post_item->save();


                            if (isset($item['categories'])) {
                                $this->createTags($item['categories'], $post_item->id);
                            }


                        } else {

                            $exists_post = Posts::where('slug', Str::slug($item['title']))->first();

                            if ($source->fetch_full_text == 1) {
                                $item['description'] = Parser::fetchFull($item['link'], $item['description']);
                            }

                            if ($source->use_auto_spin == 1) {
                                $arr = Parser::spin($item['title'], $item['description']);
                                $item['title'] = $arr['title'];
                                $item['description'] = $arr['description'];
                            }

							if(is_array($item['description'])){
							$item['description'] = "";
						}
						
						if(is_array($item['title'])){
							$item['title'] = "";
						}


                            $updated_count += 1;
                            $exists_post->render_type = $item['render_type'];
                            $exists_post->link = $item['link'];
                            $exists_post->description = $item['description'];
                            $exists_post->video_embed_code = $item['video_embed_code'];
                            $exists_post->featured_image = $item['featured_image'];
                            $exists_post->save();


                            if (isset($item['categories'])) {
                                $this->createTags($item['categories'], $exists_post->id);
                            }
                        }


                    }
                }

//                \DB::statement("UPDATE posts SET show_in_mega_menu = 1 WHERE category_id = ".$source->category_id."
//                AND CHAR_LENGTH(featured_image) > 1 ORDER BY RAND() LIMIT 4");
//
//                //Reset featured posts
//                Posts::where('featured', 1)->update(['featured' => 0]);
//
//                //Set new featured posts
//                \DB::statement("UPDATE posts SET featured = 1 WHERE render_type = 'image' OR render_type = 'video'  ORDER BY RAND() LIMIT 6");
//

            } else {
                $what .= "Source not set to auto update so skipping  " . $source->title . "  <br><br>";
            }

            $what .= "Posts ----- NEW : " . $new_count . "     UPDATED : " . $updated_count . " <br>";

            $what .= "<hr>";
        }

        $old_news = Utils::getSettings('old_news');
        $delete_count = 0;

        if ($old_news->auto_update == 1) {
            $posts = Posts::all();

            foreach ($posts as $post) {

                $created_at = $post->created_at;
                $now = Carbon::now();

                if ($now->diffInDays($created_at) >= $old_news->days) {
                    $post->delete();
                    $delete_count++;
                }
            }

            $what .= "Old News is Set to Delete which are " . $old_news->days . " days old : Deleted :" . $delete_count . " Posts which matched the settings <br><br>";
        }

        $cron_completed_on = Carbon::now();

        $what .= "<h2>Finalizing Cron job  </h2> <br><br>";

        $posts = Posts::all();

        foreach ($posts as $post) {
            if ($post->type == Posts::TYPE_SOURCE && sizeof(SubCategories::where('id', $post->category_id)->get()) <= 0) {
                $post->delete();
            } else {

                $sub = SubCategories::where('id', $post->category_id)->first();

                if (sizeof(Categories::where('id', $sub->parent_id)->get()) <= 0) {
                    $post->delete();
                }

            }
        }

        $what .= "<h2>Cron Job Completed On " . $cron_completed_on . " </h2> <br><br>";

        $cron = new CronJobs();
        $cron->cron_started_on = $cron_started_on;
        $cron->cron_completed_on = $cron_completed_on;
        $cron->what = $what;
        $cron->result = $result;
        $cron->save();


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
}
