<div>
    <h3>Add a post</h3>
    <form action="<?php echo URL; ?>post/create" method="POST">
        <div class="row">
            <label>Title</label>
            <input type="text" name="title" value="<?= isset($post->title) ? $post->title : '' ?>" required maxlength="50"/>
        </div>
        <div class="row">

            <label>Track</label>
            <textarea type="text" name="body" rows="5" cols="50" required /><?= isset($post->body) ? $post->body : '' ?></textarea>
        </div>
        <div class="row">

            <input type="submit" name="submit_add_post" value="Submit" />
        </div>
    </form>
</div>