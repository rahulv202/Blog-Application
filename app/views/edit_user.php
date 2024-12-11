<div class="container mt-5">
    <h1 class="mb-4">Edit User Details</h1>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>{$error}</div>"; ?>
    <form method="post" action="/edit-user">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($users['id']); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($users['name']); ?>" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($users['email']); ?>" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" class="form-control" value="<?php echo htmlspecialchars($users['role']); ?>" placeholder="Role" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit User Data</button>
        <a href="/user-list" class="btn btn-secondary">Back to User List</a>
    </form>
</div>