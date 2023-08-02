@include('header')
<br>
<div class="container-fluid">
    <h2>Vehicles</h2>
    <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#vehiclesCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Vehicle</a>
    <br><br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Vehicle details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Vehicle details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Vehicle details successfully deleted.
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
                <th>Registration #</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year of Manufacture</th>
                <th>MOT Expiry</th>
                <th>Year Tax Expiry</th>
                <th>ULEZ Compliant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiclesData as $data)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#vehiclesDeleteConfirmModal" onclick="getVehicleDetailsForDelete('{{ $data->vreg_number }}');"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#vehiclesEditModal" onclick="getVehicleDetails('{{ $data->vreg_number }}');"><i class="fa fa-search"></i></a></td>
                    @if ($data->photo != "")
                        <td><img style="width:25px;" src="{{ $data->photo }}" /></td>
                    @else
                        <td><img style="width:25px;" src="/images/vehicles/empty-vehicle.png" /></td>
                    @endif
                    <td>{{ $data->vreg_number }}</td>
                    <td>{{ $data->make }}</td>
                    <td>{{ $data->model }}</td>
                    <td>{{ $data->yearofmanufacture }}</td>
                    <td>{{ $data->motexpiry }}</td>
                    <td>{{ $data->roadtaxexpiry }}</td>
                    <td>{{ $data->ulezcompliant }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('modals/vehiclecreatemodal')
@include('modals/vehicleeditmodal')
@include('modals/vehicledeleteconfirmmodal')
@include('footer')
<script type="text/javascript">$('#clientstable').DataTable();</script>
<script type="text/javascript">
    var baseurl = document.getElementById("baseurl").value;
    function getVehicleDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getvehicleajax?id="+id,
            success: function(data) {
                if(data.data[0].photo != "" || data.data[0].photo != "null") {
                    document.getElementById("editimagethumbnail").setAttribute("src", data.data[0].photo);    
                }
                document.getElementById("editvehicleregistrationnumber").value = data.data[0].vreg_number;
                document.getElementById("editvehiclemake").value = data.data[0].make;
                document.getElementById("editvehiclemodel").value = data.data[0].model;
                document.getElementById("editvehicleyearofmanufacture").value = data.data[0].yearofmanufacture;
                document.getElementById("editvehiclemotexpiry").value = data.data[0].motexpiry;
                document.getElementById("editvehicleroadtaxexpiry").value = data.data[0].roadtaxexpiry;
                document.getElementById("editvehicleowner").value = data.data[0].owner;
                document.getElementById("editvehicledescription").value = data.data[0].description;
                document.getElementById("editvehiclepassenger").value = data.data[0].passengers;
                document.getElementById("editvehicleluggage").value = data.data[0].luggage;

                ulezchildren = document.getElementById("editvehicleulez").children;
                for (var i = 0; i < ulezchildren.length; i++) {
                    if(ulezchildren[i].innerText == data.data[0].ulezcompliant) {
                        ulezchildren[i].setAttribute("selected", "selected");
                    }
                }
                
            },
            error: function(error) {
              console.log(error);
            }
        });
    }
    function getVehicleDetailsForDelete(id) {
        document.getElementById("deletevehicleid").value = id;
    }
</script>