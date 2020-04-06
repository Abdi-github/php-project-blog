<?php

$router->define([
    //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
    '' => 'IndexController',
    'home' => 'IndexController',
    'about' => 'AboutController',
    'posts' => 'PostsController',
    'addPost' => 'PostsController@addPost',
    'post' => 'PostsController@showPost',
    'updatePost' => 'PostsController@updatePost',
    'deletePost' => 'PostsController@deletePost',

    'register' => 'UsersController@register',
    'login' => 'UsersController@login',
    'logout' => 'UsersController@logout',

]);
