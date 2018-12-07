@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" type="text/css"
          href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>

@stop

@section('extra_js')
    <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{trans('messages.users')}}
        <small>{{trans('messages.manage_users')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/users">{{trans('messages.users')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/users/create">{{trans('messages.create')}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.create_new_user')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">


                    <form action="/admin/users/create" enctype="multipart/form-data" method="post"
                          class="form-horizontal form-bordered">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>

                            <div class="col-sm-4">
                                @include('admin.layouts.notify')
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">{{trans('messages.name')}}</label>

                            <div class="col-sm-8">
                                <input id="name" class="form-control" type="text" name="name"
                                       placeholder="{{trans('messages.name')}}" value="{{old('name')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">{{trans('messages.email')}}</label>

                            <div class="col-sm-8">
                                <input id="email" class="form-control" type="email" name="email"
                                       placeholder="{{trans('messages.enter_email')}}" value="{{old('email')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">{{trans('messages.password')}}</label>

                            <div class="col-sm-8">
                                <input id="password" class="form-control" type="password" name="password"
                                       placeholder="{{trans('messages.enter_password')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="col-sm-3 control-label">{{trans('messages.confirm_password')}}</label>

                            <div class="col-sm-8">
                                <input id="password_confirmation" class="form-control" type="password"
                                       name="password_confirmation"
                                       placeholder="{{trans('messages.confirm_password')}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-sm-3 control-label">{{trans('messages.avatar')}}</label>

                            <div class="col-sm-8">
                                <input id="avatar" class="form-control" type="file" name="avatar"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dob" class="col-sm-3 control-label">{{trans('messages.date_of_birth')}}</label>

                            <div class="col-sm-8">
                                <input id="dob" class="form-control date-picker" type="text" name="dob"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio" class="col-sm-3 control-label">{{trans('messages.bio')}}</label>

                            <div class="col-sm-8">
                                <textarea id="bio" class="form-control" name="bio"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-sm-3 control-label">{{trans('messages.gender')}}</label>

                            <div class="col-sm-8">
                                <select id="gender" class="form-control" name="gender">
                                    <option value="{{\App\Users::GENDER_MALE}}">{{trans('messages.male')}}</option>
                                    <option value="{{\App\Users::GENDER_FEMALE}}">{{trans('messages.female')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_no"
                                   class="col-sm-3 control-label">{{trans('messages.mobile_no')}}</label>

                            <div class="col-sm-8">
                                <input id="mobile_no" class="form-control" type="text" name="mobile_no"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fb_url"
                                   class="col-sm-3 control-label">{{trans('messages.facebook_url')}}</label>

                            <div class="col-sm-8">
                                <input id="fb_url" class="form-control" type="text" name="fb_url"
                                       placeholder="{{trans('messages.enter_facebook_url')}}"
                                       value="{{old('fb_url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fb_page_url"
                                   class="col-sm-3 control-label">{{trans('messages.facebook_page_url')}}</label>

                            <div class="col-sm-8">
                                <input id="fb_page_url" class="form-control" type="text" name="fb_page_url"
                                       placeholder="{{trans('messages.enter_facebook_page_url')}}"
                                       value="{{old('fb_page_url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="website_url"
                                   class="col-sm-3 control-label">{{trans('messages.website_url')}}</label>

                            <div class="col-sm-8">
                                <input id="website_url" class="form-control" type="text" name="website_url"
                                       placeholder="{{trans('messages.website_url')}}" value="{{old('website_url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="twitter_url"
                                   class="col-sm-3 control-label">{{trans('messages.twitter_url')}}</label>

                            <div class="col-sm-8">
                                <input id="twitter_url" class="form-control" type="text" name="twitter_url"
                                       placeholder="{{trans('messages.enter_twitter_url')}}"
                                       value="{{old('twitter_url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="google_plus_url"
                                   class="col-sm-3 control-label">{{trans('messages.google_plus_url')}}</label>

                            <div class="col-sm-8">
                                <input id="google_plus_url" class="form-control" type="text" name="google_plus_url"
                                       placeholder="{{trans('messages.enter_google_plus_url')}}"
                                       value="{{old('google_plus_url')}}"/>
                                <span class="help-block"> {{trans('messages.url_should_start_with_etc')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country" class="col-sm-3 control-label">{{trans('messages.country')}}</label>

                            <div class="col-sm-8">
                                <select id="country" name="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-sm-3 control-label">{{trans('messages.type')}}</label>

                            <div class="col-sm-8">
                                <select id="type" class="form-control" name="type">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{ucfirst($group->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-offset-3 col-md-8">
                                <label>
                                    <input name="activate" type="checkbox"> {{trans('messages.activate')}} </label>
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