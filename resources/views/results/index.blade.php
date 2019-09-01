@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 3/14/19
     * Time: 1:32 PM
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
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('result.index')}}">{{trans('result.rankingDetails')}}</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div id="box">
                        <div class="scroller scroller-left"><i class="fa fa-chevron-left fa-2x"></i></div>
                        <div class="scroller scroller-right"><i class="fa fa-chevron-right fa-2x"></i></div>
                        <div class="wrapper">
                            <div class="list">
                                @for($i=date('Y'); $i>=2000; $i--)
                                    <a href="{{route('result.year','year='.$i)}}"
                                       class="item {{ isset($year) && $i == $year ? 'active' : '' }}">{{$i}}</a>
                                @endfor
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    @if (!empty($year))
                        <h4 class="card-title">{{trans('result.selectMonth')}}</h4>
                        <div class="row button-group">
                            @for($i = 1; $i <= 12; $i++)
                                <div class="col-lg-2 col-md-4">
                                    <a href="{{route('result.rankingSystem', ['year'=>$year, 'month'=> $i])}}"
                                       class="btn waves-effect waves-light btn-block {{ isset($month) && ($i == $month) ? 'btn-info' : 'btn-secondary' }}">{{trans('months.'.DateTime::createFromFormat('!m', $i)->format('F'))}}</a>
                                </div>
                            @endfor
                        </div>
                    @endif
                    @if (!empty($rankingSystems))
                        <br>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header list-group-item-info border-dark">
                                    <h4 class="card-title pull-left">{{trans('result.rankingDetails')}}</h4>
                                    <div class="pull-right btn-sm btn btn-info">{{trans('result.year')}} : {{$year}}
                                        / {{trans('result.month')}}
                                        : {{trans('months.'.DateTime::createFromFormat('!m', $month)->format('F'))}}
                                    </div>
                                </div>
                                <div class="card-body p-b-0">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                        @foreach($rankingSystems as $key => $rankingSystem)
                                            <li class="nav-item text-center"><a
                                                        href="{{route('result.criteria', ['year'=>$year, 'month'=> $month, 'system'=> $rankingSystem->id])}}"
                                                        class="nav-link {{!empty($rankingSystemId) && ($rankingSystemId == $rankingSystem->id) ? 'active' : ''}}" data-toggle="tooltip" title="{{$rankingSystem->name}}">{{$rankingSystem->abbreviation}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    &nbsp;
                                    <!-- Tab panes -->
                                    @if (!empty($rankingCriterias))
                                        <div class="vtabs col-md-12">
                                            <ul class="nav nav-tabs tabs-vertical col-md-3" role="tablist">
                                                @foreach($rankingCriterias as $key => $rankingCriteria)
                                                    <li class="text-nowrap nav-item"><a
                                                                class="nav-link {{!empty($criteria_id) && ($criteria_id == $rankingCriteria->id) ? 'active' : 'btn-secondary'}}"
                                                                href="{{route('result.indicator','rankingSystem='.$rankingSystemId.'&criteria='.$rankingCriteria->id.'&year='.$year. '&month='.$month)}}"
                                                                role="tab" data-toggle="tooltip"
                                                                title="{{$rankingCriteria->name}}"><span>{{trans('criterias.criterion')}} {{$key + 1}}</span></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                            @if (!empty($rankingIndicators))
                                                <div class="tab-content col-md-10">
                                                    <form action="{{route('result.store')}}" class="form-horizontal"
                                                          method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            @if(\Auth::user()->programs->isEmpty())
                                                                <label>{{trans('result.institutionOrProgram')}}</label>
                                                            @else
                                                                <label>{{trans('program.programs')}}</label>
                                                            @endif
                                                            &nbsp;
                                                                @if(\Auth::user()->programs->isEmpty())
                                                                    <br>

                                                                    <div class="demo-radio-button">
                                                                    <input type="radio"
                                                                           class="with-gap radio-col-teal col-md-2"
                                                                           id="institution" name="checkbox"
                                                                           value="1" {{!empty($institutionId) ? 'checked="checked"' : ''}}>
                                                                    <label for="institution">{{trans('result.institution')}}</label>

                                                                    <input type="radio"
                                                                           class="with-gap radio-col-teal col-md-2"
                                                                           id="program" name="checkbox"
                                                                           value="2" {{!empty($programId) ? 'checked="checked"' : ''}}>
                                                                    <label for="program">{{trans('result.program')}}</label>

                                                                    @if ($errors->has('checkbox'))
                                                                        <small class="form-control-feedback text-danger">{{ $errors->first('checkbox') }}</small>
                                                                    @endif
                                                                    &nbsp;
                                                                    <select class="select2 form-control custom-select col-md-8"
                                                                            style="width: 42%; height:36px;"
                                                                            id="programs" name="program"
                                                                            data-placeholder="{{trans('result.selectProgram')}}">
                                                                        <option value="">{{trans('result.selectProgram')}}</option>
                                                                        @foreach($programs as $program)
                                                                            <option value="{{$program->id}}" {{old('program') == $program->id || !empty($programId) && $programId == $program->id ? 'selected' : '' }}>{{$program->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('program'))
                                                                        <small class="form-control-feedback text-danger">{{ $errors->first('program') }}</small>
                                                                    @endif
                                                                    &nbsp;
                                                                    </div>

                                                                @else
                                                                    <select class="select2 form-control custom-select col-md-8"
                                                                            style="width: 42%; height:36px;"
                                                                            id="programs" name="program"
                                                                            data-placeholder="{{trans('result.selectProgram')}}">
                                                                        <option value="">{{trans('result.selectProgram')}}</option>
                                                                        @foreach($programs as $program)
                                                                            <option value="{{$program->id}}" {{old('program') == $program->id || !empty($programId) && $programId == $program->id ? 'selected' : '' }}>{{$program->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('program'))
                                                                        <small class=" text-danger">{{ $errors->first('program') }}</small>
                                                                    @endif
                                                                    &nbsp;
                                                                @endif
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h3>{{trans('indicators.indicatorName')}}</h3>
                                                            <br>
                                                            @foreach($rankingIndicators as $key=>$rankingIndicator)
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-8"
                                                                               for="value-{{ $key }}" data-toggle="tooltip" title="{{$rankingIndicator->description}}">{{$rankingIndicator->name}}</label>
                                                                        <div class="col-md-4">
                                                                            <input type="text" id="value-{{ $key }}"
                                                                                   name="value[]"
                                                                                   class="form-control {{$errors->has('value') ? 'is-invalid' : '' }}"
                                                                                   placeholder="{{trans('result.enterPercentage')}}"
                                                                                   value="{{ !empty($value) && $value->where('indicator_id',$rankingIndicator->id)->first() ? $value->where('indicator_id',$rankingIndicator->id)->first()->value :  old('value[]')}}">
                                                                            @if ($errors->has('value.'.$key))
                                                                                <small class="form-control-feedback text-danger">{{$errors->first('value.'.$key)}}</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="year" value="{{$year}}">
                                                                <input type="hidden" name="month"
                                                                       value="{{$month}}">
                                                                <input type="hidden" name="rankingSystemId"
                                                                       value="{{$rankingSystemId}}">
                                                                <input type="hidden" name="criteria"
                                                                       value="{{$criteria_id}}">
                                                                <input type="hidden" name="indicator[]"
                                                                       value="{{$rankingIndicator->id}}">
                                                            @endforeach
                                                        </div>

                                                        <hr>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-4 col-md-9">
                                                                            <button type="submit"
                                                                                    class="btn btn-linkedin">{{trans('result.save')}}
                                                                            </button>
                                                                            <a href="{{route('result.index')}}"
                                                                               class="btn btn-danger">{{trans('result.cancel')}}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                            @if(isset($opens))
                                                <div class="tab-content col-md-10">
                                                    <form action="{{route('result.store')}}" class="form-horizontal"
                                                          method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            @if(\Auth::user()->programs->isEmpty())
                                                                <label>{{trans('result.institutionOrProgram')}}</label>
                                                            @else
                                                                <label>{{trans('program.programs')}}</label>
                                                            @endif

                                                            &nbsp;
                                                                @if(\Auth::user()->programs->isEmpty())
                                                                    <br>
                                                                    <div class="demo-radio-button">

                                                                    <input type="radio"
                                                                           class="with-gap radio-col-teal col-md-2"
                                                                           id="institution" name="checkbox"
                                                                           value="1" {{!empty($institutionId) ? 'checked="checked"' : ''}}>
                                                                    <label for="institution">{{trans('result.institution')}}</label>

                                                                    <input type="radio"
                                                                           class="with-gap radio-col-teal col-md-2"
                                                                           id="program" name="checkbox"
                                                                           value="2" {{!empty($programId) ? 'checked="checked"' : ''}}>
                                                                    <label for="program">{{trans('result.program')}}</label>
                                                                    @if ($errors->has('checkbox'))
                                                                        <small class="form-control-feedback text-danger">{{ $errors->first('checkbox') }}</small>
                                                                    @endif
                                                                    <select class="select2 form-control custom-select col-md-8"
                                                                            style="width: 43%; height:36px;"
                                                                            id="programs" name="program"
                                                                            data-placeholder="{{trans('result.selectProgram')}}">
                                                                        <option value="">{{trans('result.selectProgram')}}</option>
                                                                        @foreach($programs as $program)
                                                                            <option value="{{$program->id}}" {{old('program') == $program->id || !empty($programId) && $programId == $program->id ? 'selected' : '' }}>{{$program->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('program'))
                                                                        <small class="form-control-feedback text-danger">{{ $errors->first('program') }}</small>
                                                                    @endif
                                                                    &nbsp;
                                                                    </div>

                                                                @else
                                                                    <select class="select2 form-control custom-select col-md-8"
                                                                            style="width: 43%; height:36px;"
                                                                            id="programs" name="program"
                                                                            data-placeholder="{{trans('result.selectProgram')}}">
                                                                        <option value="">{{trans('result.selectProgram')}}</option>
                                                                        @foreach($programs as $program)
                                                                            <option value="{{$program->id}}" {{old('program') == $program->id || !empty($programId) && $programId == $program->id ? 'selected' : '' }}>{{$program->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('program'))
                                                                        <small class="form-control-feedback text-danger">{{ $errors->first('program') }}</small>
                                                                    @endif
                                                                    &nbsp;
                                                                @endif
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h3>{{trans('criterias.criteriaName')}}</h3>
                                                            <br>
                                                            <div class="form-group row">

                                                                <label class="control-label col-md-8"
                                                                       for="value-{{$criteria->id}}" data-toggle="tooltip" title="{{$criteria->description}}">{{$criteria->name}}</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" id="value-{{$criteria->id}}"
                                                                           name="value[]"
                                                                           class="form-control {{$errors->has('value') ? 'is-invalid' : '' }}"
                                                                           placeholder="{{trans('result.enterPercentage')}}"

                                                                           value="{{!empty($value) && $value->where('criteria_id',$criteria->id)->first() ? $value->where('criteria_id',$criteria->id)->first()->value :  old('value[]')}}">
                                                                    @if ($errors->has('value.0'))
                                                                        <small class="form-control-feedback text-danger">{{$errors->first('value.0')}}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="year" value="{{$year}}">
                                                            <input type="hidden" name="month" value="{{$month}}">
                                                            <input type="hidden" name="rankingSystemId"
                                                                   value="{{$rankingSystemId}}">
                                                            <input type="hidden" name="criteria"
                                                                   value="{{$criteria_id}}">
                                                        </div>

                                                        <hr>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-4 col-md-9">
                                                                            <button type="submit"
                                                                                    class="btn btn-linkedin">{{trans('result.save')}}
                                                                            </button>
                                                                            <a href="{{route('result.index')}}"
                                                                               class="btn btn-danger">{{trans('result.cancel')}}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                </div>
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
        <link href="{{asset('css/timeline/timeline-'.$dir.'.css')}}" rel="stylesheet" type="text/css"/>

    @endpush

    @push('script')
        <script src="{{asset('js/timeline/timeline-'.$dir.'.js')}}"></script>

        <script type="text/javascript">
            jQuery(document).ready(function () {

                // For select 2
                $(".select2").select2();
                @if(\Auth::user()->programs->isEmpty())
                $('#programs').next(".select2-container").hide();
                $("input[type='radio']").change(function () {
                    if ($("input[type='radio']:checked").val() == 2) {
                        $('#programs').next(".select2-container").show();
                    } else {
                        $('#programs').next(".select2-container").hide();
                    }
                });
                @endif
                @if (!empty($programId))
                $('#programs').next(".select2-container").show();
                @endif
            });

            $('#programs').on('change', function (e) {
                e.preventDefault();
                        @if(!empty($rankingSystemId) && !empty($criteria_id) && !empty($year)  && !empty($month))
                var programId = e.target.value;
                var rankingSystem = '{{$rankingSystemId}}';
                var criteria = '{{$criteria_id}}';
                var year = '{{$year}}';
                var month = '{{$month}}';
                window.location = '/{{App::getLocale() }}/ranking-result/' + rankingSystem + '/' + criteria + '/' + programId + '/' + year + '/' + month;
                @endif
            });
            $('#institution').next(".select2-container").hide();
            $("input[type='radio']").change(function () {
                if ($("input[type='radio']:checked").val() == 1) {
                            @if(!empty($rankingSystemId) && !empty($criteria_id) && !empty($year)  && !empty($month))

                    var rankingSystem = '{{$rankingSystemId}}';
                    var criteria = '{{$criteria_id}}';
                    var year = '{{$year}}';
                    var month = '{{$month}}';
                    window.location = '/{{App::getLocale() }}/ranking-result/' + rankingSystem + '/' + criteria + '/' + year + '/' + month;
                    @endif
                }
            });
        </script>
    @endpush
@endsection