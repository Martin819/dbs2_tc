<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimetablesController extends Controller
{
    public function create()
    {
    	$buslines = DB::table('buslines')->get();
    	return view('timetables.index', compact('buslines'));
    }
}
