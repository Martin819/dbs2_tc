<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
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
        if ($position != null) {
            if ($position == 'Ridic') {
                $employee = DB::table('view_drivers')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions'));
            } else if ($position == 'Servis') {
                $employee = DB::table('view_servicemen')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions'));
            } else {
                $employee = DB::table('view_management')->where('EID', $eid)->get();
                return view('employees.detail', compact('employee', 'workingHoursLogs', 'positions'));
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

        } else if (request('position') == 'Ridic') {

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

            if (request('formerPosition') == 'Ridic') {
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
            } else if (request('position') == 'Ridic') {
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
            } else if (request('position') == 'Ridic') {
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

        return ['Message' => 'Edit request', 'Request' => request()->all()];

    }

/*    public function edit()
    {
        $position = request('position');
        $typeOfBus = request('typeOfBus');

        if ($position == 1 || $position == 2 || $position == 3) {

            $this->validate(request(), [
                'maker' => 'required',
                'model' => 'required',
                'litresPerKilometer' => 'required',
            ]);

            DB::table('vehicles')->where('vid', request('vid'))->update([
                'maker' => request('maker'),
                'model' => request('model'),
                'litresPerKilometer' => request('litresPerKilometer')
            ]);

        }
        
        if ($position == 1) {

            $this->validate(request(), [
                'seats' => 'required'
            ]);

            if ($typeOfBus != 'Tramvaj') {
                $this->validate(request(), [
                    'plateNumber' => 'required'
                ]);
                DB::table('vehicles')->where('vid', request('vid'))->update([
                    'plateNumber' => request('plateNumber')
                ]);
            }

            DB::table('buses')->where('vid', request('vid'))->update([
                'seats' => request('seats')
            ]);

            return ['message' => 'Editing row in table for bus.', 'request' => request()->all()];

        } else if ($position == 2) {

            $this->validate(request(), [
                'maxLoadKilos' => 'required',
                'plateNumber' => 'required'
            ]);

            DB::table('vehicles')->where('vid', request('vid'))->update([
                'plateNumber' => request('plateNumber')
            ]);

            DB::table('trucks')->where('vid', request('vid'))->update([
                'maxLoadKilos' => request('maxLoadKilos')
            ]);

            return ['message' => 'Editing row in table for truck.', 'request' => request()->all()];

        } else if ($position == 3) {

            $this->validate(request(), [
                'seats' => 'required',
                'plateNumber' => 'required'
            ]);

            DB::table('vehicles')->where('vid', request('vid'))->update([
                'plateNumber' => request('plateNumber')
            ]);

            DB::table('personal')->where('vid', request('vid'))->update([
                'seats' => request('seats')
            ]);

            return ['message' => 'Editing row in table for personal.', 'request' => request()->all()];

        } else {

            return ['message' => 'Unknown type of vehicle.', 'request' => request()->all()];

        }
        
    }*/

    public function search()
    {
        $position = request('selectedPosition');
        if ($position == "Ridic") {

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

/*    public function new()
    {
        $fdepots = DB::table('view_depots')->get();
        return view('vehicles.new', compact('fdepots'));
    }*/

/*    public function store()
    {

        if (request('selectedPosition') == 1) {

            $this->validate(request(), [
                'selectedPosition' => 'required',
                'selectedDepot' => 'required',
                'maker' => 'required',
                'model' => 'required',
                'plateNumber' => 'required',
                'litresPerKilometer' => 'required',
                'selectedTypeOfBus' => 'required',
                'seats' => 'required'
            ]);

            $maker = request('maker');
            $model = request('model');
            $plateNumber = request('plateNumber');
            $litresPerKilometer = request('litresPerKilometer');
            $homeBranchId = request('selectedDepot');
            $typeOfBus = request('selectedTypeOfBus');
            $seats = request('seats');

            $query = 'call new_bus(\'' . $maker . '\',\'' . $model . '\',\'' . $plateNumber . '\',' . $litresPerKilometer . ',' . $homeBranchId . ',\'' . $typeOfBus . '\',' . $seats . ')';

            DB::select($query);

            return ['message' => 'Bus added', 'data' => request()->all(), 'query' => $query];

        } else if (request('selectedPosition') == 2) {

            $this->validate(request(), [
                'selectedPosition' => 'required',
                'selectedDepot' => 'required',
                'maker' => 'required',
                'model' => 'required',
                'plateNumber' => 'required',
                'litresPerKilometer' => 'required',
                'maxLoad' => 'required'
            ]);

            $maker = request('maker');
            $model = request('model');
            $plateNumber = request('plateNumber');
            $litresPerKilometer = request('litresPerKilometer');
            $homeBranchId = request('selectedDepot');
            $maxLoad = request('maxLoad');

            $query = 'call new_truck(\'' . $maker . '\',\'' . $model . '\',\'' . $plateNumber . '\',' . $litresPerKilometer . ',' . $homeBranchId . ',' . $maxLoad . ')';

            DB::select($query);

            return ['message' => 'Truck added', 'data' => request()->all(), 'query' => $query];

        } else if (request('selectedPosition') == 3) {

            $this->validate(request(), [
                'selectedPosition' => 'required',
                'selectedDepot' => 'required',
                'maker' => 'required',
                'model' => 'required',
                'plateNumber' => 'required',
                'litresPerKilometer' => 'required',
                'seats' => 'required'
            ]);

            $maker = request('maker');
            $model = request('model');
            $plateNumber = request('plateNumber');
            $litresPerKilometer = request('litresPerKilometer');
            $homeBranchId = request('selectedDepot');
            $seats = request('seats');

            $query = 'call new_personal(\'' . $maker . '\',\'' . $model . '\',\'' . $plateNumber . '\',' . $litresPerKilometer . ',' . $homeBranchId . ',' . $seats . ')';

            DB::select($query);

            return ['message' => 'Personal vehicle added', 'request_data' => request()->all(), 'query' => $query];

        } else {

            return ['message' => 'Unknown or not selected type of vehicle.', 'request_data' => request()->all()];

        }

    }*/

/*    public function delete()
    {
        DB::table('vehicles')->where('vid', request('vid'))->delete();
        return ['Message' => 'Delete request', 'Request' => request('vid')];
    }*/

}
