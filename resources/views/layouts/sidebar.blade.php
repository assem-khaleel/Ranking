@php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 3/3/19
 * Time: 9:59 AM
 */
@endphp
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img alt="user" src="{{!empty(Auth()->user()->image->path) ? asset('storage/'.Auth()->user()->image->path) : '/images/avatar.png' }}">
                <!-- this is blinking heartbit-->
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <h5>{{Auth()->user()->name}}</h5>
                <a href="{{ route('logout') }}" data-toggle="tooltip" title="{{trans('profiles.logout')}}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form1').submit();">
                        <i class="mdi mdi-power"></i>
                    </a>
                    <form id="logout-form1" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class=""> <a class="waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">{{trans('common.dashboard')}}</span></a>
                </li>
                @if (!\Auth::user()->systemUser && \Auth::user()->programs->isEmpty())
                    <li class=""> <a class="waves-effect waves-dark" href="{{route('org-chart')}}" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">{{trans('common.orgChart')}}</span></a>
                    </li>
                    <li class=""> <a class="waves-effect waves-dark" href="{{route('result.index')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{trans('common.ranking')}}</span></a>
                    </li>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class="fa fa-pie-chart"></i><span class="hide-menu">{{trans('common.reports')}}</span></a>

                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('report.index')}}">{{trans('common.institReports')}}</a></li>
                            <li><a href="{{route('report.programShow')}}">{{trans('common.programReports')}}</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class="fa fa-user"></i><span class="hide-menu">{{trans('common.settings')}}</span></a>

                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('institution-user.index')}}">{{trans('common.users')}}</a></li>
                            <li><a href="{{route('college.index')}}">{{trans('college.colleges')}}</a></li>
                            <li><a href="{{route('department.index')}}">{{trans('department.departments')}}</a></li>
                            <li><a href="{{route('program.index')}}">{{trans('program.programs')}}</a></li>
                        </ul>
                    </li>
                @endif
                @if (\Auth::user()->programs->isNotEmpty())
                    <li class=""> <a class="waves-effect waves-dark" href="{{route('result.index')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">{{trans('common.ranking')}}</span></a>
                    </li>
                    <li class=""> <a class="waves-effect waves-dark" href="{{route('report.programShow')}}" aria-expanded="false"><i class="fa fa-pie-chart"></i><span class="hide-menu">{{trans('common.reports')}}</span></a>
                    </li>
                @endif
                @if (!empty(\Auth::user()->systemUser))
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">{{trans('common.users')}}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('institution-user.index')}}">{{trans('users.institutionUsers')}}</a></li>
                        <li><a href="{{route('system-user.index')}}">{{trans('users.systemUsers')}}</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-cog"></i><span class="hide-menu">{{trans('common.settings')}}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('institution.index')}}">{{trans('settings.institution')}}</a></li>
                        <li><a href="{{route('ranking-system.index')}}">{{trans('ranking.rankingSystem')}}</a></li>
                        <li><a href="{{route('ranking-criteria.index')}}">{{trans('criterias.rankingCriterion')}}</a></li>
                        <li><a href="{{route('ranking-indicator.index')}}">{{trans('indicators.rankingIndicators')}}</a></li>
                        <li><a href="{{route('category.index')}}">{{trans('settings.subjects')}}</a></li>

                    </ul>
                </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
