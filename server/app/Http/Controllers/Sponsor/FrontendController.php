<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return response()->json(['message'=> 'Sponsor Frontend fetched successfully']);
    }
}
