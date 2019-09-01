@php
    /**
     * Created by PhpStorm.
     * User: Assem
     * Date: 20/03/19
     * Time: 09:10 ص
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
                            href="{{route('program.index')}}">{{trans('program.programs')}}</a></li>
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
                        <h4 class="card-title pull-left">{{ trans('program.list') }} </h4>
                        <a href="{{route('program.create')}}" class="pull-right btn-sm btn btn-info" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>{{trans('program.create')}}</a>
                    </div>
                    <div class="card-body">

                        @if ($data->isEmpty())
                            <div class="bd-footer">
                                <div class="text-center">
                                    <h5>{{trans('program.noProgram')}}</h5>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table table-striped m-b-0">
                                    <thead>
                                    <tr>
                                        <th>{{trans('common.nameEn')}}</th>
                                        <th>{{trans('common.nameAr')}}</th>
                                        <th>{{trans('settings.department')}}</th>
                                        <th>{{trans('category.subject')}}</th>
                                        <th>{{trans('program.responsible')}}</th>
                                        <th class="text-nowrap text-center">{{trans('common.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $program)
                                        <tr>
                                            <td>{{$program->name_en}}</td>
                                            <td>{{$program->name_ar}}</td>
                                            <td>{{$program->department->name}}</td>
                                            <td>
                                                @if ($program->categories->isNotEmpty())
                                                    @foreach($program->categories as $category)
                                                        <h5 class="text-dark" data-toggle="tooltip" title="{{$category->system->name}}">{{$category->system->abbreviation}}</h5>
                                                    <ul>
                                                            <li>
                                                                {{$category->name}}
                                                            </li>
                                                    </ul>
                                                    @endforeach
                                                @else
                                                    {{trans('program.notRelated')}}
                                                @endif

                                            </td>
                                            <td>{{!empty($program->users->name) ? $program->users->name : 'Not related'}}</td>
                                            <td class="text-nowrap text-center">
                                                <a href="{{route('program.edit', $program->id)}}"
                                                   data-toggle="tooltip" data-original-title="{{trans('common.edit')}}"><i
                                                            class="fa fa-edit"
                                                            style="margin: 5px"></i></a>

                                                <a href="javascript:void(0);" class="sa-warning"
                                                   data-id="{{ $program->id }}"
                                                   data-toggle="tooltip"
                                                   data-original-title="{{trans('common.delete')}}"><i
                                                            class="fa fa-trash"
                                                            style="margin: 5px"></i></a>

                                                <form style="display: inline-block;" method="POST"
                                                      id="user-{{ $program->id }}"
                                                      action="{{route('program.destroy', $program->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">{{ trans('No Program') }}</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer text-center">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {!! $data->appends(request()->toArray())->render() !!}
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
