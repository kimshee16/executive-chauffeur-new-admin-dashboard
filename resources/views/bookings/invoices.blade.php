@include('header')
<br>
<div class="container-fluid">
    <h2>Invoices</h2>
    <br>
    <input type="hidden" id="baseurl" value="{{url('/')}}">
    <div class="row">
        <div class="col-3">
            Client <select id="clientid" class="form-control">
                <option value="">Select client</option>
                @foreach ($clientsData as $data)
                    <option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->surname }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            Start date <input type="date" id="startdate" class="form-control">
        </div>
        <div class="col-3">
            End date <input type="date" id="enddate" class="form-control">
        </div>
        <div class="col-3">
            Payment processed <select id="paymentprocessed" class="form-control">
                <option value="">Select option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
    </div><br>
    <div class="row">
        <div class="col-3">
            <button class="btn btn-primary" id="generatetable">Generate</button>
        </div>
    </div>
    <br>
    <table id="invoicestable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Date</th>
                <th>Time</th>
                <th>Booking Reference</th>
                <th>Account</th>
                <th>Pick Up</th>
                <th>Destination</th>
                <th>Amount</th>
                <th>Waiting Time</th>
                <th>Car Park</th>
                <th>Toll Charges</th>
                <th>Service Charge</th>
                <th>Total(£)</th>
            </tr>
        </thead>
        <tbody id="invoiceTbody">
        </tbody>
    </table>
    <br>
    <form action="{{url('/generatepdf')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-3">
                <input type="hidden" id="clientId" name="clientId">
                <input type="hidden" id="paymentProcessed" name="paymentProcessed">
                <input type="hidden" id="startDate" name="startDate">
                <input type="hidden" id="endDate" name="endDate">
                Company <input type="text" id="exportcompany" class="form-control" name="exportcompany">
            </div>
            <div class="col-3">
                Secretary <input type="text" id="exportsecretary" class="form-control" name="exportsecretary">
            </div>
            <div class="col-3">
                Payment Type <select id="exportpaymenttype" class="form-control" name="exportpaymenttype">
                    <option value="">Select option</option>
                    @foreach ($paymentsData as $data)
                        <option value="{{ $data->paymenttype }}">{{ $data->paymenttype }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                Address Line 1 <input type="text" id="exportaddress" class="form-control" name="exportaddress">
            </div>
        </div><br>
        <div class="row">
            <div class="col-3">
                City <input type="text" id="exportcity" class="form-control" name="exportcity">
            </div>
            <div class="col-3">
                Postcode <input type="text" id="exportpostcode" class="form-control" name="exportpostcode">
            </div>
            <div class="col-3">
                Country <input type="text" id="exportcounty" class="form-control" name="exportcounty">
            </div>
            <div class="col-3">
                Phone <input type="text" id="exportphone" class="form-control" name="exportphone">
            </div>
        </div><br>
        <div class="row">
            <div class="col-3">
                <button class="btn btn-success" id="exporttable" disabled>Export in PDF</button>
            </div>
        </div>
    </form>
    
    <br><br>
</div>
@include('footer')
<script type="text/javascript">$('#invoicestable').DataTable();</script>
<script type="text/javascript">
    document.getElementById("generatetable").onclick = function() {
        if(document.getElementById("startdate").value == "" && document.getElementById("enddate").value == "") {
            alert("Please enter date range!");
        } else if(document.getElementById("startdate").value != "" && document.getElementById("enddate").value == "") {
            alert("Date range invalid! Please enter end date.");
        } else if(document.getElementById("startdate").value == "" && document.getElementById("enddate").value != "") {
            alert("Date range invalid! Please enter start date.");
        } else {
            var baseurl = document.getElementById("baseurl").value;
            var clientid = document.getElementById("clientid").value;
            var paymentprocessed = document.getElementById("paymentprocessed").value;
            var startdate = document.getElementById("startdate").value;
            var enddate = document.getElementById("enddate").value;
            var dynahtml = "";

            $.ajax({
                type: "GET",
                url: baseurl + "/getinvoicesajax?client="+clientid+"&payment="+paymentprocessed+"&start="+startdate+"&end="+enddate,
                success: function(data) {
                    if(data.data.length > 0) {
                        for(var i = 0 ; i < data.data.length; i++) {
                            dynahtml += `
                                <tr>
                                <td><a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#clientEditModal" onclick="getClientDetails(`+data.data[i].id+`);"><i class="fa fa-search"></i></a></td>
                                <td>`+data.data[i].journey_date+`</td>
                                <td>`+data.data[i].journey_hour.toString().padStart(2, '0')+`:`+data.data[i].journey_minutes.toString().padStart(2, '0')+`</td>
                                <td>`+data.data[i].book_ref+`</td>
                                <td>`+data.data[i].fullname+`</td>
                                <td>`+data.data[i].address+`</td>
                                <td>`+data.data[i].going_to+`</td>
                                <td>`+data.data[i].book_subtotal+`</td>
                                <td>`+data.data[i].book_waiting_time+`</td>
                                <td>`+data.data[i].book_car_parking+`</td>
                                <td>`+data.data[i].book_congestion+`</td>
                                <td>`+data.data[i].book_service_charge+`</td>
                                <td>`+data.data[i].book_total+`</td>
                                </tr>
                            `;
                        }
                        document.getElementById("invoiceTbody").innerHTML = dynahtml;
                        document.getElementById("exporttable").removeAttribute('disabled');
                        document.getElementById("clientId").value = data.clientId;
                        document.getElementById("paymentProcessed").value = data.paymentProcessed;
                        document.getElementById("startDate").value = data.startDate;
                        document.getElementById("endDate").value = data.endDate;
                    } else {
                        document.getElementById("invoiceTbody").innerHTML = "";
                        document.getElementById("exporttable").setAttribute('disabled', '');
                    }
                },
                error: function(error) {
                  console.log(error);
                }
            });
    
        }
    }
</script>