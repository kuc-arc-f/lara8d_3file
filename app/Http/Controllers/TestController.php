<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**************************************
     *
     **************************************/
    public function test1()
    {
        $title   = request('title');
        $ret = ['title' => $title];
        return response()->json($ret);        
    }    
}
