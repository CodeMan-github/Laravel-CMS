@extends('admin.layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="/assets/plugins/redactor/redactor.css"/>
@stop

@section('extra_js')
    <script src="/assets/plugins/redactor/plugins/imagemanager.js"></script>
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
        {{trans('messages.cron_jobs_section')}}
        <small>{{trans('messages.manage_cron_jobs')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/crons">{{trans('messages.cron_jobs_section')}}</a>
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
                        <i class="fa fa-cubes"></i>{{trans('messages.view_cron')}}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="container">
                        {!! $cron->what !!}
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@stop