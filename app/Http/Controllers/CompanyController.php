<?php

namespace App\Http\Controllers;

use App\Companies;
use App\User;
use \Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Session;

use App\Http\Requests;

class CompanyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account()
    {
        return view('company.account');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('company.register');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('company.login');
    }

    /**
     * @return $this
     */
    public function postRegister()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $password = Input::get('password');
        $confirm = Input::get('confirm');
        $duplicate = User::where('name', $name)->first();
        if($duplicate != null)
            return redirect('/company/register')
                ->withErrors('Name already in use');
        $duplicate = User::where('email', $email)->first();
        if($duplicate != null)
            return redirect('/company/register')
                ->withErrors('Email already in use');
        if($password != $confirm)
            return redirect('/company/register')
                ->withErrors('Passwords did not match');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();
        Auth::login($user);


        $company = new Companies();
        $company->lat = $lat;
        $company->lng = $lng;
        $company->slug = str_slug($name);

        $user->company()->save($company);
        return redirect('/')->withMessage('Success');
    }
}
