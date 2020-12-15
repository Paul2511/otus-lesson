<!-- Page Sidebar Start--> 
<div class="page-sidebar">
  <div class="main-header-left d-none d-lg-block">
    {{-- Logo --}}
    {{-- <div class="logo-wrapper"><a href="/"><img src="{{asset('assets/images/logo-white.png')}}" alt=""></a></div> --}}
    {{-- Logo --}}
  </div>
  <div class="sidebar custom-scrollbar">
    <div class="sidebar-user text-center">
      <div><img class="img-60 rounded-circle" src="{{asset('assets/images/user/1.jpg')}}" alt="#">
        <div class="profile-edit"><a href="/users/profile"><i data-feather="edit"></i></a></div>
      </div>
      <h6 class="mt-3 f-14">{{ __('messages._sidebar.company') }}</h6>
      <p>{{ __('messages._sidebar.name') }}</p>
      <p><small>{{ __('messages._sidebar.position') }}</small></p>
    </div>
    <ul class="sidebar-menu">
      <li><a class="sidebar-header" href="{{route(\App\Services\Routes\Providers\User\UserRoutes::USER_DASHBOARD,[
    'locale' => App::getLocale()
])}}" ><i data-feather="home"></i><span>{{ __('messages.pages.dashboard.dashboard')}}</span></a></li>
      <li><a class="sidebar-header" href="#" ><i data-feather="file"></i><span>{{ __('messages._sidebar.orders')}}</span></a></li>
      <li><a class="sidebar-header" href="#" ><i data-feather="book"></i><span>{{ __('messages._sidebar.documents')}}</span></a></li>
      <li><a class="sidebar-header" href="#" ><i data-feather="credit-card"></i><span>{{ __('messages._sidebar.payments')}}</span></a></li>
      <li><a class="sidebar-header" href="#" ><i data-feather="help-circle"></i><span>{{ __('messages._sidebar.knowledgebase')}}</span></a></li>
      <li><a class="sidebar-header" href="#" ><i data-feather="mail"></i><span>{{ __('messages._sidebar.contacts')}}</span></a></li>
    </ul>
  </div>
</div>
<!-- Page Sidebar Ends-->
