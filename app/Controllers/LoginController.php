<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    
    public function login()
    {
        helper(['form', 'url']);

        // Jika sudah login, langsung redirect
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }

        return view('login');
    }

    public function loginProcess()
    {
        $db = \Config\Database::connect();
        $username = htmlspecialchars($this->request->getPost('username'), ENT_QUOTES, 'UTF-8');
        $password = $this->request->getPost('password');

        $query = $db->table('user')->where('username', $username)->get();
        $user = $query->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            // Set session login
            session()->set([
                'isLoggedIn' => true,
                'role' => $user['role'],
                'username' => $user['username'],
            ]);

            // Redirect sesuai role
            return ($user['role'] === 'admin')
                ? redirect()->to('/admin')
                : redirect()->to('/pasien/periksa');
        }

        // Login gagal
        return redirect()->to('/login')->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
