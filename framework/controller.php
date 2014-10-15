<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller {

    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct() {
        $this->openDatabaseConnection();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection() {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    public function loadModel($model_name) {
        require_once App::get()->basePath . '/protected/models/' . strtolower($model_name) . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }

    public function render($view, $params = array()) {
        
        extract($params);
        ob_start();
        $this->renderPartial($view, $params);
        $content = ob_get_contents();
        ob_end_clean();
        require App::get()->basePath . '/protected/views/layouts/main.php';

    }
    public function renderPartial($view, $params = array()) {
        if(stripos($view, '//')===0){
            $route = substr($view, 2);
        } else{
            $route = strtolower(get_class($this)) . '/' . $view ;
        }
        extract($params);
        require App::get()->basePath . '/protected/views/' . $route . '.php';

    }

}
