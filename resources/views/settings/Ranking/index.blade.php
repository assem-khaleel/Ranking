<?php /** @var \App\Models\Settings\RankingSystem $data */ ?>
@extends('layouts.app')
@section('wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('ranking.home')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('ranking.list')}} </h4>
                        <a href="{{route('ranking-system.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span>{{trans('ranking.create')}}</a>
                    </div>
                    <div class="card-body">
                        @if ($ranking->isEmpty())
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
                                        <th>{{trans('ranking.nameEn') }}</th>
                                        <th>{{trans('ranking.nameAr') }}</th>
                                        <th>{{trans('ranking.description') }}</th>
                                        <th class="text-nowrap text-center">{{ trans('ranking.Actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ranking as $rank)
                                        <tr>
                                            <td >{{$rank->name_en}}</td>
                                            <td >{{$rank->name_ar}}</td>
                                            <td>{{$rank->description}}</td>
                                            <td class="text-nowrap text-center">
                                                <a href="{{route('ranking-system.show', [$rank->id])}}"> <i
                                                            class="fa fa-eye" data-toggle="tooltip"
                                                            data-original-title="{{ trans('ranking.show') }}"
                                                            style="margin: 5px"></i>

                                                </a>

                                                <a href="{{route('ranking-system.edit', [$rank->id])}}"><i
                                                            class="fa fa-edit" data-toggle="tooltip"
                                                            data-original-title=" {{ trans('Edit') }}"
                                                            style="margin: 5px"></i>

                                                </a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $rank->id }}"
                                                   data-toggle="tooltip" data-original-title="Delete"><i
                                                            class="fa fa-trash" style="margin: 5px"></i>
                                                </a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="ranking-{{ $rank->id }}"
                                                      action="{{route('ranking-system.destroy', $rank->id)}}">
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
                            {!! $ranking->appends(request()->toArray())->render() !!}
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
                            $('#ranking-' + userId).submit();
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