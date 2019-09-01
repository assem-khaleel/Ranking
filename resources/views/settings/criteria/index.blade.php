<?php /** @var \App\Models\Settings\RankingCriteria $data */ ?>
@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('common.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('ranking-criteria.index')}}">{{trans('criterias.criteria')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('criterias.criteria')}}</h4>
                        <a href="{{route('ranking-criteria.create')}}" class="pull-right btn-sm btn btn-info" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>{{trans('criterias.create')}}</a>
                    </div>
                    <div class="card-body">
                        @if ($criteria->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('criterias.thereAreNoRankingCriteria')}}</h5>
                                </div>
                            </div>
                        @else
                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                <thead>
                                <tr>
                                    <th>{{trans('criterias.name') }}</th>
                                    <th>{{trans('criterias.description')}}</th>
                                    <th class="text-center">{{trans('criterias.percentage')}}</th>
                                    <th class="text-center">{{trans('criterias.rankingSystem')}}</th>
                                    <th class="text-nowrap text-center">{{trans('criterias.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($criteria as $crit)
                                    <tr>
                                        <td>{{ $crit->name}}</td>
                                        <td>{{ $crit->description }}</td>
                                        <td class="text-center">{{ $crit->percentage }}</td>
                                        <td class="text-center">{{ $crit->system->name }}</td>
                                        <td class="text-nowrap text-center">
                                            <a href="{{route('ranking-criteria.show', [$crit->id])}}"> <i
                                                        class="fa fa-eye" data-toggle="tooltip"
                                                        data-original-title="{{trans('criterias.show') }}"
                                                        style="margin: 5px"></i>

                                            </a>

                                            <a href="{{route('ranking-criteria.edit', [$crit->id])}}"><i
                                                        class="fa fa-edit" data-toggle="tooltip"
                                                        data-original-title="{{ trans('common.edit') }}"
                                                        style="margin: 5px"></i>

                                            </a>

                                            <a href="javascript:void(0);" class="sa-warning" data-id="{{ $crit->id }}"
                                               data-toggle="tooltip" data-original-title="{{trans('common.delete')}}"><i class="fa fa-trash" style="margin: 5px"></i>
                                            </a>

                                            <form style="display: inline-block;" method="POST" id="criteria-{{ $crit->id }}"
                                                  action="{{route('ranking-criteria.destroy', $crit->id)}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                            @endif
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {!! $criteria->appends(request()->toArray())->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

    @push('head')
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">

    @endpush
    @push('script')
    <!-- Sweet-Alert  -->
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        //Warning Message
        !function ($) {
            "use strict";

            var SweetAlert = function () {
            };
            //examples
            SweetAlert.prototype.init = function () {
                //Warning Message
                $('.sa-warning').click(function () {
                    var that = $(this);
                    swal({
                        title: "{{trans('common.removeMsg')}}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{trans('common.yesDeleteIt')}}",
                        closeOnConfirm: false
                    }, function () {
                        console.log(that);
                        var userId = that.data('id');
                        $('#criteria-' + userId).submit();
                    });
                });
            },
                //init
                $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
        }(window.jQuery),

//initializing
            function ($) {
                "use strict";
                $.SweetAlert.init()
            }(window.jQuery);
    </script>
    @endpush

@endsection