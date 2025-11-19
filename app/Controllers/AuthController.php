<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function login()
    {
        helper('form');
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/employees');
        }
        return view('auth/login');
    }

    public function attempt()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/employees');
        }

        return redirect()->back()->with('error', 'Username atau password salah')->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
