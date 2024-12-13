<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;
use App\Models\Users;

class HomeController extends Controller
{
    public function index()
    {
        $post = new Post();
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['posts' => $post->getAllData('post_approval=1')]);
        } else {
            $this->view('home', ['posts' => $post->getAllData('post_approval=1')]);
        }
    }

    public function get_post_by_id($post_id)
    {
        $post = new Post();
        $user = new Users();
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['post' => $post->find('id', $post_id), 'user' => $user->find('id', (($post->find('id', $post_id))['user_id']))]);
        } else {
            $this->view('single_post', ['post' => $post->find('id', $post_id), 'user' => $user->find('id', (($post->find('id', $post_id))['user_id']))]);
        }
    }
}
