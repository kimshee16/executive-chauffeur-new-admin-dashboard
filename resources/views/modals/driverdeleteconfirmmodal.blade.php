<div class="modal fade" id="driversDeleteConfirmModal" tabindex="-1" aria-labelledby="driversDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deletedriver')}}">
          @csrf
          <input type="hidden" id="deletedriverid" name="deletedriverid">
          Are you sure you want to delete selected driver details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>