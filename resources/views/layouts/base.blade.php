<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield("Title")</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <script src="{{mix('/js/app.js')}}"></script>
</head>
<body>
<header>
    <div class="container">
        <h1>@lang('contacts.system_description')</h1>
        <nav id="header-nav">@include("blocks.menu")</nav>
    </div>
</header>
<section id="content">
    <div class="container">
        @yield("content")
    </div>
</section>
</body>
</html>
