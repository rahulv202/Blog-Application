<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class AdminController extends Controller
{

    public function user_list()
    {
        $users = new Users();
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['users' => $users->getAllData()]);
        } else {
            $this->view('user_list', ['users' => $users->getAllData()]);
        }
    }

    public function edit_user_by_id($id)
    {
        $user = new Users();
        if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['users' => $user->find('id', $id)]);
        } else {
            $this->view('edit_user', ['users' => $user->find('id', $id)]);
        }
    }

    public function edit_user()
    {
        $users = new Users();
        //$data = ['name' => $_POST['name'], 'email' => $_POST['email'], 'role' => $_POST['role']];
        $data = [];
        if (!empty($_POST['name'])) {
            $data['name'] = $_POST['name'];
        }
        if (!empty($_POST['email'])) {
            $data['email'] = $_POST['email'];
        }
        if (!empty($_POST['role'])) {
            $data['role'] = $_POST['role'];
        }
        if (!empty($users->update($data, $_POST['id']))) {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'User Data Updated successful']);
            } else {
                $this->redirect('/user-list');
                // header('Location: /user-list');
                // exit();
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'User Data Not Updated']);
            } else {
                $this->view('/edit-user/' . $_POST['id'], ['error' => 'User Data Not Updated']);
            }
        }
    }

    public function delete_user_by_id($id)
    {
        $users = new Users();
        if ($users->delete($id)) {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'User Deleted successful']);
            } else {
                $this->redirect('/user-list');
                // header('Location: /user-list');
                // exit();
            }
        } else {
            if (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'User Not Deleted']);
            } else {
                $this->view('/user-list', ['error' => 'User Not Deleted']);
            }
        }
    }
}
