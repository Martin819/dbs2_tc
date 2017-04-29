<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'manager']);	
	}

    public function create()
    {
    	$positions = DB::table('employees')->distinct()->orderBy('position')->get(['position']);
        return view('employees.index', compact('positions'));
    }

    public function detail($eid)
    {
        $position = DB::table('employees')->where('EID', $eid)->value('position');
        $workingHoursLogs = DB::table('view_workingHoursLogs')->where('EID', $eid)->get();
        $positions = DB::table('employees')->distinct()->orderBy('position')->get(['position']);
        $branches = DB::table('branches')->get();
        $branchID = DB::table('branches_employees')->where('employeeID', $eid)->get();
        if ($position != null) {
            if ($position == 'Řidič(ka)') {
                $employee = DB::table('view_drivers')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions', 'branches', 'branchID'));
            } else if ($position == 'Servis') {
                $employee = DB::table('view_servicemen')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions', 'branches', 'branchID'));
            } else {
                $employee = DB::table('view_management')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions', 'branches', 'branchID'));
            } 
        } else {
            return ['message' => 'Employee not found.'];
        }
    }

    public function edit()
    {
        $this->validate(request(), [
            'position' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',

            'streetName' => 'required',
            'houseNr' => 'required',
            'city' => 'required',
            'postalCode' => 'required'
        ]);

        DB::table('addresses')->where('AID', request('aid'))->update([
            'streetName' => request('streetName'),
            'houseNr' => request('houseNr'),
            'city' => request('city'),
            'postalCode' => request('postalCode')
        ]);

        DB::table('employees')->where('EID', request('eid'))->update([
            'firstName' => request('firstname'),
            'lastName' => request('lastname'),
            'position' => request('position')
        ]);

        if (request('position') == 'Servis') {

            $this->validate(request(), [
                'hourlyWage' => 'required'
            ]);

            DB::table('servicemen')->where('EID', request('eid'))->update([
                'hourlyWage' => request('hourlyWage')
            ]);

            echo "Ridic validovan";

        } else if (request('position') == 'Řidič(ka)') {

            $this->validate(request(), [
                'hourlyWage' => 'required',
                'lastTraining' => 'required'
            ]);

            DB::table('drivers')->where('EID', request('eid'))->update([
                'hourlyWage' => request('hourlyWage'),
                'lastTraining' => request('lastTraining')
            ]);

            echo "Servisak validovan";

        } else {

            $this->validate(request(), [
                'annualSalary' => 'required'
            ]);

            DB::table('management')->where('EID', request('eid'))->update([
                'annualSalary' => request('annualSalary')
            ]);

            echo "Manager validovan";

        } 

        if (request('position') != request('formerPosition')) {
            echo "Zmena pozice";

            if (request('formerPosition') == 'Řidič(ka)') {
                DB::table('drivers')->where('EID', request('eid'))->delete();
                echo "Byval ridic";
            } else if (request('formerPosition') == 'Servis') {
                DB::table('servicemen')->where('EID', request('eid'))->delete();
                echo "Byval servisak";
            } else {
                DB::table('management')->where('EID', request('eid'))->delete();
                echo "Byval manager";
            }

            if (request('position') == 'Servis') {
                DB::table('servicemen')->insert([
                    'EID' => request('eid'),
                    'hourlyWage' => request('hourlyWage')
                ]);
                echo "Uz je servisak";
            } else if (request('position') == 'Řidič(ka)') {
                DB::table('drivers')->insert([
                    'EID' => request('eid'),
                    'hourlyWage' => request('hourlyWage'),
                    'lastTraining' => request('lastTraining')
                ]);
                echo "Uz je ridic";
            } else {
                DB::table('management')->insert([
                    'EID' => request('eid'),
                    'annualSalary' => request('annualSalary')
                ]);
                echo "Uz je manager";
            } 
        } else {
            if (request('position') == 'Servis') {
                DB::table('servicemen')->where('EID', request('eid'))->update([
                    'hourlyWage' => request('hourlyWage')
                ]);
                echo "Upravena data servicemen";
            } else if (request('position') == 'Řidič(ka)') {
                DB::table('drivers')->where('EID', request('eid'))->update([
                    'hourlyWage' => request('hourlyWage'),
                    'lastTraining' => request('lastTraining')
                ]);
                echo "Upravena data drivers";
            } else {
                DB::table('management')->where('EID', request('eid'))->update([
                    'annualSalary' => request('annualSalary')
                ]);
                echo "Upravena data management";
            } 
        }

        DB::table('branches_employees')->where('employeeID', request('eid'))->update([
            'branchID' => request('branchID')
        ]);

        return ['Message' => 'Edit request', 'Request' => request()->all()];

    }

    public function search()
    {
        $position = request('selectedPosition');
        if ($position == "Řidič(ka)") {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $drivers = DB::table('view_drivers')->get();
            return ['message' => 'Search request drivers', 'request' => request()->all(), 'response' => $drivers];

        } else if ($position == "Servis") {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $servicemen = DB::table('view_servicemen')->get();
            return ['message' => 'Search request servicemen', 'request' => request()->all(), 'response' => $servicemen];

        } else {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $management = DB::table('view_management')->where('position', $position)->get();
            return ['message' => 'Search request management', 'request' => request()->all(), 'response' => $management];

        } 
 
    }

    public function new()
    {
        $branches = DB::table('branches')->get();
        return view('employees.new', compact('branches'));
    }

    public function createEmployee()
    {
        $this->validate(request(), [
            'position' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',

            'dateHired' => 'required',

            'streetName' => 'required',
            'houseNr' => 'required',
            'city' => 'required',
            'postalCode' => 'required'
        ]);

        if (request('position') == 'Servis') {

            $this->validate(request(), [
                'hourlyWage' => 'required'
            ]);

        } else if (request('position') == 'Řidič(ka)') {

            $this->validate(request(), [
                'hourlyWage' => 'required',
                'lastTraining' => 'required'
            ]);

        } else {

            $this->validate(request(), [
                'annualSalary' => 'required'
            ]);

        }

        $address_id = DB::table('addresses')->insertGetId([
            'streetName' => request('streetName'),
            'houseNr' => request('houseNr'),
            'city' => request('city'),
            'postalCode' => request('postalCode'),
            'stateCODE' => 'CZ'
        ]);

        $employee_id = DB::table('employees')->insertGetId([
            'firstName' => request('firstname'),
            'lastName' => request('lastname'),
            'position' => request('position'),
            'addressID' => $address_id,
            'dateHired' => \Carbon\Carbon::createFromFormat('d/m/Y', request('dateHired')), 
        ]);

        if (request('position') == 'Servis') {

            DB::table('servicemen')->insert([
                'EID' => $employee_id,
                'hourlyWage' => request('hourlyWage')
            ]);    

        } else if (request('position') == 'Řidič(ka)') {

            DB::table('drivers')->insert([
                'EID' => $employee_id,
                'hourlyWage' => request('hourlyWage'),
                'lastTraining' => \Carbon\Carbon::createFromFormat('d/m/Y', request('lastTraining'))
            ]);

        } else {

            DB::table('management')->insert([
                'EID' => $employee_id,
                'annualSalary' => request('annualSalary')
            ]);

        }

        return ['message' => 'Create employee', 'request' => request()->all()];
    }

    public function deleteEmployee()
    {
        DB::table('employees')->where('EID', request('employee_id'))->delete();

        if (request('position') == 'Servis') {

            DB::table('servicemen')->where('EID', request('employee_id'))->delete();  

        } else if (request('position') == 'Řidič(ka)') {

            DB::table('drivers')->where('EID', request('employee_id'))->delete();

        } else {

            DB::table('management')->where('EID', request('employee_id'))->delete();

        }

        return ['message' => 'Delete employee', 'request' => request()->all()];
    }

}
