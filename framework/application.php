<?php

class App {

    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;
    private static $_basePath;
    private static $_app;
    private static $_user;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    private function __construct() {
        
    }

    public function run() {
        session_start(); // Starting Session
        self::$_basePath = dirname(__DIR__);
        // create array with URL parts in $url
        $this->splitUrl();
        $this->initUser();
        // check for controller: does such a controller exist ?
        if (file_exists(self::$_basePath . '/protected/controller/' . $this->url_controller . '.php')) {

            // if so, then load this file and create this controller
            require self::$_basePath . '/protected/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) {

                // call the method and pass the arguments to it
                if (isset($this->url_parameter_3)) {
                    // will translate to something like $this->home->method($param_1, $param_2, $param_3);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                } elseif (isset($this->url_parameter_2)) {
                    // will translate to something like $this->home->method($param_1, $param_2);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } elseif (isset($this->url_parameter_1)) {
                    // will translate to something like $this->home->method($param_1);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1);
                } else {
                    // if no parameters given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                // default/fallback: call the index() method of a selected controller
                $this->url_controller->index();
            }
        } else {
            require self::$_basePath . '/protected/controller/home.php';
            $home = new Home();
            if (false == $this->url_controller) {
                $home->index();
            } else{
                // invalid URL, so simply show home/error
                $home->error404();
            }
        }
    }

    public static function createApplication() {
        if (null == self::$_app) {
            self::$_app = new App();
        }
        return self::$_app;
    }

    /**
     * Get and split the URL
     */
    private function splitUrl() {

        if (isset($_GET['url'])) {

            // split URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->url_controller = (isset($url[0]) ? $url[0] : null);
            $this->url_action = (isset($url[1]) ? $url[1] : null);
            $this->url_parameter_1 = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_2 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_3 = (isset($url[4]) ? $url[4] : null);
            echo '<br>';

            // echo 'Controller: ' . $this->url_controller . '<br />';
            // echo 'Action: ' . $this->url_action . '<br />';
            // echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
            // echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
            // echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
        }
    }

    public function getBasePath() {
        return self::$_basePath;
    }

    public function __get($name) {
        $getter = 'get' . $name;
        if (method_exists($this, $getter))
            return $this->$getter();
    }

    public static function get() {
        return self::$_app;
    }

    public function user() {
        return self::$_user;
    }

    public function initUser() {
        require self::$_basePath . '/protected/models/usermodel.php';
        $user = new UserModel;
        if (isset($_SESSION['login_user'])) {
            $user->username = $_SESSION['login_user'];
            $user->isGuest = false;
        }
        self::$_user = $user;
    }

}
