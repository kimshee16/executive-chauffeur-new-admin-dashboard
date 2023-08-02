<div class="modal fade" id="feeSettingsDeleteConfirmModal" tabindex="-1" aria-labelledby="feeSettingsDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Fee Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deletefeesettings')}}">
          @csrf
          <input type="hidden" id="deletefeesettingsid" name="deletefeesettingsid">
          Are you sure you want to delete selected payment settings details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>