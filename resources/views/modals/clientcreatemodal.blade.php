@php
    use Illuminate\Support\Facades\Request;
@endphp

<?php
  $countries = array(
    '1' => 'Afghanistan',
    '2' => 'Albania',
    '3' => 'Algeria',
    '4' => 'American Samoa',
    '5' => 'Andorra',
    '6' => 'Angola',
    '7' => 'Anguilla',
    '8' => 'Antarctica',
    '9' => 'Antigua and Barbuda',
    '10' => 'Argentina',
    '11' => 'Armenia',
    '12' => 'Aruba',
    '13' => 'Australia',
    '14' => 'Austria',
    '15' => 'Azerbaidjan',
    '16' => 'Bahamas',
    '17' => 'Bahrain',
    '18' => 'Bangladesh',
    '19' => 'Barbados',
    '20' => 'Belarus',
    '21' => 'Belgium',
    '22' => 'Belize',
    '23' => 'Benin',
    '24' => 'Bermuda',
    '25' => 'Bhutan',
    '26' => 'Bolivia',
    '27' => 'Bosnia-Herzegovina',
    '28' => 'Botswana',
    '29' => 'Bouvet Island',
    '30' => 'Brazil',
    '31' => 'British Indian Ocean Territory',
    '32' => 'Brunei Darussalam',
    '33' => 'Bulgaria',
    '34' => 'Burkina Faso',
    '35' => 'Burundi',
    '36' => 'Cambodia',
    '37' => 'Cameroon',
    '38' => 'Canada',
    '39' => 'Cape Verde',
    '40' => 'Cayman Islands',
    '41' => 'Central African Republic',
    '42' => 'Chad',
    '43' => 'Chile',
    '44' => 'China',
    '45' => 'Christmas Island',
    '46' => 'Cocos (Keeling) Islands',
    '47' => 'Colombia',
    '48' => 'Comoros',
    '49' => 'Congo',
    '50' => 'Cook Islands',
    '51' => 'Costa Rica',
    '52' => 'Croatia',
    '53' => 'Cyprus',
    '54' => 'Czech Republic',
    '55' => 'Denmark',
    '56' => 'Djibouti',
    '57' => 'Dominica',
    '58' => 'Dominican Republic',
    '59' => 'East Timor',
    '60' => 'Ecuador',
    '61' => 'Egypt',
    '62' => 'El Salvador',
    '63' => 'Equatorial Guinea',
    '64' => 'Eritrea',
    '65' => 'Estonia',
    '66' => 'Ethiopia',
    '67' => 'Falkland Islands',
    '68' => 'Faroe Islands',
    '69' => 'Fiji',
    '70' => 'Finland',
    '71' => 'Former USSR',
    '72' => 'France',
    '73' => 'France (European Territory)',
    '74' => 'French Guyana',
    '75' => 'French Southern Territories',
    '76' => 'Gabon',
    '77' => 'Gambia',
    '78' => 'Georgia',
    '79' => 'Germany',
    '80' => 'Ghana',
    '81' => 'Gibraltar',
    '82' => 'Greece',
    '83' => 'Greenland',
    '84' => 'Grenada',
    '85' => 'Guadeloupe (French)',
    '86' => 'Guam',
    '87' => 'Guatemala',
    '88' => 'Guinea',
    '89' => 'Guinea Bissau',
    '90' => 'Guyana',
    '91' => 'Haiti',
    '92' => 'Heard and McDonald Islands',
    '93' => 'Honduras',
    '94' => 'Hong Kong',
    '95' => 'Hungary',
    '96' => 'Iceland',
    '97' => 'India',
    '98' => 'Indonesia',
    '99' => 'Iraq',
    '100' => 'Ireland',
    '101' => 'Israel',
    '102' => 'Italy',
    '103' => 'Ivory Coast',
    '104' => 'Jamaica',
    '105' => 'Japan',
    '106' => 'Jordan',
    '107' => 'Kazakhstan',
    '108' => 'Kenya',
    '109' => 'Kiribati',
    '110' => 'Kuwait',
    '111' => 'Kyrgyzstan',
    '112' => 'Laos',
    '113' => 'Latvia',
    '114' => 'Lebanon',
    '115' => 'Lesotho',
    '116' => 'Liberia',
    '117' => 'Libya',
    '118' => 'Liechtenstein',
    '119' => 'Lithuania',
    '120' => 'Luxembourg',
    '121' => 'Macau',
    '122' => 'Macedonia',
    '123' => 'Madagascar',
    '124' => 'Malawi',
    '125' => 'Malaysia',
    '126' => 'Maldives',
    '127' => 'Mali',
    '128' => 'Malta',
    '129' => 'Marshall Islands',
    '130' => 'Martinique (French)',
    '131' => 'Mauritania',
    '132' => 'Mauritius',
    '133' => 'Mayotte',
    '134' => 'Mexico',
    '135' => 'Micronesia',
    '136' => 'Moldavia',
    '137' => 'Monaco',
    '138' => 'Mongolia',
    '139' => 'Montserrat',
    '140' => 'Morocco',
    '141' => 'Mozambique',
    '142' => 'Myanmar, Union of (Burma)',
    '143' => 'Namibia',
    '144' => 'Nauru',
    '145' => 'Nepal',
    '146' => 'Netherlands',
    '147' => 'Netherlands Antilles',
    '148' => 'Neutral Zone',
    '149' => 'New Caledonia (French)',
    '150' => 'New Zealand',
    '151' => 'Nicaragua',
    '152' => 'Niger',
    '153' => 'Nigeria',
    '154' => 'Niue',
    '155' => 'Norfolk Island',
    '156' => 'Northern Mariana Islands',
    '157' => 'Norway',
    '158' => 'Oman',
    '159' => 'Pakistan',
    '160' => 'Palau',
    '161' => 'Panama',
    '162' => 'Papua New Guinea',
    '163' => 'Paraguay',
    '164' => 'Peru',
    '165' => 'Philippines',
    '166' => 'Pitcairn Island',
    '167' => 'Poland',
    '168' => 'Polynesia (French)',
    '169' => 'Portugal',
    '170' => 'Qatar',
    '171' => 'Reunion (French)',
    '172' => 'Romania',
    '173' => 'Russian Federation',
    '174' => 'Rwanda',
    '175' => 'S. Georgia & S. Sandwich Islands',
    '176' => 'Saint Helena',
    '177' => 'Saint Kitts & Nevis Anguilla',
    '178' => 'Saint Lucia',
    '179' => 'Saint Pierre and Miquelon',
    '180' => 'Saint Tome and Principe',
    '181' => 'Saint Vincent & Grenadines',
    '182' => 'Samoa',
    '183' => 'San Marino',
    '184' => 'Saudi Arabia',
    '185' => 'Senegal',
    '186' => 'Seychelles',
    '187' => 'Sierra Leone',
    '188' => 'Singapore',
    '189' => 'Slovakia',
    '190' => 'Slovenia',
    '191' => 'Solomon Islands',
    '192' => 'Somalia',
    '193' => 'South Africa',
    '194' => 'South Korea',
    '195' => 'Spain',
    '196' => 'Sri Lanka',
    '197' => 'Suriname',
    '198' => 'Svalbard and Jan Mayen Islands',
    '199' => 'Swaziland',
    '200' => 'Sweden',
    '201' => 'Switzerland',
    '202' => 'Tadjikistan',
    '203' => 'Taiwan',
    '204' => 'Tanzania',
    '205' => 'Thailand',
    '206' => 'Togo',
    '207' => 'Tokelau',
    '208' => 'Tonga',
    '209' => 'Trinidad and Tobago',
    '210' => 'Tunisia',
    '211' => 'Turkey',
    '212' => 'Turkmenistan',
    '213' => 'Turks and Caicos Islands',
    '214' => 'Tuvalu',
    '215' => 'Uganda',
    '216' => 'UK',
    '217' => 'Ukraine',
    '218' => 'United Arab Emirates',
    '219' => 'Uruguay',
    '220' => 'US',
    '221' => 'USA Minor Outlying Islands',
    '222' => 'Uzbekistan',
    '223' => 'Vanuatu',
    '224' => 'Vatican City',
    '225' => 'Venezuela',
    '226' => 'Vietnam',
    '227' => 'Virgin Islands (British)',
    '228' => 'Virgin Islands (USA)',
    '229' => 'Wallis and Futuna Islands',
    '230' => 'Western Sahara',
    '231' => 'Yemen',
    '232' => 'Yugoslavia',
    '233' => 'Zaire',
    '234' => 'Zambia',
    '235' => 'Zimbabwe'
  );
?>

<div class="modal fade" id="clientCreateModal" tabindex="-1" aria-labelledby="clientCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Client Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createclient')}}">
          @csrf
          <div class="row">
            <div class="col-4">
              <h5>Contact information</h5>
              <div class="mb-3">
                <label for="firstname" class="col-form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
              </div>
              <div class="mb-3">
                <label for="surname" class="col-form-label">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
              </div>
              <div class="mb-3">
                <label for="phone" class="col-form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
              </div>
              <div class="mb-3">
                <label for="address1" class="col-form-label">Address 1:</label>
                <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1">
              </div>
              <div class="mb-3">
                <label for="address2" class="col-form-label">Address 2:</label>
                <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
              </div>
              <div class="mb-3">
                <label for="town" class="col-form-label">Town:</label>
                <input type="text" class="form-control" id="town" name="town" placeholder="Town">
              </div>
              <div class="mb-3">
                <label for="city" class="col-form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City">
              </div>
              <div class="mb-3">
                <label for="county" class="col-form-label">County:</label>
                <input type="text" class="form-control" id="county" name="county" placeholder="County">
              </div>
              <div class="mb-3">
                <label for="postcode" class="col-form-label">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode">
              </div>
              <br>
              <h5>Payment</h5>
              <div class="mb-3">
                <label for="usualpayment" class="col-form-label">Usual Payment:</label>
                <select class="form-control" name="usualpayment">
                  <option value="">Please select</option>
                  <option value="Amex">Amex</option>
                  <option value="Cash">Cash</option>
                  <option value="Visa">Visa</option>
                  <option value="Mastercard">Mastercard</option>
                  <option value="Travellers cheques">Travellers cheques</option>
                  <option value="Invoice">Invoice</option>
                  <option value="Cheque">Cheque</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="creditcardnumber" class="col-form-label">Credit Card number:</label>
                <input type="text" class="form-control" id="creditcardnumber" name="creditcardnumber" placeholder="Credit Card number">
              </div>
              <div class="mb-3">
                <label for="expirydate" class="col-form-label">Expiry Date:</label>
                <input type="date" class="form-control" id="expirydate" name="expirydate" placeholder="Expiry Date">
              </div>
              <div class="mb-3">
                <label for="securitycode" class="col-form-label">Security Code:</label>
                <input type="text" class="form-control" id="securitycode" name="securitycode" placeholder="Security Code">
              </div>
              <div class="mb-3">
                <label for="nameoncard" class="col-form-label">Name on card:</label>
                <input type="text" class="form-control" id="nameoncard" name="nameoncard" placeholder="Name on card">
              </div>
            </div>
            <div class="col-4">
              <h5>Company</h5>
              <div class="mb-3">
                <label for="companyname" class="col-form-label">Company name:</label>
                <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company name">
              </div>
              <div class="mb-3">
                <label for="department" class="col-form-label">Department:</label>
                <input type="text" class="form-control" id="department" name="department" placeholder="Department">
              </div>
              <div class="mb-3">
                <label for="companyaddress1" class="col-form-label">Company Address 1:</label>
                <input type="text" class="form-control" id="companyaddress1" name="companyaddress1" placeholder="Company Address 1">
              </div>
              <div class="mb-3">
                <label for="companyaddress2" class="col-form-label">Company Address 2:</label>
                <input type="text" class="form-control" id="companyaddress2" name="companyaddress2" placeholder="Company Address 2">
              </div>
              <div class="mb-3">
                <label for="companycity" class="col-form-label">Company City:</label>
                <input type="text" class="form-control" id="companycity" name="companycity" placeholder="Company City">
              </div>
              <div class="mb-3">
                <label for="companycounty" class="col-form-label">Company County:</label>
                <input type="text" class="form-control" id="companycounty" name="companycounty" placeholder="Company County">
              </div>
              <div class="mb-3">
                <label for="companypostcode" class="col-form-label">Company Postcode:</label>
                <input type="text" class="form-control" id="companypostcode" name="companypostcode" placeholder="Company Postcode">
              </div>
              <div class="mb-3">
                <label for="companycountry" class="col-form-label">Company Country:</label>
                <select class="form-control" id="companycountry" name="companycountry">
                  <option value="">Please select</option>
                  <?php
                    $select = "";
                    foreach($countries as $key => $value){
                        $select .= '<option value="'.$key.'">'.$value.'</option>'."n";
                    }
                    echo $select;
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="companyphone" class="col-form-label">Company Phone:</label>
                <input type="text" class="form-control" id="companyphone" name="companyphone" placeholder="Company Phone">
              </div>
              <div class="mb-3">
                <label for="companyfax" class="col-form-label">Company Fax:</label>
                <input type="text" class="form-control" id="companyfax" name="companyfax" placeholder="Company Fax">
              </div>
              <div class="mb-3">
                <label for="website" class="col-form-label">Website:</label>
                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
              </div>
              <div class="mb-3">
                <label for="descriptionofbusiness" class="col-form-label">Description of business:</label>
                <textarea class="form-control" id="descriptionofbusiness" name="descriptionofbusiness" placeholder="Description of Business"></textarea>
              </div>
              <div class="mb-3">
                <label for="secretaryname" class="col-form-label">Secretary Name:</label>
                <input type="text" class="form-control" id="secretaryname" name="secretaryname" placeholder="Secretary Name">
              </div>
              <div class="mb-3">
                <label for="secretaryphone" class="col-form-label">Secretary phone:</label>
                <input type="text" class="form-control" id="secretaryphone" name="secretaryphone" placeholder="Secretary phone">
              </div>
              <div class="mb-3">
                <label for="secretaryemail" class="col-form-label">Secretary email:</label>
                <input type="text" class="form-control" id="secretaryemail" name="secretaryemail" placeholder="Secretary email">
              </div>
            </div>
            <div class="col-4">
              <h5>Preferences</h5>
              <div class="mb-3">
                <label for="usuallysits" class="col-form-label">Usually sits:</label>
                <select class="form-control" id="usuallysits" name="usuallysits">
                  <option value="">Please select</option>
                  <option value="rear behind passenger">rear behind passenger</option>
                  <option value="rear behind driver">rear behind driver</option>
                  <option value="front passenger">front passenger</option>
                  <option value="not fussy">not fussy</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="climate" class="col-form-label">Climate:</label>
                <select class="form-control" id="climate" name="climate">
                  <option value="">Please select</option>
                  <option value="warm">warm</option>
                  <option value="cool">cool</option>
                  <option value="not fussy">not fussy</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="listenstoradio" class="col-form-label">Listens to radio?:</label>
                <INPUT type="radio" id="listenstoradio" name="listenstoradio" value="No"> No
                <INPUT type="radio" id="listenstoradio" name="listenstoradio" value="Yes"> Yes
                <INPUT type="radio" id="listenstoradio" name="listenstoradio" value="Sometimes"> Sometimes
              </div>
              <div class="mb-3">
                <label for="radiostation" class="col-form-label">If yes/sometimes which station?:</label>
                <input type="text" class="form-control" id="radiostation" name="radiostation" placeholder="Radio Station">
              </div>
              <div class="mb-3">
                <label for="airportpickups" class="col-form-label">Airport pickups:</label>
                <select class="form-control" id="airportpickups" name="airportpickups">
                  <option value="">Please select</option>
                  <option value="Meet & greet">Meet & greet</option>
                  <option value="Meet outside departures">Meet outside departures</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="anyparticularroute" class="col-form-label">Any particular route?:</label>
                <textarea class="form-control" id="anyparticularroute" name="anyparticularroute" placeholder="Any particular route?"></textarea>
              </div>
              <div class="mb-3">
                <label for="descriptionofluggage" class="col-form-label">Description of luggage:</label>
                <textarea class="form-control" id="descriptionofluggage" name="descriptionofluggage" placeholder="Description of luggage"></textarea>
              </div>
              <div class="mb-3">
                <label for="drinkswater" class="col-form-label">Drinks water?:</label>
                <INPUT type="radio" id="drinkswater" name="drinkswater" value="No"> No
                <INPUT type="radio" id="drinkswater" name="drinkswater" value="Yes"> Yes
              </div>
              <div class="mb-3">
                <label for="descriptionofclient" class="col-form-label">Description of client:</label>
                <textarea class="form-control" id="descriptionofclient" name="descriptionofclient" placeholder="Description of client"></textarea>
              </div>
              <div class="mb-3">
                <label for="generalinfo" class="col-form-label">General info:</label>
                <textarea class="form-control" id="generalinfo" name="generalinfo" placeholder="General info"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>