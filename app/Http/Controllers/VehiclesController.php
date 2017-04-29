<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiclesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
	}

    public function create()
    {
    	$fdepots = DB::table('branches')->get();
        return view('vehicles.index', compact('fdepots'));
    }

    public function detail($vid)
    {
        $type = DB::table('vehicles')->where('VID', $vid)->value('type');
        $journeylog = DB::table('view_journeylogs')->where('VID', $vid)->get();
        $branches = DB::table('branches')->get();
        if ($type != null) {
            if ($type == 1) {
                $vehicle = DB::table('view_buses')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog', 'branches'));
            } else if ($type == 2) {
                $vehicle = DB::table('view_trucks')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog', 'branches'));
            } else if ($type == 3) {
                $vehicle = DB::table('view_personal')->where('VID', $vid)->get();
                return view('vehicles.detail', compact('vehicle', 'type', 'journeylog', 'branches'));
            } else {
                return ['message' => 'Unknown type of vehicle.'];
            }
        } else {
            return ['message' => 'Vehicle not found.'];
        }
    }

    public function edit()
    {
        $typeOfVehicle = request('typeOfVehicle');
        $typeOfBus = request('typeOfBus');

        if ($typeOfVehicle == 1 || $typeOfVehicle == 2 || $typeOfVehicle == 3) {

            $this->validate(request(), [
                'maker' => 'required',
                'model' => 'required',
                'litresPerKilometer' => 'required',
            ]);

            DB::table('vehicles')->where('vid', request('vid'))->update([
                'maker' => request('maker'),
                'model' => request('model'),
                'litresPerKilometer' => request('litresPerKilometer'),
                'homeBranchID' => request('homeBranchID')
            ]);

        }
        
        if ($typeOfVehicle == 1) {

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

        } else if ($typeOfVehicle == 2) {

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

        } else if ($typeOfVehicle == 3) {

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
        
    }

    public function search()
    {
        $typeOfVehicle = request('selectedTypeOfVehicle');
        $typeOfBus = request('selectedTypeOfBus');
        if ($typeOfVehicle == 1) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required'
            ]);

            if ($typeOfBus != '0') {
                $buses = DB::table('view_buses')->where('typeOfBus', $typeOfBus)->get();
                return ['message' => 'Search request', 'request' => request()->all(), 'response' => $buses];
            } else {
                $buses = DB::table('view_buses')->get();
                return ['message' => 'Search request without bus', 'request' => request()->all(), 'response' => $buses];
            }

        } else if ($typeOfVehicle == 2) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required'
            ]);
            $trucks = DB::table('view_trucks')->get();
            return ['message' => 'Search request', 'request' => request()->all(), 'response' => $trucks];

        } else if ($typeOfVehicle == 3) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required'
            ]);
            $personal = DB::table('view_personal')->get();
            return ['message' => 'Search request', 'request' => request()->all(), 'response' => $personal];

        } else {

            return ['message' => 'Unknown or not selected type of vehicle.', 'request_data' => request()->all()];

        }
        
    }

    public function new()
    {
        // $fdepots = DB::table('view_depots')->get();
        $branches = DB::table('branches')->get();
        return view('vehicles.new', compact('branches'));
    }

    public function store()
    {

        if (request('selectedTypeOfVehicle') == 1) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required',
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

        } else if (request('selectedTypeOfVehicle') == 2) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required',
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

        } else if (request('selectedTypeOfVehicle') == 3) {

            $this->validate(request(), [
                'selectedTypeOfVehicle' => 'required',
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

    }

    public function delete()
    {
        DB::table('vehicles')->where('vid', request('vid'))->delete();
        return ['Message' => 'Delete request', 'Request' => request('vid')];
    }

}
