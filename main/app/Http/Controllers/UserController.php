<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(){
        return view('index');
    }
    public function view_persons(Request $request){

        $FirstName = strip_tags($request->input('FirstName'));

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        // Retrieve the data
        $data = DB::table('persons')->where('FirstName', 'like', '%' . $FirstName  . '%')->skip($start)->take($length)->get();

        $recordsTotal = DB::table('persons')->count();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data,
        ]);
    }
}
