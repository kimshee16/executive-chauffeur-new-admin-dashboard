<div class="modal fade" id="driversEditModal" tabindex="-1" aria-labelledby="driversEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/editdriver')}}">
          @csrf
          <img style="height: 115px; width: auto;" class="img-thumbnail" id="editimagethumbnail" src="images/drivers/no-photo.png" />
          <input type="hidden" id="editdriverid" name="editdriverid">
          <div class="mb-3">
            <label for="drivername" class="col-form-label">Driver Name:</label>
            <input type="text" class="form-control" id="editdrivername" name="editdrivername" placeholder="Driver Name" required>
          </div>
          <div class="mb-3">
            <label for="driveremail" class="col-form-label">Driver Email:</label>
            <input type="text" class="form-control" id="editdriveremail" name="editdriveremail" placeholder="Driver Email" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Driver Phone:</label>
            <input type="text" class="form-control" id="editdriverphone" name="editdriverphone" placeholder="Driver Phone" required>
          </div>
          <div class="mb-3">
            <label for="driverphoto" class="col-form-label">Driver Photo:</label>
            <input type="file" class="form-control" id="editdriverphoto" name="editdriverphoto" onchange="getFileUrlEdit()">
            <input type="hidden" id="editdriverphotohidden" name="editdriverphotohidden">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function getFileUrlEdit() {
    const fileInput = document.getElementById('editdriverphoto');

    if (fileInput.files && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        const fileUrl = event.target.result;
        document.getElementById("editdriverphotohidden").value = fileUrl;
      };

      reader.readAsDataURL(file);
    } else {
      console.log('No file selected.');
    }
  }
</script>