<style type="text/css">
    .card-deck {
        margin: 20px;
    }

    .card {
        margin: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-weight: bold;
    }

    .card-text {
        font-size: 16px;
        color: #666;
    }

    .btn-primary {
        background-color: #337ab7;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #23527c;
    }
</style>
<?php
echo '<div class="container">';
// Create a card deck
echo '<div class="card-deck">';

// Loop through each post and create a card
foreach ($posts as $i => $post) {
    if ($i % 3 == 0) {
        echo '<div class="row">';
    }
    echo '<div class="col-md-4">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $post['post_title'] . '</h5>';
    echo '<p class="card-text">' . substr($post['post_content'], 0, 100) . '...</p>';
    echo '<a href="/' . $post['id'] . '" class="btn btn-primary">Read More</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    if (($i + 1) % 3 == 0 || $i == count($posts) - 1) {
        echo '</div>';
    }
}

// Close the card deck
echo '</div>';
echo '</div>';
