<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    public function getLogin()
    {
        return view('auth.register');
    }

    public function getRegister()
    {
        return view('auth.register');
    }
}
