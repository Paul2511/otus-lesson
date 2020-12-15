<!-- Page Header Start-->
<div class="page-main-header open">
  <div class="main-header-right row">
    <div class="main-header-left d-lg-none">
      {{-- Logo --}}
      {{-- <div class="logo-wrapper"><a href="/"><img src="{{asset('assets/images/logo.png')}}" alt=""></a></div> --}}
      {{-- Logo --}}
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
      </div>
    </div>

    <div class="nav-right col p-0">
      <ul class="nav-menus">
        <li></li>
        {{--        Language dropdown --}}
        <li class="onhover-dropdown"><a class="txt-dark" href="#">
            <h6>{{ App::isLocale('en') ? "EN" : "RU" }}</h6></a>
          <ul class="language-dropdown onhover-show-div p-20">
            <li><a href=" {{ route(Route::currentRouteName(), 'en') }} " data-lng="en">
                <i class="flag-icon flag-icon-is"></i>{{__('messages._header.english')}}
              </a>
            </li>
            <li><a href="{{ route(Route::currentRouteName(), 'ru') }}" data-lng="ru">
                <i class="flag-icon flag-icon-ru"></i>{{__('messages._header.russian')}}
              </a>
            </li>
          </ul>
        </li>
        {{-- Language dropdown --}}
        {{-- Notification dropdown--}}
        <li class="onhover-dropdown"><i data-feather="bell"></i><span class="dot"></span>
          <ul class="notification-dropdown onhover-show-div">
            <li>{{__('messages._header.notifications')}} <span class="badge badge-pill badge-primary pull-right">3</span></li>
            <li>
              <div class="media">
                <div class="media-body">
                  <h6 class="mt-0"><span><i class="shopping-color" data-feather="shopping-bag"></i></span>{{__('messages._header.orderIsReady')}}<small class="pull-right">9:00 AM</small></h6>
                  <p class="mb-0">{{__('messages._header.lorem')}}</p>
                </div>
              </div>
            </li>
            <li>
              <div class="media">
                <div class="media-body">
                  <h6 class="mt-0 txt-success"><span><i class="download-color font-success" data-feather="download"></i></span>{{__('messages._header.documentRecieved')}}<small class="pull-right">2:30 PM</small></h6>
                  <p class="mb-0">{{__('messages._header.lorem')}}</p>
                </div>
              </div>
            </li>
            <li class="bg-light txt-dark"><a href="#">{{__('messages._header.allNotifications')}}</a></li>
          </ul>
        </li>
        <li class="onhover-dropdown">
          {{--  Notification dropdown--}}
          <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="{{asset('assets/images/dashboard/user.png')}}" alt="header-user">
          </div>
          <ul class="profile-dropdown onhover-show-div p-20">
            <li><a href="profile"><i data-feather="user"></i>{{__('messages._header.edit')}}</a></li>
            <li><a href="login"><i data-feather="lock"></i>{{__('messages._header.lock')}}</a></li>
            <li><a href="settings"><i data-feather="settings"></i>{{__('messages._header.settings')}}</a></li>
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i data-feather="log-out"></i> {{ __('messages._header.logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
      <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
    </div>
    <script id="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
    <script id="empty-template" type="text/x-handlebars-template">

      <div class="EmptyMessage">  {{__('messages._header.emptyMessage') }} </div>
    </script>
  </div>
</div>
<!-- Page Header Ends -->
