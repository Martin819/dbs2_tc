<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
	}
	
    public function index()
    {
    	//$offices = DB::select('select * from view_offices');
    	//return view('offices/index', compact('offices'));
    	return view('offices.index');
    }
}
