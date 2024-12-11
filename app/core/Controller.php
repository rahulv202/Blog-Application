<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        // echo  APP_Root . "/app/views/$view.php";
        // exit();
        require_once APP_Root . "/app/views/header.php";
        require_once APP_Root . "/app/views/$view.php";
        require_once APP_Root . "/app/views/footer.php";
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}
