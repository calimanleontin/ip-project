<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        if(Auth::check() == false)
        {
            return redirect('/auth/login')
                ->withErrors('You are not logged in');
        }

        $user = Auth::user();
        if($user->is_company())
        {
            return redirect('/')
                ->withErrors('You cannot access this link');
        }
        $profile = $user->profile;

        $uri = $_SERVER['REQUEST_URI'];
        if($uri == '/my-profile')
        {
            return view('profile.show')
                ->withProfile($profile);
        }
        else
        {
            return view('profile.edit')
                ->withProfile($profile);
        }
    }
}

