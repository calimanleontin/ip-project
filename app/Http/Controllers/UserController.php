<?php

namespace App\Http\Controllers;

use App\Profiles;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use \Response;
use App\Companies;
use Illuminate\Support\Facades\Input;
use \Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = Companies::all();
        return view('home')
            ->withCompanies($companies);
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
        $profile = new Profiles();
        $profile->user_id = $user->id;
        $profile->save();
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

    /**
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        if(Auth::check() == false)
            return redirect('/auth/login')
                ->withErrors('You are not logged in');

        return view('auth.change');
    }

    public function updatePassword()
    {
        if (Auth::check() == false)
            return redirect('/auth/login')
                ->withErrors('You are not logged in');

        /**
         * @var $user User
         */
        $user = Auth::user();
        $actualPassword = Input::get('actualPassword');
        $newPassword = Input::get('newPassword');
        $confirm = Input::get('confirmPassword');

        if (!password_verify($actualPassword, $user->password))
        {
            return redirect('/auth/change-password')
                ->withErrors('Wrong Password');
        }

        if($newPassword == $confirm and $newPassword != '')
        {
            $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
            $user->save();
            return redirect('/my-profile')
                ->withMessage('Success');
        }
        return redirect('/auth/change-password')
            ->withErrors('Passwords do not match');
    }

    /**
     * @return mixed
     */
    public function saveLocation()
    {
        try {
            $uri = $_SERVER['REQUEST_URI'];
            $latLng = explode('/', $uri);
            $lat = $latLng[sizeof($latLng) - 2];
            $lng = $latLng[sizeof($latLng) - 1];
            Session::put('lat', $lat);
            Session::put('lng', $lng);
            return Response::json(['status' => 200]);
        }
        catch(Exception $e){
            return Response::json(['status' => 500]);
        }
    }

    /**
     * @return bool
     */
    public function apiLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::where('email', $email)->first();

        if (password_verify($password, $user->password))
        {
            if ($user->is_company())
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
}