<div class="modal fade" id="bookingDeleteConfirmModal" tabindex="-1" aria-labelledby="bookingDeleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Booking Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/deletebooking')}}">
          @csrf
          <input type="hidden" id="deletebookingid" name="deletebookingid">
          <input type="hidden" id="deletebookinglocation" name="deletebookinglocation">
          Are you sure you want to delete selected booking details?<br><br>
          <button type="submit" class="btn btn-primary">Yes, proceed</button>
        </form>
      </div>
    </div>
  </div>
</div>