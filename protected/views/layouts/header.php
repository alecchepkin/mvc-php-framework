<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Blog</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css -->
        <link href="<?php echo URL; ?>assets/css/style.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <!-- our JavaScript -->
        <script src="<?php echo URL; ?>assets/js/script.js"></script>
    </head>
    <body>
        <!-- header -->
        <div class="container">
            <!-- Info -->
            <h1>Blog</h1>
            <!-- navigation -->
            <h3>Navigation</h3>
            <div class="navigation">
                <ul>
                    <li><a href="<?php echo URL; ?>">Home</a></li>
                    <?php if (App::get()->user()->isGuest): ?>
                        <li><a href="<?php echo URL; ?>home/login">Login</a></li>
                    <?php else: ?>
                        <li>Hello, <?php echo App::get()->user()->username?> <a href="<?php echo URL; ?>home/logout">Logout</a></li>
                    <?php endif; ?>
                </ul>
                
                <?php //print_r($_SESSION);?>
            </div>
            <div id="javascript-header-demo-box">
            </div>
        </div>
