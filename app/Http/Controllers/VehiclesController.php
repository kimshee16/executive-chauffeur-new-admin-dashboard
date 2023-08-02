<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleData;
use DB;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiclesData = VehicleData::query()
        ->orderBy('vreg_number', 'asc')
        ->get();

        return view('vehicles.vehicles', compact('vehiclesData'));
    }

    public function createvehicle(Request $request)
    {
        $vehicleregistrationnumber = $request->input('vehicleregistrationnumber');
        $vehiclemake = $request->input('vehiclemake');
        $vehiclemodel = $request->input('vehiclemodel');
        $vehicleyearofmanufacture = $request->input('vehicleyearofmanufacture');
        $vehiclemotexpiry = $request->input('vehiclemotexpiry');
        $vehicleroadtaxexpiry = $request->input('vehicleroadtaxexpiry');
        $vehicleowner = $request->input('vehicleowner');
        $vehicledescription = $request->input('vehicledescription');
        $vehiclepassenger = $request->input('vehiclepassenger');
        $vehicleluggage = $request->input('vehicleluggage');
        $vehicleulez = $request->input('vehicleulez');
        $vehiclephotohidden = $request->input('vehiclephotohidden');

        $data = [
            'vreg_number' => $vehicleregistrationnumber,
            'make' => $vehiclemake,
            'model' => $vehiclemodel,
            'yearofmanufacture' => $vehicleyearofmanufacture,
            'motexpiry' => $vehiclemotexpiry,
            'roadtaxexpiry' => $vehicleroadtaxexpiry,
            'owner' => $vehicleowner,
            'description' => $vehicledescription,
            'passengers' => $vehiclepassenger,
            'luggage' => $vehicleluggage,
            'ulezcompliant' => $vehicleulez,
            'photo' => $vehiclephotohidden
        ];

        $vehicle = VehicleData::create($data);

        return redirect()->route('vehicles', ['success' => '1']);
    }

    public function editvehicle(Request $request)
    {
        $editvehicleregistrationnumber = $request->input('editvehicleregistrationnumber');
        $editvehiclemake = $request->input('editvehiclemake');
        $editvehiclemodel = $request->input('editvehiclemodel');
        $editvehicleyearofmanufacture = $request->input('editvehicleyearofmanufacture');
        $editvehiclemotexpiry = $request->input('editvehiclemotexpiry');
        $editvehicleroadtaxexpiry = $request->input('editvehicleroadtaxexpiry');
        $editvehicleowner = $request->input('editvehicleowner');
        $editvehicledescription = $request->input('editvehicledescription');
        $editvehiclepassenger = $request->input('editvehiclepassenger');
        $editvehicleluggage = $request->input('editvehicleluggage');
        $editvehicleulez = $request->input('editvehicleulez');
        $editvehiclephotohidden = $request->input('editvehiclephotohidden');

        $vehicle = VehicleData::find($editvehicleregistrationnumber);

        $vehicle->make = $editvehiclemake;
        $vehicle->model = $editvehiclemodel;
        $vehicle->yearofmanufacture = $editvehicleyearofmanufacture;
        $vehicle->motexpiry = $editvehiclemotexpiry;
        $vehicle->roadtaxexpiry = $editvehicleroadtaxexpiry;
        $vehicle->owner = $editvehicleowner;
        $vehicle->description = $editvehicledescription;
        $vehicle->passengers = $editvehiclepassenger;
        $vehicle->luggage = $editvehicleluggage;
        $vehicle->ulezcompliant = $editvehicleulez;
        if($editvehiclephotohidden != "") {
            $vehicle->photo = $editvehiclephotohidden;
        }
        $vehicle->save();

        return redirect()->route('vehicles', ['success' => '2']);
    }

    public function deletevehicle(Request $request)
    {
        $deletevehicleid = $request->input('deletevehicleid');
        $vehicle = VehicleData::find($deletevehicleid);
        $vehicle->delete();
        return redirect()->route('vehicles', ['success' => '3']);
    }

    public function getvehicleajax(Request $request)
    {
        $id = $request->input('id');

        $vehicleData = VehicleData::query()
        ->where('vreg_number', $id)
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $vehicleData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

}
