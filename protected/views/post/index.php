
<div>
    <h3>Posts</h3>
    <h3>List of posts</h3>
    <?php foreach ($posts as $post) { ?>
        <div>
            <div>Post #<?php if (isset($post->id)) echo $post->id; ?></div>
            <div>Date: <?php if (isset($post->date_created)) echo $post->date_created; ?></div>
            <div>Title: <?php if (isset($post->title)) echo $post->title; ?></div>
            <div>Body: <?php if (isset($post->body)) echo substr($post->body, 0, 100); ?> ...</div>
            <div><a href="<?php echo URL . 'post/view/' . $post->id; ?>">View Post</a></div>
            <?php if (false == App::get()->user()->isGuest): ?>
                <div><a href="<?php echo URL . 'post/delete/' . $post->id; ?>">Delete Post</a></div>
            <?php endif; ?>

        </div>
        <br>
    <?php } ?>
</div>

