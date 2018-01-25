<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keshi;
use Response;

class KeshiController extends Controller
{

    public function getKeshis(){
      return response()->json(Keshi::all(),200);
    }
}
