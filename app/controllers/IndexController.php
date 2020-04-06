<?php

class IndexController
{
    public function index()
    {
        // return Helper::view("index");
        Helper::redirect('posts');
    }

}
