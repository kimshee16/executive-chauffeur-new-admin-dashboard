@include('header')
<br>
<div class="container-fluid">
    <h2>Settings</h2>
    <input type="hidden" id="baseurl" value="{{url('/')}}">

    <br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Setting details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Setting details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Setting details successfully deleted.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } 
        }
    ?>

    <div class="row">
        <div class="col-6">
            <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#feeSettingsCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Fee Setting</a>
            <br><br>
            <table id="feesettingstable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No/Action</th>
                        <th>Descripton</th>
                        <th>Cost</th>
                        <th>General URL</th>
                        <th>Account URL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feeSettingsData as $data)
                        <tr>
                            <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#feeSettingsDeleteConfirmModal" onclick="getFeeSettingsDetailsForDelete({{ $data->id }});"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#feeSettingsEditModal" onclick="getFeeSettingsDetails({{ $data->id }});"><i class="fa fa-search"></i></a></td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->cost }}</td>
                            <td>{{ $data->generalurl }}</td>
                            <td>{{ $data->accounturl }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#paymentSettingsCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Payment Setting</a>
            <br><br>
            <table id="paymentsettingstable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No/Action</th>
                        <th>Payment Type</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentsSettingsData as $data)
                        <tr>
                            <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#paymentSettingsDeleteConfirmModal" onclick="getPaymentSettingsDetailsForDelete({{ $data->id }});"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#paymentSettingsEditModal" onclick="getPaymentSettingsDetails({{ $data->id }});"><i class="fa fa-search"></i></a></td>
                            <td>{{ $data->paymenttype }}</td>
                            <td>{{ $data->datecreated }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>

@include('modals/feesettingsdeleteconfirmmodal')
@include('modals/feesettingscreatemodal')
@include('modals/feesettingseditmodal')
@include('modals/paymentsettingsdeleteconfirmmodal')
@include('modals/paymentsettingscreatemodal')
@include('modals/paymentsettingseditmodal')
@include('footer')
<script type="text/javascript">$('#feesettingstable').DataTable();</script>
<script type="text/javascript">$('#paymentsettingstable').DataTable();</script>
<script type="text/javascript">
    var baseurl = document.getElementById("baseurl").value;
    function getFeeSettingsDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getfeesettingsajax?id="+id,
            success: function(data) {
                document.getElementById("editfeedescription").value = data.data[0].description;
                document.getElementById("editfeecost").value = data.data[0].cost;
                document.getElementById("editfeegeneralurl").value = data.data[0].generalurl;
                document.getElementById("editfeeaccounturl").value = data.data[0].accounturl;
                document.getElementById("editfeesettingsid").value = data.data[0].id;
            },
            error: function(error) {
              console.log(error);
            }
        });
    }

    function getPaymentSettingsDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getpaymentsettingsajax?id="+id,
            success: function(data) {
                document.getElementById("editpaymenttype").value = data.data[0].paymenttype;
                document.getElementById("editpaymentsettingid").value = data.data[0].id;
            },
            error: function(error) {
              console.log(error);
            }
        });
    }

    function getFeeSettingsDetailsForDelete(id) {
        document.getElementById("deletefeesettingsid").value = id;
    }

    function getPaymentSettingsDetailsForDelete(id) {
        document.getElementById("deletepaymentsettingsid").value = id;
    }
</script>