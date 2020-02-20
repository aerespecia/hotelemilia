@extends('layouts.adminLayout')



@section('content')
 


<div class="main-content m-t-0 p-t-0">
        <!-- BEGIN TOPBAR -->
        
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
                    
          <div class="header">

              <h2><strong>Q CITIPARK</strong> DASHBOARD</h2>
              
          <hr class="m-b-0"/>
          </div>


          <div class="header">
            <h2><strong>Guest List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: false,
        dom: 'Bfrtip',
        buttons: [
            'print'
        ],
        ajax: '{!! route('admin.dataTablesGuestList') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'Address', name: 'Address' },
            { data: 'contactNo' , name: 'contactNo' },
            { data: 'Email', name: 'Email' },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">View</button>';
            }
        }
        ]
    });
    $('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
        
                $.get("../admin/guestViewRegistration/"+guestReservID,function(data){
                    console.log(data);
                    $(".title-name").html(data.firstName+" "+data.familyName);
                    $("#guest-registration-no").html(data.guestReservNoNF);
                    $("#guest-fname").val(data.firstName);
                    $("#guest-mname").val(data.middleName);
                    $("#guest-lname").val(data.familyName);
                    $("#guest-housebldg").val(data.houseNo);
                    $("#guest-brgy").val(data.brgy);
                    $("#guest-city").val(data.city);
                    $("#guest-country").val(data.country);
                    $("#guest-postalcode").val(data.postalCode);
                    $("#guest-nationality").val(data.nationality);
                    $("#guest-contactNo").val(data.contactNo);
                    $("#guest-email").val(data.email);
                    $("#guest-dob").val(data.dob);
                    $("#guest-designation").val(data.designation);
                    $("#guest-passno").val(data.passNo);
                    $("#guest-passexp").val(data.passExpiry);
                    $("#guest-passissue").val(data.passIssue);
                    $("#guest-otherid").val(data.otherId);
                    $("#guestTempId").val(data.id);
                    $(".guest-edit-save").val(data.id);
                    $(".guest-edit-close").val(data.id);
                    
                    
                    if(data.account_id)
                        $("#account-id").html(data.account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

            $('#userss-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: '../admin/dataTablesArchiveReservationListByGuest/'+guestReservID,
                columns: [
                    { data: 'reservedDate', name: 'reservedDate' },
                    { data: 'roomName', name: 'roomName' },
                    { data: 'arrivalDate', name: 'arrivalDate' },
                    { data: 'depatureDate', name: 'depatureDate' },
                    { data: 'clientName' , name: 'clientName' },
                
                ]
            });
    } );
});


  
</script>


@endpush
            
                    </tbody>
                  </table>
            </div>
          </div>
               </div>
            </div>
   
           
        </div>
        <!-- END PAGE CONTENT -->
      </div>

            <div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View Guest Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW GUEST INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">First Name</label>
                             
                                <input type="text" name="guest-fname" id="guest-fname" class="form-control" placeholder="Enter First Name..." minlength="3" value="">

                                <input type="hidden" name="guestTempId" id="guestTempId" value="">
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Middle Name</label>
                         
                                <input type="text" name="guest-mname" id="guest-mname" class="form-control" placeholder="Enter Middle Name..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Last Name</label>
                             
                                <input type="text" name="guest-lname" id="guest-lname" class="form-control" placeholder="Enter Last Name..." minlength="3">
                             
                            </div>
                          </div>
                        </div><br/><br/>
                            <div class="row border-top">
                            <h3 class="col-sm-6 m-t-10"><strong>Complete Address</strong></h3>
                            </div>
                            
                            <div class="row">
                                 
                          <div class="col-sm-4">
                              
                            <div class="form-group">
                               
                              <label class="control-label f-12">House/Bldg No. and Street</label>
                             
                                <input type="text" name="guest-housebldg" id="guest-housebldg" class="form-control" placeholder="House/Bldg No. and Street..." minlength="3" >
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Barangay/Village</label>
                         
                                <input type="text" name="guest-brgy" id="guest-brgy" class="form-control" placeholder="Brgy./Village..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">City/Town/Province/State</label>
                             
                                <input type="text" name="guest-city" id="guest-city" class="form-control" placeholder="City/Town/Province/State..." minlength="3">
                             
                            </div>
                          </div>
                                
                        </div>
                            <div class="row border-bottom">
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Country</label>
                             
                                <input type="text" name="guest-country" id="guest-country" class="form-control" placeholder="Country.." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Postal Code</label>
                             
                                <input type="text" name="guest-postalcode" id="guest-postalcode" class="form-control" placeholder="Postal Code" minlength="3">
                             
                            </div>
                          </div>
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Nationality</label>
                             
                                <input type="text" name="guest-nationality" id="guest-nationality" class="form-control" placeholder="Nationality" minlength="3">
                             
                            </div>
                          </div>
                            </div><br/><br/>
                         <div class="row border-bottom">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Contact No.</label>
                             
                                <input type="text" name="guest-contactNo" id="guest-contactNo" class="form-control" placeholder="Contact No..." minlength="3">
                              
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Email</label>
                             
                                <input type="text" name="guest-email" id="guest-email" class="form-control" placeholder="Email" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Date of Birth</label>
                             
                                <input type="text" name="guest-dob" id="guest-dob" class="form-control" data-mask="99-99-9999" placeholder="MM/DD/YYYY" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Designation</label>
                             
                                <input type="text" name="guest-designation" id="guest-designation" class="form-control" placeholder="Title/Designation" minlength="3">
                             
                            </div>
                          </div>
                             
                     
                        </div><br/><br/>
                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport No./ID</label>
                             
                                <input type="text" name="guest-passno" id="guest-passno" class="form-control" placeholder="Passport no." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Expiry Date</label>
                             
                                <input type="text" name="guest-passexp" id="guest-passexp" class="form-control"  placeholder="Passport Expiry" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Date of Issue</label>
                             
                                <input type="text" name="guest-passissue" id="guest-passissue" class="form-control" placeholder="Passport Date of Issue" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Other ID Presented</label>
                             
                                <input type="text" name="guest-otherid" id="guest-otherid" class="form-control" placeholder="ID presented" minlength="3" >
                              
                            </div>
                          </div>
                             
                     
                        </div>
                        
                            
                        </div>

                    </div>
                    <div class="row"><br/>
                        <h2 align="center"><strong>Previous Transactions</strong></h2><hr/>
                    </div>
                  <div class="row">
            <div class="col-md-12">
             <table id="userss-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Reserved Date</th>
                <th>Room Reservation</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Booked By</th>
                
            </tr>
        </thead>
                    <tbody>
                     
            
                    </tbody>
                  </table>
            </div>
          </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                    <button type="button" class="btn btn-success btn-embossed guest-edit-save" data-dismiss="modal" id="" value=""> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>

<script>

        
        
        $(".guest-edit-save").click(function(){
            
            var guestID = $(this).val();
            
            var guestInfo = {
                  firstName:  $("#guest-fname").val(),
                  middleName: $("#guest-mname").val(),
                  familyName: $("#guest-lname").val(),
                  room: $("#guest-room").val(),
                  guestReserv: $("#guestReservID").val(),
                  houseNo:    $("#guest-housebldg").val(),
                  brgy:    $("#guest-brgy").val(),
                  city:  $("#guest-city").val(),
                  country:    $("#guest-country").val(),
                  postalCode:  $("#guest-postalcode").val(),
                  nationality:  $("#guest-nationality").val(),
                  contactNo:  $("#guest-contactNo").val(),
                  email:  $("#guest-email").val(),
                  dob:  $("#guest-dob").val(),
                  designation:  $("#guest-designation").val(),
                  passNo:  $("#guest-passno").val(),
                  passExpiry:  $("#guest-passexp").val(),
                  passIssue: $("#guest-passissue").val(),
                  otherId:    $("#guest-otherid").val(),
                  id:  $("#guestTempId").val(),
                
            };
        

               $.ajax({
                   type:"POST",
                   url: "{{route('admin.guestUpdateAjax')}}",
                   data: guestInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                        alert(datas);
                        $("#modal-guest-edit").fadeOut(300, function(){

                        });
                   }
                   
                          
               });
      
                
        });
        
        
    
</script>        
       

@endsection

