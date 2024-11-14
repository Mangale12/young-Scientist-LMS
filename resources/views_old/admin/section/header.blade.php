<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    @php
        $settings = \App\Models\Setting::first();
        // dd($settings);
    @endphp
    @if(Route::has('admin.index'))
    <a href="{{ URL::route('admin.index') }}" style="font-weight: bold;font-size:25px" class="logo">{{ $settings->site_name }}</a>

    @endif
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">

        </ul>
        <!--  notification end -->
    </div>
    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <p style="padding-top: 12px;color:#000;font-weight:bold">आजको मिति : {{ datenep(now()->toDateTimeString(), true) }} <br>

            </p> <span style="font-weight: bold;color:#000">अन्तिम लगइन : {{timesAgoNp(Auth::user()->last_login_at)  }}</span> <br>



            <!-- settings start -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-tasks"></i>
                    <span class="badge badge-success">6</span>
                </a>
                <ul class="dropdown-menu extended tasks-bar">
                    <div class="notify-arrow notify-arrow-green"></div>
                    <li>
                        <p class="green">You have 6 pending tasks</p>
                    </li>

                </ul>
            </li>
            <!-- settings end -->

            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning">7</span>
                </a>
                <ul class="dropdown-menu extended notification">
                    <div class="notify-arrow notify-arrow-yellow"></div>
                    <li>
                        <p class="yellow">You have 7 new notifications</p>
                    </li>
                </ul>
            </li>
            <!-- notification dropdown end -->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{ asset('assets/cms/img/profile-avatar.jpg')}}" class="img img-responsive img-rounded" width="29" height="29">
                    <span class="username">{{ auth()->user()->name}}</span>

                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout dropdown-menu-right">
                    <div class="log-arrow-up"></div>
                    <li><a href="#"><i class=" fa fa-suitcase"></i>प्रोफाइल सेटअप</a></li>
                    <li><a href="{{ URL::route('admin.setting.index') }}"><i class="fa fa-cog"></i> सेत्तिंग</a></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>लग आउट
                        </a></li>
                    <form action="{{ route('logout')}}" method="post" id="logout-form" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>

            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
