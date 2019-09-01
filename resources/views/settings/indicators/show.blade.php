@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 3/14/19
     * Time: 11:11 AM
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
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('indicators.home')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('ranking-indicator.index')}}">{{trans('indicators.indicators')}}</a></li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title pull-left">{{trans('indicators.nameIndicator')}} : {{$rankingIndicator->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                <thead>
                                <tr>
                                    <th >{{trans('indicators.indicatorDescription')}}</th>
                                    <th >{{trans('indicators.nameCriteria')}}</th>
                                    <th >{{trans('indicators.criteriaDescription')}}</th>
                                    <th class="text-center">{{trans('indicators.percentage')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td >{{$rankingIndicator->description}}</td>
                                    <td >{{$rankingIndicator->criteria->name}}</td>
                                    <td >{{$rankingIndicator->criteria->description}}</td>
                                    <td class="text-center">{{$rankingIndicator->criteria->percentage}}</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection
