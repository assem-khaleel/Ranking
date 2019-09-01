<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-{{$currentLanguage->locale == 'en' ? 'left' : 'right'}}">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Light Logo icon -->
                    <img src="/images/logo-light-icon.png" alt="homepage" class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- Light Logo text -->
                         <img src="/images/logo-light-text.png" class="light-logo" alt="homepage"/>
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
                <li class="nav-item m-l-10"><a
                            class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                            href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
            </ul>

            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-muted waves-effect waves-dark"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-{{$currentLanguage->locale == 'en' ? 'uk' : 'sa'}}"></i></a>
                    @foreach ($altLocalizedUrls as $alt)
                        <div class="dropdown-menu dropdown-menu-right scale-up"><a class="dropdown-item"
                                                                                   href="{{ $alt['url'] }}"
                                                                                   hreflang="{{ $alt['locale'] }}"><i
                                        class="flag-icon flag-icon-{{ $alt['locale'] == 'en' ? 'uk' : 'sa' }}"></i> {{ $alt['name'] }}
                            </a>
                        </div>
                    @endforeach
                </li>
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img alt="user"
                                                                                              class="profile-pic"
                                                                                              src="@if(!empty(Auth::user()->image->path)){{asset('storage/'.Auth::user()->image->path)}}">@else
                            /images/avatar.png">@endif</a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img alt="user"
                                                            src="@if(!empty(Auth::user()->image->path)){{asset('storage/'.Auth::user()->image->path)}}">@else
                                            /images/avatar.png">@endif </div>
                                    <div class="u-text">
                                        <h4>{{Auth::user()->name}}</h4>
                                        <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('profiles.myProfile')}}"><i
                                            class="ti-user"></i> {{trans('profiles.myProfile')}}</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                {{trans('profiles.logout')}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->