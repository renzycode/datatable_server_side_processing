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
        // Get the parameters sent by DataTables for pagination
        $start = $request->input('start', 0); // Start index
        $length = $request->input('length', 10); // Number of records per page

        // Query the database and limit the results
        $data = DB::table('persons')
            ->skip($start) // Start index for pagination
            ->take($length) // Number of records per page
            ->get();

        // Get the total number of records without filtering
        $recordsTotal = DB::table('persons')->count();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal, // For simplicity, same as recordsTotal
            'data' => $data,
        ]);
    }
}
