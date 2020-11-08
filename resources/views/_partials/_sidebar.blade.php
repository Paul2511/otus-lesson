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
      <h6 class="mt-3 f-14">{{ __('_partials/_sidebar.company') }}</h6>
      <p>{{ __('_partials/_sidebar.name') }}</p>
      <p><small>{{ __('_partials/_sidebar.position') }}</small></p>
    </div>
    <ul class="sidebar-menu">
      <li><a class="sidebar-header" href="{{route('dashboard')}}" ><i data-feather="home"></i><span>{{ __('pages/dashboard.dashboard')}}</span></a></li>
      <li><a class="sidebar-header" href="{{route('orders')}}" ><i data-feather="file"></i><span>{{ __('_partials/_sidebar.orders')}}</span></a></li>
      <li><a class="sidebar-header" href="{{route('documents')}}" ><i data-feather="book"></i><span>{{ __('_partials/_sidebar.documents')}}</span></a></li>
      <li><a class="sidebar-header" href="{{route('payments')}}" ><i data-feather="credit-card"></i><span>{{ __('_partials/_sidebar.payments')}}</span></a></li>
      <li><a class="sidebar-header" href="{{route('knowledgebase')}}" ><i data-feather="help-circle"></i><span>{{ __('_partials/_sidebar.knowledgebase')}}</span></a></li>
      <li><a class="sidebar-header" href="{{route('contacts')}}" ><i data-feather="mail"></i><span>{{ __('_partials/_sidebar.contacts')}}</span></a></li>
    </ul>
  </div>
</div>
<!-- Page Sidebar Ends-->
