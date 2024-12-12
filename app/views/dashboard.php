<div class="container mt-5">
    <h1 class="mb-4">Welcome, <?= htmlspecialchars($users['name']) ?></h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($users['email']) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($users['role']) ?></p>

    <?php if ($users['role'] == 'Admin') : ?>
        <p><a href="/user-list" class="btn btn-info">User List Panel</a></p>
        <p><a href="/all-post-list" class="btn btn-info">All Post Manage Panel</a></p>
    <?php endif; ?>
    <p><a href="/user-post-manage" class="btn btn-info">Post Manage</a></p>
    <p><a href="/user-post" class="btn btn-info">Create Post</a></p>

    <a href="/logout" class="btn btn-danger">Logout</a>
</div>