<div class="modal fade" id="paymentSettingsEditModal" tabindex="-1" aria-labelledby="paymentSettingsEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Payment Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/editpaymentsettings')}}">
          @csrf
          <input type="hidden" id="editpaymentsettingid" name="editpaymentsettingid">
          <div class="mb-3">
            <label for="paymenttype" class="col-form-label">Payment Type:</label>
            <input type="text" class="form-control" id="editpaymenttype" name="editpaymenttype" placeholder="Payment Type">
          </div>
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>