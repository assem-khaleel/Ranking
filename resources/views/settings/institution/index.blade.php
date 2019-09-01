@php
    /**
     * Created by PhpStorm.
     * User: plus
     * Date: 04/03/19
     * Time: 04:03 م
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
                            href="{{route('institution.index')}}">{{trans('settings.institution')}}</a></li>
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
                        <h4 class="card-title pull-left">{{trans('settings.institution')}}</h4>
                        <a href="{{route('institution.create')}}" class="pull-right btn-sm btn btn-info"
                           type="button"><span class="btn-label"><i
                                        class="fa fa-plus"></i></span>{{trans('settings.institutionCreate')}}</a>
                    </div>
                    <div class="card-body">
                        @if ($data->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('settings.noInstitutions')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('common.nameEn') }}</th>
                                        <th>{{ trans('common.nameAr') }}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $institution)
                                        <tr>
                                            <td>{{$institution->name_en}}</td>
                                            <td>{{$institution->name_ar}}</td>
                                            <td class="text-nowrap text-center">
                                                <a href="{{route('institution.edit', $institution->id)}}"
                                                   data-toggle="tooltip" data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $institution->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="user-{{ $institution->id }}"
                                                      action="{{route('institution.destroy', $institution->id)}}">
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
                            {{$data->links()}}
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
