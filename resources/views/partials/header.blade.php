<style type="text/css">
  a.app-nav__item {
   color: #404040;
}
</style>
<header class="app-header" style="background-color: #dbf4fd">

  <title>Laxyo | HRMS</title>
  <a class="app-header__logo" href="http://www.laxyo.org" style="background-color: #dbf4fd "><img src="http://www.laxyo.org/images/1591695666.png" height="25" ></img></a>

  <hr>
<!-- Sidebar toggle button-->
<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar" style="color: #404040;"></a>
<!-- Navbar Right Menu-->
{{-- {{auth()->user()->name}} --}}
<ul class="app-nav">

  <div class="col text-center" style="font-size:20px; padding-top: 12px; color: white; font-weight: 500; font-family: lucida console, monospace; color: #404040;" >
    HRMS
  </div>
 {{--  <li class="app-search">
    <input class="app-search__input" type="search" placeholder="Search">
    <button class="app-search__button"><i class="fa fa-search"></i></button>
  </li> --}}
  <!--Notification Menu-->
  
  <!-- <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
    <ul class="app-notification dropdown-menu dropdown-menu-right">
      <li class="app-notification__title">You have 4 new notifications.</li>
      <div class="app-notification__content">
        <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
            <div>
              <p class="app-notification__message">Lisa sent you a mail</p>
              <p class="app-notification__meta">2 min ago</p>
            </div></a></li>
        
        </div>
      </div>
      <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
    </ul>
  </li> -->
  <!-- User Menu-->
  <img class="app-sidebar__user-avatar" src="{{asset('storage/'.trim(Session::get('avatar'), 'public'))}}" alt="User Image" width="28" height="28" style="margin: 1% 0 0 0">
  <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-tasks fa-lg"></i></a>
    <ul class="dropdown-menu settings-menu dropdown-menu-right">
      <li><a class="dropdown-item" href="{{route('mast_entity.home')}}"><i class="fa fa-cog fa-lg fa-spin"></i> Settings</a></li>
      <li><a class="dropdown-item" href="{{route('information.index')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
      <li><a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>   
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
    </ul>
  </li>
</ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
@include('partials.sidebar')