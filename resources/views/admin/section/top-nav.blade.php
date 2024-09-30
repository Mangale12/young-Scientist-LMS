  <!-- START HEADER-->
  <header class="header">
      <div class="page-brand">
          <a class="link" href="{{ route('admin.index') }}">
              <span class="brand">CRM &nbsp;
                  <span class="brand-tip"></span>
              </span>
              <span class="brand-mini">CRM</span>
          </a>
      </div>
      <div class="flexbox flex-1">
          <!-- START TOP-LEFT TOOLBAR-->
          <ul class="nav navbar-toolbar">
              <li>
                  <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
              </li>
             
          </ul>
          <!-- END TOP-LEFT TOOLBAR-->
          <!-- START TOP-RIGHT TOOLBAR-->
          <ul class="nav navbar-toolbar">
              <li class="dropdown dropdown-user">
                  <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                      <img src="{{ asset('assets/cms/img/admin-avatar.png')}}" />
                      <span></span>{{ auth()->user()->name}}<i class="fa fa-angle-down m-l-5"></i></a>
                  <ul class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                      <a class="dropdown-item" href=""><i class="fa fa-cog"></i>Settings</a>
                      <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                      <li class="dropdown-divider"></li>
                      <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          <i class="fa fa-power-off"></i>Logout
                      </a>
                      <form action="{{ route('logout')}}" method="post" id="logout-form" class="d-none">
                          @csrf
                      </form>
                  </ul>
              </li>
          </ul>
          <!-- END TOP-RIGHT TOOLBAR-->
      </div>
  </header>
  <!-- END HEADER-->