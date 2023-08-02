<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drivers;
use DB;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driversData = Drivers::query()
        ->orderBy('name', 'asc')
        ->get();

        return view('drivers.drivers', compact('driversData'));
    }

    public function createdriver(Request $request)
    {
        $drivername = $request->input('drivername');
        $driveremail = $request->input('driveremail');
        $driverphone = $request->input('driverphone');
        $driverphotohidden = $request->input('driverphotohidden');
        $datenow = date("Y-m-d H:i:s");

        $data = [
            'name' => $drivername,
            'email' => $driveremail,
            'phone' => $driverphone,
            'photo' => $driverphotohidden,
            'date_added' => $datenow
        ];

        $driver = Drivers::create($data);

        return redirect()->route('drivers', ['success' => '1']);
    }

    public function editdriver(Request $request)
    {
        $editdrivername = $request->input('editdrivername');
        $editdriveremail = $request->input('editdriveremail');
        $editdriverphone = $request->input('editdriverphone');
        $editdriverphotohidden = $request->input('editdriverphotohidden');
        $editdriverid = $request->input('editdriverid');

        $driver = Drivers::find($editdriverid);

        $driver->name = $editdrivername;
        $driver->email = $editdriveremail;
        $driver->phone = $editdriverphone;
        if($editdriverphotohidden != "") {
            $driver->photo = $editdriverphotohidden;
        }
        $driver->save();

        return redirect()->route('drivers', ['success' => '2']);
    }

    public function deletedriver(Request $request)
    {
        $deletedriverid = $request->input('deletedriverid');
        $driver = Drivers::find($deletedriverid);
        $driver->delete();
        return redirect()->route('drivers', ['success' => '3']);
    }

    public function getdriverajax(Request $request)
    {
        $id = $request->input('id');

        $driverData = Drivers::query()
        ->where('driver_id', $id)
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $driverData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

   
}