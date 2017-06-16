<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function post(Request $request){
        var_dump(json_decode($request->getContent()));die;
    }
}
