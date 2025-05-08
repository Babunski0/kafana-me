<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ]);

            return redirect()->to(base_url('dashboard'))->with('success', 'Uspešno ste se prijavili.');
        }

        // Pogrešan username ili lozinka
        return redirect()->back()->withInput()->with('error', 'Pogrešan username ili lozinka.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $validation = \Config\Services::validation();
        $userModel = new UserModel();

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user',
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Uspešna registracija. Možete se prijaviti.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Uspešno ste se odjavili.');
    }
}
