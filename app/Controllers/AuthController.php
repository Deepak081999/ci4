<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{

    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $userModel = new UserModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ]);

        if (! $this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), 'created_at' => date('Y-m-d H:i:s'),
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    public function login()
    {
        $session = \Config\Services::session();

        if (session()->has('user')) {
            return redirect()->to('/song_page');
        }
        return view('auth/login');
    }

    public function checkLogin()
    {
        // If user is already logged in, redirect to the song page
        if (session()->has('user')) {
            return redirect()->to('/song_page');
        }

        $userModel = new UserModel();
        $email     = $this->request->getPost('email');
        $password  = $this->request->getPost('password');

        $user = $userModel->getUserByEmail($email);

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }

        // Set user session upon successful login
        session()->set('user', $user);

        return redirect()->to('/song_page');
    }

    public function logout()
    {
        // Destroy the session and redirect to login with a success message
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }

}
