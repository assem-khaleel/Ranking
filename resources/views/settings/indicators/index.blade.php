<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 10/03/19
 * Time: 01:13 م
 */
?>
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
                        <h4 class="card-title pull-left">{{trans('indicators.indicators') }} </h4>
                        <a href="{{route('ranking-indicator.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span> {{trans('indicators.create')}}</a>
                    </div>
                    <div class="card-body">

                        @if ($rankingIndicators->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('indicators.thereAreNoRankingIndicators')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('indicators.nameEn') }}</th>
                                        <th>{{trans('indicators.nameAr') }}</th>
                                        <th>{{trans('indicators.nameCriteria')}}</th>
                                        <th>{{trans('indicators.descriptionCriteria')}}</th>
                                        <th class="text-nowrap text-center">{{trans('indicators.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rankingIndicators as $rankingIndicator)
                                        <tr>

                                            <td>{{$rankingIndicator->name_en}}</td>
                                            <td>{{$rankingIndicator->name_ar}}</td>
                                            <td>{{$rankingIndicator->criteria->name}}</td>
                                            <td>{{$rankingIndicator->criteria->description}}</td>

                                            <td class="text-nowrap text-center">
                                                <a href="{{route('ranking-indicator.show', $rankingIndicator->id)}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('indicators.show')}}"><i
                                                            class="fa fa-eye"
                                                            style="margin: 5px"></i></a>
                                                <a href="{{route('ranking-indicator.edit', $rankingIndicator->id)}}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('indicators.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $rankingIndicator->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('indicators.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="user-{{ $rankingIndicator->id }}"
                                                      action="{{route('ranking-indicator.destroy', $rankingIndicator->id)}}">
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
                            {{$rankingIndicators->links()}}
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
                            title: "{{trans('users.areYouSure')}}",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{trans('users.yesDeleteIt')}}",
                            closeOnConfirm: false
                        }, function () {
                            console.log(that);
                            var userId = that.data('id');
                            $('#user-' + userId).submit();
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

