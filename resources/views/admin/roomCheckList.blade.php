@extends('layouts.adminLayout')



@section('content')

<script>
    $(function() {
    $( "#userSearch" ).autocomplete({
      source: "{{route('admin.userSearch')}}",
      autoFocus:true,
      select:function(e, ui){
          $("#email").val(ui.item['email']);
          $("#address").val(ui.item['address']);
          $("#position").val(ui.item['role']).change();
          $("#fname").val(ui.item['firstName']);
          $("#mname").val(ui.item['middleName']);
          $("#lname").val(ui.item['lastName']);
          $("#contactno").val(ui.item['contactNo']);
          $("#username").val(ui.item['username']);
          $("#idUser").val(ui.item['id']);
          $("#updateMe").val(1);
      }

    });  

  });
    </script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
            <script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
            <script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
     <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<div class="main-content m-t-0 p-t-0">

<div class="page-content">
          <div class="header">

              <h2><strong>Discount Management</strong></h2>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   
                      <h4><strong>MANAGE ROOM CHECK LIST</strong></h4>
                             <hr/>




                      <div class="row">
               
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Name</label>
                              <div class="append-icon">
                                <input type="text" name="name" id="name" class="form-control" minlength="3" placeholder="Enter Name..." autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Category</label>
                                <select id="category" name="category" style="width:100%;">
                                  <option value="0" selected>Category</option>
                                  <option value="1">Door</option>
                                  <option value="2">Room</option>
                                  <option value="3">Bathroom</option>
                                  <option value="4">Bed</option>
                                  <option value="100">Others</option>
                                </select>
                            </div>
                          </div>
                          
                          </div>                                              
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <button type="button" class="btn btn-hg btn-primary" id="saveRoomCheckList" name="saveRoomCheckList">Save</button>
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
</div>
</form>


<hr class="m-b-0"/> 

          <div class="header">
            <h2><strong>Room Item Check List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="roomItem-table" class="table table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#roomItem-table').DataTable({
        processing: false,
        serverSide: false,
        "bDestroy": true,
        ajax: '{!! route('admin.dataTablesRoomCheckListItems') !!}',
        dom: 'Bfrtip',
        buttons: [
          'print'
        ],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'category' , name: 'category' },
            { data: 'status' , name: 'status' },
            {
              "className":      'optionss',
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
@endpush
            
                    </tbody>
                  </table>
            </div>
          </div>
               </div>
            </div>
            </div>










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
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Name</label>
                                <input type="text" name="nameUpdate" id="nameUpdate" class="form-control" placeholder="Enter First Name..." value="">
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Category</label>
                                <select id="categoryUpdate" name="categoryUpdate" style="width:100%;">
                                  <option value="0" selected>Category</option>
                                  <option value="1">Door</option>
                                  <option value="2">Room</option>
                                  <option value="3">Bathroom</option>
                                  <option value="4">Bed</option>
                                  <option value="100">Others</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Status</label>
                                <select id="statusUpdate" name="statusUpdate" style="width:100%;">
                                  <option value="0" selected>Inactive</option>
                                  <option value="1">Active</option>
                                </select>
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


</div>


<script>
$('#roomItem-table tbody').on( 'click', 'button', function () {    

          var guestReservID = this.value;
              $.get("../admin/roomCheckListViewRegistration/"+guestReservID,function(data){
                    console.log(data);


                    $("#nameUpdate").val(data[0].name);
                    $("#statusUpdate").val(data[0].status).change();
                    $("#categoryUpdate").val(data[0].category).change();


                    
                    $(".guest-edit-save").val(data[0].id);
                    $(".guest-edit-close").val(data[0].id);
                    
                    if(data.account_id)
                        $("#account-id").html(data[0].account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

          
            
              
  
          });

$(".guest-edit-save").click(function(){
        var actionId = $(this).attr('data-value');
        var id = $(this).attr('value');
        //alert(id);
       

        var discountInfo = {
          'id':id,
          'name':$("#nameUpdate").val(),
          'status':$("#statusUpdate").val(),
          'category':$("#categoryUpdate").val(),
        };
                
      $.ajax({
           type:"POST",
           url: "{{route('admin.updateRoomCheckListAjax')}}",
           data: discountInfo,
           headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
           success: function (datas){
            //alert(datas);
              $("#modal-guest-edit").fadeOut(300, function(){

                        });

              $(function() {
                  $('#roomItem-table').DataTable({
                                processing: false,
                                serverSide: false,
                                "bDestroy": true,
                                ajax: '{!! route('admin.dataTablesRoomCheckListItems') !!}',
                                dom: 'Bfrtip',
                                buttons: [
                                  'print'
                                ],
                                columns: [
                                    { data: 'name', name: 'name' },
                                    { data: 'category' , name: 'category' },
                                    { data: 'status' , name: 'status' },
                                    {
                                      "className":      'optionss',
                                      "data":           null,
                                      "render": function(data, type, full, meta){
                                            var valueHere=data.id;
                                             return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button>';
                                      }
                                    }
                                ]
                            });
              });
           }
       });
      
                
        });


$("#saveRoomCheckList").click(function(){
        
        //alert(id);
        var discountInfo = {
          'name':$("#name").val(),
          'status':$("#status").val(),
          'category':$("#category").val(),
        };
                
      $.ajax({
           type:"POST",
           url: "{{route('admin.roomCheckListItemManage')}}",
           data: discountInfo,
           headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
           success: function (datas){
            $("#name").val('');
            //alert(datas);
                    $(function() {
                            $('#roomItem-table').DataTable({
                                processing: false,
                                serverSide: false,
                                "bDestroy": true,
                                ajax: '{!! route('admin.dataTablesRoomCheckListItems') !!}',
                                dom: 'Bfrtip',
                                buttons: [
                                  'print'
                                ],
                                columns: [
                                    { data: 'name', name: 'name' },
                                    { data: 'category' , name: 'category' },
                                    { data: 'status' , name: 'status' },
                                    {
                                      "className":      'optionss',
                                      "data":           null,
                                      "render": function(data, type, full, meta){
                                            var valueHere=data.id;
                                             return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button>';
                                      }
                                    }
                                ]
                            });
                        });
           }
       });
      
                
        });

</script>


@endsection