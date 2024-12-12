<div class="container mt-5">
    <h1 class="mb-4">All Users & Blogs POST Approval</h1>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>{$error}</div>"; ?>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Post Title</th>
                <th>Post Metadata</th>
                <th>Post Content</th>
                <th>Author Name</th>
                <th>Author Email</th>
                <th>Author Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // print_r($posts);
            // echo "<br><br>";
            // print_r($users);
            // $id = 10;
            // $data = array_filter($users, function ($item) use ($id) {
            //     return $item['id'] == $id;
            // });
            // echo "<br><br>";
            // print_r($data);
            // exit();
            ?>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['post_title']) ?></td>
                    <td><?= htmlspecialchars($post['post_metadata']) ?></td>
                    <td><?= htmlspecialchars($post['post_content']) ?></td>
                    <?php $id = $post['user_id'];
                    $user = array_filter($users, function ($item) use ($id) {
                        return $item['id'] == $id;
                    });
                    $index = array_keys($user);
                    $user = $user[$index[0]];
                    //print_r($user);  
                    ?>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <?php if ($_SESSION['role'] == 'Admin') : ?>
                            <!-- <a href="/edit-user/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/delete-user/<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a> -->
                            <a href="/approve-post/<?= $post['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard" class="btn btn-primary">Back to Dashboard</a>
</div>