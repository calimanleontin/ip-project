<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CampaignsController extends Controller
{
  function getCreate(Request $request) {
    return view('campaigns/create');
  }
}
