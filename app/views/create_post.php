<div class="container mt-5">
    <h2>Create a New Blog Post</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>{$error}</div>"; ?>
    <form action="/save_post" method="POST">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="metadata">Metadata</label>
            <input type="text" class="form-control" id="metadata" name="metadata" required>
        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Post</button>
    </form>
</div>