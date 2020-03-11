<?php

class AboutController
{

    public function index()
    {
     $appName = "Social Post Share";
     $description = "Application used to creating, updating, adding and deleting social posts.";

        return Helper::view("about", ['appName' => $appName, 'description' =>$description]);


    }

}
