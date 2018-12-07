@extends('admin.layouts.master')

@section('extra_js')
    <script>
        (function(w,d,s,g,js,fs){
            g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
            js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
            js.src='https://apis.google.com/js/platform.js';
            fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
        }(window,document,'script'));
    </script>



    <script>

        gapi.analytics.ready(function() {

            /**
             * Authorize the user immediately if the user has already granted access.
             * If no access has been created, render an authorize button inside the
             * element with the ID "embed-api-auth-container".
             */
            gapi.analytics.auth.authorize({
                container: 'embed-api-auth-container',
                clientid: '{{env('GOOGLE_ANALYTICS_CLIENT_ID')}}'
            });


            /**
             * Create a ViewSelector for the first view to be rendered inside of an
             * element with the id "view-selector-1-container".
             */
            var viewSelector1 = new gapi.analytics.ViewSelector({
                container: 'view-selector-1-container'
            });

            /**
             * Create a ViewSelector for the second view to be rendered inside of an
             * element with the id "view-selector-2-container".
             */
            var viewSelector2 = new gapi.analytics.ViewSelector({
                container: 'view-selector-2-container'
            });

            // Render both view selectors to the page.
            viewSelector1.execute();
            viewSelector2.execute();


            /**
             * Create the first DataChart for top countries over the past 30 days.
             * It will be rendered inside an element with the id "chart-1-container".
             */
            var dataChart1 = new gapi.analytics.googleCharts.DataChart({
                query: {
                    metrics: 'ga:sessions',
                    dimensions: 'ga:country',
                    'start-date': '30daysAgo',
                    'end-date': 'yesterday',
                    'max-results': 6,
                    sort: '-ga:sessions'
                },
                chart: {
                    container: 'chart-1-container',
                    type: 'PIE',
                    options: {
                        width: '100%'
                    }
                }
            });


            /**
             * Create the second DataChart for top countries over the past 30 days.
             * It will be rendered inside an element with the id "chart-2-container".
             */
            var dataChart2 = new gapi.analytics.googleCharts.DataChart({
                query: {
                    metrics: 'ga:pageviews',
                    dimensions: 'ga:date',
                    'start-date': '7daysAgo',
                    'end-date': 'yesterday'
                },
                chart: {
                    container: 'chart-2-container',
                    type: 'LINE',
                    options: {
                        width: '100%'
                    }
                }
            });

            /**
             * Update the first dataChart when the first view selecter is changed.
             */
            viewSelector1.on('change', function(ids) {
                dataChart1.set({query: {ids: ids}}).execute();
            });

            /**
             * Update the second dataChart when the second view selecter is changed.
             */
            viewSelector2.on('change', function(ids) {
                dataChart2.set({query: {ids: ids}}).execute();
            });

        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{trans('messages.statistics')}} <small>{{trans('messages.check_statistics_analytics')}}</small>
    </h3>

    <div class="page-bar">
        <ul class="page-breadcrumb">

            <li>
                <a href="/admin">{{trans('messages.home')}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/admin/statistics">{{trans('messages.statistics')}}</a>
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
                        <i class="icon-puzzle"></i>{{trans('messages.all_statistics')}}
                    </div>

                </div>

                <div class="portlet-body" style="min-height: 800px;">

                    <div id="embed-api-auth-container"></div>

                    <div class="col-md-6">
                        <div id="chart-1-container"></div>
                        <div id="view-selector-1-container"></div>
                    </div>

                    <div class="col-md-6">
                        <div id="chart-2-container"></div>
                        <div id="view-selector-2-container"></div>
                    </div>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@stop