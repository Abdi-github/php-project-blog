<?php

$router->define([
    //'' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
    '' => 'IndexController',
    'home' => 'IndexController',
    'about' => 'AboutController',
    'posts' => 'PostsController',
    'addPost' => 'PostsController@addPost',
    'post' => 'PostsController@showPost',
    'editPost' => 'PostsController@editPost',
    'updatePost' => 'PostsController@updatePost',
    'deletePost' => 'PostsController@deletePost',

    'register' => 'UsersController@register',
    'login' => 'UsersController@login',
    'logout' => 'UsersController@logout',
    /*
'index' => 'IndexController',
'about' => 'AboutController',
'tasks' => 'TaskController',
'task' => 'TaskController@show',
'add_task' => 'TaskController@showAddView',
'parse_add_form' => 'TaskController@parseInput'
 */
]);
