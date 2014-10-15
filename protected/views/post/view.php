<h1>View Post</h1>
<div>Post #<?php if (isset($post->id)) echo $post->id; ?></div>
<div>Date: <?php if (isset($post->date_created)) echo $post->date_created; ?></div>
<div>Title: <?php if (isset($post->title)) echo $post->title; ?></div>
<div>Body: <?php if (isset($post->body)) echo $post->body; ?></div>
<?php if (false == App::get()->user()->isGuest): ?>
    <div><a href="<?php echo URL . 'post/delete/' . $post->id; ?>">Delete Post</a></div>
<?php endif; ?>

