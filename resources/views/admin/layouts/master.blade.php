<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Viral Web Admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="/assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    @yield('extra_css')

    <link rel="shortcut icon" href="/assets/img/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

@include('admin.layouts.header')

<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    @include('admin.layouts.navigation')

            <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @yield('content')
        </div>
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('admin.layouts.footer')
        <!-- END FOOTER -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>
<script src="/assets/plugins/respond.min.js"></script>
<script src="/assets/plugins/excanvas.min.js"></script>
<![endif]-->

<script src="/assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

@yield('extra_js')

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/js/app.js" type="text/javascript"></script>
<script src="/assets/js/layout.js" type="text/javascript"></script>
<script src="/assets/js/custom.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
    });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>