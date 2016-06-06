<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Campaign;

class CampaignsController extends Controller
{
  function getCreate(Request $request) {
    return view('campaigns/create');
  }

  function postCreate(Request $request) {
    $user = \Auth::user();
    $company = $user->company;
    $campaign = new Campaign;
    $campaign->company_id = $company->id;
    $campaign->title = $request->get('title');
    $campaign->start = $request->get('start_date');
    $campaign->end = $request->get('end_date');
    $campaign->save();
    return redirect('campaigns/' . $campaign->getAttribute('id'));
  }

  function viewEntity($id, Request $request) {
    $campaign = Campaign::find($id);
    return view('campaigns/viewEntity')->with('campaign', $campaign);
  }

  function campaignsListing(Request $request) {
    $campaigns = Campaign::all();
    return view('campaigns/listing')->with('campaigns', $campaigns);
  }
}
