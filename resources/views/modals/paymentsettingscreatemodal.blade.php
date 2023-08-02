<div class="modal fade" id="paymentSettingsCreateModal" tabindex="-1" aria-labelledby="paymentSettingsCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Payment Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/createpaymentsettings')}}">
          @csrf
          <div class="mb-3">
            <label for="paymenttype" class="col-form-label">Payment Type:</label>
            <input type="text" class="form-control" id="paymenttype" name="paymenttype" placeholder="Payment Type">
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>