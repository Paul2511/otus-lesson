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
				<h1>IT Company Management System - Система уравления IT компанией</h1>
				<nav id="header-nav">@include("includes.menu")</nav>
			</div>
		</header>
		<section id="content">
			<div class="container">
				@yield("content")
			</div>
		</section>
		<footer>
			<div class="container">
				<nav id="footer-nav">@include("includes.menu")</nav>
			</div>
		</footer>
	</body>
</html>
