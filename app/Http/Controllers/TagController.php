<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Tags;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use \Auth;
use \Response;

use App\Http\Requests;

class TagController extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function index()
    {
        $user = Auth::user();
        $company = Companies::find($user->company->id);
        if($company == null)
            return Response::json(array('success' => false, 'reason' => 'Company does not exist', 'error' => '404'));
        return Response::json($company->tags);
    }

    /**
     * @param $tagId
     * @param $companyId
     * @return mixed
     */
    public function assign(Request $request)
    {
        $tagId = Input::all();
        $user = Auth::user();
        $company = Companies::find($user->company->id);
        if($company == null)
            return Response::json(array('success' => false, 'reason' => 'company do not exit'));

        $tag = Tags::find($tagId);
        if($tag == null)
            return Response::json(array('success' => false, 'reason' => 'tag do not exit'));

        $tags = $company->tags;
         if(in_array($tag, $tags->all()))
             return Response::json(array('success' => false, 'reason' => 'element already in array'));

        $company->tags()->attach($tagId);
        return Response::json(array('success' => true));
    }

    /**
     * @param $tagId
     * @param $companyId
     * @return mixed
     */
    public function delete($tagId)
    {
        $user = Auth::user();
        $company = Companies::find($user->company->id);
        if($company == null)
            return Response::json(array('success' => false, 'reason' => 'company do not exit'));

        $tag = Tags::find($tagId);
        if($tag == null)
            return Response::json(array('success' => false, 'reason' => 'tag do not exit'));

        $company->tags()->detach($tagId);
        return Response::json(array('success' => true));
    }

    /**
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if(!Auth::guest() and Auth::user()->is_admin())
            return view('tags.create');
        else
            return redirect('/')
                ->withErrors('You have not sufficient permissions');
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $name = Input::get('name');
        $duplicate = Tags::where('name', $name)->first();
        $description = Input::get('description');
        if($duplicate != null)
        return view('tags.create')
                ->withErrors('Name already used')
                ->with('description', $description);
        $slug = str_slug($name);
        $tag = new Tags();
        $tag->name = $name;
        $tag->description = $description;
        $tag->slug = $slug;
        $tag->save();
        return redirect('/')->withMessage('Success');
    }
}
