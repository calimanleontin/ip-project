<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use \Auth;
use App\Grades;
use \Response;

use App\Http\Requests;

class GradeController extends Controller
{
    /**
     * @param $companySlug
     * @return mixed
     */
    public function getGradeValue($companySlug)
    {
        $company = Companies::where('slug', $companySlug)->first();
        if($company == null)
        {
            return Response::json(['status' => 404]);
        }
        $average = $this->average($company->id);
        $grade = Grades::where('company_id', $company->id)->where('user_id', Auth::user()->id)->first();
        if($grade == null)
        {
            $gradeValue = 'You did not rate yet.';
        }
        else
        {
            $gradeValue = $grade->value;
        }
        return Response::json(array('status' => 200, 'value' => $average, 'myValue' => $gradeValue));
    }

    /**
     * @param $companyId
     * @param $value
     */
    public function setGradeValue($companyId, $value)
    {
        if(Auth::check() == false)
        {
            return Response::json(['status' => 404]);
        }
        $user = Auth::user();
        $company = Companies::find($companyId);

        $grade = Grades::where('user_id', $user->id)->where('company_id', $companyId)->first();
        if($grade == null)
        {
            $grade = new Grades();
            $grade->company_id = $companyId;
            $grade->user_id = $user->id;
        }
        $grade->value = $value;
        $grade->save();

        return $this->getGradeValue($company->slug);
    }

    /**
     * @param $companyId
     * @return float|int
     */
    public function average($companyId)
    {
        $grades = Grades::where('company_id', $companyId)->get();
        if($grades == null)
        {
            return -1;
        }
        $sum = 0.0;
        $count = 0;
        foreach($grades as $grade)
        {
            $sum += $grade->value;
            $count++;
        }
        return (float)$sum/$count;
    }
}
