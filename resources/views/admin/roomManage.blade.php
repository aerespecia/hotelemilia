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
            <h2><strong>Room Management</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                
                <th>Name</th>
                <th>Room Type</th>
                <th>Status</th>
                <th>Clean Status</th>
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
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: 'Discrepancy Monitoring',
                exportOptions: {
                    columns: [0,1,2,3]
                },
            }
        ],
        ajax: '{!! route('admin.dataTablesRoomManage') !!}',
        columns: [
            { data: 'roomName', name: 'roomName' },
            { data: 'name', name: 'name' },
            { data: 'status' , name: 'status' },
            { data: 'cleanStatus', name: 'cleanStatus' },
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.id;
                     return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button>';
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
      </div>
<div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View Room Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW ROOM INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Room Name</label>
                                <input type="text" name="roomNo" id="roomNo" class="form-control" placeholder="Enter First Name..." minlength="3" value="" readonly>
                            </div>
                          </div>
                          
                           <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Room Type</label>
                                <select id="roomType" name="roomType" class="form-control">

                                  <option value="0" selected>Room Type...</option>
                                  @foreach($roomTypes as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                            
                          </div>
                        </div>
                         <div class="row border-bottom">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label f-12">Status</label>
                                <select id="status" name="status" class="form-control" >
                                  <option value="0">Vacant Ready</option>
                                  <option value="1">Occupied</option>
                                  <option value="2">Vacant Dirty</option>
                                  <option value="3">Blocked</option>
                                  <option value="4">Out of Order</option>
                                  <option value="5">No Show</option>
                                  <option value="6">Slept Out</option>
                                  <option value="7">House Use</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label f-12">Clean Status</label>
                                <select id="cleanStatus" name="cleanStatus" class="form-control" >
                                  <option value="0">Clean Status....</option>
                                  <option value="1">Vacant Dirty</option>
                                  <option value="2">Vacant Clean</option>
                                  <option value="3">Occupied</option>
                                  <option value="4">Out of Order</option>
                              </select>
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
              $.get("../admin/roomViewRegistration/"+guestReservID,function(data){
                    console.log(data);
                    $("#roomNo").val(data.roomName);
                    $("#roomType").val(data.type).change();
                    $("#status").val(data.status).change();
                    $("#cleanStatus").val(data.cleanStatus).change();
                    
                    
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
                  status:  $("#status").val(),
                  cleanStatus: $("#cleanStatus").val(),
                  roomType: $("#roomType").val(),
                  id:  bookerId,
            };
        

               $.ajax({
                   type:"POST",
                   url: "{{route('admin.roomUpdateAjax')}}",
                   data: bookerInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                        $("#modal-guest-edit").fadeOut(300, function(){

                        });
                        location.reload();
                   }
                   
                          
               });
      
                
        });
        
        
    
</script>        
@endsection