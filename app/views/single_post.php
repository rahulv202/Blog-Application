<!-- Single Blog Post Container -->
<div class="container mt-5">
    <!-- Blog Post Header -->
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4"><?php echo $post['post_title'] ?></h1>
            <!-- Blog Post Title -->
            <p class="lead">By <a href="#"><?php echo $user['name']; ?></a> Email <span class="text-muted"><?php echo $user['email']; ?></span></p>
            <!-- on January 1, 2022 -->
        </div>
    </div>

    <!-- Blog Post Content -->
    <div class="row mt-4">
        <div class="col-md-12">
            <p>
                <?php echo $post['post_content'] ?>
            </p>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas faucibus mollis interdum. Aenean lacinia bibendum nulla sed consectetur.</p> -->
        </div>
    </div>

    <!-- Blog Post Footer -->
    <!-- <div class="row mt-4">
        <div class="col-md-12">
            <p class="text-muted">Tags: <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
            <p class="text-muted">Comments: <a href="#">0 Comments</a></p>
        </div>
    </div> -->
</div><!-- Single Blog Post Container -->