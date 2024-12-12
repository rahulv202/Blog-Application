<div class="container mt-5">
    <h2>Update User Blog Post</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>{$error}</div>"; ?>
    <form action="/update_user_post" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post_data['id'] ?>">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="<?php echo $post_data['post_title'] ?>">
        </div>
        <div class="form-group">
            <label for="metadata">Metadata</label>
            <input type="text" class="form-control" id="metadata" name="metadata" required value="<?php echo $post_data['post_metadata'] ?>">
        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $post_data['post_content'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>