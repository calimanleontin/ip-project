<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Tags;
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
        {
            return redirect('/company/register')
                ->withErrors('Name already in use');
        }
        $duplicate = User::where('email', $email)->first();
        if($duplicate != null)
        {
            return redirect('/company/register')
                ->withErrors('Email already in use');
        }
        if($password != $confirm)
        {
            return redirect('/company/register')
                ->withErrors('Passwords did not match');
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();
        Auth::login($user);

        $company = new Companies();
        $company->name = $name;
        $company->lat = $lat;
        $company->lng = $lng;
        $company->slug = str_slug($name);

        $user->company()->save($company);
        return redirect('/')->withMessage('Success');
    }

    /**
     * @return $this
     */
    public function postLogin()
    {
        $email = Input::get('email');
        $user = User::where('email', $email)->first();
        if ($user == null)
        {
            return redirect('/auth/register')
                ->withErrors('E-mail not found');
        }

        $password = Input::get('password');

        if (password_verify($password, $user->password)) {

            if($user->is_company() == false)
            {
                return redirect('/company/login')
                    ->withErrors('You do not have a company');
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
     * @return $this
     */
    public function edit()
    {
        if(!Auth::guest() and Auth::user()->is_company())
        {
            $user = Auth::user();
            if($user->is_company())
            {
                $company = $user->company;
                $tags = Tags::all();
                return view('company.edit')
                    ->withUser($user)
                    ->withCompany($company)
                    ->withTags($tags);
            }
            else
            {
                return redirect('/')->withErrors('Error');
            }
        }
        else
        {
            return redirect('/')->withErrors('Error');
        }
    }

    public function update()
    {
        $user = Auth::user();
        if($user == null or $user->is_company() == false)
        {
            return redirect('/company/login')
                ->withErrors('You have not sufficient permissions');
        }
        $name = Input::get('name');
        $description = Input::get('description');
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $company = $user->company;

        $company->name = $name;
        $company->description = $description;
        $company->lat = $lat;
        $company->lng = $lng;

        if(Input::file('image') != null) {
            $destinationPath = 'images/companies'; // upload path
            $extension = Input::file('image')->getClientOriginalName(); // getting image name
            $fileName = time() . '.' . $extension; // renameing image
            $company->image = $fileName;
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        }

        $company->save();
        $user->company()->save($company);

        return redirect('/company/edit')
            ->withMessage('Success');
    }

}
