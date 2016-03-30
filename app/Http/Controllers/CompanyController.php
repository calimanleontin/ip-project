<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Tags;
use App\User;
use \Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use \Session;
use \Response;

use App\Http\Requests;

class CompanyController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');

        return view('company.account');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');

        return view('company.register');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');

        return view('company.login');
    }

    /**
     * @return $this
     */
    public function postRegister()
    {
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');

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
        if(Auth::check() == true)
            return redirect('/')
                ->withErrors('You are already logged in');

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

    /**
     * @return $this
     */
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
            $fileName = time() . '.' . $extension; // renaming image
            $company->image = $fileName;
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
        }

        $company->save();
        $user->company()->save($company);

        return redirect('/company/edit')
            ->withMessage('Success');
    }

    /**
     * @param $slug
     * @return $this
     */
    public function show($slug)
    {
        $company = Companies::where('slug', $slug)->first();
        if($company == null)
            return redirect('/')
                ->withErrors('No company with that name');

        return view('company.show')
            ->withCompany($company);
    }

    /**
     * @param $companyId
     * @return mixed
     */
    public function getLocation($companyId)
    {
        $company = Companies::find($companyId);
        if($company == null)
            return Response::json(['status' => 404]);
        $lat = $company->lat;
        $lng = $company->lng;
        if($lat == null or $lng == null)
            return Response::json(['status' => 500]);

        return Response::json(['status' => 200, 'lat' => $lat, 'lng' => $lng]);
    }

    /**
     * @param $initialLat
     * @param $initialLong
     * @param $finalLat
     * @param $finalLong
     * @return int
     */
    function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /**
     * @param $maxDistance
     * @param $distance
     * @return bool
     */
    public function checkLocation($maxDistance, $distance)
    {
        return ($maxDistance <= $distance);
    }

    /**
     * @return $this
     */
    public function search()
    {
        $expression = Input::get('q');
        $distance = Input::get('distance');
        $initialLat = Session::get('lat');
        $initialLng = Session::get('lng');


        $expression = explode(' ', $expression);

        $companies = array();

        foreach ($expression as $item) {
            $matchedCompanies = Companies::where('name', 'like', '%' . $item . '%')->get();
            foreach($matchedCompanies as $company)
            {
                if(!in_array($company, $companies))
                {
                    $maxDistance = $this->calculateDistance($initialLat, $initialLng, $company->lat, $company->lng);

                    if($this->checkLocation($maxDistance, $distance))
                    {
                        $companies[] = $company;
                    }
                }
            }
        }
        foreach ($expression as $item) {
            $tags = Tags::where('name', 'like', '%' . $item . '%')->get();
            foreach ($tags as $tag) {
                $companiesFromTags = $tag->companies;
                foreach($companiesFromTags as $company)
                {
                    if(!in_array($company, $companies))
                    {
                        $maxDistance = $this->calculateDistance($initialLat, $initialLng, $company->lat, $company->lng);
                        if($this->checkDistance($maxDistance, $distance))
                        {
                            $companies[] = $company;
                        }
                    }
                }
            }
            return view('home')
                ->with('companies', $companies)
                ->withTitle('Search Result');
        }
    }

    /**
     * @return mixed
     */
    public function getSearchData()
    {
        $term = Input::get('term');
        $companies = DB::table('companies')->where('name', 'like', '%' . $term . '%')->lists('name');
        $tags = DB::table('tags')->where('name', 'like', '%' . $term . '%')->lists('name');
        $data = array_merge($companies, $tags);
        return Response::json($data);
    }
}
