@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 4/14/19
     * Time: 10:17 AM
     */
$dir = $currentLanguage->locale == 'en' ? 'ltr' : 'rtl';
@endphp
@extends('layouts.app')

@section('wrapper')

    <style>
        .ranking-systems>table {
            margin: auto !important;
        }
    </style>

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('common.dashboard')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-t-30">
                <form action="{{route('home.system')}}" class="form-horizontal"
                      method="get">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">

                                    <div class="col-md-9">
                                        <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" name="institution"
                                                data-placeholder="{{trans('auth.selectInstitution')}}">
                                            <option value="">{{trans('auth.selectInstitution')}}</option>
                                            @foreach($institutions as $institution)
                                                <option value="{{$institution->id}}" {{old('institution') == $institution->id || !empty($currentInstitution) && $institution->id == $currentInstitution->id ? 'selected' : '' }}>{{$institution->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('institution'))
                                            <small class="form-control-feedback text-danger">{{ $errors->first('institution') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit"
                                                class="btn btn-info pull-right">{{trans('common.search')}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>

                </form>
                @if(!empty($currentInstitution))
                    <div id="box">
                        <div class="scroller scroller-left"><i class="fa fa-chevron-left fa-2x"></i></div>
                        <div class="scroller scroller-right"><i class="fa fa-chevron-right fa-2x"></i></div>
                        <div class="wrapper">
                            <div class="list">
                                @for($i=date('Y'); $i>=2000; $i--)
                                    <a href="{{route('home.system',['year'=>$i, 'institution'=>$currentInstitution->id])}}"
                                       class="item {{ isset($year) && $i == $year ? 'active' : '' }}">{{$i}}</a>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endif
                    <br>
                    @if (!empty($year))
                        <div class="card-body">
                            <h4 class="card-title">{{trans('home.selectMonth')}}</h4>
                            <div class="row button-group">
                                @for($i = 1; $i <= 12; $i++)
                                    <div class="col-lg-1 col-md-1">
                                        <ul class="nav nav-pills nav-fill">
                                            <li class="nav-item">
                                                <div class="button-box">
                                                    <a href="{{route('home', ['year'=>$year, 'month'=> $i, 'institution'=>$currentInstitution->id])}}"
                                                       class="btn btn-secondary btn-outline {{isset($month) && $i == $month ? 'active-month' :''}}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="{{trans('months.'.DateTime::createFromFormat('!m', $i)->format('F'))}}">
                                                        {{$i}}
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif

                @if (!empty($systems))

                    <div class="card">
                        <div class="card-header">
                            <span class="text-dark">{{trans('home.rankingInstitution')}}</span>
                            : {{$currentInstitution->name}}
                        </div>
                        @php $width = (1/count($systems) * 100) @endphp
                        <div class="card-body">
                            @foreach($systems as $system)
                                <div class="pull-left" style="width: {{$width}}%;">
                                    @php $institutionId = $currentInstitution->id; @endphp

                                    <div class="p-3 v-middle ranking-systems" id="ranking_systems-{{ $system->id }}" data-system-id = "{{$system->id}}" data-year="{{$year}}" data-institution-id= "{{$institutionId}}" >
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="text-center system-criteria" data-toggle="tooltip" data-placement="top" title="{{$system->name}}"  id="ranking-system-name-{{ $system->id }}" data-system-id = "{{$system->id}}" data-year="{{$year}}" data-institution-id= "{{$institutionId}}" ></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
        @if(!empty($systems))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{trans('home.rankingSubjects')}} </h4>
                        <div id="accordion1" class="panel-group accordion" role="tablist" aria-multiselectable="true">
                            @foreach($systems as $system)
                                <div class="card m-b-0">
                                    <div class="card-header" role="tab" id="system-{{ $system->id }}">
                                        <h5 class="mb-0">
                                            <a class="link" data-toggle="collapse" data-parent="#accordion1"
                                               href="#body-{{ $system->id }}" aria-expanded="true"
                                               aria-controls="body-{{ $system->id }}">
                                                {{ $system->name }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="body-{{ $system->id }}" class="panel-collapse collapse" role="tabpanel"
                                         aria-labelledby="system-{{ $system->id }}" data-parent="#accordion1">
                                        <div class="card-body panel-body">
                                            @php $institutionId = $currentInstitution->id; @endphp
                                            @foreach($system->categories as $category)
                                                <tr>
                                                    <td>{{$category->name}}
                                                        <span data-category="{{$category->id}}"
                                                              class="label label-rouded label-themecolor pull-right show-programs">{{$category->programs()->whereHas('department.college', function ($q) use($institutionId){ $q->where('institution_id', $institutionId);})->count()}}</span>
                                                        <hr>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('dashboard.modals.systems-criteria')
    @include('dashboard.modals.home-programs')

    @push('head')
        <link href="{{asset('css/timeline/timeline-'.$dir.'.css')}}" rel="stylesheet" type="text/css"/>
    @endpush

    @push('script')
        <script src="{{asset('js/timeline/timeline-'.$dir.'.js')}}"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            $('.active-month').css({
                'background-color': '#dadab5',
                'border-bottom': '2px solid #345775',
                'border-top': '2px solid #345775'
            });

            jQuery(document).ready(function () {
                // For select 2
                $(".select2").select2();

            });

            $(".system-criteria, .ranking-systems").click(function (e) {
                e.preventDefault();

                var $modal = $('#system-criteria-modal');

                var systemId = $(this).data('system-id');
                var year = $(this).data('year');
                var institution_id = $(this).data('institution-id');

                $modal.find('#system-table').empty();
                $.ajax({
                    url: '/criteriaindicator/'+systemId+'/'+year+'/'+institution_id,
                    dataType:'json',
                    success: function (e) {
                        console.log(e.length);
                        if(e.length===0){
                            $modal.find('#system-table').append('<div class="col-lg-12 text-center h1">There is no criteria</div>');
                        }else{
                            $('#system-table').html(e.html);
                            $('#system-criteria-modal').modal('show');
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            @if(!empty($systems))
            google.charts.load('current', {'packages': ['gauge']});
            @foreach($systems as $system)
            google.charts.setOnLoadCallback(drawChart{{ $system->id }});

            function drawChart{{ $system->id }}() {

                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['{{ $system->abbreviation }}', {{ $system->progress }}]
                ]);

                var options = {
                    width: 110, height: 500,
                    redFrom: 0, redTo: 33,
                    yellowFrom: 34, yellowTo: 66,
                    greenFrom: 67, greenTo: 100,
                    minorTicks: 5, greenColor: '#2c897b',
                    yellowColor: '#fcb437', redColor: '#db3636'
                };

                var chart = new google.visualization.Gauge(document.getElementById('ranking_systems-{{ $system->id }}'));

                document.getElementById('ranking-system-name-{{ $system->id }}').innerText = '{{$system->abbreviation}}';
                chart.draw(data, options);
            }
            @endforeach

            $(document).ready(function () {
                $(".show-programs").click(function (e) {
                    e.preventDefault();

                    var categoryId = $(this).data('category');
                    var institutionId = '{{$currentInstitution->id}}';
                    $.ajax({
                        url: '/adminGetPrograms/' + categoryId  + '/' + institutionId,
                        dataType:'json',
                        success: function (e) {
                            var $programs = e;
                            if ($programs) {
                                var $modal = $('#home-programs');
                                var $table = $('#progress').find('tbody');

                                $table.empty();

                                $.each($programs,function (i,item) {
                                    $table.append('<tr><td class="title"><a class="link" href="program-home/'+ item.id
                                        + '">' + item.name_{{ app()->getLocale() }} + '</a></td></tr>');
                                });

                                $modal.modal().show();
                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                });
            });
            @endif
        </script>
    @endpush

@endsection