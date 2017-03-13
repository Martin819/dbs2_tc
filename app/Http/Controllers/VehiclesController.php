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
    	$branches = DB::table('view_depots')->get();
        return view('vehicles.index', compact('branches'));
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
        $fdepots = DB::table('view_depots')->get();
        return view('vehicles.new', compact('fdepots'));
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

}
