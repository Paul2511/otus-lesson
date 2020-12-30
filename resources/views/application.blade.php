<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PurrPurr Care</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset(mix('css/main.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/iconfont.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/material-icons/material-icons.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/vuesax.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/prism-tomorrow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
  </head>
  <body>
    <noscript>
      <strong><?= trans('main.noscript') ?></strong>
    </noscript>
    <div id="app">
    </div>

    <?php
    $data = $data ?? [];
    $data = json_encode($data);
    $data = preg_replace("_\\\_", "\\\\\\", $data);
    $data = preg_replace("/\"/", "\\\"", $data);
    ?>

    @if(isset($data))
        <script>
            window.appParams = JSON.parse("{!!$data!!}");
        </script>
    @endif

    <script src="{{ asset(mix('js/app.js')) }}"></script>

  </body>
</html>
