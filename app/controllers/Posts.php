<?php

class Posts extends Controller
{
    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->postModel = $this->model('Post');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('/posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];

            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_error'] = 'Please enter body';
            }

            // Make sure errors are empty
            if(empty($data['title_error']) && empty($data['body_error'])) {
                // Validated

                if(!$this->postModel->addPost($data)) {
                    die('Something went wrong');
                }
                flash('Post added');
                redirect('/posts');
                exit();
            }
            $this->view('posts/add', $data);
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_error' => '',
                'body_error' => '',

            ];
            $this->view('/posts/add', $data);
        }
    }
}