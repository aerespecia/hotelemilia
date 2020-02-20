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
            <h2><strong>Transactions</strong></h2>
          </div>
            
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Client Name</th>
                <th>Institution</th>
                <th>Code</th>
                <th>Discount Type</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
                    <tbody>
                      
<script>
$(function() {
    $('#users-table').DataTable({
        processing: false,
        serverSide: false,
        "bDestroy": true,
        ajax: '{!! route('admin.dataTablesTransactions') !!}',
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4]
                },
                title: 'Transactions'
            }
        ],
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionsName', name: 'institutionsName' },
            { data: 'code', name: 'code' },
            { data: 'discountStatus', name: 'discountStatus' },
            { data: 'transactionstatus', name: 'transactionstatus' },
            { data: 'username', name: 'username' },
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.id;
                    var clientName=data.clientName;
                    var institutionsName=data.institutionsName;
                  return '<button type="button" data-cname="'+clientName+'" data-iname="'+institutionsName+'" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button>';
              }
            }
        ]
    });
});
</script>

            
                    </tbody>
                  </table>
            </div>
          </div>
               </div>
            </div>
   
           
        </div>
        <!-- END PAGE CONTENT -->
      

<!-- modal for edit transaction -->


<div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View TRANSACTION Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW TRANSACTION INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    <ul class="nav nav-tabs nav-primary">
                        <li class="active tabsRoomLi" id="firstTabLi"><a href="#tab2_1" data-toggle="tab" class="tabsRooms"><i class="icon-home"></i>Manage Transaction</a></li>
                        <li class="tabsRoomLi"><a href="#tab2_2" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> Manage Room Reservation</a></li>
                        <li class="tabsRoomLi"><a href="#tab2_4" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> Downpayments</a></li>
                        <li class="tabsRoomLi"><a href="#tab2_3" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> Room Charges</a></li>
                        
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane fade active in tabsRoomPane" id="tab2_1"> 

                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Client Name</label>
                                <input type="text" name="clientName" id="clientName" class="form-control" placeholder="No Value" minlength="3" value="" readonly>
                            </div>
                          </div>
                          
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Institution Name</label>
                                <input type="text" name="institutionName" id="institutionName" class="form-control" placeholder="No Value" minlength="3" readonly>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Code</label>
                                <input type="text" name="transactionCode" id="transactionCode" class="form-control" placeholder="No Value" minlength="3" readonly>
                            </div>
                          </div>
                            
                            <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Status</label>
                              <select id="status" name="status" class="form-control" >
                                  <option value="0" selected>Ongoing</option>
                                  <option value="1">Billed</option>
                                  <option value="2">No Show</option>
                                  <option value="3">House Use</option>
                              </select>
                            </div>
                          </div>


                          </div>
                        </div>
                         <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Charge Type</label>
                              <select id="chargeType" name="chargeType" class="form-control" >
                                  <option value="1" selected>Cash</option>
                                  <option value="2">Credit Card</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Made Thru</label>
                                <select id="madeThru" name="madeThru" class="form-control">
                                  <option value="1" selected>Walk In</option>
                                  <option value="2">Email</option>
                                  <option value="3">Phone</option>
                                
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Guaranteed To</label>
                              <select id="guaranteed" name="guaranteed" class="form-control" >
                                  <option value="1" selected>Yes</option>
                                  <option value="2">No</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Billing Type</label>
                              <select id="billArrange" name="billArrange" class="form-control" >
                                  <option value="1" selected>Charge To Company</option>
                                  <option value="2">Guest Account</option>
                              </select>
                                  
                            </div>
                          </div>
                             
                     
                        </div>
                        <div class="row border-bottom">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Special Request Note</label>
                                <textarea class="form-control" id="specialRequestNotes" name="specialRequestNotes"></textarea>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Guaranteed Note</label>
                                <textarea class="form-control" id="guaranteedNote" name="guaranteedNote"></textarea>
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Billing Note</label>
                                <textarea class="form-control" id="billingNote" name="billingNote"></textarea>
                            </div>
                          </div>                             
                     
                        </div>
                        
                        
                            
                        </div>
                    
                      
                  
          </div>

          <div class="tab-pane fade tabsRoomPane" id="tab2_2">
                      <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                        <label class="form-label">Initial Arrival</label>
                        <div class="prepend-icon">
                          <input type="text" name="InitialArrivalDateRoom" id="InitialArrivalDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="form-label">Initial Departure</label>
                              <div class="prepend-icon">
                                <input type="text" name="InitialDepatureDateRoom" id="InitialDepatureDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                                <i class="icon-calendar"></i>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                        <label class="form-label">Arrival</label>
                        <div class="prepend-icon">
                          <input type="hidden" name="isRoomManage" id="isRoomManage" value="">
                          <input type="text" name="arrivalDateRoom" id="arrivalDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                          </div>
                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="form-label">Departure</label>
                              <div class="prepend-icon">
                                <input type="text" name="depatureDateRoom" id="depatureDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                                <i class="icon-calendar"></i>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Discount Status</label>
                              <select id="discountStatus" name="discountStatus" class="form-control">
                                @foreach($discountDetails as $dd)
                                  <option value="{{$dd->id}}">{{$dd->name.' ('.($dd->discountValue*100).' %)'}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Occupied Status</label>
                              <select id="occupiedStatus" name="occupiedStatus" class="form-control">
                                  <option value="0">--------</option>
                                  <option value="1">Occupied</option>
                                  <option value="2">Checked Out</option>
                              </select>
                            </div>
                          </div>


                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="form-label">Final Room Rate</label>
                              
                                <input type="text" name="finalRoomRate" id="finalRoomRate" class="form-control" placeholder="Reservation Room Rate Here...">
                               
                            
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="form-label">*For Billing Room Type</label>
                              
                                <input type="text" name="finalRoomType" id="finalRoomType" class="form-control" placeholder="Reservation Room Rate Here...">
                           
                            </div>
                          </div>

                        </div>




                          

            <div class="row">
            <div class="col-sm-12">
             <table id="userss-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Rooms</th>
                <th>Discount Type</th>
                <th>Reserved Date</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Guest Names</th>
                <th>Actions</th>
                
            </tr>
        </thead>
                    <tbody>
            
                    </tbody>
                  </table>
            </div>
          </div>
                                                        
            </div>





            <div class="tab-pane fade tabsRoomPane" id="tab2_3">
            <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="form-label">Guest Charged</label>
                                
                                  <input type="hidden" name="isRoomChargeManage" id="isRoomChargeManage" value="">
                                  <select id="guestNameCharged" name="guestNameCharged" class="form-control">
                                  
                                  </select>
                                
                              </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="form-label">OR</label>
                              
                                <input type="text" name="orCharge" id="orCharge" class="form-control" placeholder="Official Slip No....">
                              
                            </div>
                          </div>
                            
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Type</label>
                              <select id="roomChargeType" name="roomChargeType" class="form-control">
                                  <option value="1">Food & Beverages</option>
                                  <option value="2">Room Service</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row"> 
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Account Type</label>
                              <select id="accountChargeType" name="accountChargeType" class="form-control">
                                  <option value="1">Debit</option>
                                  <option value="2">Credit</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="form-label">Item Name</label>                              
                                <input type="text" name="itemNameCharge" id="itemNameCharge" class="form-control" placeholder="Select a date...">
                              </div>
                            </div>

                            <div class="col-sm-4">
                            <div class="form-group">
                              <label class="form-label">Price</label>                              
                                <input type="text" name="priceCharge" id="priceCharge" class="form-control" placeholder="Select a date...">
                              </div>
                            </div>
                        </div>
                        <div class="row">
            <div class="col-sm-12">
             <table id="roomCharges-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Date and Time</th>        
                <th>Guest Name</th>
                <th>Room #</th>
                <th>Account Type</th>
                <th>Type</th>
                <th>O.R.</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Actions</th>
                
            </tr>
        </thead>
                    <tbody>
            
                    </tbody>
                  </table>
            </div>
          </div>
                </div>

                <div class="tab-pane fade tabsRoomPane" id="tab2_4">
                  <div class="row">
                    <div class="col-sm-6">
                      <table id="downpayments-table" class="table table-striped">
                        <thead>
                          <tr>
                          <th>Date &amp; Time</th>
                          <th>Paid Thru</th>
                          <th>Amount</th>
                          <th>Notes</th>
                          <th>frontdesk</th>
                          <th>Actions</th>

                          </tr>
                        </thead>

                        <tbody>

                        </tbody>
                      </table>
                  </div>


                    <div class="col-sm-6">
                      <div class="col-sm-12">
                          <div class="form-group">
                          <label class="control-label f-12">Paid Thru</label>
                          <select id="paidThruDownpayment" name="paidThruDownpayment" class="form-control">
                            <option value="1">Cash</option>
                            <option value="2">Credit Card</option>
                            <option value="3">Cheque</option>
                          </select>
                          </div>
                        </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                        <label class="form-label">Amount</label>

                        <input type="hidden" name="isDownpaymentManage" id="isDownpaymentManage" value="">
                        <input type="text" name="amountDownpayment" id="amountDownpayment" class="form-control" placeholder="Amount...">

                        </div>
                      </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                          <label class="form-label">Notes</label>
                          <textarea name="notesDownpayment" id="notesDownpayment" class="form-control" rows="10"></textarea>
                          
                          </div>
                        </div>

                        
                      </div>
                  
                </div>

                </div>

            
                                                        
            </div>






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





<script>

        $(function() {
    
    $('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
        var cname = $(this).attr("data-cname");
        var iname = $(this).attr("data-iname");

              $("#InitialArrivalDateRoom").val('');
              $("#InitialDepatureDateRoom").val('');

              $("#arrivalDateRoom").val('');
              $("#depatureDateRoom").val('');
              $("#noDaysPaid").val('');
              $("#discountStatus").val(0).change();
              $("#isRoomManage").val(0);

              $("#occupiedStatus").val(0).change();

              $("#isRoomChargeManage").val(0);
              $("#guestNameCharged").val(0).change();
              $("#orCharge").val('');
              $("#roomChargeType").val(0).change();
              $("#accountChargeType").val(0).change();
              $("#itemNameCharge").val('');
              $("#priceCharge").val('');



              $.get("../admin/transactionViewRegistration/"+guestReservID,function(data){
                    console.log(data);
                    //$('#typeIssue').val(0).change();
                    $("#clientName").val(cname);
                    $("#institutionName").val(iname);
                    $("#transactionCode").val(data.code);

                    $("#status").val(data.status).change();
                    $("#chargeType").val(data.chargeType).change();
                    $("#madeThru").val(data.madeThru).change();
                    $("#guaranteed").val(data.guaranteed).change();
                    $("#billArrange").val(data.billingType).change();

                    $("#guaranteedNote").html(data.guaranteedNote);
                    $("#specialRequestNotes").html(data.specialRequestNotes);
                    $("#billingNote").html(data.billingNote);
                    
                    
                    
                    $(".guest-edit-save").val(data.id);
                    $(".guest-edit-close").val(data.id);
                    
                    if(data.account_id)
                        $("#account-id").html(data.account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

          var trasactionInfo = {
                'id':guestReservID,
            };

          $.ajax({
                   type:"POST",
                   url: "{{route('admin.retrieveGuestsTransaction')}}",
                   data: trasactionInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    $('#guestNameCharged').find('option').remove().end();
                      $.each(datas, function (i, item) {
                          $('#guestNameCharged').append($('<option>', { 
                              value: item.id,
                              text : item.name 
                          }));
                      });

                   }
               });



          $('#userss-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: '../admin/dataTablesArchiveReservationListByTransaction/'+guestReservID,
                columns: [
                    
                    { data: 'roomNames', name: 'roomNames' },
                    { data: 'discountName', name: 'discountName' },
                    
                    { data: 'reservedDate', name: 'reservedDate' },
                    { data: 'arrivalDate', name: 'arrivalDate' },
                    { data: 'depatureDate', name: 'depatureDate' },
                    { data: 'guestnames' , name: 'guestnames' },
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    
                     return '<button type="button" class="btn-sm btn-default btn-transparent edit-modal" value="'+data.id+'">Manage Reservation</button>';
              }
            }
                    
                  
                
                ]
            });


          $('#roomCharges-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: '../admin/dataTablesRoomChargesByTransaction/'+guestReservID,
                columns: [
                    { data: 'created_at', name: 'created_at' },
                    { data: 'guestName', name: 'guestName' },
                    { data: 'roomName', name: 'roomName' },
                    { data: 'acctype', name: 'acctype' },
                    { data: 'type', name: 'type' },
                    { data: 'OR', name: 'OR' },
                    { data: 'itemName', name: 'itemName' },
                    { data: 'price' , name: 'price' },
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    
                     return '<button data-type="1" type="button" class="btn-sm btn-default btn-transparent edit-modal" value="'+data.id+'">Manage</button><button data-type="2" type="button" class="btn-sm btn-default btn-transparent edit-modal" data-transaction="'+guestReservID+'" value="'+data.id+'">Delete</button>';
              }
            }
                    
                  
                
                ]
            });


            $('#downpayments-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: '../admin/dataTablesDownpaymentByTransaction/'+guestReservID,
                columns: [
                    
                    { data: 'dateTime', name: 'dateTime' },
                    { data: 'paidThru', name: 'paidThru' },
                    { data: 'amount', name: 'amount' },
                    { data: 'notes', name: 'notes' },
                    { data: 'frontdesk', name: 'frontdesk' },
                    {
                      "className":      'options',
                      "data":           null,
                      "render": function(data, type, full, meta){
                             return '<button data-type="1" type="button" class="btn-sm btn-default btn-transparent edit-modal" value="'+data.id+'">Manage</button><button data-type="2" type="button" class="btn-sm btn-default btn-transparent edit-modal" data-transaction="'+guestReservID+'" value="'+data.id+'">Delete</button>';
                      }
                    }
                    
                  
                
                ]
            });

            
    } );


///////////////Room Reservation

$('#userss-table tbody').on( 'click', 'button', function () {       
        var guestReservID = this.value;
        
              $.get("../admin/roomReservationViewRegistration/"+guestReservID,function(datas){
                    console.log(datas);
                    //$('#typeIssue').val(0).change();
                    $("#InitialArrivalDateRoom").val(datas[0].initialArrivalDate);
                    $("#InitialDepatureDateRoom").val(datas[0].initialDepatureDate);
                    $("#arrivalDateRoom").val(datas[0].arrivalDate);
                    $("#depatureDateRoom").val(datas[0].depatureDate);
                    $("#noDaysPaid").val(datas[0].noOfdays);
                    $("#discountStatus").val(datas[0].discountId).change();
                    $("#occupiedStatus").val(datas[0].occupiedStatus).change();
                    $("#finalRoomRate").val(datas[0].FinalRoomRate);

                    if(datas[0].FinalRoomType == "")
                      $("#finalRoomType").val(datas[0].roomType);
                    else
                      $("#finalRoomType").val(datas[0].FinalRoomType);

                    $("#isRoomManage").val(datas[0].id);
                    
                    
                    $(".guest-edit-save").val(datas[0].id);
                    $(".guest-edit-close").val(datas[0].id);
                  
                });

         

            
    } );
});

$('#roomCharges-table tbody').on( 'click', 'button', function () {
      var actionId = $(this).attr('data-type');
      var id = $(this).attr('value');


      if(actionId == 1){
          $.get("../admin/roomChargeViewRegistration/"+id,function(data){
          console.log(data);
          //$('#typeIssue').val(0).change();
          $("#isRoomChargeManage").val(data[0].id);
          $("#guestNameCharged").val(data[0].guestReservationId).change();
          $("#orCharge").val(data[0].OR);
          $("#roomChargeType").val(data[0].type).change();
          $("#accountChargeType").val(data[0].acctype).change();
          $("#itemNameCharge").val(data[0].itemName);
          $("#priceCharge").val(data[0].price);
        
          
          $(".guest-edit-save").val(data[0].id);
          $(".guest-edit-close").val(data[0].id);
         
        
      });
      }
      if(actionId == 2){
            var transactId = $(this).attr('data-transaction');
            var deleteRoomChargeInfo = {
                'id':id,
            };

          $.ajax({
                   type:"POST",
                   url: "{{route('admin.deleteRoomChargeAjax')}}",
                   data: deleteRoomChargeInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                      $('#roomCharges-table').DataTable({
                          processing: true,
                          serverSide: false,
                          "bDestroy": true,
                          ajax: '../admin/dataTablesRoomChargesByTransaction/'+transactId,
                          columns: [
                              
                              { data: 'created_at', name: 'created_at' },
                              { data: 'guestName', name: 'guestName' },
                              { data: 'roomName', name: 'roomName' },
                              { data: 'acctype', name: 'acctype' },
                              { data: 'type', name: 'type' },
                              { data: 'OR', name: 'OR' },
                              { data: 'itemName', name: 'itemName' },
                              { data: 'price' , name: 'price' },
                      {
                        "className":      'options',
                        "data":           null,
                        "render": function(data, type, full, meta){
                              
                               return '<button data-type="1" type="button" class="btn-sm btn-default btn-transparent edit-modal" value="'+data.id+'">Manage</button><button data-type="2" type="button" class="btn-sm btn-default btn-transparent edit-modal" data-transaction="'+transactId+'" value="'+data.id+'">Delete</button>';
                        }
                      }
                              
                            
                          
                          ]
                      });
                   }
               });
      }
      

});

$('#downpayments-table tbody').on( 'click', 'button', function () {
      var actionId = $(this).attr('data-type');
      var id = $(this).attr('value');


      if(actionId == 1){
          $.get("../admin/downpaymentViewRegistration/"+id,function(data){
          console.log(data);
          //$('#typeIssue').val(0).change();
          $("#isDownpaymentManage").val(data[0].id);
          $("#paidThruDownpayment").val(data[0].paidThru).change();
          $("#amountDownpayment").val(data[0].amount);
          $("#notesDownpayment").html(data[0].notes);
          
        
          
          $(".guest-edit-save").val(data[0].id);
          $(".guest-edit-close").val(data[0].id);
         
        
      });
      }
      if(actionId == 2){
            var transactId = $(this).attr('data-transaction');
            var deleteRoomChargeInfo = {
                'id':id,
            };

          $.ajax({
                   type:"POST",
                   url: "{{route('admin.deleteDownpaymentAjax')}}",
                   data: deleteRoomChargeInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                      $('#downpayments-table').DataTable({
                          processing: true,
                          serverSide: false,
                          "bDestroy": true,
                          ajax: '../admin/dataTablesDownpaymentByTransaction/'+transactId,
                          columns: [
                              
                              { data: 'dateTime', name: 'dateTime' },
                              { data: 'paidThru', name: 'paidThru' },
                              { data: 'amount', name: 'amount' },
                              { data: 'notes', name: 'notes' },
                              { data: 'frontdesk', name: 'frontdesk' },
                              {
                                "className":      'options',
                                "data":           null,
                                "render": function(data, type, full, meta){
                                       return '<button data-type="1" type="button" class="btn-sm btn-default btn-transparent edit-modal" value="'+data.id+'">Manage</button><button data-type="2" type="button" class="btn-sm btn-default btn-transparent edit-modal" data-transaction="'+guestReservID+'" value="'+data.id+'">Delete</button>';
                                }
                              }
                              
                            
                          
                          ]
                      });
                   }
               });
      }
      

});





        
        $(".guest-edit-save").click(function(){

            
            var transactionId = $(this).val();
            
            
            var transactionInfo = {
                  chargeType:  $("#chargeType").val(),
                  madeThru: $("#madeThru").val(),
                  guaranteed: $("#guaranteed").val(),
                  billArrange: $("#billArrange").val(),
                  status:$("#status").val(),
                  guaranteedNote: $("#guaranteedNote").val(),
                  specialRequestNotes: $("#specialRequestNotes").val(),
                  billingNote: $("#billingNote").val(),
                  id:  transactionId,


                  initialArrivalDate:  $("#InitialArrivalDateRoom").val(),
                  initialDepatureDate: $("#InitialDepatureDateRoom").val(),

                  arrivalDateRoom:  $("#arrivalDateRoom").val(),
                  depatureDateRoom: $("#depatureDateRoom").val(),
                  occupiedStatus: $("#occupiedStatus").val(),
                  discountStatus: $("#discountStatus").val(),
                  finalRoomRate: $("#finalRoomRate").val(),
                  finalRoomType: $("#finalRoomType").val(),
                  isRoomManage:$("#isRoomManage").val(),

                  isRoomChargeManage:  $("#isRoomChargeManage").val(),
                  guestNameCharged:  $("#guestNameCharged").val(),
                  orCharge:  $("#orCharge").val(),
                  roomChargeType:  $("#roomChargeType").val(),
                  accountChargeType:  $("#accountChargeType").val(),
                  itemNameCharge:  $("#itemNameCharge").val(),
                  priceCharge:  $("#priceCharge").val(),

                  isDownpaymentManage:  $("#isDownpaymentManage").val(),
                  paidThruDownpayment:  $("#paidThruDownpayment").val(),
                  amountDownpayment:  $("#amountDownpayment").val(),
                  notesDownpayment:  $("#notesDownpayment").val(),
                  
            };


          

               $.ajax({
                   type:"POST",
                   url: "{{route('admin.transactionUpdateAjax')}}",
                   data: transactionInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                        location.reload();
                   }
                   
                          
               });
      
                
        });
        
        
    
</script>        
@endsection