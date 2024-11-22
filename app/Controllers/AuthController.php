<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function register()
    {
        helper(['form', 'url']);

        // Validasi form
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $rules = [
                'username' => 'required|is_unique[user.username]',
                'email' => 'required|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                // Jika validasi gagal
                return view('register', ['validation' => $this->validator]);
            }

            // Hash password dan simpan user
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $userModel = new UserModel();

            $userModel->save([
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $password,
                'role' => 'user', // Default role
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/login');
        }

        return view('register');
    }

    public function login()
    {
        helper(['form', 'url']);

        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin'); // Atur redirect sesuai kebutuhan
        }

        return view('login');
        // helper(['form', 'url']);

        // // Cek jika sudah login
        // if (session()->get('isLoggedIn')) {
        //     return redirect()->to('/dashboard'); // Ganti dengan route dashboard jika perlu
        // }

        // // Proses login
        // if ($this->request->getMethod() === 'post') {
        //     $validation = \Config\Services::validation();

        //     $rules = [
        //         'username' => 'required',
        //         'password' => 'required',
        //     ];

        //     if (!$this->validate($rules)) {
        //         return view('login', ['validation' => $this->validator]);
        //     }

        //     // Validasi kredensial login
        //     $userModel = new UserModel();
        //     $user = $userModel->where('username', $this->request->getPost('username'))->first();

        //     if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
        //         session()->set([
        //             'isLoggedIn' => true,
        //             'username' => $user['username'],
        //             'role' => $user['role'],
        //         ]);

        //         return redirect()->to('/dashboard');
        //     } else {
        //         session()->setFlashdata('error', 'Invalid login credentials');
        //         return redirect()->to('/login');
        //     }
        // }

        // return view('login');
    }

    public function loginProcess()
    {
        helper(['form', 'url']);

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                return view('login', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $user = $userModel->where('username', $this->request->getPost('username'))->first();

            if (!$user) {
                session()->setFlashdata('error', 'Username tidak ditemukan.');
                return redirect()->to('/login');
            }

            if (!password_verify($this->request->getPost('password'), $user['password'])) {
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->to('/login');
            }

            session()->set([
                'isLoggedIn' => true,
                'username' => $user['username'],
                'role' => $user['role'],
            ]);

            return redirect()->to('/index'); 
        }

        return redirect()->to('/login');
    }


    public function logout()
    {
        session()->destroy();  // Menghancurkan session
        return redirect()->to('/login');  // Redirect ke halaman login setelah logout
    }
}
