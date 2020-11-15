<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@include('layout.header.index')
<div class="container">
    @yield('content')
</div>
</body>
</html>
