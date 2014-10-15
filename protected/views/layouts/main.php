<?php
require App::get()->basePath . '/protected/views/layouts/header' . '.php';
?>
<div class="container">
    <?php echo $content; ?>
</div>

<?php
require App::get()->basePath . '/protected/views/layouts/footer' . '.php';

