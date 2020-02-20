@extends('layouts.housekeepingLayout')

@section('content')

<div class="main-content m-t-0 p-t-0">
    <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="header">
        <h2><strong>Room Status</strong></h2>
        <hr class="m-b-0"/>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="wizard-div current wizard-simple">
          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-content">
                  <div class="row">
                    <div class="col-md-12">
                     <table id="users-table" class="table table-striped">
                        <thead>
                            <tr>
          		                <th>Room Name</th>
          		                <th>Type</th>
          		                <th>Status</th>
          		                <th>Action</th>
                    		    </tr>
                		    </thead>
                        <tbody>
                          @push('scripts')
                          <script>
                          //ajax: '../admin/dataTablesArchiveReservationListByGuest/'+guestReservID,
                          </script>
                          @endpush
                        </tbody>
                      </table>  
                    </div>
                </div>
                  
               
                </div>
              </div>
                              
                              </div>
                           
                            
                          
                          </div>



        </div>
      </div>
    </div>
  </div>



       
                              
                              
</div>


<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: false,
        "bDestroy": true,
        ajax: "{!! route('housekeeping.dataTablesRoomList') !!}",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        dom: 'Bfrtip',
        buttons: [
        'colvis',
        'pageLength',
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2]
                }
            }
        ],
        "scrollx":false,
        
        columns: [
            { data: 'roomName', name: 'roomName', width:"20%" },
            { data: 'type', name: 'type', width:"20%"},
            { data: 'status', name: 'status', width:"20%" },
            {
              "className":      'optionss',
              width:"20%",
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.id;
                     return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-hg btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Update Room Status</button>';
              }
            }
            
        ],
        
    });
$('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
        

        		$.get("housekeeping/roomInfo/"+guestReservID,function(data){
                    console.log(data);
                    //$(".title-name").html(data.firstName+" "+data.familyName);
                    $("#roomId").val(data[0].id);
                    $("#roomNamePopout").val(data[0].roomName);
                    $("#statusPopout").val(data[0].status);
                    $("#typePopout").val(data[0].type);

                    $("#from_status").val(data[0].status);
                    $("#from_status").val(data[0].type);


                    $(".guest-edit-save").val(data[0].id);
                    $(".guest-edit-close").val(data[0].id);
                    $("#description").html('&nbsp;');
                    
                    if(data.account_id)
                        $("#account-id").html(data.account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

    });


});
      

</script>               

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
                              <label class="control-label">Room Name</label>
                                <input type="hidden" id="roomId" name="roomId" value="">
                                <input type="hidden" id="cleanerId" name="cleanerId" value="{{$user->id}}">
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="from_status" name="from_status" value="">
                                <input type="hidden" id="to_status" name="to_status" value="">
                                <input type="text" name="roomNamePopout" id="roomNamePopout" class="form-control" placeholder="Enter First Name..." minlength="3" value="" readonly>
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Type</label>
                         
                                <input type="text" name="typePopout" id="typePopout" class="form-control" placeholder="Enter Middle Name..." minlength="3"  readonly>
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Status</label>
                             
                                <input type="text" name="statusPopout" id="statusPopout" class="form-control" placeholder="Enter Last Name..." minlength="3"  readonly>
                             
                            </div>
                          </div>
                        </div><br/><br/>                            
                        </div>

                    </div>
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                            	<center>
                              	<h1 class="alert bg-primary"><STRONG name="description" id="description">&nbsp;</STRONG></h1>
                              	<br/><br/>                            
                              </center>
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              	<button type="button" class="btn btn-hg btn-block btn-info btn-embossed guest-edit-save changeStatus" data-value="1"> Prepared </button>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              	<button type="button" class="btn btn-hg btn-block btn-success btn-embossed guest-edit-save changeStatus" data-value="2"> Cleaned </button>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              	<button type="button" class="btn btn-hg btn-block btn-warning btn-embossed guest-edit-save changeStatus" data-value="3"> Repaired</button>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-hg btn-block btn-danger btn-embossed guest-edit-save changeStatus" data-value="4"> Out of Order</button>
                            </div>
                          </div>
                          
                        </div>
                        
                        </div>

                    </div>
                    
                  
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                    <button type="button" class="btn btn-success btn-embossed guest-edit-save" data-dismiss="modal" id="saveRoom" value=""> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>

        <script>
        
        //var guestReservID = this.value.split("#");
        
         $(".changeStatus").click(function() {
              var id = $(this).attr('data-value'); // $(this) refers to button that was clicked

              if(id==1){
                $("#description").text('PREPARED');
                $("#type").val(1);
                if($("#from_status").val()==2)
                  $("#to_status").val(0);
                
              }
              else if(id==2){
                $("#description").text('CLEANED');
                $("#to_status").val('');
                $("#type").val(2);
              }
              else if(id==3){
                $("#description").text('REPAIRED');
                $("#type").val(3);
                if($("#from_status").val()==2 || $("#from_status").val()==4)
                  $("#to_status").val(0);
                
              }
              else if(id==4){
                $("#description").text('OUT OF ORDER');
                $("#to_status").val(4);
                $("#type").val(4);
              }
          });

 


        $("#saveRoom").click(function() {
              var roomInfo = {
                  'roomId':  $("#roomId").val(),
                  'cleanerId': $("#cleanerId").val(),
                  'type': $("#type").val(),
                  'from_status': $("#from_status").val(),
                  'to_status': $("#to_status").val()
              };
              


              $.ajax({
                   type:"POST",
                   url: "{{route('housekeeping.roomStatusSaves')}}",
                   data: roomInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                        $("#modal-guest-edit").fadeOut(300, function(){
                        
                        $('#users-table').DataTable({
                            processing: true,
                            serverSide: false,
                            "bDestroy": true,
                            ajax: "{!! route('housekeeping.dataTablesRoomList') !!}",
                            lengthMenu: [
                                [ 10, 25, 50, -1 ],
                                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                            ],
                            dom: 'Bfrtip',
                            buttons: [
                            'colvis',
                            'pageLength',
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0,1,2]
                                    }
                                }
                            ],
                            "scrollx":false,
                            
                            columns: [
                                { data: 'roomName', name: 'roomName', width:"20%" },
                                { data: 'type', name: 'type', width:"20%"},
                                { data: 'status', name: 'status', width:"20%" },
                                {
                                  "className":      'optionss',
                                  width:"20%",
                                  "data":           null,
                                  "render": function(data, type, full, meta){
                                        var valueHere=data.id;
                                         return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-hg btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Update Room Status</button>';
                                  }
                                }
                                
                            ],
                            
                        });

                        });
                   }
                   
                          
               });
          });



        </script>
@endsection
 