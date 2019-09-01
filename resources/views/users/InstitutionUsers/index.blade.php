@php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 3/7/19
 * Time: 12:35 PM
 */
use App\Models\Setting\Users\User;
@endphp
@extends('layouts.app')

@section('wrapper')
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('profiles.home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('institution-user.index')}}">{{trans('users.institutionUsers')}}</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title pull-left">{{ trans('users.institutionUsers') }} </h4>
                            <a href="{{route('institution-user.create')}}" class="pull-right btn-sm btn btn-info" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>{{trans('users.createUser')}}</a>
                        </div>
                    <div class="card-body">
                        @if ($users->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('users.thereAreNoUsers')}}</h5>
                                </div>
                            </div>
                        @else
                        <div class="table-responsive">
                            <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                <thead>
                                <tr>
                                    <th>{{trans('users.name')}}</th>
                                    <th>{{trans('users.email')}}</th>
                                    <th>{{trans('users.institution')}}</th>
                                    <th class="text-center">{{trans('users.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="text-nowrap">{{$user->name}}</td>
                                    <td class="text-nowrap">{{$user->email}}</td>
                                    <td class="text-nowrap">{{$user->institutionUser->institution->name}}</td>
                                    @if($user->status == User::$ACTIVE)
                                        <td class="text-nowrap text-center">
                                            <a href="{{route('institution-user.show', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.show')}}"><i class="fa fa-eye" style="margin: 5px"></i></a>

                                            <a href="{{route('institution-user.edit', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.edit')}}"><i class="fa fa-edit" style="margin: 5px"></i></a>

                                            <a href="{{route('users.inactive', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.inactive')}}"><i class="fa fa-user text-danger"></i></a>

{{--                                            @if(Auth::user()->systemUser)--}}

{{--                                                @if($user->id == $user->institutionUser->user_id)--}}


{{--                                                    <a href="{{route('logi', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.inactive')}}"><i class="fa fa-user text-danger"></i></a>--}}

{{--                                                @endif--}}

{{--                                            @endif--}}

                                            <a href="javascript:void(0);" class="sa-warning" data-id="{{ $user->id }}"
                                               data-toggle="tooltip" data-original-title="{{trans('users.delete')}}"><i class="fa fa-trash"
                                                                                                     style="margin: 5px"></i></a>
                                            <form style="display: inline-block;" method="POST" id="user-{{ $user->id }}"
                                                  action="{{route('institution-user.destroy', $user->id)}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>

                                        </td>
                                    @else
                                        <td class="text-nowrap text-center">
                                            <a href="{{route('institution-user.show', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.show')}}"><i class="fa fa-eye" style="margin: 5px"></i></a>

                                            <a href="{{route('institution-user.edit', $user->id)}}" data-toggle="tooltip" data-original-title="{{trans('users.edit')}}"><i class="fa fa-edit" style="margin: 5px"></i></a>

                                            <a href="{{ route('users.active', $user->id) }}" data-toggle="tooltip" data-original-title="{{trans('users.active')}}"><i class="fa fa-user"></i></a>
                                        </td>
                                    @endif

                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{$users->links()}}
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
        </div>
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