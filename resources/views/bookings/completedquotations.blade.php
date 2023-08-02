@include('header')
<br>
<div class="container-fluid">
    <h2>Completed Quotation Requests</h2>
    <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#bookingCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Booking</a>
    <br><br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Booking details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Booking details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Booking details successfully deleted.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "4") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Email confirmation successfully sent.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } 
        }
    ?>
    <input type="hidden" id="baseurl" value="{{url('/')}}">
    <table id="quotationrequeststable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No/Action</th>
                <th>Posted On</th>
                <th>Client</th>
                <th>Date/Time of Journey</th>
                <th>Collection Address</th>
                <th>Going To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotationsData as $data)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#bookingDeleteConfirmModal" onclick="getBookingDetailsForDelete({{ $data->id }});"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" target='_blank' href="{{url('/clients?openDetails=1&clientid='.$data->client_id)}}" title="Client Details"><i class="fa fa-user"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#bookingEditModal" onclick="getBookingDetails({{ $data->id }});"><i class="fa fa-search"></i></a></td>
                    <td>{{ date('Y-m-d', $data->date_added) }}</td>
                    <td>{{ $data->first_name }} {{ $data->surname }}</td>
                    <td>{{ date('Y-m-d H:i A', strtotime($data->journey_date . ' ' . $data->journey_hour . ':' . $data->journey_minutes)) }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->going_to }}</td>
                    <td>{{ $data->book_status }} <a class="btn btn-primary btn-sm" href="#" title="Details"><i class="fa fa-edit"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('modals/bookingcreatemodal')
@include('modals/bookingeditmodal')
@include('modals/bookingdeleteconfirmmodal')
@include('footer')
<script type="text/javascript">$('#quotationrequeststable').DataTable();</script>
<script type="text/javascript">
    var baseurl = document.getElementById("baseurl").value;
    function getBookingDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getbookingajax?id="+id,
            success: function(data) {
                document.getElementById("editbookingid").value = id;

                sourcechildren = document.getElementById("editsourceofbooking").children;
                for (var i = 0; i < sourcechildren.length; i++) {
                    if(sourcechildren[i].getAttribute("value") == data.data[0].book_source) {
                        sourcechildren[i].setAttribute("selected", "selected");
                    }
                }
                
                document.getElementById("editbookingreference").value = data.data[0].book_ref;

                accountchildren = document.getElementById("editaccount").children;
                for (var a = 0; a < accountchildren.length; a++) {
                    if(accountchildren[a].getAttribute("value") == data.data[0].book_acc) {
                        accountchildren[a].setAttribute("selected", "selected");
                    }
                }

                paymenttypechildren = document.getElementById("editpaymenttype").children;
                for (var b = 0; b < paymenttypechildren.length; b++) {
                    if(paymenttypechildren[b].getAttribute("value") == data.data[0].book_payment_type) {
                        paymenttypechildren[b].setAttribute("selected", "selected");
                    }
                }

                document.getElementById("editsubtotal").value = parseFloat(data.data[0].book_subtotal);
                document.getElementById("editwaitingtime").value = data.data[0].book_waiting_time;
                document.getElementById("editcarparking").value = data.data[0].book_car_parking;
                document.getElementById("editlondoncongestioncharge").value = data.data[0].book_congestion;
                document.getElementById("editulez").value = data.data[0].ulez;
                document.getElementById("editservicecharge").value = data.data[0].book_service_charge;
                document.getElementById("edittotal").value = data.data[0].book_total;
                document.getElementById("editspecialrequest").value = data.data[0].special_requests;

                vehiclechildren = document.getElementById("editpreferredvehicle").children;
                for (var c = 0; c < vehiclechildren.length; c++) {
                    if(vehiclechildren[c].getAttribute("value") == data.data[0].vehicle) {
                        vehiclechildren[c].setAttribute("selected", "selected");
                    }
                }

                passengerchildren = document.getElementById("editnumberofpassengers").children;
                for (var d = 0; d < passengerchildren.length; d++) {
                    if(passengerchildren[d].getAttribute("value") == data.data[0].passengers) {
                        passengerchildren[d].setAttribute("selected", "selected");
                    }
                }

                if(data.data[0].journey_date != "") {
                    var parts = data.data[0].journey_date.split('-');
                    var date = new Date(parts[2], parts[1] - 1, parts[0]);
                    var hour = parseInt(data.data[0].journey_hour);
                    var minute = parseInt(data.data[0].journey_minutes);
                    if (data.data[0].journey_AMPM === "PM" && hour !== 12) {
                      hour += 12;
                    } else if (data.data[0].journey_AMPM === "AM" && hour === 12) {
                      hour = 0;
                    }
                    date.setHours(hour);
                    date.setMinutes(minute);
                    var fjourneydate = formatDate(data.data[0].journey_date);
                    var formattedDateTime = fjourneydate + 'T' + hour.toString().padStart(2, '0') + ':' + minute.toString().padStart(2, '0');
                    document.getElementById("editdatetimeofjourney").value = formattedDateTime;
                }

                returnjourneyoptions = document.getElementsByClassName("editreturnjourney");
                for(var n = 0; n < returnjourneyoptions.length; n++){
                    if(returnjourneyoptions[n].value == data.data[0].return_journey) {
                        returnjourneyoptions[n].click();
                    }
                }

                if(data.data[0].return_date != "") {
                    var parts = data.data[0].return_date.split('-');
                    var date = new Date(parts[2], parts[1] - 1, parts[0]);
                    var hour = parseInt(data.data[0].return_journey_hour);
                    var minute = parseInt(data.data[0].return_journey_minutes);
                    if (data.data[0].return_journey_AMPM === "PM" && hour !== 12) {
                      hour += 12;
                    } else if (data.data[0].return_journey_AMPM === "AM" && hour === 12) {
                      hour = 0;
                    }
                    date.setHours(hour);
                    date.setMinutes(minute);
                    var freturndate = formatDate(data.data[0].return_date);
                    var formattedDateTime = freturndate + 'T' + hour.toString().padStart(2, '0') + ':' + minute.toString().padStart(2, '0');
                    document.getElementById("editdatetimeofreturnjourney").value = formattedDateTime;
                }
                
                paymentprocessedchildren = document.getElementById("editpaymentprocessed").children;
                for (var d = 0; d < paymentprocessedchildren.length; d++) {
                    if(paymentprocessedchildren[d].getAttribute("value") == data.data[0].payment_proccessed) {
                        paymentprocessedchildren[d].setAttribute("selected", "selected");
                    }
                }

                document.getElementById("editdrivername").value = data.data[0].driver_name;

                driveridchildren = document.getElementById("editdriverid").children;
                for (var e = 0; e < driveridchildren.length; e++) {
                    if(driveridchildren[e].getAttribute("value") == data.data[0].driver_id) {
                        driveridchildren[e].setAttribute("selected", "selected");
                    }
                }
                
                document.getElementById("editvehicleinfo").value = data.data[0].vehicle_info;
                document.getElementById("editcollectionaddress").value = data.data[0].address;
                document.getElementById("editgoingto").value = data.data[0].going_to;

                airportchildren = document.getElementById("editairportterminal").children;
                for (var f = 0; f < airportchildren.length; f++) {
                    if(airportchildren[f].getAttribute("value") == data.data[0].airport) {
                        airportchildren[f].setAttribute("selected", "selected");
                    }
                }

                document.getElementById("editflightnumber").value = data.data[0].flight_no;
                document.getElementById("editarrivingfrom").value = data.data[0].arriving_from;
            },
            error: function(error) {
              console.log(error);
            }
        });
    }

    function getBookingDetailsForDelete(id) {
        document.getElementById("deletebookingid").value = id;
    }

    if(window.location.href.includes("confirmedbookings")) {
        document.getElementById("createbookinglocation").value = "confirmedbookings";
        document.getElementById("editbookinglocation").value = "confirmedbookings";
        document.getElementById("deletebookinglocation").value = "confirmedbookings";
    } else if(window.location.href.includes("completedbookings")) {
        document.getElementById("createbookinglocation").value = "completedbookings";
        document.getElementById("editbookinglocation").value = "completedbookings";
        document.getElementById("deletebookinglocation").value = "completedbookings";
    } else {
        document.getElementById("createbookinglocation").value = "quotationrequests";
        document.getElementById("editbookinglocation").value = "quotationrequests";
        document.getElementById("deletebookinglocation").value = "quotationrequests";
    }

    function formatDate(dateString) {
      // Regular expression to match the desired format (yyyy-MM-dd)
      var regex = /^\d{4}-\d{2}-\d{2}$/;

      // Check if the date string matches the desired format
      if (regex.test(dateString)) {
        // Date is already in the desired format, return as is
        return dateString;
      } else {
        // Date is in a different format, parse it and convert to the desired format
        var date = new Date(dateString);
        var year = date.getFullYear();
        var month = ("0" + (date.getMonth() + 1)).slice(-2); // Adding leading zero if needed
        var day = ("0" + date.getDate()).slice(-2); // Adding leading zero if needed

        // Return the date in the desired format (yyyy-MM-dd)
        return year + "-" + month + "-" + day;
      }
    }
    
</script>