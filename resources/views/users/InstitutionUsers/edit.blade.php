@php
    /**
    * Created by PhpStorm.
    * User: dura
    * Date: 3/7/19
    * Time: 1:20 PM
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
                <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('profiles.home')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{{route('institution-user.index')}}">{{trans('users.institutionUsers')}}</a></li>
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
                        <h4 class="m-b-0 text-white">{{trans('users.editUser')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('institution-user.update', $user->id)}}" class="form-horizontal"
                              method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.name')}}</label>
                                            <div class="col-md-10">
                                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                       type="text" name="name" value="{{$user->name}}" required=""
                                                       placeholder="{{trans('users.name')}}">
                                                @if ($errors->has('name'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('name') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.email')}}</label>
                                            <div class="col-md-10">
                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       name="email" value="{{$user->email}}" type="email" required=""
                                                       placeholder="{{trans('users.email') }}">
                                                @if ($errors->has('email'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('email') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.institution')}}</label>
                                            <div class="col-md-10">
                                                <select class="select2 form-control custom-select"
                                                        style="width: 100%; height:36px;" name="institution_id"
                                                        data-placeholder="{{trans('users.selectInstitution')}}">
                                                    <option value="">{{trans('users.selectInstitution')}}</option>
                                                    @foreach($institutions as $institution)
                                                        <option value="{{$institution->id}}"
                                                                {{ $institution->id == $user->institutionUser->institution_id ? 'selected' : '' }}>{{$institution->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('institution'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('institution') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.imageUpload')}}</label>
                                            <div class="col-md-10 fileinput fileinput-new input-group"
                                                 data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"><i
                                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                                            class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-default btn-file"> <span
                                                            class="fileinput-new">{{trans('users.selectImage')}}</span> <span
                                                            class="fileinput-exists">{{trans('users.change')}}</span>
                                            <input type="file" name="image"> </span>
                                                <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                                   data-dismiss="fileinput">{{trans('users.remove')}}</a>
                                            </div>
                                            @if ($errors->has('image'))
                                                <small class="form-control-feedback text-danger">{{ $errors->first('image') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit"
                                                        class="btn btn-linkedin">{{trans('users.editUser')}}</button>
                                                <a href="{{route('institution-user.index')}}"
                                                   class="btn btn-danger">{{trans('users.cancel')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    @push('script')
        <script src="{{asset('js/jasny-bootstrap.js')}}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // For select 2
                $(".select2").select2();
            });
        </script>
    @endpush

@endsection