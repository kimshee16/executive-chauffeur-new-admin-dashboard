<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Drivers;
use App\Models\VehicleData;
use App\Models\PaymentSettings;
use App\Models\Clients;
use DB;
use Carbon\Carbon;
use PDF;
use App\Mail\ConfirmProposalEmail;
use Illuminate\Support\Facades\Mail;

class BookingsController extends Controller
{
    /**
     * Display quotation request list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotationsData = Bookings::join('clients', 'clients.id', '=', 'quotes.book_acc')
        ->whereIn('quotes.book_status', ['Not actioned', 'Proposal sent'])
        ->select('quotes.*', 'clients.first_name', 'clients.surname', 'clients.id AS client_id')
        ->get();

        $clientsData = Clients::query('clients')
        ->where('log_id', 0)
        ->orderBy('first_name', 'asc')
        ->get();

        $paymentsData = PaymentSettings::all();

        $vehiclesData = VehicleData::query()
        ->orderBy('vreg_number', 'asc')
        ->get();

        $driversData = Drivers::query()
        ->orderBy('name', 'asc')
        ->get();

        return view('bookings.quotationrequests', compact('quotationsData', 'clientsData', 'paymentsData', 'vehiclesData', 'driversData'));
    }

    public function completednotpaidbookings()
    {
        $quotationsData = Bookings::join('clients', 'clients.id', '=', 'quotes.book_acc')
        ->where('quotes.book_status', 'Completed')
        ->where('quotes.payment_proccessed', 'No')
        ->select('quotes.*', 'clients.first_name', 'clients.surname', 'clients.id AS client_id')
        ->get();

        $driversData = DB::select('SELECT d.driver_id, d.name, d.email, d.phone, d.photo, count(q.id) as jobs FROM `drivers` d join quotes q ON (d.driver_id = q.driver_id OR d.name = q.driver_name) group by d.driver_id, d.name, d.email, d.phone, d.photo order by d.name asc');

        return view('bookings.completednotpaidquotations', compact('quotationsData', 'driversData'));
    }

    public function driverjoblist(Request $request)
    {
        $driverid = $request->input('driverid');
        $drivername = $request->input('drivername');

        $driversquotationsData = DB::select('SELECT * FROM quotes q inner join clients c on q.book_acc = c.id WHERE (q.driver_id = "'.$driverid.'" OR q.driver_name = "'.$drivername.'")');
        foreach($driversquotationsData as $data) {
            $data->driverid = $driverid;
            $data->drivername = $drivername;
        }

        return view('bookings.driverjoblist', compact('driversquotationsData'));
    }

    public function getbookingajax(Request $request)
    {
        $id = $request->input('id');

        $bookingData = Bookings::join('clients', 'clients.id', '=', 'quotes.book_acc')
        ->where('quotes.id', $id)
        ->select('quotes.*', 'quotes.id as bookingId', 'clients.email', 'clients.first_name', 'clients.surname', 'clients.id AS client_id')
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $bookingData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

    /**
     * Display confirmed quotaion list.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmedbookings()
    {
        $quotationsData = Bookings::join('clients', 'clients.id', '=', 'quotes.book_acc')
        ->whereIn('quotes.book_status', ['Confirmed'])
        ->select('quotes.*', 'clients.first_name', 'clients.surname', 'clients.id AS client_id')
        ->get();

        $clientsData = Clients::query('clients')
        ->where('log_id', 0)
        ->orderBy('first_name', 'asc')
        ->get();

        $paymentsData = PaymentSettings::all();

        $vehiclesData = VehicleData::query()
        ->orderBy('vreg_number', 'asc')
        ->get();

        $driversData = Drivers::query()
        ->orderBy('name', 'asc')
        ->get();

        return view('bookings.confirmedquotations', compact('quotationsData', 'clientsData', 'paymentsData', 'vehiclesData', 'driversData'));
    }

    /**
     * Display completed quotaion list.
     *
     * @return \Illuminate\Http\Response
     */
    public function completedbookings()
    {
        $quotationsData = Bookings::join('clients', 'clients.id', '=', 'quotes.book_acc')
        ->whereIn('quotes.book_status', ['Completed'])
        ->select('quotes.*', 'clients.first_name', 'clients.surname', 'clients.id AS client_id')
        ->get();

        $clientsData = Clients::query('clients')
        ->where('log_id', 0)
        ->orderBy('first_name', 'asc')
        ->get();

        $paymentsData = PaymentSettings::all();

        $vehiclesData = VehicleData::query()
        ->orderBy('vreg_number', 'asc')
        ->get();

        $driversData = Drivers::query()
        ->orderBy('name', 'asc')
        ->get();

        return view('bookings.completedquotations', compact('quotationsData', 'clientsData', 'paymentsData', 'vehiclesData', 'driversData'));
    }

    public function changebookingstatus(Request $request)
    {
        $id = $request->input('bookingid');
        $bookingstatus = $request->input('bookingstatus');

        DB::table('quotes')
        ->where('id', $id)
        ->update([
            'book_status' => $bookingstatus
        ]);

        return $this->index();
    }

    public function createbooking(Request $request)
    {
        $datenow = time();
        $sourceofbooking = $request->input('sourceofbooking');
        $bookingreference = $request->input('bookingreference');
        $account = $request->input('account');
        $paymenttype = $request->input('paymenttype');
        $subtotal = $request->input('subtotal');
        $waitingtime = $request->input('waitingtime');
        $carparking = $request->input('carparking');
        $londoncongestioncharge = $request->input('londoncongestioncharge');
        $ulez = $request->input('ulez');
        $servicecharge = $request->input('servicecharge');
        $total = $request->input('total');
        $specialrequest = $request->input('specialrequest');
        $preferredvehicle = $request->input('preferredvehicle');
        $numberofpassengers = $request->input('numberofpassengers');
        $datetimeofjourney = $request->input('datetimeofjourney');
        $returnjourney = $request->input('returnjourney');
        $datetimeofreturnjourney = $request->input('datetimeofreturnjourney');
        $paymentprocessed = $request->input('paymentprocessed');
        $drivername = $request->input('drivername');
        $driverid = $request->input('driverid');
        $vehicleinfo = $request->input('vehicleinfo');
        $collectionaddress = $request->input('collectionaddress');
        $goingto = $request->input('goingto');
        $airportterminal = $request->input('airportterminal');
        $poi = $request->input('poi');
        $pc = $request->input('pc');
        $flightnumber = $request->input('flightnumber');
        $arrivingfrom = $request->input('arrivingfrom');

        $returnjourneycarbonInstance = Carbon::parse($datetimeofreturnjourney);

        $returnjourneymonth = $returnjourneycarbonInstance->month;
        $returnjourneyday = $returnjourneycarbonInstance->day;
        $returnjourneyyear = $returnjourneycarbonInstance->year;
        $returnjourneyhour = $returnjourneycarbonInstance->hour;
        $returnjourneyminute = $returnjourneycarbonInstance->minute;
        $returnjourneyamPm = $returnjourneycarbonInstance->format('A');

        $journeycarbonInstance = Carbon::parse($datetimeofjourney);

        $journeymonth = $journeycarbonInstance->month;
        $journeyday = $journeycarbonInstance->day;
        $journeyyear = $journeycarbonInstance->year;
        $journeyhour = $journeycarbonInstance->hour;
        $journeyminute = $journeycarbonInstance->minute;
        $journeyamPm = $journeycarbonInstance->format('A');

        $datetimeofjourney = date('d-m-Y', strtotime($datetimeofjourney));
        $datetimeofreturnjourney = date('d-m-Y', strtotime($datetimeofreturnjourney));

        $data = [
            'date_added' => $datenow,
            'vehicle' => $preferredvehicle,
            'passengers' => $numberofpassengers,
            'journey_date' => $datetimeofjourney,
            'return_date' => $datetimeofreturnjourney,
            'journey_hour' => $journeyhour,
            'journey_minutes' => $journeyminute,
            'journey_AMPM' => strtoupper($journeyamPm),
            'address' => $collectionaddress,
            'going_to' => $goingto,
            'airport' => $airportterminal,
            'flight_no' => $flightnumber,
            'return_journey' => $returnjourney,
            'return_journey_hour' => $returnjourneyhour, 
            'return_journey_minutes' => $returnjourneyminute,
            'return_journey_AMPM' => strtoupper($returnjourneyamPm),
            'special_requests' => $specialrequest,
            'book_source' => $sourceofbooking,
            'book_ref' => $bookingreference, 
            'book_payment_type' => $paymenttype,
            'book_subtotal' => $subtotal,
            'book_waiting_time' => $waitingtime,
            'book_car_parking' => $carparking,
            'book_congestion' => $londoncongestioncharge, 
            'book_total' => $total,
            'payment_proccessed' => $paymentprocessed,
            'driver_name' => $drivername,
            'vehicle_info' => $vehicleinfo,
            'type' => 'Quotation',
            'status' => 'Booking Confirmed',
            'book_status' => 'Confirmed',
            'book_acc' => $account,
            'book_service_charge' => $servicecharge,
            'driver_id' => $driverid,
            'arriving_from' => $arrivingfrom,
            'ulez' => $ulez
        ];

        $booking = Bookings::create($data);

        $createbookinglocation = $request->input('createbookinglocation');

        if($createbookinglocation == "quotationrequests") {
            return redirect()->route('bookings', ['success' => '1']);
        } else if($createbookinglocation == "confirmedbookings") {
            return redirect()->route('confirmedbookings', ['success' => '1']);
        } else if($createbookinglocation == "completedbookings") {
            return redirect()->route('completedbookings', ['success' => '1']);
        }
    }

    public function updatebooking(Request $request)
    {
        $editbookingid = $request->input('editbookingid');
        $editsourceofbooking = $request->input('editsourceofbooking');
        $editbookingreference = $request->input('editbookingreference');
        $editaccount = $request->input('editaccount');
        $editpaymenttype = $request->input('editpaymenttype');
        $editsubtotal = $request->input('editsubtotal');
        $editwaitingtime = $request->input('editwaitingtime');
        $editcarparking = $request->input('editcarparking');
        $editlondoncongestioncharge = $request->input('editlondoncongestioncharge');
        $editulez = $request->input('editulez');
        $editservicecharge = $request->input('editservicecharge');
        $edittotal = $request->input('edittotal');
        $editspecialrequest = $request->input('editspecialrequest');
        $editpreferredvehicle = $request->input('editpreferredvehicle');
        $editnumberofpassengers = $request->input('editnumberofpassengers');
        $editdatetimeofjourney = $request->input('editdatetimeofjourney');
        $editreturnjourney = $request->input('editreturnjourney');
        $editdatetimeofreturnjourney = $request->input('editdatetimeofreturnjourney');
        $editpaymentprocessed = $request->input('editpaymentprocessed');
        $editdrivername = $request->input('editdrivername');
        $editdriverid = $request->input('editdriverid');
        $editvehicleinfo = $request->input('editvehicleinfo');
        $editcollectionaddress = $request->input('editcollectionaddress');
        $editgoingto = $request->input('editgoingto');
        $editairportterminal = $request->input('editairportterminal');
        $editpoi = $request->input('editpoi');
        $editpc = $request->input('editpc');
        $editflightnumber = $request->input('editflightnumber');
        $editarrivingfrom = $request->input('editarrivingfrom');

        $editreturnjourneycarbonInstance = Carbon::parse($editdatetimeofreturnjourney);

        $editreturnjourneymonth = $editreturnjourneycarbonInstance->month;
        $editreturnjourneyday = $editreturnjourneycarbonInstance->day;
        $editreturnjourneyyear = $editreturnjourneycarbonInstance->year;
        $editreturnjourneyhour = $editreturnjourneycarbonInstance->hour;
        $editreturnjourneyminute = $editreturnjourneycarbonInstance->minute;
        $editreturnjourneyamPm = $editreturnjourneycarbonInstance->format('A');

        $editjourneycarbonInstance = Carbon::parse($editdatetimeofjourney);

        $editjourneymonth = $editjourneycarbonInstance->month;
        $editjourneyday = $editjourneycarbonInstance->day;
        $editjourneyyear = $editjourneycarbonInstance->year;
        $editjourneyhour = $editjourneycarbonInstance->hour;
        $editjourneyminute = $editjourneycarbonInstance->minute;
        $editjourneyamPm = $editjourneycarbonInstance->format('A');

        $editdatetimeofjourney = date('d-m-Y', strtotime($editdatetimeofjourney));
        $editdatetimeofreturnjourney = date('d-m-Y', strtotime($editdatetimeofreturnjourney));

        $bookingdata = Bookings::find($editbookingid);

        $bookingdata->vehicle = $editpreferredvehicle;
        $bookingdata->passengers = $editnumberofpassengers;
        $bookingdata->journey_date = $editdatetimeofjourney;
        $bookingdata->return_date = $editdatetimeofreturnjourney;
        $bookingdata->journey_hour = $editjourneyhour;
        $bookingdata->journey_minutes = $editjourneyminute;
        $bookingdata->journey_AMPM = strtoupper($editjourneyamPm);
        $bookingdata->address = $editcollectionaddress;
        $bookingdata->going_to = $editgoingto;
        $bookingdata->airport = $editairportterminal;
        $bookingdata->flight_no = $editflightnumber;
        $bookingdata->return_journey = $editreturnjourney;
        $bookingdata->return_journey_hour = $editreturnjourneyhour; 
        $bookingdata->return_journey_minutes = $editreturnjourneyminute;
        $bookingdata->return_journey_AMPM = strtoupper($editreturnjourneyamPm);
        $bookingdata->special_requests = $editspecialrequest;
        $bookingdata->book_source = $editsourceofbooking;
        $bookingdata->book_ref = $editbookingreference; 
        $bookingdata->book_payment_type = $editpaymenttype;
        $bookingdata->book_subtotal = $editsubtotal;
        $bookingdata->book_waiting_time = $editwaitingtime;
        $bookingdata->book_car_parking = $editcarparking;
        $bookingdata->book_congestion = $editlondoncongestioncharge; 
        $bookingdata->book_total = $edittotal;
        $bookingdata->payment_proccessed = $editpaymentprocessed;
        $bookingdata->driver_name = $editdrivername;
        $bookingdata->vehicle_info = $editvehicleinfo;
        $bookingdata->book_acc = $editaccount;
        $bookingdata->book_service_charge = $editservicecharge;
        $bookingdata->driver_id = $editdriverid;
        $bookingdata->arriving_from = $editarrivingfrom;
        $bookingdata->ulez = $editulez;        
        $bookingdata->save();

        $editbookinglocation = $request->input('editbookinglocation');

        if($editbookinglocation == "quotationrequests") {
            return redirect()->route('bookings', ['success' => '2']);
        } else if($editbookinglocation == "confirmedbookings") {
            return redirect()->route('confirmedbookings', ['success' => '2']);
        } else if($editbookinglocation == "completedbookings") {
            return redirect()->route('completedbookings', ['success' => '2']);
        }
    }

    public function deletebooking(Request $request)
    {
        $deletebookingid = $request->input('deletebookingid');
        $deletebookinglocation = $request->input('deletebookinglocation');

        $booking = Bookings::find($deletebookingid);
        $booking->delete();

        if($deletebookinglocation == "quotationrequests") {
            return redirect()->route('bookings', ['success' => '3']);
        } else if($deletebookinglocation == "confirmedbookings") {
            return redirect()->route('confirmedbookings', ['success' => '3']);
        } else if($deletebookinglocation == "completedbookings") {
            return redirect()->route('completedbookings', ['success' => '3']);
        }
        
    }

    public function getinvoicesajax(Request $request)
    {
        $clientId = $request->input('client');
        $paymentProcessed = $request->input('payment');
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if($clientId === null || $clientId == "") {
            $clientcondition = ""; 
        } elseif($clientId !== null || $clientId != "") {
            $clientcondition = "AND q.book_acc = '$clientId'"; 
        }

        if($paymentProcessed === null || $paymentProcessed == "") {
            $paymentcondition = ""; 
        } elseif($paymentProcessed !== null || $paymentProcessed != "") {
            if(($startDate === null && $endDate === null) || ($startDate == "" && $endDate == "")) {
                $paymentcondition = "WHERE q.payment_proccessed = '$paymentProcessed'"; 
            } else {
                $paymentcondition = "AND q.payment_proccessed = '$paymentProcessed'";
            }
        }

        if(($startDate === null && $endDate === null) || ($startDate == "" && $endDate == "")) {
            $datecondition = ""; 
        } elseif(($startDate !== null && $endDate !== null) || ($startDate != "" && $endDate != "")) {
            $startDate = date('d-m-Y', strtotime($startDate));
            $endDate = date('d-m-Y', strtotime($endDate));
            $datecondition = "WHERE STR_TO_DATE(q.journey_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDate', '%d-%m-%Y') AND STR_TO_DATE('$endDate', '%d-%m-%Y')"; 
        }

        $bookingData = DB::select("SELECT concat(c.first_name,' ',c.surname) as fullname, c.id as clientid, q.id as bookingid, c.*,q.* FROM quotes q join clients c on (q.book_acc=c.id) $datecondition $paymentcondition $clientcondition order by STR_TO_DATE(CONCAT(q.journey_date,',',q.journey_hour,',',q.journey_minutes),'%d-%m-%Y,%H,%i') ASC;");

        if(($startDate === null && $endDate === null) || ($startDate == "" && $endDate == "")) {
            // Build the response
            $response = [
                'status' => 'success',
                'data' => new \stdClass(),
            ];
        } elseif(($startDate !== null && $endDate !== null) || ($startDate != "" && $endDate != "")) {
            // Build the response
            $response = [
                'status' => 'success',
                'clientId' => $clientId,
                'paymentProcessed' => $paymentProcessed,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'data' => $bookingData,
            ];
        }

        // Return the AJAX response

        return response()->json($response);
    }

    public function generatepdf(Request $request)
    {
        $clientId = $request->input('clientId');
        $paymentProcessed = $request->input('paymentProcessed');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $exportcompany = $request->input('exportcompany');
        $exportsecretary = $request->input('exportsecretary');
        $exportpaymenttype = $request->input('exportpaymenttype');
        $exportaddress = $request->input('exportaddress');
        $exportcity = $request->input('exportcity');
        $exportpostcode = $request->input('exportpostcode');
        $exportcounty = $request->input('exportcounty');
        $exportphone = $request->input('exportphone');

        $html = "";
        $totalsum = 0;

        if($clientId === null || $clientId == "") {
            $clientcondition = ""; 
        } elseif($clientId !== null || $clientId != "") {
            $clientcondition = "AND q.book_acc = '$clientId'"; 
        }

        if($paymentProcessed === null || $paymentProcessed == "") {
            $paymentcondition = ""; 
        } elseif($paymentProcessed !== null || $paymentProcessed != "") {
            if(($startDate === null && $endDate === null) || ($startDate == "" && $endDate == "")) {
                $paymentcondition = "WHERE q.payment_proccessed = '$paymentProcessed'"; 
            } else {
                $paymentcondition = "AND q.payment_proccessed = '$paymentProcessed'";
            }
        }

        if(($startDate === null && $endDate === null) || ($startDate == "" && $endDate == "")) {
            $datecondition = ""; 
        } elseif(($startDate !== null && $endDate !== null) || ($startDate != "" && $endDate != "")) {
            $startDate = date('d-m-Y', strtotime($startDate));
            $endDate = date('d-m-Y', strtotime($endDate));
            $datecondition = "WHERE STR_TO_DATE(q.journey_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$startDate', '%d-%m-%Y') AND STR_TO_DATE('$endDate', '%d-%m-%Y')"; 
        }

        $bookingData = DB::select("SELECT concat(c.first_name,' ',c.surname) as fullname, c.id as clientid, q.id as bookingid, c.*,q.* FROM quotes q join clients c on (q.book_acc=c.id) $datecondition $paymentcondition $clientcondition order by STR_TO_DATE(CONCAT(q.journey_date,',',q.journey_hour,',',q.journey_minutes),'%d-%m-%Y,%H,%i') ASC;");

        $html .= '
                <html>
                <head>
                    <title>Invoice</title>
                </head>
                <body>
                    <center><h1>TRAVEL STATEMENT</h1></center>
                    <img src="'.public_path('images/executive-chauffeurslogon.jpg').'" width="380px"><br>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 50%;">
                                <small>Booking: booking@executive-chauffeur.com</small><br>
                                <small>Web: executive-chauffeur.com</small><br>
                                <small>Email: info@executive-chauffeur.com</small><br>
                                <small>Phone: 0330 2233330</small><br><br>
                                '.$exportsecretary.'<br>
                                '.$exportcompany.'<br>
                                '.$exportaddress.'<br>
                                '.$exportcity.'<br>
                                '.$exportpostcode.'<br>
                                '.$exportcounty.'<br>
                                Phone: '.$exportphone.'
                            </td>
                            <td style="width: 50%; text-align: right;">
                                Date: '.date("d-M-Y").'<br>
                                Payment type: '.$exportpaymenttype.'<br>
                                Payment received with thanks<br>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 12px;">
                        <thead style="background-color: black; color: white;">
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Booking<br>Reference</th>
                                <th>Account</th>
                                <th>Pick-up<br>Address</th>
                                <th>Destination</th>
                                <th>Amount<br>(£)</th>
                                <th>Car Park<br>(£)</th>
                                <th>Toll Chrgs<br>(£)</th>
                                <th>Svc Chrgs<br>(£)</th>
                                <th>Total<br>(£)</th>
                            </tr>
                        </thead>
                        <tbody>
                            ';

                            foreach($bookingData as $data) {
                                $html .= '<tr>';
                                $html .= '<td>'.$data->journey_date.'</td>';

                                $hour = str_pad($data->journey_hour, 2, '0', STR_PAD_LEFT);
                                $minutes = str_pad($data->journey_minutes, 2, '0', STR_PAD_LEFT);
                                $time = $hour . ':' . $minutes;
                                $html .= '<td>'.$time.'</td>';
                                
                                $html .= '<td>'.$data->book_ref.'</td>';
                                $html .= '<td>'.$data->fullname.'</td>';
                                $html .= '<td>'.$data->address.'</td>';
                                $html .= '<td>'.$data->going_to.'</td>';
                                $html .= '<td style="border-left: 1px solid black;">'.$data->book_subtotal.'</td>';
                                $html .= '<td style="border-left: 1px solid black;">'.$data->book_car_parking.'</td>';
                                $html .= '<td style="border-left: 1px solid black;">'.$data->book_congestion.'</td>';
                                $html .= '<td style="border-left: 1px solid black;">'.$data->book_service_charge.'</td>';
                                $html .= '<td style="border-left: 1px solid black;">'.$data->book_total.'</td>';
                                $html .= '</tr>';

                                $totalsum = $totalsum + $data->book_total;
                            }

        $html .=            '
                            <tr>
                                <td colspan="10" style="text-align: right; border: 1px solid black;"><b>TOTAL</b></td>
                                <td style="border: 1px solid black;"><b>'.$totalsum.'</b></td>
                            </tr>
                        </tbody>
                    </table>
                </body>
                </html>
                ';

        $pdf = PDF::loadHtml($html);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('example.pdf');

    }

    function confirmbooking(Request $request) {
        $subject = $request->input('confirmsubject');
        $recipient = $request->input('confirmto');
        $body = $request->input('confirmbody');
        
        Mail::to($recipient)->send(new ConfirmProposalEmail($subject, $recipient, $body));
        
        $confirmbookinglocation = $request->input('confirmbookinglocation');

        if($confirmbookinglocation == "quotationrequests") {
            return redirect()->route('bookings', ['success' => '4']);
        } else if($confirmbookinglocation == "confirmedbookings") {
            return redirect()->route('confirmedbookings', ['success' => '4']);
        } else if($confirmbookinglocation == "completedbookings") {
            return redirect()->route('completedbookings', ['success' => '4']);
        }
    }

}