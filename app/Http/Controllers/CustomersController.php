<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');	
	}

    public function create()
    {
    	return view('customers.index');
    }

    public function detail($cid) 
    {
        $customer = DB::table('customers')->where('CID', $cid)->get();
        $contracts = DB::table('contracts')->where('customerID', $cid)->get();
        $companyName = $customer[0]->companyName;
        if ($companyName == null) {
            $companyName = '\''. 'Fyzická osoba' . '\'';
        } else {
            $companyName = '\'' . 'Právnická osoba' . '\'';
        }
        return view('customers.detail', compact('companyName', 'customer', 'contracts'));
    }

    public function search()
    {
    	$typeOfCustomer = request('typeOfCustomer');

    	if ($typeOfCustomer == 'Fyzická osoba') {

    		$customers;
    		
    		$firstname = request('firstname');
    		$lastname = request('lastname');

    		if ($firstname != null && $lastname != null) {
    			$customers = '\'' . DB::table('customers')->where([['firstName', $firstname], ['lastname', $lastname]])->get() . '\'';
    		} else if ($firstname != null) {
    			$customers = DB::table('customers')->where('firstName', 'like', '%' . $firstname . '%')->get();
    		} else if ($lastname != null) {
    			$customers = DB::table('customers')->where('lastname', 'like', '%' . $lastname . '%')->get();
    		} else {
    			$customers = DB::table('customers')->where('companyName', '=', '')->get();
    		}

    		return ['message' => 'Person search request.', 'response' => $customers,'request' => request()->all()];

    	} else if ($typeOfCustomer == 'Právnická osoba') {

    		$customers;

    		$companyName = request('companyName');
    		$companyIdentNr = request('companyIdentNr');

    		if ($companyName != null && $companyIdentNr != null) {
    			$customers = DB::table('customers')->where([['companyName', $companyName], ['companyIdentNr', $companyIdentNr]])->get();
    		} else if ($companyName != null) {
    			$customers = DB::table('customers')->where('companyName', 'like', '%' . $companyName . '%')->get();
    		} else if ($companyIdentNr != null) {
    			$customers = DB::table('customers')->where('companyIdentNr', 'like', '%' . $companyIdentNr . '%')->get();
    		} else {
    			$customers = DB::table('customers')->where('companyName', '<>', '')->get();
    		}

    		return ['message' => 'Company search request.', 'response' => $customers, 'request' => request()->all()];

    	} else {

    		return ['message' => 'Unknown type of customer.', 'request' => request()->all()];

    	}
 
    }
}
