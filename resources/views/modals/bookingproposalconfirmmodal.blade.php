<div class="modal fade" id="bookingProposalConfirmModal" tabindex="-1" aria-labelledby="bookingProposalConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Proposal Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/confirmbooking')}}">
          @csrf
          <input type="hidden" id="confirmbookingid" name="confirmbookingid">
          <input type="hidden" id="confirmbookinglocation" name="confirmbookinglocation">
          <div class="mb-3">
            <label for="phone" class="col-form-label">To:</label>
            <input type="text" class="form-control" id="confirmto" name="confirmto" readonly>
          </div>
          <div class="mb-3">
            <label for="address1" class="col-form-label">Subject:</label>
            <input type="text" class="form-control" id="confirmsubject" name="confirmsubject" readonly>
          </div>
          <div class="mb-3">
            <label for="address2" class="col-form-label">Body:</label>
            <textarea name="confirmbody" id="confirmbody" class="ckeditor form-control">
	        	</textarea>
          </div>
          <br><br>
          <button type="submit" class="btn btn-primary">Send Confirmation</button>
        </form>
      </div>
    </div>
  </div>
</div>
