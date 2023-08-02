<div class="modal fade" id="vehiclesCreateModal" tabindex="-1" aria-labelledby="vehiclesCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createvehicle')}}">
          @csrf
          <div class="mb-3">
            <label for="drivername" class="col-form-label">Registration #:</label>
            <input type="text" class="form-control" id="vehicleregistrationnumber" name="vehicleregistrationnumber" placeholder="Registration #" required>
          </div>
          <div class="mb-3">
            <label for="driveremail" class="col-form-label">Make:</label>
            <input type="text" class="form-control" id="vehiclemake" name="vehiclemake" placeholder="Make" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Model:</label>
            <input type="text" class="form-control" id="vehiclemodel" name="vehiclemodel" placeholder="Model" required>
          </div>
          <div class="mb-3">
            <label for="drivername" class="col-form-label">Year of Manufacture:</label>
            <input type="number" min="1900" max="2099" class="form-control" id="vehicleyearofmanufacture" name="vehicleyearofmanufacture" placeholder="Year of Manufacture" required>
          </div>
          <div class="mb-3">
            <label for="driveremail" class="col-form-label">MOT Expiry:</label>
            <input type="date" class="form-control" id="vehiclemotexpiry" name="vehiclemotexpiry" placeholder="MOT Expiry" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Roadtax Expiry:</label>
            <input type="date" class="form-control" id="vehicleroadtaxexpiry" name="vehicleroadtaxexpiry" placeholder="Roadtax Expiry" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Owner:</label>
            <input type="text" class="form-control" id="vehicleowner" name="vehicleowner" placeholder="Owner" required>
          </div>
          <div class="mb-3">
            <label for="drivername" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="vehicledescription" name="vehicledescription" placeholder="Description" required>
          </div>
          <div class="mb-3">
            <label for="driveremail" class="col-form-label">Passengers:</label>
            <input type="number" class="form-control" id="vehiclepassenger" name="vehiclepassenger" placeholder="Passengers" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Luggage:</label>
            <input type="text" class="form-control" id="vehicleluggage" name="vehicleluggage" placeholder="Luggage" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">ULEZ Compliant:</label>
            <select id="vehicleulez" name="vehicleulez" class="form-control">
                <option value="">Select option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="driverphoto" class="col-form-label">Vehicle Photo:</label>
            <input type="file" class="form-control" id="vehiclephoto" name="vehiclephoto" onchange="getFileUrlCreate()" required>
            <input type="hidden" id="vehiclephotohidden" name="vehiclephotohidden">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function getFileUrlCreate() {
    const fileInput = document.getElementById('vehiclephoto');

    if (fileInput.files && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        const fileUrl = event.target.result;
        document.getElementById("vehiclephotohidden").value = fileUrl;
      };

      reader.readAsDataURL(file);
    } else {
      console.log('No file selected.');
    }
  }
</script>