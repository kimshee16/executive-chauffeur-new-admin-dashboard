<?php

namespace App\Http\Controllers;

use App\Models\PaymentSettings;
use App\Models\FeeSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeSettingsData = FeeSettings::query()
        ->where('isdeleted', 0)
        ->get();

        $paymentsSettingsData = PaymentSettings::all();

        return view('settings.settings', compact('feeSettingsData', 'paymentsSettingsData'));
    }

    public function createfeesettings(Request $request)
    {
        $feedescription = $request->input('feedescription');
        $feecost = $request->input('feecost');
        $feegeneralurl = $request->input('feegeneralurl');
        $feeaccounturl = $request->input('feeaccounturl');
        $datenow = date("Y-m-d");

        $data = [
            'description' => $feedescription,
            'cost' => $feecost,
            'generalurl' => $feegeneralurl,
            'accounturl' => $feeaccounturl,
            'datecreated' => $datenow,
            'isdeleted' => 0
        ];

        $feesettings = FeeSettings::create($data);

        return redirect()->route('settings', ['success' => '1']);
    }

    public function editfeesettings(Request $request)
    {
        $editfeedescription = $request->input('editfeedescription');
        $editfeecost = $request->input('editfeecost');
        $editfeegeneralurl = $request->input('editfeegeneralurl');
        $editfeeaccounturl = $request->input('editfeeaccounturl');
        $editfeesettingsid = $request->input('editfeesettingsid');

        $feesettings = FeeSettings::find($editfeesettingsid);

        $feesettings->description = $editfeedescription;
        $feesettings->cost = $editfeecost;
        $feesettings->generalurl = $editfeegeneralurl;
        $feesettings->accounturl = $editfeeaccounturl;
        $feesettings->save();

        return redirect()->route('settings', ['success' => '2']);
    }

    public function deletefeesettings(Request $request)
    {
        $deletefeesettingsid = $request->input('deletefeesettingsid');
        $feesettings = FeeSettings::find($deletefeesettingsid);
        $feesettings->isdeleted = 1;
        $feesettings->save();
        return redirect()->route('settings', ['success' => '3']);
    }

    public function getfeesettingsajax(Request $request)
    {
        $id = $request->input('id');

        $feeSettingsData = FeeSettings::query()
        ->where('id', $id)
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $feeSettingsData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

    public function createpaymentsettings(Request $request)
    {
        $paymenttype = $request->input('paymenttype');
        $datenow = date("Y-m-d");

        $data = [
            'paymenttype' => $paymenttype,
            'datecreated' => $datenow,
        ];

        $paymentsettings = PaymentSettings::create($data);

        return redirect()->route('settings', ['success' => '1']);
    }

    public function editpaymentsettings(Request $request)
    {
        $editpaymenttype = $request->input('editpaymenttype');
        $editpaymentsettingid = $request->input('editpaymentsettingid');

        $paymentsettings = PaymentSettings::find($editpaymentsettingid);

        $paymentsettings->paymenttype = $editpaymenttype;
        $paymentsettings->save();

        return redirect()->route('settings', ['success' => '2']);
    }

    public function deletepaymentsettings(Request $request)
    {
        $deletepaymentsettingsid = $request->input('deletepaymentsettingsid');
        $paymentsettings = PaymentSettings::find($deletepaymentsettingsid);
        $paymentsettings->delete();
        return redirect()->route('settings', ['success' => '3']);
    }

    public function getpaymentsettingsajax(Request $request)
    {
        $id = $request->input('id');

        $paymentSettingsData = PaymentSettings::query()
        ->where('id', $id)
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $paymentSettingsData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

}
