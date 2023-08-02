s<div class="modal fade" id="driversCreateModal" tabindex="-1" aria-labelledby="driversCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createdriver')}}">
          @csrf
          <div class="mb-3">
            <label for="drivername" class="col-form-label">Driver Name:</label>
            <input type="text" class="form-control" id="drivername" name="drivername" placeholder="Driver Name" required>
          </div>
          <div class="mb-3">
            <label for="driveremail" class="col-form-label">Driver Email:</label>
            <input type="text" class="form-control" id="driveremail" name="driveremail" placeholder="Driver Email" required>
          </div>
          <div class="mb-3">
            <label for="driverphone" class="col-form-label">Driver Phone:</label>
            <input type="text" class="form-control" id="driverphone" name="driverphone" placeholder="Driver Phone" required>
          </div>
          <div class="mb-3">
            <label for="driverphoto" class="col-form-label">Driver Photo:</label>
            <input type="file" class="form-control" id="driverphoto" name="driverphoto" onchange="getFileUrlCreate()" required>
            <input type="hidden" id="driverphotohidden" name="driverphotohidden">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function getFileUrlCreate() {
    const fileInput = document.getElementById('driverphoto');

    if (fileInput.files && fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        const fileUrl = event.target.result;
        document.getElementById("driverphotohidden").value = fileUrl;
      };

      reader.readAsDataURL(file);
    } else {
      console.log('No file selected.');
    }
  }
</script>