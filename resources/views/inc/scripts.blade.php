<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

@if ( $page_name != 'auth_default')
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@endif
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@switch($page_name)
    @case('home')
      {{-- Dashboard --}}
      <script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>
      @break

    @case('auth_default')
      {{-- Auth Lockscreen --}}
      <script src="{{asset('assets/js/authentication/form-1.js')}}"></script>
      @break


    @default
    <script>console.log('No custom script available.')</script>
@endswitch
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
