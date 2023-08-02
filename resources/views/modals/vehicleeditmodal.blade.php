<div class="modal fade" id="vehiclesEditModal" tabindex="-1" aria-labelledby="vehiclesEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/editvehicle')}}">
          @csrf
          <img style="height: 115px; width: auto;" class="img-thumbnail" id="editimagethumbnail" src="images/drivers/no-photo.png" />
          <div class="mb-3">
            <label for="editvehicleregistrationnumber" class="col-form-label">Registration #:</label>
            <input type="text" class="form-control" id="editvehicleregistrationnumber" name="editvehicleregistrationnumber" placeholder="Registration #" readonly>
          </div>
          <div class="mb-3">
            <label for="editvehiclemake" class="col-form-label">Make:</label>
            <input type="text" class="form-control" id="editvehiclemake" name="editvehiclemake" placeholder="Make">
          </div>
          <div class="mb-3">
            <label for="editvehiclemodel" class="col-form-label">Model:</label>
            <input type="text" class="form-control" id="editvehiclemodel" name="editvehiclemodel" placeholder="Model">
          </div>
          <div class="mb-3">
            <label for="editvehicleyearofmanufacture" class="col-form-label">Year of Manufacture:</label>
            <input type="number" min="1900" max="2099" class="form-control" id="editvehicleyearofmanufacture" name="editvehicleyearofmanufacture" placeholder="Year of Manufacture">
          </div>
          <div class="mb-3">
            <label for="editvehiclemotexpiry" class="col-form-label">MOT Expiry:</label>
            <input type="date" class="form-control" id="editvehiclemotexpiry" name="editvehiclemotexpiry" placeholder="MOT Expiry">
          </div>
          <div class="mb-3">
            <label for="editvehicleroadtaxexpiry" class="col-form-label">Roadtax Expiry:</label>
            <input type="date" class="form-control" id="editvehicleroadtaxexpiry" name="editvehicleroadtaxexpiry" placeholder="Roadtax Expiry">
          </div>
          <div class="mb-3">
            <label for="editvehicleowner" class="col-form-label">Owner:</label>
            <input type="text" class="form-control" id="editvehicleowner" name="editvehicleowner" placeholder="Owner">
          </div>
          <div class="mb-3">
            <label for="editvehicledescription" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="editvehicledescription" name="editvehicledescription" placeholder="Description">
          </div>
          <div class="mb-3">
            <label for="editvehiclepassenger" class="col-form-label">Passengers:</label>
            <input type="number" class="form-control" id="editvehiclepassenger" name="editvehiclepassenger" placeholder="Passengers">
          </div>
          <div class="mb-3">
            <label for="editvehicleluggage" class="col-form-label">Luggage:</label>
            <input type="text" class="form-control" id="editvehicleluggage" name="editvehicleluggage" placeholder="Luggage">
          </div>
          <div class="mb-3">
            <label for="editvehicleulez" class="col-form-label">ULEZ Compliant:</label>
            <select id="editvehicleulez" name="editvehicleulez" class="form-control">
                <option value="">Select option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editvehiclephoto" class="col-form-label">Vehicle Photo:</label>
            <input type="file" class="form-control" id="editvehiclephoto" name="editvehiclephoto" onchange="getFileUrlEdit()" required>
            <input type="hidden" id="editvehiclephotohidden" name="editvehiclephotohidden">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function getFileUrlEdit() {
    const fileInput = document.getElementById('editvehiclephoto');

    if (fileInput.files && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        const fileUrl = event.target.result;
        document.getElementById("editvehiclephotohidden").value = fileUrl;
      };

      reader.readAsDataURL(file);
    } else {
      console.log('No file selected.');
    }
  }
</script>