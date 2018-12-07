<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>{{trans('messages.rss_agg_change_password')}}</title>

    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link href="/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
<div class="wrapper">
    <div class="block-center mt-xl wd-xl">
        <!-- START panel-->
        <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
                <a href="/">
                    <img src="/assets/img/logo.png" alt="Image" class="block-center">
                </a>
            </div>
            <div class="panel-body">
                <p class="text-center pv">{{strtoupper(trans('messages.rss_agg_change_password'))}}</p>

                @include('admin.layouts.notify')

                <form role="form" action="/reset_password" method="POST" class="mb-lg">

                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="email" value="{{$email}}"/>
                    <input type="hidden" name="code" value="{{$code}}"/>

                    <div class="form-group has-feedback">
                        <input type="password" name="password" placeholder="{{trans('messages.enter_new_password')}}" autocomplete="off"
                               required class="form-control">
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation" placeholder="{{trans('messages.confirm_new_password')}}" autocomplete="off"
                               required class="form-control">
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary mt-lg">{{trans('messages.change_password')}}</button>
                </form>
            </div>
        </div>
        <!-- END panel-->
        <div class="p-lg text-center">
            <span>&copy;</span>
            <span>{{trans('messages.year')}}</span>
            <span>-</span>
            <span>{{trans('messages.rss_aggregator')}}</span>
        </div>
    </div>
</div>
</body>

</html>