<div class="container mt-5">
    <h1 class="mb-4">All Blogs POST OF Users</h1>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>{$error}</div>"; ?>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Post Title</th>
                <th>Post Metadata</th>
                <th>Post Content</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['post_title']) ?></td>
                    <td><?= htmlspecialchars($post['post_metadata']) ?></td>
                    <td><?= htmlspecialchars($post['post_content']) ?></td>
                    <td>
                        <?php if ($post['post_approval'] == 0) : ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php else: //elseif ($post['post_approval'] == 1) : 
                        ?>
                            <span class="badge badge-success">Approved</span>
                            <?php //else : 
                            ?>
                            <!-- <span class="badge badge-danger">Rejected</span> -->
                        <?php endif; ?>
                    </td>
                    <td>

                        <a href="/user-post-edit/<?= $post['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/user-post-delete/<?= $post['id'] ?>" class="btn btn-danger btn-sm">Delete</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard" class="btn btn-primary">Back to Dashboard</a>
</div>