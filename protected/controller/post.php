<?php


class Post extends Controller {

    public function index() {

        $postModel = $this->loadModel('PostModel');
        $posts = $postModel->getAllPosts();


        $this->render('index', array(
            'posts' => $posts
        ));
    }


    public function create() {
        if (App::get()->user()->isGuest) {
            throw new Exception('You are not authorized for this action', '401');
        }
        $postModel = $this->loadModel('PostModel');
        if (isset($_POST["submit_add_post"])) {
            $posts_model = $this->loadModel('PostModel');
            $posts_model->addPost($_POST["title"], $_POST["body"]);
            header('location: ' . URL . 'post/index');
        }
        $this->render('create', array('post' => $postModel));
    }

    public function update($post_id) {
        if (App::get()->user()->isGuest) {
            throw new Exception('You are not authorized for this action', '401');
        }
        $postModel = $this->loadModel('PostModel');
        $post = $postModel->getPost($post_id);
        if (null == $post) {
            throw new Exception('Post not found', '404');
        }
        if (isset($_POST["submit_add_post"])) {
            $postModel->addPost($_POST["title"], $_POST["body"]);
            // where to go after song has been added
            header('location: ' . URL . 'post/index');
        }

        $this->render('update', array('post' => $post));
    }

    public function delete($post_id) {
        if (App::get()->user()->isGuest) {
            throw new Exception('You are not authorized for this action', '401');
        }
        if (isset($post_id)) {
            // load model, perform an action on the model
            $posts_model = $this->loadModel('PostModel');
            $posts_model->deletePost($post_id);
        }

        header('location: ' . URL . 'post/index');
    }

    public function view($post_id) {

        $post_id = (int) $post_id;
        if ($post_id) {
            $postModel = $this->loadModel('PostModel');
            $post = $postModel->getPost($post_id);
            if (!$post) {
                throw new Exception('Post not found', '404');
            }
        }

        $this->render('view', array(
            'post' => $post
        ));
    }

}
