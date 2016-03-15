<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Auth;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @return $this
     */
    public function postRegister()
    {
        $name = Input::get('username');
        $duplicate = User::where('name', $name)->first();
        if($duplicate != null)
            return redirect('/auth/register')
                ->withErrors('Name already used');

        $email = Input::get('email');
        $duplicate = User::where('email', $email)->first();
        if($duplicate != null)
            return redirect('/auth/register')
                ->withErrors('Email already used');

        $password = Input::get('password');
        $confirm = Input::get('confirm');
        if($password != $confirm)
            return redirect('/auth/register')
                ->withErrors('Password does not match');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password,PASSWORD_BCRYPT);
        $user->save();
        Auth::login($user);
        return redirect('/')->withMessage('Register successfully');
    }


}
