<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/loader.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

@if ( $page_name != 'auth_default')
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
@endif
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@switch($page_name)
    @case('home')
      {{-- Dashboard --}}
<link href="{{asset('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
      @break

    @case('auth_default')
      {{-- Auth Lockscreen  --}}
      <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
      @break


    @case('profile')
      {{-- User Profile --}}
      <link href="{{asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
      @break

    @default
        <script>console.log('No custom Styles available.')</script>
@endswitch
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
