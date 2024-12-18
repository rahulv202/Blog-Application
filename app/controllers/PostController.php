<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;
use App\Models\Users;

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

    public function all_post_list()
    {
        $post = new Post();
        $posts = $post->getAllData('post_approval=0');
        $users = new Users();
        $user = $users->getAllData();
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['posts' => $posts, 'users' => $user]);
        } else {
            $this->view('all_post_list', ['posts' => $posts, 'users' => $user]);
        }
    }

    public function approve_post($id)
    {
        $post = new Post();
        $data = ['post_approval' => 1];
        if ($post->update($data, $id)) {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Post Approved successful']);
            } else {
                $this->redirect('/all-post-list');
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Post Not Approved']);
            } else {
                $this->view('/all-post-list', ['error' => 'Post Not Approved']);
            }
        }
    }

    public function user_post_manage()
    {
        $post = new Post();
        $posts = $post->getAllData('user_id=' . $_SESSION['user_id']);
        $this->view('user_post_manage', ['posts' => $posts]);
    }

    public function user_post_edit($id)
    {
        $post = new Post();
        $post_data = $post->find('id', $id);
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['post_data' => $post_data]);
        } else {
            $this->view('user_post_edit', ['post_data' => $post_data]);
        }
    }

    public function update_user_post()
    {
        $title = htmlspecialchars($_POST['title']);
        $metadata = htmlspecialchars($_POST['metadata']);
        $content = htmlspecialchars($_POST['content']);
        $post_id = htmlspecialchars($_POST['post_id']);
        $data = ['post_title' => $title, 'post_metadata' => $metadata, 'post_content' => $content, 'post_approval' => 0];
        $post = new Post();
        if ($post->update($data, $post_id)) {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Post Updated successful']);
            } else {
                $this->redirect('/user-post-manage');
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Post Not Updated']);
            } else {
                $this->view('/user-post-edit/' . $post_id, ['error' => 'Post Not Updated']);
            }
        }
    }

    public function user_post_delete($id)
    {
        $post = new Post();
        if ($post->delete($id)) {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Post Deleted successful']);
            } else {
                $this->redirect('/user-post-manage');
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Post Not Deleted']);
            } else {
                $this->view('/user-post-edit/' . $id, ['error' => 'Post Not Deleted']);
            }
        }
    }
}
