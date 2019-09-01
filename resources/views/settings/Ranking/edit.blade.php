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
                        href="{{route('ranking-system.index')}}">{{trans('ranking.rankingSystem')}}</a></li>
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
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">
                        {{trans('settings.institutionEdit')}}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('ranking-system.update', $ranking->id)}}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        @include('settings.Ranking.forms.fields')
                    </form>
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
@endsection

