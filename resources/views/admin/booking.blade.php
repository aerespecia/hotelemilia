@extends('layouts.adminLayout')



@section('content')
 


<div class="main-content m-t-0 p-t-0">
        <!-- BEGIN TOPBAR -->
        
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
                    
          <div class="header">

              <h2><strong>Q CITIPARK</strong> DASHBOARD</h2>
              
          
          </div>
          <hr class="m-b-0"/> 

          <div class="header">
            <h2><strong>Booking Persons</strong></h2>
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
        ajax: '{!! route('admin.dataTablesBookingList') !!}',
        dom: 'Bfrtip',
        buttons: [
          'print'
        ],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'Address', name: 'Address' },
            { data: 'contactNo' , name: 'contactNo' },
            { data: 'title', name: 'title' },
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
                  <h4 class="modal-title"><strong>View BOOKER Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW BOOKER INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name..." minlength="3" value="">
                            </div>
                          </div>
                          
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name..." minlength="3">
                            </div>
                          </div>
                            <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Last Name..." minlength="3">
                            </div>
                          </div>
                          </div>
                        </div>
                         <div class="row border-bottom">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Adress...." minlength="3">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Contact No.</label>
                                <input type="text" name="contactNo" id="contactNo" class="form-control" placeholder="Contact No..." minlength="3">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" minlength="3">
                            </div>
                          </div>
                             
                     
                        </div>
                        
                        
                            
                        </div>
                    <div class="row"><br/>
                        <h2 align="center"><strong>Previous Transactions</strong></h2><hr/>
                    </div>
                  <div class="row">
            <div class="col-sm-12">
             <table id="userss-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Reserved Date</th>
                <th>Transaction Code</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Rooms Attached</th>
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    
    $('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
              $.get("../admin/bookingViewRegistration/"+guestReservID,function(data){
                    console.log(data);
                    $(".title-name").html(data.firstname+" "+data.lastName);                    
                    $("#fname").val(data.firstname);
                    $("#lname").val(data.lastName);
                    $("#title").val(data.title);

                    
                    $("#address").val(data.address);
                    $("#contactNo").val(data.contactNo);
                    $("#email").val(data.email);
                    
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
                ajax: '../admin/dataTablesArchiveReservationListByClient/'+guestReservID,
                columns: [
                    { data: 'reservedDate', name: 'reservedDate' },
                    { data: 'code', name: 'code' },
                    { data: 'arrivalDate', name: 'arrivalDate' },
                    { data: 'depatureDate', name: 'depatureDate' },
                    { data: 'roomNames' , name: 'roomNames' },
                
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

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                    <button type="button" class="btn btn-success btn-embossed guest-edit-save" id="" value=""> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
</div>

<script>

        
        
        $(".guest-edit-save").click(function(){

            
            var bookerId = $(this).val();
            

            var bookerInfo = {
                  firstName:  $("#fname").val(),
                  familyName: $("#lname").val(),
                  title: $("#title").val(),
                  address: $("#address").val(),
                  contactNo: $("#contactNo").val(),
                  email:    $("#email").val(),
                  id:  bookerId,
            };
        

               $.ajax({
                   type:"POST",
                   url: "{{route('admin.clientUpdateAjax')}}",
                   data: bookerInfo,
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