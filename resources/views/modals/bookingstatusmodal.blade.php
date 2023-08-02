<div class="modal fade" id="bookingStatusModal" tabindex="-1" aria-labelledby="bookingStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/changebookingstatus')}}">
          @csrf
          <div class="mb-3">
            <input type="hidden" name="bookingid" id="bookingid">
            <label for="sourceofbooking" class="col-form-label">Status Update:</label>
            <select class="form-control" name="bookingstatus">
              <option value="">Please select</option>
              @php
                if (Request::url() === url('/')) {
                    echo '
                      <option value="Not actioned">Not actioned</option>
                      <option value="Proposal sent">Proposal sent</option>
                      <option value="Confirmed">Confirmed</option>
                      <option value="Booking lost">Booking lost</option>
                      <option value="Cancelled">Cancelled</option>
                    ';
                } else {
                    echo '
                      <option value="Not actioned">Confirmed</option>
                      <option value="Proposal sent">Completed</option>
                      <option value="Confirmed">No Show</option>
                      <option value="Cancelled">Cancelled</option>
                    ';
                }
              @endphp
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>