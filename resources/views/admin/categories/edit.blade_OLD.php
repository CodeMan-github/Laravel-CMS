@extends('admin.layouts.master')

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
                <a href="/admin/categories/edit/{{$category->id}}">{{trans('messages.update_category')}}
                    - {{$category->title}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.edit_category')}} - {{$category->title}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/categories/update" id="form-username" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="id" value="{{$category->id}}"/>

                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">{{trans('messages.title')}}</label>

                            <div class="col-sm-8">
                                <input id="title" class="form-control" type="text" name="title"
                                       placeholder="{{trans('messages.enter_category_title')}}"
                                       value="{{old('title',$category->title)}}"/>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$category->show_in_menu==1?'checked':''}} name="show_in_menu"
                                           type="checkbox"> {{trans('messages.show_category_in_menu')}} </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$category->show_in_sidebar==1?'checked':''}} name="show_in_sidebar"
                                           type="checkbox"> {{trans('messages.show_category_in_sidebar')}} </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$category->show_in_footer==1?'checked':''}} name="show_in_footer"
                                           type="checkbox"> {{trans('messages.show_category_in_footer')}} </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$category->show_as_mega_menu==1?'checked':''}} name="show_as_mega_menu"
                                           type="checkbox"> {{trans('messages.show_as_mega_menu')}} </label>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input {{$category->show_on_home==1?'checked':''}} name="show_on_home"
                                           type="checkbox"> {{trans('messages.show_on_home')}}
                                </label>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="seo_keywords"
                                   class="col-sm-3 control-label">{{trans('messages.seo_keywords')}}</label>

                            <div class="col-sm-8">
                                <textarea id="seo_keywords" class="form-control" name="seo_keywords"
                                          placeholder="{{trans('messages.enter_seo_keywords')}}">{{old('seo_keywords',$category->seo_keywords)}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_description"
                                   class="col-sm-3 control-label">{{trans('messages.seo_description')}}</label>

                            <div class="col-sm-8">
                                <textarea id="seo_description" class="form-control" name="seo_description"
                                          placeholder="{{trans('messages.enter_seo_description')}}">{{old('seo_description',$category->seo_description)}}</textarea>
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