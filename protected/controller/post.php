<?php

/**
 * Class Post
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Post extends Controller {

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/posts/index
     */
    public function index() {

        // load a model, perform an action, pass the returned data to a variable
        // NOTE: please write the name of the model "LikeThis"
        $postModel = $this->loadModel('PostModel');
        $posts = $postModel->getAllPosts();


        $this->render('index', array(
            'posts' => $posts
        ));
    }

    /**
     * ACTION: addPost
     * This method handles what happens when you move to http://yourproject/posts/addsong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a song" form on posts/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to posts/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function create() {
        if(App::get()->user()->isGuest){
            throw new Exception('You are not authorized for this action', '401');
        }
        
        if (isset($_POST["submit_add_post"])) {
            // load model, perform an action on the model
            $posts_model = $this->loadModel('PostModel');
            $posts_model->addPost($_POST["title"], $_POST["body"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'post/index');
    }

    /**
     * ACTION: deletePost
     * This method handles what happens when you move to http://yourproject/posts/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on posts/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to posts/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete song
     */
    public function delete($post_id) {
        if(App::get()->user()->isGuest){
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
            // load model, perform an action on the model
            $postModel = $this->loadModel('PostModel');
            $post = $postModel->getPost($post_id);
//            dump($post, 'post');
//            exit('STop ttt');
            if (!$post) {
                throw new Exception('Post not found', '404');
            }
        }


        $this->render('view', array(
            'post' => $post
        ));
    }

}
