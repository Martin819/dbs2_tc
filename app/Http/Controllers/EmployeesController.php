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
/*    	$branches = DB::table('view_branches')->get();*/
        return view('employees.index');
    }

/*    public function detail($vid)
    {
        $type = DB::table('vehicles')->where('VID', $vid)->value('type');
        $journeylog = DB::table('view_journeylogs')->where('VID', $vid)->get();
        if ($type != null) {
            if ($type == 1) {
                $vehicle = DB::table('view_buses')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog'));
            } else if ($type == 2) {
                $vehicle = DB::table('view_trucks')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog'));
            } else if ($type == 3) {
                $vehicle = DB::table('view_personal')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog'));
            } else {
                return ['message' => 'Unknown type of vehicle.'];
            }
        } else {
            return ['message' => 'Vehicle not found.'];
        }
    }*/

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
        if ($position == "Řidič(ka)") {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $drivers = DB::table('view_drivers')->get();
            return ['message' => 'Search request drivers', 'request' => request()->all(), 'response' => $drivers];

        } else if ($position == "Zaměstnanec servisu") {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $servicemen = DB::table('view_servicemen')->get();
            return ['message' => 'Search request servicemen', 'request' => request()->all(), 'response' => $servicemen];

        } else if ($position == "Management") {

            $this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $management = DB::table('view_management')->get();
            return ['message' => 'Search request management', 'request' => request()->all(), 'response' => $management];

        } else {

            /*$this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $otherEmployees = DB::table('view_otherEmployees')->get();
            return ['message' => 'Search request otherEmployees', 'request' => request()->all(), 'response' => $otherEmployees];*/
            return ['message' => 'Unknown position.'];
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
