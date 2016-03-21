<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use \Response;
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
        if(Auth::check() == false)
            return view('auth.login');
        else
            return redirect('/')
                ->withErrors('You are already logged in');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        if(Auth::check() == false)
            return view('auth.register');
        else
            return redirect('/')
                ->withErrors('You are already logged in');
    }

    /**
     * @return $this
     */
    public function postRegister()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');
        $name = Input::get('username');
        $duplicate = User::where('name', $name)->first();
        if ($duplicate != null)
            return redirect('/auth/register')
                ->withErrors('Name already used');

        $email = Input::get('email');
        $duplicate = User::where('email', $email)->first();
        if ($duplicate != null)
            return redirect('/auth/register')
                ->withErrors('Email already used');

        $password = Input::get('password');
        $confirm = Input::get('confirm');
        if ($password != $confirm)
            return redirect('/auth/register')
                ->withErrors('Password does not match');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();
        Auth::login($user);
        return redirect('/')->withMessage('Register successfully');
    }

    public function postLogin()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');
        $email = Input::get('email');
        $user = User::where('email', $email)->first();
        if ($user == null)
            return redirect('/auth/register')
                ->withErrors('E-mail not found');

        $password = Input::get('password');

        if (password_verify($password, $user->password)) {

            if($user->is_company())
            {
                return redirect('/auth/login')
                    ->withErrors('You are not registered as an user');
            }

            Auth::login($user);
            return redirect('/')
                ->withMessage('Login successfully');
        } else {
            return redirect('/auth/login')
                ->with('email', $email)
                ->withErrors('Wrong Password');
        }
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        if(Auth::check() == false)
            return redirect('/')
                ->withErrors('You are not logged in');
        Auth::logout();
        return redirect('/')
            ->withMessage('Logout successfully');
    }
}