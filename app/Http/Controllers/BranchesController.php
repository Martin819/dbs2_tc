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
        $branches = DB::table('view_depots')->get();
        return view('branches.index', compact('branches'));
    }

    public function detail($bid)
    {
        $branchesVehicles = DB::table('view_branches_vehicles')->where('BID', $bid)->get();
        $branchesEmployees = DB::table('view_branches_employees')->where('BID', $bid)->get();
        $type = DB::table('branches')->where('BID', $bid)->value('type');
        if ($type != null) {
            if ($type == 1) {
                $branches = DB::table('view_depots')->where('BID', $bid)->get();
                return view('branches.detail', compact('branches', 'type'));
            } else if ($type == 2) {
                $branches = DB::table('view_offices')->where('BID', $bid)->get();
                return view('branches.detail', compact('branches', 'type'));
            } else if ($type == 3) {
                $branches = DB::table('view_warehouses')->where('BID', $bid)->get();
                return view('branches.detail', compact('branches', 'type'));
            } else {
                return ['message' => 'Unknown type of branche.'];
            }
        } else {
            return ['message' => 'Branches not found.'];
        }
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
        $typeOfBranches = request('selectedTypeOfBranches');
        if ($typeOfBranches == 1) {

            $this->validate(request(), [
                'selectedTypeOfBranches' => 'required'
            ]);
            $depots = DB::table('view_depots')->get();
            return ['message' => 'Search request depots', 'request' => request()->all(), 'response' => $depots];

        } else if ($typeOfBranches == 2) {

            $this->validate(request(), [
                'selectedTypeOfBranches' => 'required'
            ]);
            $offices = DB::table('view_offices')->get();
            return ['message' => 'Search request offices', 'request' => request()->all(), 'response' => $offices];

        } else if ($typeOfBranches == 3) {

            $this->validate(request(), [
                'selectedTypeOfBranches' => 'required'
            ]);
            $warehouses = DB::table('view_warehouses')->get();
            return ['message' => 'Search request warehouses', 'request' => request()->all(), 'response' => $warehouses];

        } else {

            /*$this->validate(request(), [
                'selectedPosition' => 'required'
            ]);
            $otherEmployees = DB::table('view_otherEmployees')->get();
            return ['message' => 'Search request otherEmployees', 'request' => request()->all(), 'response' => $otherEmployees];*/
            return ['message' => 'Unknown type of branch.', 'request' => request()->all()];
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