<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users;

class AdminController extends Controller
{

    public function user_list()
    {
        $users = new Users();
        $this->view('user_list', ['users' => $users->getAllData()]);
    }

    public function edit_user_by_id($id)
    {
        $user = new Users();
        $this->view('edit_user', ['users' => $user->find('id', $id)]);
    }

    public function edit_user()
    {
        $users = new Users();
        $data = ['name' => $_POST['name'], 'email' => $_POST['email'], 'role' => $_POST['role']];
        if (!empty($users->update($data, $_POST['id']))) {
            $this->redirect('/user-list');
            // header('Location: /user-list');
            // exit();
        } else {
            $this->view('/edit-user/' . $_POST['id'], ['error' => 'User Data Not Updated']);
        }
    }
}
