@php
    /**
    * Created by PhpStorm.
    * User: dura
    * Date: 4/10/19
    * Time: 10:56 AM
    */
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
                <li class="breadcrumb-item"><a
                            href="{{route('report.index')}}">{{trans('common.reportInstitution')}}</a></li>
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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-40">{{trans('common.reportInstitution')}}</h4>
                        <form action="{{route('report.show')}}" class="form-horizontal"
                              method="get">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <select class="select2 form-control custom-select"
                                                        style="width: 100%; height:36px;" name="system" data-placeholder="{{trans('criterias.selectRankingSystem')}}">
                                                    <option value="">{{trans('criterias.selectRankingSystem')}}</option>
                                                    @foreach($rankingSystems as $rankingSystem)
                                                        <option value="{{$rankingSystem->id}}" {{old('system') == $rankingSystem->id || !empty($system) && $rankingSystem->id == $system->id ? 'selected' : '' }}>{{$rankingSystem->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('system'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('system') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <select class="select2 form-control custom-select"
                                                        style="width: 100%; height:36px;" name="year" data-placeholder="{{trans('result.selectYear')}}">
                                                    <option value="">{{trans('result.selectYear')}}</option>
                                                    @for($i=date('Y'); $i>=2000; $i--)
                                                        <option value="{{$i}}" {{old('year') == $i || !empty($year) && $i == $year ? 'selected' : '' }}>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @if ($errors->has('year'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('year') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <select class="select2 form-control custom-select"
                                                        style="width: 100%; height:36px;" name="month">
                                                    <option value="">{{trans('result.selectMonth')}}</option>
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option value="{{$i}}" {{old('month') == $i || !empty($month) && $i == $month ? 'selected' : '' }}>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @if ($errors->has('month'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('month') }}</small>
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
                        @if(!empty($criterias))

                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0"
                                       style="table-layout: fixed">
                                    <thead>
                                    <tr>
                                        <th width="15%">{{trans('criterias.criteriaName')}}</th>

                                        @if(!empty($system->indicatorsCount) && $system->indicatorsCount != 0)
                                            <th width="25%">{{trans('indicators.nameIndicator')}}</th>
                                        @endif
                                        @if(empty($month))
                                            @for ($i = 1; $i <= 12; $i++)
                                                <th width="5%">{{$i}}</th>
                                            @endfor
                                        @else
                                            <th width="5%">{{trans('result.value')}}</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $currentCriteria = 0 @endphp
                                    @foreach($criterias as $criteria)
                                        @if ($criteria->indicator->isNotEmpty())

                                            @foreach($criteria->indicator as $indicator)
                                                <tr>
                                                    @if ($currentCriteria != $criteria->id)
                                                        @php $currentCriteria = $criteria->id @endphp
                                                        <td class="" width="15%"
                                                            rowspan="{{ $criteria->indicator->count() }}"> {{$criteria->name}}</td>
                                                    @endif
                                                    <td class="" width="25%">{{$indicator->name}}</td>
                                                    @if(empty($month))
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <td class="class"
                                                                width="5%">{!! $system->results->where('indicator_id', $indicator->id)->where('month', $i)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!}</td>
                                                        @endfor
                                                    @else
                                                        <td class="class"
                                                            width="5%">{!! $system->results->where('indicator_id', $indicator->id)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!}</td>

                                                    @endif

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                @if ($currentCriteria != $criteria->id)
                                                    @php $currentCriteria = $criteria->id @endphp
                                                    <td class="" width="90%"> {{$criteria->name}}</td>
                                                @endif
                                                @if(empty($month))
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <td class="class"
                                                            width="5%">{!!$system->results->where('criteria_id', $criteria->id)->where('month', $i)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!} </td>
                                                    @endfor
                                                @else
                                                    <td class="class"
                                                        width="5%">{!!$system->results->where('criteria_id', $criteria->id)->first()->value ?? '<i class="fa fa-window-close text-danger" aria-hidden="true"></i>'!!} </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @push('script')
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // For select 2
                $(".select2").select2();
            });
        </script>
    @endpush


@endsection