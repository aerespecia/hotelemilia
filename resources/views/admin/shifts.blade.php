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

              <h2><strong>Staff Management</strong></h2>
          <hr class="m-b-0"/>
          </div>
              <div class="row">
            <div class="col-lg-12">
          
                   
          <div class="wizard-div current wizard-simple">
                      
                      {!! Form::open(['method'=>'POST','action'=>'AdminController@shiftsManage','name'=>'formregis','id'=>'AdminController','class'=>'wizard','data-style'=>'simple']) !!}
                        
                          <div class="row">
                              <div class="col-md-12">
                              <div class="panel">
                <div class="panel-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   
                      <h4><strong>MANAGE STAFF</strong></h4>
                             <hr/>

                             <div class="row">
                           <div class="col-sm-12">
              
                            <div class="form-group">
                              
                              <div class="prepend-icon">

                                <input id="userSearch" name="userSearch" class="form-control sm" placeholder="Search ...." minlength="3" autocomplete="on">
                                <i class="fa fa-search"></i>
                              </div>
                            </div>
                          </div>
                            
                        </div>



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
                              <label>Time</label>
                              <div class="prepend-icon">
                              <input type="text" name="timeIn" value="12:00pm" class="timepicker form-control" placeholder="Choose a time...">
                              <i class="icon-clock"></i>
                            </div>
                            </div>

                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Status</label>
                              <div class="option-group">
                                <select id="status" name="status" style="width:100%;">
                                  <option value="0" selected>Status</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                
                                </select>
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
            <h2><strong>Staff List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Username</th>
                <th>Position</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Contact No.</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: '{!! route('admin.dataTablesUsersList') !!}',
        dom: 'Bfrtip',
        buttons: [
          'print'
        ],
        columns: [
            { data: 'username', name: 'username' },
            { data: 'Position', name: 'Position' },
            { data: 'email' , name: 'email' },
            { data: 'name', name: 'name' },
            { data: 'address', name: 'address' },
            { data: 'contactNo', name: 'contactNo' },
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


</div>





@endsection