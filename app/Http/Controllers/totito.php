<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class totito extends Controller
{
    public function show_app(){
        return view('index');
    }
}
