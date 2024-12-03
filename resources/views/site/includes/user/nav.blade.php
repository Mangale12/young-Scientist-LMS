
<style>
    /* Customize dropdown styling */
    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ensure smooth scrolling for long notifications */
    .dropdown-menu::-webkit-scrollbar {
        width: 8px;
    }
    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }

    /* Notification badge */
    .badge {
        min-width: 1.5rem;
        height: 1.5rem;
        line-height: 1.5rem;
        font-weight: bold;
        text-align: center;
    }
    .dropdown-toggle::after {
        display: none;
    }
</style>

<section class="header">

    <div class="header__navbar py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="index.html"><img src="{{asset('images/logo.png')}}" alt="logo" height="70" class="center-image"></a>
                <nav class="header__navbar--left header__navbar--right">
                    <ul class="d-flex align-items-center">

                        <li class="dropdown">
                            <a href="Quarky .html">Open Resources </a>
                            <ul class="dropdown-menu">
                                <li><a href="Quarky .html">Quarky </a></li>
                                <li><a href="elementry.html">Quarky </a></li>
                                <li><a href="Quarky .html">Quarky </a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="course.html">Courses </a>
                            <ul class="dropdown-menu">
                                <li><a href="summber-camp.html">Quarky </a></li>
                                <li><a href="winter-camp.html">Quarky </a></li>
                                <li><a href="after-school.html">Quarky </a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="Quarky .html">Projects </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Quarky </a></li>
                                <li><a href="#">Quarky </a></li>
                                <li><a href="#">Quarky </a></li>

                            </ul>
                        </li>
                   
                        <li class="dropdown">
                            <a href="Quarky .html">Group Management </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Quarky </a></li>
                                <li><a href="#">Quarky </a></li>
                                <li><a href="#">Quarky </a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="Quarky .html">Logout </a>
                        </li>
                        <li class="nav-item dropdown dropdown-center">
                            <a 
                                class="nav-link dropdown-toggle position-relative" 
                                id="notificationDropdown" 
                                role="button" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                                <i class="fa-regular fa-bell"></i>
                                <span 
                                    id="notification-count" 
                                    class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle"
                                    style="font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 50%; display: none;">
                                    0
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2" id="notification-list" style="width: 27rem; max-height: 400px; overflow-y: auto;">
                                <li class="dropdown-item text-center text-muted">
                                    <em>Loading...</em>
                                </li>
                            </ul>
                        </li>
                        

                        <li class="dropdown dropdown-center">
                            <a class="d-flex align-items-center justify-content-end"> {{auth()->user()->name}} &nbsp; <span
                                    class="avatar">DM</span></a>
                        </li>
                    </ul>

                </nav>



            </div>
        </div>
    </div>
</section>