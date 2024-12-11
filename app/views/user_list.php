<div class="container mt-5">
    <h1 class="mb-4">All Users</h1>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <?php if ($user['role'] != 'Admin') : ?>
                            <a href="/edit-user/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/delete-user/<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard" class="btn btn-primary">Back to Dashboard</a>
</div>