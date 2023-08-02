@include('header')
<br>
<div class="container-fluid">
    <h2>Driver Job List From {{$driversquotationsData[0]->drivername}}</h2>
    <br><br>
    <table id="quotationrequeststable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Posted On</th>
                <th>Client</th>
                <th>Date/Time of Journey</th>
                <th>Collection Address</th>
                <th>Going To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($driversquotationsData as $data)
                <tr>
                    <td>{{ $data->date_added }}</td>
                    <td>{{ $data->first_name }} {{ $data->surname }}</td>
                    <td>{{ date('Y-m-d H:i A', strtotime($data->journey_date . ' ' . $data->journey_hour . ':' . $data->journey_minutes)) }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->going_to }}</td>
                    <td>{{ $data->book_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('footer')
<script type="text/javascript">$('#quotationrequeststable').DataTable();</script>
<script type="text/javascript">$('#driverreportstable').DataTable();</script>