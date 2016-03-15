<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    public function account()
    {
        return view('company.account');
    }

    public function getRegister()
    {
        return view('company.register');
    }

    public function getLogin()
    {
        return view('company.login');
    }
}
