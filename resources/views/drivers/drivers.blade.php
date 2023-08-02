@include('header')
<br>
<div class="container-fluid">
    <h2>Drivers</h2>
    <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#driversCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Driver</a>
    <br><br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Driver details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Driver details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Driver details successfully deleted.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } 
        }
    ?>
    <input type="hidden" id="baseurl" value="{{url('/')}}">
    <table id="clientstable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No/Action</th>
                <th>Image</th>
                <th>Driver Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($driversData as $data)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#driversDeleteConfirmModal" onclick="getDriverDetailsForDelete({{ $data->driver_id }});"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#driversEditModal" onclick="getDriverDetails({{ $data->driver_id }});"><i class="fa fa-search"></i></a></td>
                    @if ($data->photo != "")
                        <td><img style="width:25px;" src="{{ $data->photo }}" /></td>
                    @else
                        <td><img style="width:25px;" src="/images/drivers/empty-user.png" /></td>
                    @endif
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('modals/driverdeleteconfirmmodal')
@include('modals/drivercreatemodal')
@include('modals/drivereditmodal')
@include('footer')
<script type="text/javascript">$('#clientstable').DataTable();</script>
<script type="text/javascript">
    var baseurl = document.getElementById("baseurl").value;
    function getDriverDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getdriverajax?id="+id,
            success: function(data) {
                if(data.data[0].photo != "" || data.data[0].photo != "null") {
                    document.getElementById("editimagethumbnail").setAttribute("src", data.data[0].photo);    
                }
                document.getElementById("editdrivername").value = data.data[0].name;
                document.getElementById("editdriveremail").value = data.data[0].email;
                document.getElementById("editdriverphone").value = data.data[0].phone;
                document.getElementById("editdriverid").value = data.data[0].driver_id;
            },
            error: function(error) {
              console.log(error);
            }
        });
    }

    function getDriverDetailsForDelete(id) {
        document.getElementById("deletedriverid").value = id;
    }
</script>