<?php

require "app/models/Post.php";

class PostsController   {
    public function index(){

        $posts = Post::getPosts();


        return Helper::view('posts', ['posts' => $posts]);
    }

    public  function  addPost() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
// Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                // 'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['content'])) {
                $data['content_err'] = 'Please enter content text';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['content_err'])) {
                // Validated
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                return Helper::view('addPost', $data);
            }
        }
            else {
                $data = [
                    'title' => '',
                    'content' => ''
                ];

                return Helper::view('addPost', $data);
            }
        }


    }





