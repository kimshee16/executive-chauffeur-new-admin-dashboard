<div class="modal fade" id="driverReportModal" tabindex="-1" aria-labelledby="driverReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Driver Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="driverreportstable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Driver Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Jobs</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($driversData as $data)
                    <tr>
                        @if ($data->photo != "")
                          <td><img style="width:25px;" src="{{ $data->photo }}" /></td>
                        @else
                          <td><img style="width:25px;" src="/images/drivers/empty-user.png" /></td>
                        @endif
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td><a href="{{url('/driverjoblist?driverid='.$data->driver_id.'&drivername='.$data->name)}}" target="_blank">{{ $data->jobs }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>