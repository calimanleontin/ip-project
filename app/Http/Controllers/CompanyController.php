<?php

namespace App\Http\Controllers;

use App\Companies;
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

    public function postRegister()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $password = Input::get('password');
        $confirm = Input::get('confirm');
        $duplicate = Companies::where('name', $name)->first();
        if($duplicate != null)
            return redirect('/company/register')
                ->withErrors('Name already in use');
        $duplicate = Companies::where('email', $email)->first();
        if($duplicate != null)
            return redirect('/company/register')
                ->withErrors('Email already in use');
        if($password != $confirm)
            return redirect('/company/register')
                ->withErrors('Passwords did not match');

        $company = new Companies();
        $company->name = $name;
        $company->email = $email;
        $company->lat = $lat;
        $company->lng = $lng;
        $company->password = password_hash($password, PASSWORD_BCRYPT);
        $company->save();
        Session::put('company', $company);
        return redirect('/')->withMessage('Success');
    }
}
