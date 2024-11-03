<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function viewLogin(): string
    {
        return view('login');
    }

    public function viewRegister(): string
    {
        return view('register');
    }
}
