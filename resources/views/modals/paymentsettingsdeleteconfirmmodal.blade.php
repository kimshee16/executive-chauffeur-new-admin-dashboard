<div class="modal fade" id="paymentSettingsDeleteConfirmModal" tabindex="-1" aria-labelledby="paymentSettingsDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Payment Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deletepaymentsettings')}}">
          @csrf
          <input type="hidden" id="deletepaymentsettingsid" name="deletepaymentsettingsid">
          Are you sure you want to delete selected payment settings details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>