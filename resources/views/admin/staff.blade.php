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


<div class="main-content m-t-0 p-t-0">

<div class="page-content">
          <div class="header">

              <h2><strong>Staff Management</strong></h2>
          <hr class="m-b-0"/>
          </div>
              <div class="row">
            <div class="col-lg-12">
          
                   
          <div class="wizard-div current wizard-simple">
                      
                      {!! Form::open(['method'=>'POST','action'=>'AdminController@store','name'=>'formregis','id'=>'AdminController','class'=>'wizard','data-style'=>'simple']) !!}
                        
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
                              <label>First Name</label>
                              <div class="append-icon">
                                <input type="hidden" name="idUser" id="idUser" value="">
                                <input type="hidden" name="updateMe" id="updateMe" value="">
                                <input type="text" name="fname" id="fname" class="form-control" minlength="3" placeholder="Enter firstname..." autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Middle Name</label>
                              <div class="append-icon">
                                <input type="text" name="mname" id="mname" class="form-control" minlength="4" placeholder="Enter Middlename..." autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Last Name</label>
                              <div class="append-icon">
                                <input type="text" name="lname" id="lname" class="form-control" minlength="4" placeholder="Enter Lastname..." autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" minlength="4" placeholder="Enter Address..." autocomplete="off">
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Email</label>
                              
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" autocomplete="off">
                               
                            </div>
                            </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Position</label>
                              
                                <select id="position" name="position" class="form-control" data-style="white" data-placeholder="Select Account Type...">
                                    <option value="0">Select Account Type</option>
                                    <option value="frontdesk">Frontdesk</option>
                                    <option value="admin">Administrator</option>
                                    <option value="3">Housekeeping</option> 
                                </select>
                               
                            </div>
                            </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Contact No.</label>
                              <div class="append-icon">
                                <input type="text" name="contactno" id="contactno" class="form-control" placeholder="Enter Contact No." autocomplete="off">
                                <i class="fa fa-mobile"></i>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                                <label>Shifts</label>
                              <div class="append-icon">
                                <select id="shiftId" name="shiftId" class="form-control" data-style="white" data-placeholder="Select Account Type...">
                                  <option value="0">Select Shifts</option>
                                    @foreach($shifts as $r)          
                                      <option value="{{$r->id}}">{{$r->name}} - {{$r->shiftTime}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Username</label>
                              
                                <input type="text" name="username" id="username" class="form-control" minlength="4" placeholder="Enter Username..." autocomplete="off">
                               
                            </div>
                            </div>
                          <div class="col-sm-6">
              
                            <div class="form-group">
                                <label>Password</label>
                              <div class="append-icon">
                                <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password..." autocomplete="off">
                                <i class="fa fa-mobile"></i>
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