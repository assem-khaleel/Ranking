@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 4/4/19
     * Time: 12:12 PM
     */
$dir = $currentLanguage->locale == 'en' ? 'ltr' : 'rtl';

@endphp
@extends('layouts.app')

@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('profiles.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('home.program',$programId)}}">{{trans('program.detailedProgramProgress')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div id="box">
            <div class="scroller scroller-left"><i class="fa fa-chevron-left fa-2x"></i></div>
            <div class="scroller scroller-right"><i class="fa fa-chevron-right fa-2x"></i></div>
            <div class="wrapper">
                <div class="list">
                    @for($i=date('Y'); $i>=2000; $i--)
                        <a href="{{route('home.program',$programId.'/'.$i)}}"
                           class="item {{ isset($year) && $i == $year ? 'active' : '' }}">{{$i}}</a>
                    @endfor
                </div>
            </div>
        </div>
        &nbsp;
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->

            @foreach($rankingSystems as $rankingSystem)
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-t-10 p-b-10">
                                <!-- Column -->
                                <div class="col p-r-0">
                                    <span class="text-sm">{{$rankingSystem->name }}</span>
                                </div>
                                <div class="col m-r-40">
                                    <div class="chart easy-pie-chart-1" data-percent="{{$totalSystem[$rankingSystem->id]}}"> <span class="percent">{{$totalSystem[$rankingSystem->id]}}</span> <canvas height="100" width="100"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- column -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-t-40">

                                @for($i = 1; $i <= 12; $i++)

                                    <div class="col-lg-2 col-md-6 m-b-30 text-center show-system"  id="show-system"
                                         data-system-id="{{ $rankingSystem->id }}" data-year="{{$year}}"
                                         data-month="{{$i}}" data-program-id="{{$programId}}"><span class="donut"
                                                                                                    data-peity='{ "fill": ["#26c6da", "#f2f2f2"], "innerRadius": 20, "radius": 32 }'>{{$results[$rankingSystem->id][$i]}}/100</span>
                                        <div><small>{{trans('program.progress')}} : {{$results[$rankingSystem->id][$i]}}</small></div>
                                        <div class="text-dark">{{trans('months.'.DateTime::createFromFormat('!m', $i)->format('F'))}}</div>
                                    </div>
                                @endfor

                            </div>
                        </div>
                    </div>
                </div>
                <!-- column -->
            @endforeach
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @push('head')
        <link href="{{asset('plugins/css-chart/css-chart.css')}}" rel="stylesheet">
        <link href="{{asset('css/timeline/timeline-'.$dir.'.css')}}" rel="stylesheet" type="text/css"/>

    @endpush
    @push('script')
        <script src="{{asset('plugins/peity/jquery.peity.min.js')}}"></script>
        <script src="{{asset('plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('js/timeline/timeline-'.$dir.'.js')}}"></script>

        <script>

            $("span.donut").peity("donut",{
                width: 50,
                height: 50
            });

            $(".show-system").click(function (e) {
                e.preventDefault();
                var program_id = $(this).data('program-id');

                var system_id = $(this).data('system-id');

                var month = $(this).data('month');

                var year = $(this).data('year');

                var lang = '{{\App::getLocale()}}';

                $.ajax({
                    url: '/showProgress/' + program_id + '/' + system_id  + '/'+ month + '/' + lang + '/' + year,
                    dataType: 'json',
                    success: function (e) {
                        $('#program-progress-modal').remove();
                        $('body').append(e.html);
                        $('#program-progress-modal').modal('show');
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            !function($) {
                "use strict";

                var EasyPieChart = function() {};

                EasyPieChart.prototype.init = function() {
                    //initializing various types of easy pie charts
                    $('.easy-pie-chart-1').easyPieChart({
                        easing: 'easeOutBounce',
                        barColor : '#13dafe',
                        lineWidth: 3,
                        animate: 1000,
                        lineCap: 'square',
                        trackColor: '#e5e5e5',
                        onStep: function(from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    });

                },
                    //init
                    $.EasyPieChart = new EasyPieChart, $.EasyPieChart.Constructor = EasyPieChart
            }(window.jQuery),
//initializing
                function($) {
                    "use strict";
                    $.EasyPieChart.init()
                }(window.jQuery);
        </script>
    @endpush

@endsection