@php
    use Illuminate\Support\Facades\Request;
@endphp
<div class="modal fade" id="bookingCreateModal" tabindex="-1" aria-labelledby="bookingCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Booking Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createbooking')}}">
          @csrf
          <input type="hidden" id="createbookinglocation" name="createbookinglocation">
          <div class="row">
            <div class="col-4">
              <h5>Contact information</h5>
              <div class="mb-3">
                <label for="sourceofbooking" class="col-form-label">Source of Booking:</label>
                <select class="form-control" name="sourceofbooking">
                  <option value="">Please select</option>
                  <option value="Our Website">Our Website</option>
                  <option value="Telephone">Telephone</option>
                  <option value="Email">Email</option>
                  <option value="From Client">From Client</option>
                  <option value="Limos.com">Limos.com</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="bookingreference" class="col-form-label">Booking Reference:</label>
                <input type="text" class="form-control" id="bookingreference" name="bookingreference" placeholder="Booking Reference">
              </div>
              <div class="mb-3">
                <label for="account" class="col-form-label">Account:</label>
                <select class="form-control" name="account">
                  <option value="">Please select</option>
                  @foreach ($clientsData as $data)
                    <option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->surname }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="paymenttype" class="col-form-label">Payment Type:</label>
                <select class="form-control" name="paymenttype">
                  <option value="">Please select</option>
                  @foreach ($paymentsData as $data)
                    <option value="{{ $data->paymenttype }}">{{ $data->paymenttype }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">Subtotal:</label>
                <input type="text" class="form-control" name="subtotal" placeholder="Subtotal" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">Waiting Time (£):</label>
                <input type="text" class="form-control" name="waitingtime" placeholder="Waiting Time (£)" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">Car Parking:</label>
                <input type="text" class="form-control" name="carparking" placeholder="Car Parking" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">London Congestion Charge:</label>
                <input type="text" class="form-control" name="londoncongestioncharge" placeholder="London Congestion Charge" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">ULEZ:</label>
                <input type="text" class="form-control" name="ulez" placeholder="ULEZ" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label">Service Charge:</label>
                <input type="text" class="form-control" name="servicecharge" placeholder="Service Charge" value="0.00">
              </div>
              <div class="mb-3">
                <label for="subtotale" class="col-form-label"><b>Total:</b></label>
                <input type="text" class="form-control" name="total" placeholder="Total" value="0.00">
              </div>
              <div class="mb-3">
                <label for="specialrequest" class="col-form-label">Special Request:</label>
                <textarea class="form-control" name="specialrequest" placeholder="Special Request"></textarea>
              </div>
            </div>
            <div class="col-4">
              <h5>Journey information</h5>
              <div class="mb-3">
                <label for="preferredvehicle" class="col-form-label">Preferred Vehicle:</label>
                <select class="form-control" name="preferredvehicle">
                  <option value="">Please select</option>
                  <option value="Anyvehicle">Any Executive Vehicle</option>
                  @foreach ($vehiclesData as $data)
                    <option value="{{ $data->vreg_number }}">{{ $data->make }} {{ $data->model }} - {{ $data->passengers }} Passengers</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="numberofpassengers" class="col-form-label">Number of Passengers:</label>
                <select class="form-control" name="numberofpassengers">
                  <option value="">Please select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="datetimeofjourney" class="col-form-label">Date/Time of Journey:</label>
                <input type="datetime-local" class="form-control" name="datetimeofjourney">
              </div>
              <div class="mb-3">
                <label for="returnjourney" class="col-form-label">Return Journey:</label>
                <INPUT type="radio" name="returnjourney" value="No"> No
                <INPUT type="radio" name="returnjourney" value="Yes"> Yes
              </div>
              <div class="mb-3">
                <label for="datetimeofreturnjourney" class="col-form-label">Date/Time of Return Journey:</label>
                <input type="datetime-local" class="form-control" name="datetimeofreturnjourney">
              </div>
              <div class="mb-3">
                <label for="paymentprocessed" class="col-form-label">Payment processed:</label>
                <select class="form-control" name="paymentprocessed" required>
                  <option value="">-</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="driverid" class="col-form-label">Driver Name:</label>
                <input type="hidden" name="drivername" id="drivername">
                <select class="form-control" name="driverid" id="driverid" required>
                  <option value="">Please select</option>
                  @foreach ($driversData as $data)
                    <option value="{{ $data->driver_id }}">{{ $data->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="vehicleinfo" class="col-form-label"><b>Vehicle Info:</b></label>
                <input type="text" class="form-control" name="vehicleinfo" placeholder="Vehicle Info" required>
              </div>
            </div>
            <div class="col-4">
              <h5>Address information</h5>
              <div class="mb-3">
                <label for="collectionaddress" class="col-form-label">Collection Address:</label>
                <textarea class="form-control" name="collectionaddress" placeholder="Collection Address"></textarea>
              </div>
              <div class="mb-3">
                <label for="goingto" class="col-form-label">Going to:</label>
                <textarea class="form-control" name="goingto" placeholder="Going to"></textarea>
              </div>
              <div class="mb-3">
                <label for="airportterminal" class="col-form-label">Airport & Terminal:</label>
                <select class="form-control" name="airportterminal">
                  <option value="">Please select</option>
                  <option value="Heathrow1">Heathrow Terminal 1</option>
                  <option value="Heathrow2">Heathrow Terminal 2</option>
                  <option value="Heathrow3">Heathrow Terminal 3</option>
                  <option value="Heathrow4">Heathrow Terminal 4</option>
                  <option value="Heathrow5">Heathrow Terminal 5</option>
                  <option value="GatwickNorth">Gatwick North Terminal</option>
                  <option value="GatwickSouth">Gatwick South Terminal</option>
                  <option value="Stansted">London Stansted</option>
                  <option value="City">London City</option>
                  <option value="Luton">Luton</option>
                  <option value="Farnborough">Farnborough</option>
                  <option value="Northolt">Northolt</option>
                  <option value="Biggin Hill">Biggin Hill</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="poi" class="col-form-label">POI:</label>
                <select class="form-control" name="poi">
                  <option value="">Please select</option>
                  <option value="SW1X 7LA">Mandarin Oriental Hotel</option>
                  <option value="SE1 7PB">Marriott County Hall</option>
                  <option value="SE10 0DX">O2 Arena</option>
                  <option value="SW7 2AP">Royal Albert Hall</option>
                  <option value="TW1 1DZ">Twickenham Stadium</option>
                  <option value="HA9 0WS">Wembley Stadium</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="pc" class="col-form-label">PC:</label>
                <select class="form-control" name="pc">
                  <option value="">Please Select</option>
                  <option value="BA2">BA2 - Bath</option>
                  <option value="B4">B4 - Birmingham</option>
                  <option value="BH2">BH2 - Bournemouth</option>
                  <option value="BD1">BD1 - Bradford</option>
                  <option value="BS1">BS1 - Bristol</option>
                  <option value="CB1">CB1 - Cambridge</option>
                  <option value="GL50">GL50 - Cheltenham</option>
                  <option value="CF10">CF10 - Cardiff</option>
                  <option value="CT17">CT17 - Dover</option>
                  <option value="CO12">CO12 - Harwich</option>
                  <option value="LS1">LS1 - Leeds</option>
                  <option value="L1">L1 - Liverpool</option>
                  <option value="M1">M1 - Manchester</option>
                  <option value="NE1">NE1 - Newcastle</option> 
                  <option value="NG1">NG1 - Nottingham</option>
                  <option value="OX1">OX1 - Oxford</option>
                  <option value="S1">S1 - Sheffield</option>
                  <option value="SO14">SO14 - Southampton</option>
                  <option value="SN1">SN1 - Swindon</option>  
                </select>
              </div>
              <div class="mb-3">
                <label for="flightnumber" class="col-form-label">Flight Number:</label>
                <input type="text" class="form-control" name="flightnumber" size=9 maxlength=7 placeholder="Flight Number">
              </div>
              <div class="mb-3">
                <label for="arrivingfrom" class="col-form-label">Arriving From:</label>
                <INPUT type="text" class="form-control" name="arrivingfrom" size=9 maxlength=7 placeholder="Arriving From">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  document.getElementById('driverid').onchange = function() {
    var selectElement = document.getElementById("driverid");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedOptionText = selectedOption.textContent;
    document.getElementById('drivername').value = selectedOptionText;
  }


</script>