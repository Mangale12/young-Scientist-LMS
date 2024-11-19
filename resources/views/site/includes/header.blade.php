<section class="header">
    <div class="header__top py-1">
        <div class="container">
            <div class="d-flex justify-content-end login-register-btn">
                @auth
                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                        <!-- Show user name or dashboard link -->
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-user-circle"></i>
                            {{ auth()->user()->name }}
                        </a>
                    @else
                        <!-- Show a different symbol or message for other roles -->
                        <a href="{{ route('admin.index') }}">
                            <i class="fa-solid fa-user-circle"></i>
                            Dashboard
                        </a>
                    @endif
                @else
                    <!-- Login and Register links for guests -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginForm">
                        <i class="fa-regular fa-user"></i> Login
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerForm">
                        <i class="fa-solid fa-circle-notch"></i> Register Account
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="header__navbar py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="index.html"><img src="{{asset('images/logo.png')}}" alt="logo" height="70" class="center-image"></a>
                <nav class="header__navbar--left header__navbar--right">
                    <ul class="d-flex align-items-center">

                        <li class="dropdown">
                            <a href="Pre-K & Kindergarten.html">LEVELS <i
                                    class="fa-solid fa-chevron-down arrow"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="Pre-K & Kindergarten.html">Pre-K & Kindergarten </a></li>
                                <li><a href="elementry.html">Elementary</a></li>
                                <li><a href="middle.html">Middle</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="elementary.html">CAMPS <i class="fa-solid fa-chevron-down arrow"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="summber-camp.html">Summery CAMP</a></li>
                                <li><a href="winter-camp.html">Winter CAMP</a></li>
                                <li><a href="after-school.html">After School </a></li>



                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="middle.html">SCHOOL PROGRAM <i class="fa-solid fa-chevron-down arrow"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="yearly-plan.html">Yearly Plan</a></li>
                                <li><a href="bootcamp.html">Bootcamp</a></li>
                                <li><a href="online-class.html">Online Class</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="coding-cometition.html">COMPETITION </a>

                        </li>
                        <!-- Login dropdown -->
                        <!-- <li class="dropdown">
                            <a href="#">Login <i class="fa-solid fa-chevron-down arrow"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="login.html">Individual Login</a></li>
                                <li><a href="#">School Login</a></li>
                            </ul>
                        </li> -->
                        <!-- <li>
                            <a class="try-a-free-class login" href="login.html">Login</a>
                        </li> -->

                        <li>
                            <a class="try-a-free-class" href="try-free-class.html">Try a free Trial Class</a>
                        </li>
                    </ul>
                </nav>



            </div>
        </div>
    </div>
</section>