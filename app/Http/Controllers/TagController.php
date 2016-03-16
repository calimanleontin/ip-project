<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Tags;
use Illuminate\Http\Request;
use \Response;

use App\Http\Requests;

class TagController extends Controller
{
    public function index($id)
    {
        $company = Companies::find($id);
        return Response::json($company->tags);
    }

    public function assign($tagId, $companyId)
    {
        $company = Companies::find($companyId);
        if($company == null)
            return Response::json(array('success' => false, 'reason' => 'company do not exit'));

        $tag = Tags::find($tagId);
        if($tag == null)
            return Response::json(array('success' => false, 'reason' => 'tag do not exit'));

        $company->tags()->attach($tagId);
        return Response::json(array('success' => true));


    }

    public function delete($tagId, $companyId)
    {
        $company = Companies::find($companyId);
        if($company == null)
            return Response::json(array('success' => false, 'reason' => 'company do not exit'));

        $tag = Tags::find($tagId);
        if($tag == null)
            return Response::json(array('success' => false, 'reason' => 'tag do not exit'));

        $company->tags()->detach($tagId);
        return Response::json(array('success' => true));
    }
}
