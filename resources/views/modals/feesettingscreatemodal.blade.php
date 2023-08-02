<div class="modal fade" id="feeSettingsCreateModal" tabindex="-1" aria-labelledby="feeSettingsCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Fee Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createfeesettings')}}">
          @csrf
          <div class="mb-3">
            <label for="feedescription" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="feedescription" name="feedescription" placeholder="Description">
          </div>
          <div class="mb-3">
            <label for="feecost" class="col-form-label">Cost:</label>
            <input type="number" min="0.01" step="0.01" class="form-control" id="feecost" name="feecost" placeholder="Cost">
          </div>
          <div class="mb-3">
            <label for="feegeneralurl" class="col-form-label">General URL:</label>
            <input type="text" class="form-control" id="feegeneralurl" name="feegeneralurl" placeholder="General URL">
          </div>
          <div class="mb-3">
            <label for="feeaccounturl" class="col-form-label">Account URL:</label>
            <input type="text" class="form-control" id="feeaccounturl" name="feeaccounturl" placeholder="Account URL">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>