<?php


// load application config (error reporting etc.)
require 'protected/config/config.php';

// load application class
require 'framework/application.php';
require 'framework/controller.php';
require 'framework/helpers.php';

// start the application
$app =  App::createApplication();
$app->run();
