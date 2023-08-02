<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\PaymentSettings;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientsData = Clients::query('clients')
        ->where('log_id', 0)
        ->orderBy('first_name', 'asc')
        ->get();

        $paymentsData = PaymentSettings::all();

        return view('bookings.invoices', compact('clientsData', 'paymentsData'));
    }

}
