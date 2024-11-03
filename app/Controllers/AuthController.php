<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    public function __construct() {
        $db = db_connect();
        $this->userModel = new UserModel($db);
    }
    public function viewLogin(){
        if (session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }
        return view('login');
    }
    public function viewRegister(){
        return view('register');
    }
    public function save()
    {
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');
        $phone = $this->request->getPost('phone_number');

        $data = [
            'email'    => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'user',
            'phone_number' => $phone
        ];

        $this->userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    public function checkLogin()
{
    $session = session();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $role = $this->request->getPost('role');

    $user = $this->userModel->where('email', $email)->first();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            if ($role === $user['role']) {
                $sessionData = [
                    'userId'   => $user['id'],
                    'email'    => $user['email'],
                    'username' => $user['username'],
                    'phone_number' => $user['phone_number'],
                    'role'     => $user['role'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);

                if ($role === 'admin') {
                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->to('/');
                }
            } else {
                return redirect()->back()->with('error', 'Peran tidak cocok.');
            }
        } else {
            return redirect()->back()->with('error', 'Password salah.');
        }
    } else {
        return redirect()->back()->with('error', 'Email tidak ditemukan.');
    }
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
