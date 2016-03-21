<?php

namespace App\Http\Controllers;

use App\Comments;
use App\User;
use App\Companies;
use Illuminate\Http\Request;
use \Auth;
use \Response;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class CommentController extends Controller
{
    /**
     * @param $slug
     * @return $this
     */
    public function show($slug)
    {
        $company = Companies::where('slug', $slug)->first();
        $comments = Comments::where('companies_id', $company->id)->with('user')->with('company')->get();
        return Response::json($comments);
    }

    /**
     * @param $company_id
     * @return mixed
     */
    public function save($company_id)
    {
        $user = Auth::user();
        if($user == null)
            return Response::json(['success' => 'false', 'reason' => 'No logged user']);

        $content = Input::get('content');
        $comment = new Comments();
        $comment->user_id = $user->id;
        $comment->companies_id = $company_id;
        $comment->content = $content;
        $comment->save();

        return Response::json(['success' => 'true']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $comment = Comments::find($id);
        if($comment == null)
        {
            return Response::json(['success' => false, 'status' => 404]);
        }

        $user = Auth::user();
        if($user == null)
            return Response::json(['success' => 'false', 'reason' => 'No user logged']);

        if($comment->user_id != $user->id and $user->is_admin() == false)
            return Response::json(['success' => 'false', 'reason' => 'Not enough permissions']);

        $comment->delete();

        return Response::json(['success' => true]);
    }
}
