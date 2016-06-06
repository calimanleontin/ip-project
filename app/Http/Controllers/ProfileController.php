<?php

namespace App\Http\Controllers;

use \Auth;
use Illuminate\Support\Facades\Input;
use App\Profiles;
use App\User;
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

    /**
     * @return $this
     */
    public function update()
    {
        if(Auth::check() == false)
            return redirect('/auth/login')
                ->withErrors('You are not logged in');

        /**
         * @var $user User
         */
        $user = Auth::user();

        /**
         * @var $profile Profiles
         */
        $profile = $user->profile;

        $profile->firstName = Input::get('firstName');
        $profile->lastName = Input::get('lastName');
        $profile->birthday = Input::get('birthday');
        $profile->about = Input::get('about');
        $profile->sex = Input::get('sex');

        if(Input::file('avatar') != null) {
            $destinationPath = 'images/profiles';
            $originalName = Input::file('image')->getClientOriginalName();
            $fileName = date() . '.' . $originalName;
            $profile->avatar = $fileName;
            Input::file('image')->move($destinationPath, $fileName);
        }

        $profile->save();

        return redirect('/edit-profile')
            ->withMessage('Updates made successfully');
    }
}

