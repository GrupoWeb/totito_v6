<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\modelPlay;
use Carbon\Carbon;

class totito extends Controller
{
    public function show_app(){
        return view('index');
    }

    public function watch_play(Request $request){
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $query = modelPlay::selectraw('primera,segunda,tercera')->where([['jugador','=',0],['created_ad','=',$date],['primera','=',$request->jugada]])->get();

        if($query->isEmpty()){
            return response()->json(false, 200);
        }else{
            return response()->json($query, 200);
        }
    }

    public function save_play(Request $request){
        //dd($request);
            $date = Carbon::now();
            $date = $date->format('Y-m-d');
            $data = new modelPlay;
            $data->jugador =    $request->jugada[0]['seleccion'];
            $data->primera =    $request->jugada[0]['primera'];
            $data->segunda =    $request->jugada[0]['segunda'];
            $data->tercera =    $request->jugada[0]['tercera'];
            $data->created_ad =  $date;

            if($data->save()){
                return response()->json(true, 200);
            };
    }
}
