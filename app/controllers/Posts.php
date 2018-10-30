<?php

class Posts extends Controller
{
    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
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

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'id' => $id,
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

                if(!$this->postModel->updatePost($data)) {
                    die('Something went wrong');
                }
                flash('Post Updated');
                redirect('/posts');
                exit();
            }
            $this->view('posts/edit', $data);
        } else {
            // Get existing post frm model
            $post = $this->postModel->find($id);

            // Check for owner
            if($post->user_id != $_SESSION['user_id']) {
                redirect('/posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_error' => '',
                'body_error' => '',

            ];
            $this->view('/posts/edit', $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->find($id);
        if(empty($post)) {
            redirect('/posts');
        }
        $data = [
            'post' => $post,
            'user' => $this->userModel->find($post->user_id)
        ];
        $this->view('/posts/show', $data);
    }
}