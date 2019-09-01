@php
    $dir = $currentLanguage->locale == 'en' ? 'ltr' : 'rtl';

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
    <title>Ranking</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style-'.$dir.'.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/megna-dark-'.$dir.'.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar" style="background-image:url(/images/background/background-System.jpg);">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="/register" method="post">
                @csrf
                <a href="javascript:void(0)" class="text-center db"><img src="/images/logo-icon.png" alt="Home" /><br/><img src="/images/logo-text.png" alt="Home" /></a>
                <h3 class="box-title m-t-40 m-b-0">{{trans('auth.registerNow')}}</h3>

                <div class="form-group m-t-20">
                    <div class="col-xs-12">
                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required="" placeholder="{{trans('auth.name')}}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="email" required="" placeholder="{{ trans('auth.eMailAddress')}}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" required="" placeholder="{{trans('auth.password')}}">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="{{trans('auth.confirmPassword')}}">

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-12">{{trans('auth.institutions')}}</label>
                        <div class="col-12">
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="institution" data-placeholder="{{trans('auth.choose')}}">
                                <option value="">{{trans('auth.selectInstitution')}}</option>
                                @foreach($institutions as $institution)
                                    <option value="{{$institution->id}}" {{old('institution') == $institution->id ? 'selected' : '' }}>{{$institution->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->has('institution'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('institution') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary p-t-0">
                            <input name='terms' id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">{{trans('auth.iAgreeToAll')}} <a href="#">{{trans('auth.terms')}}</a></label>
                        </div>
                        @if ($errors->has('terms'))
                            <small class="form-control-feedback text-danger">{{ $errors->first('terms') }}</small>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{trans('auth.signUp')}}</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>{{trans('auth.alreadyHaveAnAccount')}} <a href="{{route('login')}}" class="text-info m-l-5"><b>{{trans('auth.signIn')}}</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('js/jquery.slimscroll-'.$dir.'.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('js/waves-'.$dir.'.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('js/sidebarmenu-'.$dir.'.js')}}"></script>
<!--stickey kit -->
<script src="{{asset('plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('js/custom-'.$dir.'.min.js')}}"></script>
<script src="{{asset('plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();
    });
</script>

</body>

</html>