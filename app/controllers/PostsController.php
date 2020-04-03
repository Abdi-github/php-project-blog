<?php

require "app/models/Post.php";

class PostsController
{
    public function __construct()
    {

        if (!isLoggedIn()) {
            Helper::redirect('login');
        }
    }

    public function index()
    {

        $posts = Post::getPosts();

        return Helper::view('posts', ['posts' => $posts]);
    }

    public function showPost()
    {

        if (isset($_GET["id"]) && ctype_digit($_GET["id"])) {
            $post = Post::fetchById($_GET["id"]);

            if ($post == null) {
                // raising an exception maybe not the best solution
                throw new Exception("POST NOT FOUND.", 1);
            }
        } else {
            throw new Exception("POST NOT FOUND.", 1);
        }

        return Helper::view("showPost", [
            'post' => $post,
        ]);
    }

    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'content_err' => '',
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['content'])) {
                $data['content_err'] = 'Please enter content text';
            }
            if (strlen($data['title']) > 255) {

                $data['title_err'] = 'The title can not be longer than 255  characters';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['content_err'])) {
                // Validated
                if ((isset($_POST['title'])) & (isset($_POST['content']))) {
                    Post::addPost($_POST['title'], $_POST['content'], $_SESSION['user_id']);
                    Helper::redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                return Helper::view('addPost', $data);
            }

        } else {
            $data = [
                'title' => '',
                'content' => '',
            ];

            Helper::view('addPost', $data);
        }
    }

    public function editPost()
    {
        if (isset($_GET["id"]) && ctype_digit($_GET["id"])) {
            $post = Post::fetchById($_GET["id"]);

            if ($post == null) {
                // raising an exception maybe not the best solution
                throw new Exception("ARTICLE NOT FOUND.", 1);
            }
        } else {
            throw new Exception("POST NOT FOUND.", 1);
        }

        return Helper::view("editPost", [
            'currentPost' => $post,
        ]);

    }

}
