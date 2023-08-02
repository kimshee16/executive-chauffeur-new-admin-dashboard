@include('header')
<br>
<div class="container-fluid">
    <h2>Clients</h2>
    <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#clientCreateModal" data-bs-whatever="@getbootstrap"><i class="fa fa-plus"></i> Create New Client</a>
    <br><br>
    <?php 
        if(isset($_GET['success'])) {
           if($_GET['success'] == "1") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Client details successfully created.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "2") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Client details successfully updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } elseif($_GET['success'] == "3") {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Client details successfully deleted.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            } 
        }
    ?>
    <input type="hidden" id="baseurl" value="{{url('/')}}">
    <table id="clientstable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No/Action</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientsData as $data)
                <tr>
                    <td><a class="btn btn-danger btn-sm" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#clientDeleteConfirmModal" onclick="getClientDetailsForDelete('{{ $data->id }}');"><i class="fa fa-trash"></i></a> <a class="btn btn-primary btn-sm" href="#" title="Details" data-bs-toggle="modal" data-bs-target="#clientEditModal" onclick="getClientDetails('{{ $data->id }}');"><i class="fa fa-search"></i></a></td>
                    <td>{{ $data->first_name }}</td>
                    <td>{{ $data->surname }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
</div>
@include('modals/clientcreatemodal')
@include('modals/clienteditmodal')
@include('modals/clientdeleteconfirmmodal')
@include('footer')
<script type="text/javascript">$('#clientstable').DataTable();</script>
<script type="text/javascript">
    var baseurl = document.getElementById("baseurl").value;
    function getClientDetails(id) {
        $.ajax({
            type: "GET",
            url: baseurl + "/getclientajax?id="+id,
            success: function(data) {
                
                document.getElementById('editclientid').value = data.data[0].id;
                document.getElementById('editfirstname').value = data.data[0].first_name;
                document.getElementById('editsurname').value = data.data[0].surname;
                document.getElementById('editemail').value = data.data[0].email;
                document.getElementById('editphone').value = data.data[0].phone;
                document.getElementById('editaddress1').value = data.data[0].home_addr1;
                document.getElementById('editaddress2').value = data.data[0].home_addr2;
                document.getElementById('edittown').value = data.data[0].home_town;
                document.getElementById('editcity').value = data.data[0].home_city;
                document.getElementById('editcounty').value = data.data[0].home_county;
                document.getElementById('editpostcode').value = data.data[0].home_postcode;

                usualpaymentchildren = document.getElementById("editusualpayment").children;
                for (var i = 0; i < usualpaymentchildren.length; i++) {
                    if(usualpaymentchildren[i].getAttribute("value") == data.data[0].payment_method) {
                        usualpaymentchildren[i].setAttribute("selected", "selected");
                    }
                }
                
                document.getElementById('editcreditcardnumber').value = data.data[0].card_no;
                document.getElementById('editexpirydate').value = data.data[0].card_exp;
                document.getElementById('editsecuritycode').value = data.data[0].card_code;
                document.getElementById('editnameoncard').value = data.data[0].card_name;
                document.getElementById('editcompanyname').value = data.data[0].comp_name;
                document.getElementById('editdepartment').value = data.data[0].comp_dep;
                document.getElementById('editcompanyaddress1').value = data.data[0].comp_addr1;
                document.getElementById('editcompanyaddress2').value = data.data[0].comp_addr2;
                document.getElementById('editcompanycity').value = data.data[0].comp_city;
                document.getElementById('editcompanycounty').value = data.data[0].comp_county;
                document.getElementById('editcompanypostcode').value = data.data[0].comp_postcode;

                companycountrychildren = document.getElementById("editcompanycountry").children;
                for (var j = 0; j < companycountrychildren.length; j++) {
                    if(companycountrychildren[j].getAttribute("value") == data.data[0].comp_country) {
                        companycountrychildren[j].setAttribute("selected", "selected");
                    }
                }
                
                document.getElementById('editcompanyphone').value = data.data[0].comp_phone;
                document.getElementById('editcompanyfax').value = data.data[0].comp_fax;
                document.getElementById('editwebsite').value = data.data[0].comp_website;
                document.getElementById('editdescriptionofbusiness').value = data.data[0].comp_des;
                document.getElementById('editsecretaryname').value = data.data[0].sec_name;
                document.getElementById('editsecretaryphone').value = data.data[0].sec_phone;
                document.getElementById('editsecretaryemail').value = data.data[0].sec_email;

                usualsitschildren = document.getElementById("editusuallysits").children;
                for (var k = 0; k < usualsitschildren.length; k++) {
                    if(usualsitschildren[k].getAttribute("value") == data.data[0].pref_sits) {
                        usualsitschildren[k].setAttribute("selected", "selected");
                    }
                }
                
                climatechildren = document.getElementById("editclimate").children;
                for (var l = 0; l < climatechildren.length; l++) {
                    if(climatechildren[l].getAttribute("value") == data.data[0].pref_climate) {
                        climatechildren[l].setAttribute("selected", "selected");
                    }
                }
                
                listenoptions = document.getElementsByClassName("editlistenstoradio");
                for(var n = 0; n < listenoptions.length; n++){
                    if(listenoptions[n].value == data.data[0].pref_radio) {
                        listenoptions[n].click();
                    }
                }

                document.getElementById('editradiostation').value = data.data[0].pref_station;

                pickupchildren = document.getElementById("editairportpickups").children;
                for (var m = 0; m < pickupchildren.length; m++) {
                    if(pickupchildren[m].getAttribute("value") == data.data[0].pref_pickup) {
                        pickupchildren[m].setAttribute("selected", "selected");
                    }
                }

                document.getElementById('editanyparticularroute').value = data.data[0].pref_route;
                document.getElementById('editdescriptionofluggage').value = data.data[0].pref_luggage;

                drinkoptions = document.getElementsByClassName("editdrinkswater");
                for(var n = 0; n < drinkoptions.length; n++){
                    if(drinkoptions[n].value == data.data[0].pref_drink) {
                        drinkoptions[n].click();
                    }
                }
                
                document.getElementById('editdescriptionofclient').value = data.data[0].pref_client_des;
                document.getElementById('editgeneralinfo').value = data.data[0].genral_info;
                
            },
            error: function(error) {
              console.log(error);
            }
        });
    }
    function getClientDetailsForDelete(id) {
        document.getElementById("deleteclientid").value = id;
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var openDetails = urlParams.get('openDetails');
        var clientid = urlParams.get('clientid');

        if(openDetails !== null && clientid !== null) {
            getClientDetails(clientid);
            $('#clientEditModal').modal('show');
        }
    });
</script>