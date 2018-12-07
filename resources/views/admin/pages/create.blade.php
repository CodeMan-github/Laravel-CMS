@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script src="/assets/plugins/redactor/plugins/imagemanager.js" data-cfasync='false'></script>
    <script src="/assets/plugins/redactor/redactor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#description').redactor({
                imageUpload: '/admin/redactor',
                imageManagerJson: '/admin/redactor/images.json',
                plugins: ['imagemanager'],
                replaceDivs: false,
                convertDivs: false,
                uploadImageFields: {
                    _token: "{{csrf_token()}}"
                }
            });
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{trans('messages.pages')}}
        <small>{{trans('messages.manage_pages')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <a href="/admin/pages">{{trans('messages.pages')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>

            <li>
                <a href="/admin/pages/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-docs"></i>{{trans('messages.create_new_page')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/pages/create" id="form-username" method="post"
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
                                       placeholder="{{trans('messages.enter_title')}}" value="{{old('title')}}"/>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-4">
                                <label>
                                    <input name="show_in_sidebar"
                                           type="checkbox"> {{trans('messages.show_page_in_sidebar')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-4">
                                <label>
                                    <input name="show_in_footer"
                                           type="checkbox"> {{trans('messages.show_page_in_footer')}}
                                </label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="description"
                                   class="col-sm-3 control-label">{{trans('messages.description')}}</label>

                            <div class="col-sm-8">
                                <textarea id="description" class="form-control" name="description"
                                          placeholder="{{trans('messages.enter_description')}}">{{old('description')}}</textarea>
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
                            <label for="author" class="col-sm-3 control-label">{{trans('messages.posted_by')}}</label>

                            <div class="col-sm-8">
                                <select id="author" class="form-control" name="author">
                                    @foreach($admins as $admin)
                                        <option value="{{$admin->id}}"
                                                class="label label-info">{{$admin->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">{{trans('messages.status')}}</label>

                            <div class="col-sm-8">
                                <select id="status" class="form-control" name="status">
                                    <option value="{{\App\Posts::STATUS_PUBLISHED}}">{{trans('messages.published')}}</option>
                                    <option value="{{\App\Posts::STATUS_HIDDEN}}">{{trans('messages.hidden')}}</option>
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