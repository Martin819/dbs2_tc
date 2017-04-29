<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function create()
    {
        $depots = DB::table('view_depots')->get();
        $offices = DB::table('view_offices')->get();
        $warehouses = DB::table('view_warehouses')->get();
        return view('branches.index', compact('depots', 'offices', 'warehouses'));
    }

    public function detail($bid)
    {
        $branchType = DB::table('branches')->where('BID', $bid)->value('type');
        $branch;
        if ($branchType == 1) {
            $branch = DB::table('view_offices')->where('BID', $bid)->get();
        } else if ($branchType == 2) {
            $branch = DB::table('view_warehouses')->where('BID', $bid)->get();
        } else {
            $branch = DB::table('view_depots')->where('BID', $bid)->get();
        }   
        $departments = DB::table('departments')->where('officeID', $branch[0]->BID)->get();
        $employees = DB::table('view_branches_employees')->where('branchID', $bid)->get();
        $vehicles = DB::table('vehicles')->where('homeBranchID', $bid)->get();
        return view('branches.detail', compact('branch', 'departments', 'employees', 'vehicles'));
    }

    // public function create()
    // {
    //     $branches = DB::table('view_depots')->get();
    //     return view('branches.index', compact('branches'));
    // }

    // public function detail($bid)
    // {
    //     $branchesVehicles = DB::table('view_branches_vehicles')->where('BID', $bid)->get();
    //     $branchesEmployees = DB::table('view_branches_employees')->where('BID', $bid)->get();
    //     $type = DB::table('branches')->where('BID', $bid)->value('type');
    //     if ($type != null) {
    //         if ($type == 1) {
    //             $branches = DB::table('view_depots')->where('BID', $bid)->get();
    //             return view('branches.detail', compact('branches', 'type'));
    //         } else if ($type == 2) {
    //             $branches = DB::table('view_offices')->where('BID', $bid)->get();
    //             return view('branches.detail', compact('branches', 'type'));
    //         } else if ($type == 3) {
    //             $branches = DB::table('view_warehouses')->where('BID', $bid)->get();
    //             return view('branches.detail', compact('branches', 'type'));
    //         } else {
    //             return ['message' => 'Unknown type of branche.'];
    //         }
    //     } else {
    //         return ['message' => 'Branches not found.'];
    //     }
    // }

}