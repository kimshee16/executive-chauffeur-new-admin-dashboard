<div class="modal fade" id="vehiclesDeleteConfirmModal" tabindex="-1" aria-labelledby="vehiclesDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deletevehicle')}}">
          @csrf
          <input type="hidden" id="deletevehicleid" name="deletevehicleid">
          Are you sure you want to delete selected vehicle details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>