<div class="modal fade" id="feeSettingsEditModal" tabindex="-1" aria-labelledby="feeSettingsEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Fee Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/editfeesettings')}}">
          @csrf
          <input type="hidden" id="editfeesettingsid" name="editfeesettingsid">
          <div class="mb-3">
            <label for="editfeedescription" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="editfeedescription" name="editfeedescription" placeholder="Description">
          </div>
          <div class="mb-3">
            <label for="editfeecost" class="col-form-label">Cost:</label>
            <input type="number" min="0.01" step="0.01" class="form-control" id="editfeecost" name="editfeecost" placeholder="Cost">
          </div>
          <div class="mb-3">
            <label for="editfeegeneralurl" class="col-form-label">General URL:</label>
            <input type="text" class="form-control" id="editfeegeneralurl" name="editfeegeneralurl" placeholder="General URL">
          </div>
          <div class="mb-3">
            <label for="editfeeaccounturl" class="col-form-label">Account URL:</label>
            <input type="text" class="form-control" id="editfeeaccounturl" name="editfeeaccounturl" placeholder="Account URL">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>