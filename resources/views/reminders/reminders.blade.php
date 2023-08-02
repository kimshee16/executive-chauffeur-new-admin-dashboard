@include('header')
<br>
<div class="container-fluid">
    <h2>Reminders</h2>
    <br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Reminder details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Reminder details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Reminder details successfully deleted.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } 
        }
    ?>
    <input type="hidden" id="baseurl" value="{{url('/')}}">
    <div class="row">
        <div class="col-6">
            <b>Reminder Settings</b> (for Not Actioned Quotations)
            @foreach ($reminder1Data as $data)
                <form method="POST" action="{{url('/editremindersfromid1')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="emailaddress1" class="col-form-label">Email Address:</label>
                    <input type="text" class="form-control" id="emailaddress1" name="emailaddress1" placeholder="Email Address" value="{{ $data->from1 }}">
                  </div>
                  <div class="mb-3">
                    <label for="emailsubject1" class="col-form-label">Email Subject:</label>
                    <input type="text" class="form-control" id="emailsubject1" name="emailsubject1" placeholder="Email Subject" value="{{ $data->subj }}">
                  </div>
                  <div class="mb-3">
                    <label for="emailbody1" class="col-form-label">Email Body:</label>
                    <textarea class="form-control" id="emailbody1" name="emailbody1" placeholder="Email Body" style="height: 250px;">{{ $data->body }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
            @endforeach
        </div>
        <div class="col-6">
            <b>Reminder Settings</b> (for Confirmed Booking with booking date in the past)
            @foreach ($reminder2Data as $data)
                <form method="POST" action="{{url('/editremindersfromid2')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="emailaddress2" class="col-form-label">Email Address:</label>
                    <input type="text" class="form-control" id="emailaddress2" name="emailaddress2" placeholder="Email Address" value="{{ $data->from1 }}">
                  </div>
                  <div class="mb-3">
                    <label for="emailsubject2" class="col-form-label">Email Subject:</label>
                    <input type="text" class="form-control" id="emailsubject2" name="emailsubject2" placeholder="Email Subject" value="{{ $data->subj }}">
                  </div>
                  <div class="mb-3">
                    <label for="emailbody2" class="col-form-label">Email Body:</label>
                    <textarea class="form-control" id="emailbody2" name="emailbody2" placeholder="Email Body" style="height: 250px;">{{ $data->body }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
            @endforeach
        </div>
    </div>
    <br><br>

</div>
@include('footer')