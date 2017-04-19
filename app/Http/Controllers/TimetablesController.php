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

	public function detail($lid)
    {
    	$busline = DB::table('buslines')->where('LID', $lid)->get();
        $timetables = DB::table('view_timetable')->where('busLineID', $lid)->get();
        return view('timetables.detail', compact('timetable', 'busline'));
    }
}