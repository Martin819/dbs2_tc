<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimetablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function create()
    {
    	$buslines = DB::table('buslines')->get();
    	return view('timetables.index', compact('buslines'));
    }

	public function detail($lid)
    {
        $timetable = DB::table('view_timetables')->where('busLineID', $lid)->get();
        return view('timetables.detail', compact('lid', 'timetable'));
    }
}