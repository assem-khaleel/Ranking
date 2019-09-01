@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 3/10/19
     * Time: 11:24 AM
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
                <li class="breadcrumb-item"><a href="{{route('system-user.index')}}">{{trans('users.systemUsers')}}</a></li>
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
                        <h4 class="m-b-0 text-white">{{trans('users.createUser')}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('system-user.store')}}" class="form-horizontal" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.name')}}</label>
                                            <div class="col-md-10">
                                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                       type="text" name="name" value="{{ old('name') }}" required=""
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
                                                       name="email" value="{{ old('email') }}" type="email" required=""
                                                       placeholder="{{trans('users.email') }}">
                                                @if ($errors->has('email'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('email') }}</small>
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
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">{{trans('users.password')}}</label>
                                            <div class="col-md-10">
                                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                       name="password" type="password" required=""
                                                       placeholder="{{trans('users.password')}}">
                                                @if ($errors->has('password'))
                                                    <small class="form-control-feedback text-danger">{{ $errors->first('password') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">  {{trans('users.passwordConfirmation')}}</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" name="password_confirmation"
                                                       required="" placeholder="{{trans('users.passwordConfirmation')}}">

                                            </div>
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
                                                <button type="submit" class="btn btn-linkedin">{{trans('users.createUser')}}</button>
                                                <a href="{{route('system-user.index')}}"
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
    @endpush

@endsection