<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $this->view('create_post');
    }

    public function save_post()
    {
        $title = htmlspecialchars($_POST['title']);
        $metadata = htmlspecialchars($_POST['metadata']);
        $content = htmlspecialchars($_POST['content']);

        // Save the post to the database
        $post = new Post();
        $key = ['post_title', 'post_metadata', 'post_content', 'user_id'];
        $value = [$title, $metadata, $content, $_SESSION['user_id']];
        if ($post->save($key, $value)) {
            $this->redirect('/dashboard');
        } else {
            $this->view('create_post', ['error' => 'Failed to save the post. Please try again later.']);
        }
    }
}
