@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script type="text/javascript" src="/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/plugins/redactor/plugins/imagemanager.js" data-cfasync='false'></script>
    <script src="/assets/plugins/redactor/redactor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $i=1;

            $('#add_item').on('click',function(event){
                $("#description_container").append(' <div class="form-group">'+
                        ' <label class="col-sm-3 control-label">{{trans('messages.description')}}</label>'+

                        '<div class="col-sm-8">'+
                        '<textarea  class="form-control description'+$i+'"  name="description[]"></textarea>'+
                        '</div>'+
                        '</div>');

                $('.description'+$i+'').redactor({
                    imageUpload: '/admin/redactor',
                    imageManagerJson: '/admin/redactor/images.json',
                    plugins: ['imagemanager'],
                    replaceDivs: true,
                    convertDivs: true,
                    uploadImageFields: {
                        _token: "{{csrf_token()}}"
                    }
                });

                event.preventDefault();
                $i=$i+1;
            });

            $('#tags').tagsinput();

            $('.description').redactor({
                        imageUpload: '/admin/redactor',
                        imageManagerJson: '/admin/redactor/images.json',
                        plugins: ['imagemanager'],
                        replaceDivs: false,
                        convertDivs: false,
                        uploadImageFields: {
                            _token: "{{csrf_token()}}"
                        }
                    }
            );

            var category_el = $('#category');
            var render_type_el = $('#render_type');

            category_el.on('change', function () {
                $.ajax({
                    url: "/admin/api/get_sub_categories_by_category/" + $('#category').val(),
                    success: function (sub_categories) {

                        var $sub_category_select = $('#sub_category');
                        $sub_category_select.find('option').remove();

                        $.each(sub_categories, function (key, value) {
                            $sub_category_select.append('<option value=' + value['id'] + '>' + value['title'] + '</option>');
                        });
                    },
                    error: function (response) {
                    }
                });
            });

            render_type_el.on('change', function (ev) {
                var val = $(this).find('option:selected').val();

                if (val == "{{\App\Posts::RENDER_TYPE_TEXT}}") {
                    $('#featured_image_div').hide();
                    $('#image_parallax_div').hide();

                    $('#gallery_image_div').hide();
                    $('#featured_preview_div').hide();
                    $('#video_div').hide();
                    $('#video_parallax_div').hide();
                }

                if (val == "{{\App\Posts::RENDER_TYPE_IMAGE}}") {
                    $('#featured_image_div').show();
                    $('#image_parallax_div').show();

                    $('#gallery_image_div').hide();
                    $('#video_div').hide();
                    $('#video_parallax_div').hide();
                }

                if (val == "{{\App\Posts::RENDER_TYPE_GALLERY}}") {
                    $('#gallery_image_div').show();

                    $('#featured_image_div').hide();
                    $('#featured_preview_div').hide();
                    $('#image_parallax_div').hide();
                    $('#video_div').hide();
                    $('#video_parallax_div').hide();
                }

                if (val == "{{\App\Posts::RENDER_TYPE_VIDEO}}") {
                    $('#video_div').show();
                    $('#video_parallax_div').show();
                    $('#featured_preview_div').show();
                    $('#featured_image_div').show();

                    $('#gallery_image_div').hide();
                    $('#image_parallax_div').hide();
                }

            });


            //category_el.trigger('change');
            render_type_el.trigger('change');

        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Lists
        <small>Manage Lists</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/lists">Lists</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/lists/edit/{{$post->id}}">Edit List - {{$post->title}}</a>
            </li>

        </ul>
    </div>

    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet box green-meadow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-docs"></i>Edit List - {{$post->title}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/lists/update" id="form-username" method="post"
                          class="form-horizontal form-bordered" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="id" value="{{$post->id}}"/>


                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">{{trans('messages.title')}}</label>

                            <div class="col-sm-8">
                                <input id="title" class="form-control" type="text" name="title"
                                       placeholder="{{trans('messages.enter_post_title')}}"
                                       value="{{old('title',$post->title)}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-sm-3 control-label">{{trans('messages.category')}}</label>

                            <div class="col-sm-8">
                                <select name="category" id="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option {{$post->parent_category->id == $category->id ? 'checked':''}}
                                                value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sub_category"
                                   class="col-sm-3 control-label">{{trans('messages.sub_category')}}</label>

                            <div class="col-sm-8">
                                <select id="sub_category" name="sub_category" class="form-control">
                                    @foreach($sub_categories as $sub)
                                        <option {{$post->category->id == $sub->id ? 'selected':''}} value="{{$sub->id}}">{{$sub->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="featured_image_div">
                            <label for="featured_image"
                                   class="col-sm-3 control-label">{{trans('messages.featured_image')}}</label>

                            <div class="col-sm-8">
                                <input id="featured_image" class="form-control" type="file" name="featured_image"/>
                            </div>
                        </div>

                        @if(strlen($post->featured_image) >0 && $post->render_type != App\Posts::RENDER_TYPE_GALLERY)
                            <div class="form-group" id="featured_preview_div">
                                <label class="col-sm-3 control-label"></label>

                                <div class="col-sm-8">
                                    <a target="_blank" href="{{$post->featured_image}}"><img
                                                src="{{$post->featured_image}}" style="width:200px;"/></a>
                                </div>
                            </div>
                        @endif




                        <div id="description_container">
                            @foreach($lists_description as $list_description)
                            <div class="form-group">
                                <label
                                        class="col-sm-3 control-label">{{trans('messages.description')}}</label>

                                <div class="col-sm-8">
                                    <textarea   class="form-control description" name="description[]">{{$list_description}}</textarea>
                                </div>
                            </div>
                                @endforeach
                        </div>

                        <div class="form-group">
                            <label for=""
                                   class="col-sm-3 control-label">Add Item</label>

                            <div class="col-sm-8">


                                <a id="add_item" class="btn red">
                                    <i class="fa fa-plus"></i> Add Item </a>

                            </div>
                        </div>

                        <div class="form-group">

                            <label for="tags" class="col-sm-3 control-label">{{trans('messages.select_tags')}}</label>

                            <div class="col-sm-8">
                                <input type="text" id="tags" name="tags" multiple value="{{implode(',',$post->tags)}}"/>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$post->featured == 1?"checked":""}} name="featured" type="checkbox">
                                    {{trans('messages.featured')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="rating_box"
                                   class="col-sm-3 control-label">{{trans('messages.rating_box')}}</label>

                            <div class="col-sm-8">
                                <select id="rating_box" class="form-control" name="rating_box">
                                    <option {{$post->rating_box == 0 ? 'selected':''}} value="0">{{trans('messages.no_rating_box')}}</option>
                                    <option {{$post->rating_box == 1 ? 'selected':''}} value="1">{{trans('messages.add_5_star_rating')}}</option>
                                    <option {{$post->rating_box == 2 ? 'selected':''}} value="2">{{trans('messages.yes_like_dislike')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rating_desc"
                                   class="col-sm-3 control-label">{{trans('messages.rating_desc')}}</label>

                            <div class="col-sm-8">
                                <textarea id="rating_desc" class="form-control" name="rating_desc" placeholder="{{trans('messages.rating_holder')}}">{{$post->rating_desc}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$post->show_in_mega_menu == 1?"checked":""}} name="show_in_mega_menu"
                                           type="checkbox"> {{trans('messages.show_in_mega_menu')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$post->show_featured_image_in_post == 1?"checked":""}} name="show_featured_image_in_post"
                                           type="checkbox"> {{trans('messages.show_featured_image_above_desc')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$post->show_author_box == 1?"checked":""}} name="show_author_box"
                                           type="checkbox"> {{trans('messages.show_author_box')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$post->show_author_socials == 1?"checked":""}} name="show_author_socials"
                                           type="checkbox"> {{trans('messages.show_author_social_links')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"> </label>

                            <div class="col-sm-8">
                                <label>
                                    <input {{$post->dont_show_author_publisher == 1?"checked":""}} name="dont_show_author_publisher"
                                           id="dont_show_author_publisher"
                                           type="checkbox"> {{trans('messages.dont_show_author_publisher')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label"> </label>

                            <div class="col-sm-8">
                                <label>
                                    <input {{$post->show_post_source == 1?"checked":""}} name="show_post_source"
                                           id="show_post_source"
                                           type="checkbox"> {{trans('messages.show_source_in_credits')}} </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="author" class="col-sm-3 control-label">{{trans('messages.posted_by')}}</label>

                            <div class="col-sm-8">
                                <select id="author" class="form-control" name="author">
                                    @foreach($admins as $admin)
                                        <option {{$post->author_id == $admin->id ? 'selected':''}} value="{{$admin->id}}"
                                                class="label label-info">{{$admin->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">{{trans('messages.status')}}</label>

                            <div class="col-sm-8">
                                <select id="status" class="form-control" name="status">
                                    <option {{$post->status == \App\Posts::STATUS_PUBLISHED?'selected':''}}
                                            value="{{\App\Posts::STATUS_PUBLISHED}}">{{trans('messages.published')}}
                                    </option>
                                    <option {{$post->status == \App\Posts::STATUS_HIDDEN?'selected':''}}
                                            value="{{\App\Posts::STATUS_HIDDEN}}">{{trans('messages.hidden')}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple"><i
                                                class="fa fa-check"></i> {{trans('messages.save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop