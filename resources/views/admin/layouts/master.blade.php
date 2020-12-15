<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('admin._partials._head')
    <title>@yield('title') | {{__('messages.app.name')}}</title>
    @include('admin._partials._style')
  </head>
  <body>
    <div class="page-wrapper">
      @include('admin._partials._header')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        @include('admin._partials._sidebar')
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>@yield('breadcrumb-title')</h3>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/" title="{{ __('messages.breadcrumbs.home') }}"><i data-feather="home"></i></a></li>
                      @yield('breadcrumb-item')
                    </ol>
                  </div>

                </div>
                    @yield('bookmark')
              </div>
            </div>
          </div>
          @yield('body')
        </div>
        @include('admin._partials._footer')
      </div>
    </div>
    @include('admin._partials._script')
  </body>

</html>
