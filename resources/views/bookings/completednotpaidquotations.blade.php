@include('header')
<br>
<div class="container-fluid">
    <h2>Reports</h2>
    <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#driverReportModal" data-bs-whatever="@getbootstrap"><i class="fa fa-id-card"></i> View Drivers Reports</a>
    <br><br>
    <table id="quotationrequeststable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Posted On</th>
                <th>Client</th>
                <th>Date/Time of Journey</th>
                <th>Collection Address</th>
                <th>Going To</th>
                <th>Payment Proccessed</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotationsData as $data)
                <tr>
                    <td>{{ $data->date_added }}</td>
                    <td>{{ $data->first_name }} {{ $data->surname }}</td>
                    <td>{{ date('Y-m-d H:i A', strtotime($data->journey_date . ' ' . $data->journey_hour . ':' . $data->journey_minutes)) }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->going_to }}</td>
                    <td>{{ $data->payment_proccessed }}</td>
                    <td>{{ $data->book_status }} <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#bookingStatusModal" onclick="editBookingStatus({{ $data->id }});"><i class="fa fa-edit"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('modals/driverreportmodal')
@include('modals/bookingstatusmodal')
@include('footer')
<script type="text/javascript">$('#quotationrequeststable').DataTable();</script>
<script type="text/javascript">$('#driverreportstable').DataTable();</script>
<script type="text/javascript">
    function editBookingStatus(bid) {
        document.getElementById("bookingid").value = bid;
    }
</script>