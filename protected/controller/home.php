<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller {

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {

        require App::get()->basePath . '/protected/controller/post.php';
        $post = new Post();
        $post->index();
    }

    public function login() {

        $error = ''; // Variable To Store Error Message
        if (isset($_POST['UserLoginForm']['username']) && isset($_POST['UserLoginForm']['password'])) {
            if (empty($_POST['UserLoginForm']['username']) || empty($_POST['UserLoginForm']['password'])) {
                $error = "Username or Password is invalid1";
            } else {
                // Define $username and $password
                $username = $_POST['UserLoginForm']['username'];
                $password = $_POST['UserLoginForm']['password'];
                // To protect MySQL injection for Security purpose
                $username = stripslashes($username);
                $password = stripslashes($password);
                // Establishing Connection with Server by passing server_name, user_id and password as a parameter

                if ($username == USERNAME && $password == PASSWORD) {
                    $_SESSION['login_user'] = $username; // Initializing Session
                    header("location: " . URL); // Redirecting To Other Page
                } else {
                    $error = "Username or Password is invalid2";
                }
            }
        }



        $this->render('login', array(
            'error' => $error,
        ));
    }

    public function logout() {
        if (session_destroy()) { // Destroying All Sessions
            header("Location:" . URL); // Redirecting To Home Page
        }
    }

}
