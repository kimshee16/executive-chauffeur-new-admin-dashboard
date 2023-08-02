<div class="modal fade" id="clientDeleteConfirmModal" tabindex="-1" aria-labelledby="clientDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Client Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deleteclient')}}">
          @csrf
          <input type="hidden" id="deleteclientid" name="deleteclientid">
          Are you sure you want to delete selected client details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>