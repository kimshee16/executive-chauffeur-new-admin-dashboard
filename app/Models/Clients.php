<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [    
        'id',
        'login_id',
        'log_id',
        'date_added',
        'first_name',
        'surname',
        'email',
        'phone',
        'payment_method',
        'card_no',
        'card_exp',
        'card_code',
        'card_name',
        'comp_name',
        'comp_dep',
        'comp_addr1',
        'comp_addr2',
        'comp_city',
        'comp_county',
        'comp_postcode',
        'comp_country',
        'comp_phone',
        'comp_fax',
        'comp_website',
        'comp_des',
        'pref_sits',
        'pref_climate',
        'pref_radio',
        'pref_station',
        'pref_pickup',
        'pref_route',
        'pref_luggage',
        'pref_drink',
        'pref_client_des',
        'genral_info',
        'home_addr1',
        'home_addr2',
        'home_town',
        'home_city',
        'home_postcode',
        'home_county',
        'sec_name',
        'sec_phone',
        'sec_email',
        'test'
    ];

}
