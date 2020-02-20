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
                      
                      {!! Form::open(['method'=>'POST','action'=>'AdminController@discountManage','name'=>'formregis','id'=>'AdminController','class'=>'wizard','data-style'=>'simple']) !!}
                        
                          <div class="row">
                              <div class="col-md-12">
                              <div class="panel">
                <div class="panel-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   
                      <h4><strong>MANAGE DISCOUNT</strong></h4>
                             <hr/>




                      <div class="row">
               
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Name</label>
                              <div class="append-icon">
                                <input type="hidden" name="idUser" id="idUser" value="">
                                <input type="hidden" name="updateMe" id="updateMe" value="">
                                <input type="text" name="name" id="name" class="form-control" minlength="3" placeholder="Enter Name..." autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Type</label>
                              <div class="option-group">
                                <select id="type" name="type" style="width:100%;">
                                  <option value="0" selected>Status</option>
                                  <option value="1">Percentage</option>
                                  <option value="2">Amount</option>
                                
                                </select>
                              </div>


                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Discount Value</label>
                              <div class="prepend-icon">
                              <input type="text" name="discountValue" id="discountValue" class="form-control" minlength="3" placeholder="Enter Value..." autocomplete="off">
                            </div>
                            </div>
                          </div>                                              
                      </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <button type="submit" class="btn btn-hg btn-primary">Save</button>
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
</div>

<hr class="m-b-0"/> 

          <div class="header">
            <h2><strong>Discount List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="discount-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Value</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#discount-table').DataTable({
        processing: false,
        serverSide: false,
        "bDestroy": true,
        ajax: '{!! route('admin.dataTablesDiscountsList') !!}',
        dom: 'Bfrtip',
        buttons: [
          'print'
        ],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'type', name: 'type' },
            { data: 'discountValue' , name: 'discountValue' },
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
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Name</label>
                                <input type="text" name="names" id="names" class="form-control" placeholder="Enter First Name..." value="" readonly>
                            </div>
                          </div>
                          
                           <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Type</label>
                                <select id="types" name="types" style="width:100%;">
                                  <option value="1" selected>Percentage</option>
                                  <option value="2">Amount</option>
                                </select>
                            </div>
                          </div>


                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Value</label>
                                <input type="text" name="value" id="value" class="form-control" placeholder="Enter First Name..." value="">
                            </div>
                          </div>


                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">Status</label>
                                <select id="status" name="status" style="width:100%;">
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
$('#discount-table tbody').on( 'click', 'button', function () {    

          var guestReservID = this.value;
              $.get("../admin/discountViewRegistration/"+guestReservID,function(data){
                    console.log(data);

                    $("#names").val(data[0].name);
                    $("#types").val(data[0].type).change();
                    $("#value").val(data[0].discountValue);
                    $("#status").val(data[0].status).change();
                    
                    
                    
                    $(".guest-edit-save").val(data[0].id);
                    $(".guest-edit-close").val(data[0].id);
                    
                    if(data[0].account_id)
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
          'names':$("#names").val(),
          'types':$("#types").val(),
          'value':$("#value").val(),
          'status':$("#status").val(),

        };
                
      $.ajax({
           type:"POST",
           url: "{{route('admin.deleteDiscountAjax')}}",
           data: discountInfo,
           headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
           success: function (datas){
            //alert(datas);
              $("#modal-guest-edit").fadeOut(300, function(){

                        });

              $(function() {
                  $('#discount-table').DataTable({
                      processing: false,
                      serverSide: false,
                      "bDestroy": true,
                      ajax: '{!! route('admin.dataTablesDiscountsList') !!}',
                      dom: 'Bfrtip',
                      buttons: [
                        'print'
                      ],
                      columns: [
                          { data: 'name', name: 'name' },
                          { data: 'type', name: 'type' },
                          { data: 'discountValue' , name: 'discountValue' },
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