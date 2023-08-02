<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\InvoicesController;

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

//Booking module
Route::get('/', [BookingsController::class, 'index'])->name('bookings');
Route::get('/confirmedbookings', [BookingsController::class, 'confirmedbookings'])->name('confirmedbookings');
Route::get('/completedbookings', [BookingsController::class, 'completedbookings'])->name('completedbookings');
Route::post('/createbooking', [BookingsController::class, 'createbooking']);
Route::post('/deletebooking', [BookingsController::class, 'deletebooking']);
Route::post('/updatebooking', [BookingsController::class, 'updatebooking']);
Route::get('/confirmbookingproposal', [BookingsController::class, 'confirmbookingproposal']);
Route::post('/changebookingstatus', [BookingsController::class, 'changebookingstatus']);
Route::get('/getbookingajax', [BookingsController::class, 'getbookingajax']);
Route::get('/getinvoicesajax', [BookingsController::class, 'getinvoicesajax']);
Route::get('/reports', [BookingsController::class, 'completednotpaidbookings'])->name('reports');
Route::get('/driverjoblist', [BookingsController::class, 'driverjoblist'])->name('driverjoblist');
Route::post('/generatepdf', [BookingsController::class, 'generatepdf']);
Route::post('/confirmbooking', [BookingsController::class, 'confirmbooking']);


//Clients module
Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
Route::post('/createclient', [ClientsController::class, 'createclient']);
Route::post('/updateclient', [ClientsController::class, 'updateclient']);
Route::post('/deleteclient', [ClientsController::class, 'deleteclient']);
Route::get('/getclientajax', [ClientsController::class, 'getclientajax']);

//Drivers module
Route::get('/drivers', [DriversController::class, 'index'])->name('drivers');
Route::post('/createdriver', [DriversController::class, 'createdriver']);
Route::post('/editdriver', [DriversController::class, 'editdriver']);
Route::post('/deletedriver', [DriversController::class, 'deletedriver']);
Route::get('/getdriverajax', [DriversController::class, 'getdriverajax']);

//Vehicles module
Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles');
Route::post('/createvehicle', [VehiclesController::class, 'createvehicle']);
Route::post('/editvehicle', [VehiclesController::class, 'editvehicle']);
Route::post('/deletevehicle', [VehiclesController::class, 'deletevehicle']);
Route::get('/getvehicleajax', [VehiclesController::class, 'getvehicleajax']);

//Setting module
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/createfeesettings', [SettingsController::class, 'createfeesettings']);
Route::post('/editfeesettings', [SettingsController::class, 'editfeesettings']);
Route::post('/deletefeesettings', [SettingsController::class, 'deletefeesettings']);
Route::get('/getfeesettingsajax', [SettingsController::class, 'getfeesettingsajax']);
Route::post('/createpaymentsettings', [SettingsController::class, 'createpaymentsettings']);
Route::post('/editpaymentsettings', [SettingsController::class, 'editpaymentsettings']);
Route::post('/deletepaymentsettings', [SettingsController::class, 'deletepaymentsettings']);
Route::get('/getpaymentsettingsajax', [SettingsController::class, 'getpaymentsettingsajax']);

//Reminders module
Route::get('/reminders', [RemindersController::class, 'index'])->name('reminders');
Route::post('/editremindersfromid1', [RemindersController::class, 'editremindersfromid1']);
Route::post('/editremindersfromid2', [RemindersController::class, 'editremindersfromid2']);

//Invoices module
Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices');