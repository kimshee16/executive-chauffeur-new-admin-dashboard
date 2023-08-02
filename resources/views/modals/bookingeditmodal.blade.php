@php
    use Illuminate\Support\Facades\Request;
@endphp
<div class="modal fade" id="bookingEditModal" tabindex="-1" aria-labelledby="bookingEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Booking Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="refreshList();"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/updatebooking')}}">
          @csrf
          <input type="hidden" id="editbookingid" name="editbookingid">
          <input type="hidden" id="editbookinglocation" name="editbookinglocation">
          <div class="row">
            <div class="col-4">
              <h5>Contact information</h5>
              <div class="mb-3">
                <label for="editsourceofbooking" class="col-form-label">Source of Booking:</label>
                <select class="form-control" id="editsourceofbooking" name="editsourceofbooking">
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
                <label for="editbookingreference" class="col-form-label">Booking Reference:</label>
                <input type="text" class="form-control" id="editbookingreference" name="editbookingreference" placeholder="Booking Reference">
              </div>
              <div class="mb-3">
                <label for="editaccount" class="col-form-label">Account:</label>
                <select class="form-control" id="editaccount" name="editaccount">
                  <option value="">Please select</option>
                  @foreach ($clientsData as $data)
                    <option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->surname }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="editpaymenttype" class="col-form-label">Payment Type:</label>
                <select class="form-control" id="editpaymenttype" name="editpaymenttype">
                  <option value="">Please select</option>
                  @foreach ($paymentsData as $data)
                    <option value="{{ $data->paymenttype }}">{{ $data->paymenttype }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="editsubtotal" class="col-form-label">Subtotal:</label>
                <input type="number" class="form-control" id="editsubtotal" name="editsubtotal" placeholder="Subtotal" value="0.00" step="0.01">
              </div>
              <div class="mb-3">
                <label for="editwaitingtime" class="col-form-label">Waiting Time (£):</label>
                <input type="text" class="form-control" id="editwaitingtime" name="editwaitingtime" placeholder="Waiting Time (£)" value="0.00">
              </div>
              <div class="mb-3">
                <label for="editcarparking" class="col-form-label">Car Parking:</label>
                <input type="text" class="form-control" id="editcarparking" name="editcarparking" placeholder="Car Parking" value="0.00">
              </div>
              <div class="mb-3">
                <label for="editlondoncongestioncharge" class="col-form-label">London Congestion Charge:</label>
                <input type="text" class="form-control" id="editlondoncongestioncharge" name="editlondoncongestioncharge" placeholder="London Congestion Charge" value="0.00">
              </div>
              <div class="mb-3">
                <label for="editulez" class="col-form-label">ULEZ:</label>
                <input type="text" class="form-control" id="editulez" name="editulez" placeholder="ULEZ" value="0.00">
              </div>
              <div class="mb-3">
                <label for="editservicecharge" class="col-form-label">Service Charge:</label>
                <input type="text" class="form-control" id="editservicecharge" name="editservicecharge" placeholder="Service Charge" value="0.00">
              </div>
              <div class="mb-3">
                <label for="edittotal" class="col-form-label"><b>Total:</b></label>
                <input type="text" class="form-control" id="edittotal" name="edittotal" placeholder="Total" value="0.00">
              </div>
              <div class="mb-3">
                <label for="editspecialrequest" class="col-form-label">Special Request:</label>
                <textarea class="form-control" id="editspecialrequest" name="editspecialrequest" placeholder="Special Request"></textarea>
              </div>
            </div>
            <div class="col-4">
              <h5>Journey information</h5>
              <div class="mb-3">
                <label for="editpreferredvehicle" class="col-form-label">Preferred Vehicle:</label>
                <select class="form-control" id="editpreferredvehicle" name="editpreferredvehicle">
                  <option value="">Please select</option>
                  <option value="Anyvehicle">Any Executive Vehicle</option>
                  @foreach ($vehiclesData as $data)
                    <option value="{{ $data->vreg_number }}">{{ $data->make }} {{ $data->model }} - {{ $data->passengers }} Passengers</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="editnumberofpassengers" class="col-form-label">Number of Passengers:</label>
                <select class="form-control" id="editnumberofpassengers" name="editnumberofpassengers">
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
                <label for="editdatetimeofjourney" class="col-form-label">Date/Time of Journey:</label>
                <input type="datetime-local" class="form-control" id="editdatetimeofjourney" name="editdatetimeofjourney">
              </div>
              <div class="mb-3">
                <label for="editreturnjourney" class="col-form-label">Return Journey:</label>
                <INPUT type="radio" class="editreturnjourney" name="returnjourney" value="No"> No
                <INPUT type="radio" class="editreturnjourney" name="returnjourney" value="Yes"> Yes
              </div>
              <div class="mb-3">
                <label for="editdatetimeofreturnjourney" class="col-form-label">Date/Time of Return Journey:</label>
                <input type="datetime-local" class="form-control" id="editdatetimeofreturnjourney" name="editdatetimeofreturnjourney">
              </div>
              <div class="mb-3">
                <label for="editpaymentprocessed" class="col-form-label">Payment processed:</label>
                <select class="form-control" id="editpaymentprocessed" name="editpaymentprocessed" required>
                  <option value="">-</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="editdriverid" class="col-form-label">Driver Name:</label>
                <input type="hidden" name="editdrivername" id="editdrivername">
                <select class="form-control" name="editdriverid" id="editdriverid" required>
                  <option value="">Please select</option>
                  @foreach ($driversData as $data)
                    <option value="{{ $data->driver_id }}">{{ $data->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="editvehicleinfo" class="col-form-label"><b>Vehicle Info:</b></label>
                <input type="text" class="form-control" id="editvehicleinfo" name="editvehicleinfo" placeholder="Vehicle Info" required>
              </div>
            </div>
            <div class="col-4">
              <h5>Address information</h5>
              <div class="mb-3">
                <label for="editcollectionaddress" class="col-form-label">Collection Address:</label>
                <textarea class="form-control" id="editcollectionaddress" name="editcollectionaddress" placeholder="Collection Address"></textarea>
              </div>
              <div class="mb-3">
                <label for="editgoingto" class="col-form-label">Going to:</label>
                <textarea class="form-control" id="editgoingto" name="editgoingto" placeholder="Going to"></textarea>
              </div>
              <div class="mb-3">
                <label for="editairportterminal" class="col-form-label">Airport & Terminal:</label>
                <select class="form-control" id="editairportterminal" name="editairportterminal">
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
                <label for="editpoi" class="col-form-label">POI:</label>
                <select class="form-control" id="editpoi" name="editpoi">
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
                <label for="editpc" class="col-form-label">PC:</label>
                <select class="form-control" id="editpc" name="editpc">
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
                <label for="editflightnumber" class="col-form-label">Flight Number:</label>
                <input type="text" class="form-control" id="editflightnumber" name="editflightnumber" size=9 maxlength=7 placeholder="Flight Number">
              </div>
              <div class="mb-3">
                <label for="editarrivingfrom" class="col-form-label">Arriving From:</label>
                <INPUT type="text" class="form-control" id="editarrivingfrom" name="editarrivingfrom" size=9 maxlength=7 placeholder="Arriving From">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  document.getElementById('editdriverid').onchange = function() {
    var selectElement = document.getElementById("editdriverid");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedOptionText = selectedOption.textContent;
    document.getElementById('editdrivername').value = selectedOptionText;
  }

  function refreshList() {
    location.reload();
  }
</script>