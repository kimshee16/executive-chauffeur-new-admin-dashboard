<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientsData = Clients::query()
        ->where('log_id', 0)
        ->orderByDesc('date_added')
        ->get();

        return view('clients.clients', compact('clientsData'));
    }

    public function createclient(Request $request)
    {
        $datenow = time();
        $firstname = $request->input('firstname');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $town = $request->input('town');
        $city = $request->input('city');
        $county = $request->input('county');
        $postcode = $request->input('postcode');
        $usualpayment = $request->input('usualpayment');
        $creditcardnumber = $request->input('creditcardnumber');
        $expirydate = $request->input('expirydate');
        $securitycode = $request->input('securitycode');
        $nameoncard = $request->input('nameoncard');
        $companyname = $request->input('companyname');
        $department = $request->input('department');
        $companyaddress1 = $request->input('companyaddress1');
        $companyaddress2 = $request->input('companyaddress2');
        $companycity = $request->input('companycity');
        $companycounty = $request->input('companycounty');
        $companypostcode = $request->input('companypostcode');
        $companycountry = $request->input('companycountry');
        $companyphone = $request->input('companyphone');
        $companyfax = $request->input('companyfax');
        $website = $request->input('website');
        $descriptionofbusiness = $request->input('descriptionofbusiness');
        $secretaryname = $request->input('secretaryname');
        $secretaryphone = $request->input('secretaryphone');
        $secretaryemail = $request->input('secretaryemail');
        $usuallysits = $request->input('usuallysits');
        $climate = $request->input('climate');
        $listenstoradio = $request->input('listenstoradio');
        $radiostation = $request->input('radiostation');
        $airportpickups = $request->input('airportpickups');
        $anyparticularroute = $request->input('anyparticularroute');
        $descriptionofluggage = $request->input('descriptionofluggage');
        $drinkswater = $request->input('drinkswater');
        $descriptionofclient = $request->input('descriptionofclient');
        $generalinfo = $request->input('generalinfo');

        $data = [
            'date_added' => $datenow,
            'first_name' => $firstname,
            'surname' => $surname,
            'email' => $email,
            'phone' => $phone,
            'payment_method' => $usualpayment,
            'card_no' => $creditcardnumber,
            'card_exp' => $expirydate,
            'card_code' => $securitycode,
            'card_name' => $nameoncard,
            'comp_name' => $companyname,
            'comp_dep' => $department,
            'comp_addr1' => $companyaddress1,
            'comp_addr2' => $companyaddress2,
            'comp_city' => $companycity,
            'comp_county' => $companycounty,
            'comp_postcode' => $companypostcode,
            'comp_country' => $companycountry,
            'comp_phone' => $companyphone,
            'comp_fax' => $companyfax,
            'comp_website' => $website,
            'comp_des' => $descriptionofbusiness,
            'pref_sits' => $usuallysits,
            'pref_climate' => $climate,
            'pref_radio' => $listenstoradio,
            'pref_station' => $radiostation,
            'pref_pickup' => $airportpickups,
            'pref_route' => $anyparticularroute,
            'pref_luggage' => $descriptionofluggage,
            'pref_drink' => $drinkswater,
            'pref_client_des' => $descriptionofclient,
            'genral_info' => $generalinfo,
            'home_addr1' => $address1,
            'home_addr2' => $address2,
            'home_town' => $town,
            'home_city' => $city,
            'home_postcode' => $postcode,
            'home_county' => $county,
            'sec_name' => $secretaryname,
            'sec_phone' => $secretaryphone,
            'sec_email' => $secretaryemail,
        ];

        $clientsave = Clients::create($data);

        return redirect()->route('clients', ['success' => '1']);

    }

    public function updateclient(Request $request)
    {
        $editclientid = $request->input('editclientid');
        $editfirstname = $request->input('editfirstname');
        $editsurname = $request->input('editsurname');
        $editemail = $request->input('editemail');
        $editphone = $request->input('editphone');
        $editaddress1 = $request->input('editaddress1');
        $editaddress2 = $request->input('editaddress2');
        $edittown = $request->input('edittown');
        $editcity = $request->input('editcity');
        $editcounty = $request->input('editcounty');
        $editpostcode = $request->input('editpostcode');
        $editusualpayment = $request->input('editusualpayment');
        $editcreditcardnumber = $request->input('editcreditcardnumber');
        $editexpirydate = $request->input('editexpirydate');
        $editsecuritycode = $request->input('editsecuritycode');
        $editnameoncard = $request->input('editnameoncard');
        $editcompanyname = $request->input('editcompanyname');
        $editdepartment = $request->input('editdepartment');
        $editcompanyaddress1 = $request->input('editcompanyaddress1');
        $editcompanyaddress2 = $request->input('editcompanyaddress2');
        $editcompanycity = $request->input('editcompanycity');
        $editcompanycounty = $request->input('editcompanycounty');
        $editcompanypostcode = $request->input('editcompanypostcode');
        $editcompanycountry = $request->input('editcompanycountry');
        $editcompanyphone = $request->input('editcompanyphone');
        $editcompanyfax = $request->input('editcompanyfax');
        $editwebsite = $request->input('editwebsite');
        $editdescriptionofbusiness = $request->input('editdescriptionofbusiness');
        $editsecretaryname = $request->input('editsecretaryname');
        $editsecretaryphone = $request->input('editsecretaryphone');
        $editsecretaryemail = $request->input('editsecretaryemail');
        $editusuallysits = $request->input('editusuallysits');
        $editclimate = $request->input('editclimate');
        $editlistenstoradio = $request->input('editlistenstoradio');
        $editradiostation = $request->input('editradiostation');
        $editairportpickups = $request->input('editairportpickups');
        $editanyparticularroute = $request->input('editanyparticularroute');
        $editdescriptionofluggage = $request->input('editdescriptionofluggage');
        $editdrinkswater = $request->input('editdrinkswater');
        $editdescriptionofclient = $request->input('editdescriptionofclient');
        $editgeneralinfo = $request->input('editgeneralinfo');

        $clientdata = Clients::find($editclientid);

        $clientdata->first_name = $editfirstname;
        $clientdata->surname = $editsurname;
        $clientdata->email = $editemail;
        $clientdata->phone = $editphone;
        $clientdata->payment_method = $editusualpayment;
        $clientdata->card_no = $editcreditcardnumber;
        $clientdata->card_exp = $editexpirydate;
        $clientdata->card_code = $editsecuritycode;
        $clientdata->card_name = $editnameoncard;
        $clientdata->comp_name = $editcompanyname;
        $clientdata->comp_dep = $editdepartment;
        $clientdata->comp_addr1 = $editcompanyaddress1;
        $clientdata->comp_addr2 = $editcompanyaddress2;
        $clientdata->comp_city = $editcompanycity;
        $clientdata->comp_county = $editcompanycounty;
        $clientdata->comp_postcode = $editcompanypostcode;
        $clientdata->comp_country = $editcompanycountry;
        $clientdata->comp_phone = $editcompanyphone;
        $clientdata->comp_fax = $editcompanyfax;
        $clientdata->comp_website = $editwebsite;
        $clientdata->comp_des = $editdescriptionofbusiness;
        $clientdata->pref_sits = $editusuallysits;
        $clientdata->pref_climate = $editclimate;
        $clientdata->pref_radio = $editlistenstoradio;
        $clientdata->pref_station = $editradiostation;
        $clientdata->pref_pickup = $editairportpickups;
        $clientdata->pref_route = $editanyparticularroute;
        $clientdata->pref_luggage = $editdescriptionofluggage;
        $clientdata->pref_drink = $editdrinkswater;
        $clientdata->pref_client_des = $editdescriptionofclient;
        $clientdata->genral_info = $editgeneralinfo;
        $clientdata->home_addr1 = $editaddress1;
        $clientdata->home_addr2 = $editaddress2;
        $clientdata->home_town = $edittown;
        $clientdata->home_city = $editcity;
        $clientdata->home_postcode = $editpostcode;
        $clientdata->home_county = $editcounty;
        $clientdata->sec_name = $editsecretaryname;
        $clientdata->sec_email = $editsecretaryemail;
        $clientdata->sec_phone = $editsecretaryphone;
        $clientdata->save();

        return redirect()->route('clients', ['success' => '2']);
    }

    public function getclientajax(Request $request)
    {
        $id = $request->input('id');

        $clientData = Clients::query()
        ->where('id', $id)
        ->get();

        // Build the response
        $response = [
            'status' => 'success',
            'data' => $clientData,
        ];

        // Return the AJAX response
        return response()->json($response);
    }

    public function deleteclient(Request $request)
    {
        $deleteclientid = $request->input('deleteclientid');
        $client = Clients::find($deleteclientid);
        $client->delete();
        return redirect()->route('clients', ['success' => '3']);
    }
    
}
