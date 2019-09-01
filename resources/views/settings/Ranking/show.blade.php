@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('ranking-system.index')}}">{{trans('ranking.rankingSystem')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('ranking.nameRankingSystem')}}: {{$ranking->name}}</h4>

                    </div>
                    <div class="card-body">
                       <div class="row m-b-5">
                           <div class="col-md-3 col-lg-3 col-sm-6">
                               <img class="card-img-top img-responsive" src="{{(!empty($ranking->logo->path)) ? asset('storage/'.$ranking->logo->path):''}}" title="{{(!empty($ranking->logo->description)) ? $ranking->logo->description:''}}">
                           </div>
                       </div>
                        @if ($ranking->criteria->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('ranking.thereAreNoRankingSystem')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('ranking.criteriaIndicator')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @foreach($ranking->criteria as $criteria)

                                            <h5 class="text-dark">{{ $criteria->name }}</h5>
                                        <ul>

                                            @foreach($criteria->indicator as $indicator)
                                            <li>
                                                {{$indicator->name}}
                                            </li>
                                                @endforeach
                                        </ul>
                                            @endforeach
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        @endif
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