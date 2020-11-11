<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > About
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.about'), route('about'));
});

// Home > Price
Breadcrumbs::for('price', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.price'), route('price'));
});

// Home > Feedback
Breadcrumbs::for('feedback', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.feedback'), route('feedback'));
});


// Home > Login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.login'), route('login'));
});

// Home > Login > Reset
Breadcrumbs::for('reset', function ($trail) {
    $trail->parent('login');
    $trail->push(__('auth.forgot'), route('password.request'));
});

// Home > Register
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push(__('auth.register'), route('register'));
});

/*
// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});*/
