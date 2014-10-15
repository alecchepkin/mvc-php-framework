    <?php


class Home extends Controller {

  
    public function index() {

        $postModel = $this->loadModel('PostModel');
        $posts = $postModel->getAllPosts(5);


        $this->render('//post/index', array(
            'posts' => $posts
        ));
    }

    public function error404() {

        header("HTTP/1.0 404 Not Found");


        $this->render('404');
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
