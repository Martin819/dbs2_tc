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
        $customer = DB::table('view_customers')->where('CID', $cid)->get();
        $contracts = DB::table('contracts')->where('customerID', $cid)->get();
        $branches = DB::table('branches')->get();
        $companyName = $customer[0]->companyName;
        if ($companyName == null) {
            $companyName = '\''. 'Fyzická osoba' . '\'';
        } else {
            $companyName = '\'' . 'Právnická osoba' . '\'';
        }
        return view('customers.detail', compact('companyName', 'customer', 'contracts', 'branches'));
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

    public function newCus()
    {
        return view('customers.new');
    }

    public function newStore()
    {
        $this->validate(request(), [
            'streetName' => 'required',
            'houseNr' => 'required',
            'city' => 'required',
            'postalCode' => 'required'
        ]);

        if (request('firstname')) {
            $this->validate(request(), [
                'firstname' => 'required',
                'lastname' => 'required'
            ]);
        } else {
            $this->validate(request(), [
                'companyName' => 'required',
                'companyIdentNr' => 'required'
            ]);
        }

        $addressId = DB::table('addresses')->insertGetId([
            'streetName' => request('streetName'),
            'houseNr' => request('houseNr'),
            'city' => request('city'),
            'postalCode' => request('postalCode'),
            'stateCODE' => 'CZ'
        ]);

        DB::table('customers')->insert([
            'firstName' => request('firstname'),
            'lastname' => request('lastname'),
            'companyName' => request('companyName'),
            'companyIdentNr' => request('companyIdentNr'),
            'addressID' => $addressId
        ]);
        
        return ['Message' => 'Create customer request.', 'Request' => request()->all()];
    }

    public function edit()
    {
        if (request('firstname')) {
            $this->validate(request(), [
                'firstname' => 'required',
                'lastname' => 'required'
            ]);
        } else {
            $this->validate(request(), [
                'companyName' => 'required',
                'companyIdentNr' => 'required'
            ]);
        }

        $this->validate(request(), [
            'streetName' => 'required',
            'houseNr' => 'required',
            'city' => 'required',
            'postalCode' => 'required'
        ]);

        DB::table('customers')->where('CID', request('cid'))->update([
            'firstName' => request('firstname'),
            'lastname' => request('lastname'),
            'companyName' => request('companyName'),
            'companyIdentNr' => request('companyIdentNr')
        ]);

        DB::table('addresses')->where('AID', request('aid'))->update([
            'streetName' => request('streetName'),
            'houseNr' => request('houseNr'),
            'city' => request('city'),
            'postalCode' => request('postalCode')
        ]);

        return ['Message' => 'Edit customer', 'Request' => request()->all()];
    }

    public function deleteCustomer()
    {
        DB::table('customers')->where('cid', request('customer_id'))->delete();
        return ['message' => 'Delete employee', 'request' => request()->all()];
    }

    public function newInvoice()
    {
        $this->validate(request(), [
            'type' => 'required',
            'startDest' => 'required',
            'finalDest' => 'required',
            'distance' => 'required',
            'price' => 'required',
        ]);
        
        $contract_id = DB::table('contracts')->insertGetId([
            'customerID' => request('customerID'),
            'type' => request('type'),
            'startDest' => request('startDest'),
            'finalDest' => request('finalDest'),
            'distance' => request('distance')
        ]);

        $invoice_id = DB::table('invoices')->insertGetId([
            'customerID' => request('customerID'),
            'price' => request('price')
        ]);

        DB::table('contracts_invoices')->insert([
            'contractID' => $contract_id,
            'invoiceID' => $invoice_id
        ]);

        return ['Message' => 'New invoice request', 'Request' => request()->all()];
    }
}
