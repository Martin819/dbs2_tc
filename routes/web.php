<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/branches', 'BranchesController@create');
Route::post('/branches', 'BranchesController@search');
Route::get('/branches/new', 'BranchesController@new');
Route::get('/branches/{bid}', 'BranchesController@detail');

Route::get('/employees', 'EmployeesController@create');
Route::post('/employees', 'EmployeesController@search');
Route::get('/employees/new', 'EmployeesController@new');
Route::post('/employees/new', 'EmployeesController@createEmployee');
Route::post('/employees/delete', 'EmployeesController@deleteEmployee');
Route::post('/employees/edit', 'EmployeesController@edit');
Route::get('/employees/{eid}', 'EmployeesController@detail');
Route::get('/vehicles', 'VehiclesController@create');
Route::post('/vehicles', 'VehiclesController@search');
Route::get('/vehicles/new', 'VehiclesController@new');
Route::post('/vehicles/new', 'VehiclesController@store');
Route::get('/vehicles/{vid}', 'VehiclesController@detail');
Route::post('/vehicles/edit', 'VehiclesController@edit');
Route::post('/vehicles/delete', 'VehiclesController@delete');
Route::get('/timetables', 'TimetablesController@create');
Route::get('/timetables/{lid}', 'TimetablesController@detail');
Route::get('/customers', 'CustomersController@create');
Route::post('/customers', 'CustomersController@search');
Route::get('/customers/new', 'CustomersController@newCus');
Route::post('/customers/new', 'CustomersController@newStore');
Route::post('/customers/edit', 'CustomersController@edit');
Route::post('/customers/delete', 'CustomersController@deleteCustomer');
Route::post('/customers/invoices/new', 'CustomersController@newInvoice');
Route::get('/customers/{cid}', 'CustomersController@detail');
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');
Route::get('/pass', 'RegistrationController@createpass');
Route::post('/pass', 'RegistrationController@storepass');
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');
