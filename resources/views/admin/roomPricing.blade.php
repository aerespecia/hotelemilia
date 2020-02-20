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
            <h2><strong>Room Pricing Management</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                
                <th>Name</th>
                <th>Rate</th>
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
                exportOptions: {
                    columns: [0,1]
                },
                title: 'Room Pricing'
            }
        ],
        ajax: '{!! route('admin.dataTablesRoomPricing') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },

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
                  <h4 class="modal-title"><strong>View Room Type Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW ROOM TYPE INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter First Name..." value="" readonly>
                            </div>
                          </div>
                          
                           <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Price Rate</label>
                                <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter First Name..." value="">
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
</div>

<script>
      $('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
              $.get("../admin/roomTypeViewRegistration/"+guestReservID,function(data){
                    console.log(data);

                    $("#name").val(data[0].name);
                    $("#rate").val(data[0].price);
                    
                    
                    
                    $(".guest-edit-save").val(data[0].id);
                    $(".guest-edit-close").val(data[0].id);
                    
                    if(data[0].account_id)
                        $("#account-id").html(data[0].account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

            
    } );
        
        
        $(".guest-edit-save").click(function(){

            
            var bookerId = $(this).val();
            

            var bookerInfo = {                  
                  rate: $("#rate").val(),
                  id:  bookerId,
            };
        

               $.ajax({
                   type:"POST",
                   url: "{{route('admin.roomTypeUpdateAjax')}}",
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