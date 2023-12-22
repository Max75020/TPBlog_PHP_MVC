<?php

namespace App\Controllers\Front;

use \Core\Controller;
use \App\Models\Blog;

class ProfileController extends Controller
{
    public function index()
    {
        if ($this->userIsConnected()) {
            $this->render('Layout/main', 'Front/profile', [
                'user' => $this->session->get('user'),
            ]);
        } else {
            header('location:' . ROOT_URL . '/login');
            exit();
        }
    }
}
