@extends('admin.layouts.master')
@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script src="/assets/plugins/redactor/plugins/imagemanager.js" data-cfasync='false'></script>
    <script src="/assets/plugins/redactor/redactor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#splash_page_content').redactor({
                imageUpload: '/admin/redactor',
                imageManagerJson: '/admin/redactor/images.json',
                plugins: ['imagemanager'],
                replaceDivs: false,
                convertDivs: false,
                uploadImageFields: {
                    _token: "{{csrf_token()}}"
                }
            });
			redirect_type = "{{old('redirect_type')}}";
			if(redirect_type != "" && redirect_type != null){
				$("#redirect_type").val(redirect_type);
			}
			RedirectionTypeChange();
			$("#redirect_type").change(function(){
				RedirectionTypeChange();
			});
			function RedirectionTypeChange(){
				if($("#redirect_type").val() == 'Default'){
					$("#redirect_url_div").hide();
					$("#splash_page_content_div").hide();
				}
				else if($("#redirect_type").val() == 'Link'){
					$("#redirect_url_div").show();
					$("#splash_page_content_div").hide();
				}
				else if($("#redirect_type").val() == 'Splash Page'){
					$("#redirect_url_div").show();
					$("#splash_page_content_div").show();
				}
			}
        });
    </script>
@stop
@section('content')

    <h3 class="page-title">
        {{trans('messages.categories')}}
        <small>{{trans('messages.manage_categories')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/categories">{{trans('messages.categories')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/categories/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.create_new_category')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/categories/create" id="form-username" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">{{trans('messages.title')}}</label>

                            <div class="col-sm-8">
                                <input id="title" class="form-control" type="text" name="title"
                                       placeholder="{{trans('messages.enter_category_title')}}"
                                       value="{{old('title')}}"/>
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="show_in_menu"
                                           type="checkbox"> {{trans('messages.show_category_in_menu')}}
                                </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="show_in_sidebar"
                                           type="checkbox"> {{trans('messages.show_category_in_sidebar')}}
                                </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="show_in_footer"
                                           type="checkbox"> {{trans('messages.show_category_in_footer')}}
                                </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="show_as_mega_menu"
                                           type="checkbox"> {{trans('messages.show_as_mega_menu')}}
                                </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="show_on_home"
                                           type="checkbox"> {{trans('messages.show_on_home')}}
                                </label>

                            </div>

                        </div>


                        <div class="form-group">
                            <label for="seo_keywords"
                                   class="col-sm-3 control-label">{{trans('messages.seo_keywords')}}</label>

                            <div class="col-sm-8">
                                <textarea id="seo_keywords" class="form-control" name="seo_keywords"
                                          placeholder="{{trans('messages.enter_seo_keywords')}}">{{old('seo_keywords')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_description"
                                   class="col-sm-3 control-label">{{trans('messages.seo_description')}}</label>

                            <div class="col-sm-8">
                                <textarea id="seo_description" class="form-control" name="seo_description"
                                          placeholder="{{trans('messages.enter_seo_description')}}">{{old('seo_description')}}</textarea>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="redirect_type"
                                   class="col-sm-3 control-label">{{trans('messages.redirect_type')}}</label>

                            <div class="col-sm-8">
                                <select id="redirect_type" class="form-control" name="redirect_type">
                                    <option value="{{trans('messages.default')}}">{{trans('messages.default')}}</option>             
                                    <option value="{{trans('messages.link')}}">{{trans('messages.link')}}</option>             
                                    <option value="{{trans('messages.splash')}}">{{trans('messages.splash')}}</option>             
                                </select>
                            </div>
                        </div>
						<div class="form-group" id="redirect_url_div">
                            <label for="redirect_url"
                                   class="col-sm-3 control-label">{{trans('messages.redirect_url')}}</label>

                            <div class="col-sm-8">
                                <textarea id="redirect_url" class="form-control" name="redirect_url"
                                          placeholder="{{trans('messages.enter_redirect_url')}}">{{old('redirect_url')}}</textarea>
                            </div>
                        </div>
						<div class="form-group" id="splash_page_content_div">
                            <label for="splash_page_content"
                                   class="col-sm-3 control-label">{{trans('messages.splash_page_content')}}</label>

                            <div class="col-sm-8">
                                <textarea id="splash_page_content" class="form-control" name="splash_page_content"
                                          placeholder="{{trans('messages.enter_splash_page_content')}}">{{old('splash_page_content')}}</textarea>
                            </div>
                        </div>
						

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn purple"><i
                                                class="fa fa-check"></i> {{trans('messages.save')}} </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop