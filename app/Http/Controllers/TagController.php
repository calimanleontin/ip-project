<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Tags;
use Illuminate\Http\Request;
use \Response;

use App\Http\Requests;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        return Response::json($tags);
    }

    public function assign($tagId, $companyId)
    {
        $company = Companies::find($companyId);
        if($company == null)
            return Response::json(array('success' => false));

    }

    public function delete()
    {

    }
}
