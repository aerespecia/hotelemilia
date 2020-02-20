@extends('layouts.housekeepingLayout')
@section('content')
 
<div class="main-content m-t-0 p-t-0">
    <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    
    <div class="panel-content bg-white">
      <div class="header">

        <h2><strong>Room Status</strong></h2>
        <hr class="m-b-0"/>
    </div>
     <div class="panel panel-transparent p-t-5 bd-6 p-b-10 m-l-20 m-r-20" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                  <div class="panel-header">
                  <h3 class="m-b-0"><strong>ROOM STATUS CODES:</strong></h3>
                  </div>
                    <div class="panel-content">
                            <div class="row">
                                 <div class="col-md-12">
                            <div class="col-md-3">
                                <h5><span class="bg-orange p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">&nbsp;&nbsp;&nbsp;&nbsp;</span> - <strong>VACANT DIRTY</strong></h5>
                            </div>
                            <div class="col-md-3">
                                  <h5><span class="bg-green p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">&nbsp;&nbsp;&nbsp;&nbsp;</span> - <strong>VACANT CLEANED</strong></h5>
                            </div>
                            <div class="col-md-3">
                              <h5><span class="bg-red p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">&nbsp;&nbsp;&nbsp;&nbsp;</span> - <strong>OCCUPIED</strong></h5>
                                
                            </div>
                            <div class="col-md-3">
                                <h5><span class="bg-white p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">&nbsp;&nbsp;&nbsp;&nbsp;</span> - <strong>OUT OF ORDER</strong></h5>
                            </div>
                            
                            </div>
                        </div> 
                    </div>
              </div>
    <div class="wizard-div current wizard-simple">
      <div class="row">
        <div class="panel-content">
                      <div class="tab_left">
                        <ul  class="nav nav-tabs nav-red">
                          
                          <li><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> 2nd Floor</a></li>
                          <li><a href="#tab3_2" data-toggle="tab"><i class="icon-home"></i> 3rd Floor</a></li>
                          <li><a href="#tab3_3" data-toggle="tab"><i class="icon-home"></i> 4th Floor</a></li>
                        </ul>
                        <div class="tab-content">
                         
                          <div class="tab-pane fade active in" id="tab3_1">
                            @foreach($rooms2 as $r)
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="button" data-toggle="modal" data-test="{{$r->cleanStatus}}" data-target="#modal-guest-edit" class="btn btn-hg btn-block {{$r->cleanStatus}} edit-modal roomstatusChange" id="edit-modal" onlick="buttonAppear()" data-value="{{$r->id}}" value="{{$r->id}} ">{{$r->roomName}} </button>
                                    </div>
                                  </div>
                            @endforeach 
                          </div>
                          <div class="tab-pane fade" id="tab3_2">
                            @foreach($rooms3 as $r)
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="button" data-toggle="modal" data-test="{{$r->cleanStatus}}" data-target="#modal-guest-edit" class="btn btn-hg btn-block {{$r->cleanStatus}} edit-modal roomstatusChange" id="edit-modal" onlick="buttonAppear()" data-value="{{$r->id}}" value="{{$r->id}} ">{{$r->roomName}} </button>
                                    </div>
                                  </div>
                            @endforeach 
                          </div>
                          <div class="tab-pane fade" id="tab3_3">
                            @foreach($rooms4 as $r)
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="button" data-toggle="modal" data-test="{{$r->cleanStatus}}" data-target="#modal-guest-edit" class="btn btn-hg btn-block {{$r->cleanStatus}} edit-modal roomstatusChange" id="edit-modal" onlick="buttonAppear()" data-value="{{$r->id}}" value="{{$r->id}} ">{{$r->roomName}} </button>
                                    </div>
                                  </div>
                            @endforeach 
                          </div>
                        </div>
                      </div>
                    </div>
      </div>
      <div class="row">
      <div class="col-lg-12">
      
         
      </div>
      
      </div>
    </div>
      </div>
        
      
    

             

<div class="modal fade modal" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View Room Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    {!! Form::open(['method'=>'POST','files'=>'true','action'=>'HousekeepingController@roomStatusSaves','name'=>'formregis','id'=>'HousekeepingController']) !!}
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW ROOM INFORMATIONS</strong></h2><hr/>
                    </div>
                        <ul class="nav nav-tabs nav-primary">
                        <li class="active tabsRoomLi tabsMenu" data-value="1" id="firstTabLi"><a href="#tab2_1" data-toggle="tab" class="tabsRooms"><i class="icon-home"></i> Room Status</a></li>
                        <li class="tabsRoomLi tabsMenu" data-value="1"><a href="#tab2_2" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> History</a></li>
                        <li class="tabsRoomLi tabsMenu" data-value="2"><a href="#tab2_3" data-toggle="tab" class="tabsRooms"><i class="icon-notebook"></i>Issue Room Report</a></li>
                        <li class="tabsRoomLi tabsMenu" data-value="1"><a href="#tab2_4" data-toggle="tab" class="tabsRooms"><i class="fa fa-warning"></i>Room Issues <span id="cuurRoomIssue" class=""></span></a></li>
                        <li class="tabsRoomLi tabsMenu" data-value="3"><a href="#tab2_5" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> Replenish Items</a></li>
                        </ul>
                    
                        <div class="panel-content">
                        <div class="tab-content">
                         <div class="tab-pane fade active in tabsRoomPane" id="tab2_1"> 
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Room Name</label>
                                <input type="hidden" id="roomId" name="roomId" value="">
                                <input type="hidden" id="cleanerId" name="cleanerId" value="{{$user->id}}">
                                <input type="hidden" class="nonIssue" id="type" name="type" value="">
                                <input type="hidden" class="nonIssue" id="from_status" name="from_status" value="">
                                <input type="hidden" class="nonIssue" id="to_status" name="to_status" value="">
                                <input type="hidden" class="nonIssue" id="cleanStatus" name="cleanStatus" value="">
                                <input type="hidden" class="nonIssue" id="currStatus" name="currStatus" value="">
                                <input type="text" name="roomNamePopout" id="roomNamePopout" class="form-control" placeholder="Enter First Name..." minlength="3" value="" readonly>
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Type</label>
                                <input type="text" name="typePopout" id="typePopout" class="nonIssue form-control" placeholder="Enter Middle Name..." minlength="3"  readonly>
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Status</label>
                             
                                <input type="text" name="statusPopout" id="statusPopout" class="nonIssue form-control" placeholder="Enter Last Name..." minlength="3"  readonly>
                             
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Notes</label>
                              <textarea id="currhouseNotes" name="currhouseNotes" rows="3" class="nonIssue form-control" placeholder="No notes attached..." readonly></textarea>
                            </div>
                          </div>
                        </div>

                        </div>
                        
                    </div>

                    
                  </div>
                  <div class="row">
                    <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <center>
                                <h1 class="alert bg-primary"><STRONG name="description" id="description">&nbsp;</STRONG></h1>
                                                       
                              </center>
                            </div>
                          </div>
                          
                        </div>
                        <hr/>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-hg btn-block bg-green btn-embossed guest-edit-save changeStatus" data-value="1"> Vacant Clean </button>
                            </div>
                          </div>
                          
                          <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-hg btn-block bg-orange btn-embossed guest-edit-save changeStatus" data-value="2"> Vacant Dirty </button>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-hg btn-block bg-red btn-embossed guest-edit-save changeStatus" data-value="3"> Occupied </button>
                            </div>
                          </div>

                          
                          <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-hg btn-block bg-white btn-embossed guest-edit-save changeStatus" data-value="4"> Out of Order</button>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Notes</label>
                              <textarea id="houseNotes" name="houseNotes" rows="6" class="nonIssue form-control" placeholder="Additional Notes Here..."></textarea>
                            </div>
                          </div>
                        </div>
                        </div>
                  </div>

                  </div>


                    
                    <div class="tab-pane fade tabsRoomPane" id="tab2_2">
                    <div class="panel-content">
                          <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <table id="users-table" class="table table-striped">
                <thead>
                    <tr>
                    <th>Cleaner</th>
                    <th>Housekeeping Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date and Time</th>
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
                        <div class="tab-pane fade tabsRoomPane" id="tab2_3">
                            <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Type</label>
                                <select id="typeIssue" name="typeIssue" class="form-control">
                                  <option value="0">Type of Issue</option>
                                  <option value="1">Lost And Found Items</option>
                                  <option value="2">Lost Of Hotel Items</option>
                                  <option value="3">Broken Items</option>
                                  <option value="100">Others</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              {{ Form::label('file','',array('id'=>'','class'=>'control-label')) }}
                              <input type="file" name="files" id="files", class="form-control">
                              
                             </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="control-label">Issue Description</label>
                              <textarea id="issueNotes" name="issueNotes" rows="5" class="form-control" placeholder="Issue Description..."></textarea>
                            </div>
                          </div>
                        </div>

                        </div>



                        </div>

                        <div class="tab-pane fade tabsRoomPane" id="tab2_4">
                          <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                              <div class="panel-content">
                          <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <table id="issuesTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>Issue</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @push('scripts')
                                        <script>
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


                        <div class="tab-pane fade tabsRoomPane" id="tab2_5" >
                            <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                       <div class="row">
                          <div class="col-sm-6">
                            <table id="roomItems" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                        
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @push('scripts')
                                        <script>
                                        </script>
                                        @endpush
                                      </tbody>
                                </table>
                          </div>
                          <div class="col-sm-6">
                            <h2><strong>Available Items</strong></h2>
                            <input type="hidden" id="replenishReport" name="replenishReport" value="0">
                            <div class="form-group" style="height:300px; overflow-y: scroll; overflow-x: hidden;">
                              <span id="addAvailableItems">
                                
                              </span>
                              
                            </div>
                          </div>
                        </div>

                        </div>



                        </div>

                        </div>
                    </div>
                  

                    
                    
                  <br/>
                  <br/>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                    <button type="button" class="btn btn-success btn-embossed guest-edit-save" data-dismiss="modal" id="saveRoom" value=""> SAVE</button>
                    <button type="submit" class="btn btn-success btn-embossed guest-edit-save" id="saveRoomSubmit" style="display:none">ISSUE CASUALTIES REPORT</button>
                    <button type="submit" class="btn btn-success btn-embossed guest-edit-save" id="saveRoomReplenishSubmit" style="display:none">ISSUE REPLENISH REPORT</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
            
        </div>

        <script>
        var currClass = "";
        var currButton;
        var guestReservID;
        $( document ).ready(function() {
        $('#roomItems').DataTable({
                processing: true,
                serverSide: false,
                sScrollY: "300px",
                sScrollX: "100%",
                sScrollXInner: "150%",
                bSort: false,
                bInfo: false,
                bPaginate: false,
                ajax: 'housekeeping/dataTablesRoomCheckListItems',
                columns: [
                  { data: 'name', name: 'name'},
                  { data: 'category', name: 'category'},
                  {
                    "className":      'optionss',
                    "data":           null,
                    "render": function(data, type, full, meta){
                          var valueHere=data.id+"#"+data.name;
                           return '<button type="button" data-toggle="modal" class="btn-sm btn-default btn-hg btn-transparent edit-modal updateIssueButton" id="edit-modal" data-value="0" value="'+valueHere+'"><strong>Add Item</strong></button>';
                    }
                  }
                ],
                
            });
      });
      var roomAddedItems = [];
      $('#roomItems tbody').on( 'click', 'button', function () {        
            var guestReservID = this.value;
            var infoGuest = guestReservID.split('#');
            if(roomAddedItems.indexOf(guestReservID)==-1)
            {
              roomAddedItems.push(guestReservID)
              var htmlNumeric = "<div class='row'>"+
                                  "<div class='col-sm-10'>"+
                                  "<label class='form-label'><strong>"+infoGuest[1]+"</strong></label></div></div>"+
                                    "<div class='row'>  <div class='col-sm-2'><button data-action='1' data-id='"+infoGuest[0]+"' class='btn btn-primary roomItemButton' onclick='roomItemClick(this)' type='button'><strong>-</strong></button></div><div class='col-sm-7'><input type='text' name='roomItemInventory["+infoGuest[0]+"]' id='roomItemInventory-"+infoGuest[0]+"' value='1' readonly data-btn-before='primary' data-btn-after='danger' data-step='1' class='form-control' style='display: block;'></div><div class='col-sm-2'><button class='btn btn-danger roomItemButton' data-id='"+infoGuest[0]+"' data-action='2' onclick='roomItemClick(this)' type='button'><strong>+</strong></button></div></div>";
              $('#addAvailableItems').append(htmlNumeric);
            }
            
            
      });

      /*
      data-action:
      1-minus
      2-add

      data-id:
      id of input box

      roomItemInventory[
      */
      function roomItemClick(x){
        var datatype = $(x).attr('data-action');
        var dataId = $(x).attr('data-id');

        var inputBox = "#roomItemInventory-"+dataId;
        var currentVal = $(inputBox).val();

        if(datatype==1)
        {
          if(currentVal>0)
            currentVal--;

          $(inputBox).val(currentVal)
        }
        if(datatype==2)
        {
          currentVal++;
          $(inputBox).val(currentVal)
        }
          
      }

        
        
        $('.tabsMenu').click(function() {     
            var tabType = $(this).attr('data-value');
            if(tabType==1)
            {
              $('#saveRoom').show();
              $('#saveRoomSubmit').hide();
              $('#saveRoomReplenishSubmit').hide();
              $('#replenishReport').val('0');
              $(".nonIssue").prop('disabled', false);  //Enable input 
            }
              
            else if(tabType==2)
            {
              $('#saveRoomSubmit').show();
              $('#saveRoom').hide();
              $('#saveRoomReplenishSubmit').hide();
              $('#replenishReport').val('0');
              $(".nonIssue").prop('disabled', true);   //Disable input
            }
            else if(tabType==3)
            {
              $('#saveRoomReplenishSubmit').show();
              $('#saveRoom').hide();
              $('#saveRoomSubmit').hide();
              $('#replenishReport').val('1');
              $(".nonIssue").prop('disabled', false);   //Disable input
            }
            //$('.saveRoom').

        });

        
        $(".roomstatusChange").click(function() {     
            guestReservID = $(this).attr('data-value');
           
            $("#from_status").val('')
            $("#roomId").val('')
            $("#houseNotes").val('');
            $("#to_status").val('');
            $("#cleanStatus").val('');
            $("#houseNotes").val('');
            $('#issueNotes').val('');
            $('#typeIssue').val(0).change();
            
            $('.tabsRoomLi').removeClass('active');
            $('#firstTabLi').addClass('active');

            $('.tabsRoomPane').removeClass('active in');
            $('#tab2_1').addClass('active in');
            
            //$(currButton).addClass(datas);
            $("#cuurRoomIssue").html('');
            $('#cuurRoomIssue').removeClass('badge badge-danger');  


            currButton = $(this);
            currClass = $(this).attr('data-test');
            
            $('#users-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: 'housekeeping/dataTablesHousekeepingHistoryRoom/'+guestReservID,
                lengthMenu: [
                    [ 5, 10, 25, 50, -1 ],
                    [ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
               
                
                
                columns: [
                    
                { data: 'cleanerName', name: 'cleanerName'},
                    { data: 'type', name: 'type'},
                    { data: 'from_status', name: 'from_status'},
                    { data: 'to_status', name: 'to_status'},
                    { data: 'created_at', name: 'created_at' },
                ],
                
            });

            $('#issuesTables').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax: 'housekeeping/dataTablesRoomIssuesHousekeeping/'+guestReservID,
                lengthMenu: [
                    [ 5, 10, 25, 50, -1 ],
                    [ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                
                columns: [
                
                  { data: 'type', name: 'type', width:'33.3%'},
                  { data: 'notes', name: 'notes', width:'33.3%'},
                  {
                    "className":      'optionss',
                    width:'33.3%',
                    "data":           null,
                    "render": function(data, type, full, meta){
                          var valueHere=data.id;
                           return '<button type="button" data-toggle="modal" class="btn-sm btn-default btn-hg btn-transparent edit-modal updateIssueButton" id="edit-modal" data-value="0" value="'+valueHere+'">Solve</button>';
                    }
                  }
                ],
                
            });
            


            
        

            $.get("housekeeping/roomInfo/"+guestReservID,function(data){
                    console.log(data);
                    //$(".title-name").html(data.firstName+" "+data.familyName);
                    $("#roomId").val(data[0].id);
                    $("#roomNamePopout").val(data[0].roomName);
                    $("#statusPopout").val(data[0].status);
                    $("#typePopout").val(data[0].type);

                    
                    $("#from_status").val(data[0].fromStatus);

                    $("#currhouseNotes").val(data[0].roomNotes);

                    


                    $(".guest-edit-save").val(data[0].id);
                    $(".guest-edit-close").val(data[0].id);
                    $("#description").html('&nbsp;');
                    
                    if(data[0].countIssues>0)
                    {
                      $("#cuurRoomIssue").html(data[0].countIssues);
                      $('#cuurRoomIssue').addClass('badge badge-danger');  
                    }
                    
                    
                    
                    if(data.account_id)
                        $("#account-id").html(data.account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });

    });
        
        //var guestReservID = this.value.split("#");
        
         $(".changeStatus").click(function() {
              var id = $(this).attr('data-value');
              if(id==1){
                $("#description").text('Vacant Clean');
                $("#type").val(1);
                $("#cleanStatus").val(2);
                $("#to_status").val(0);
              }
              else if(id==2){
                $("#description").text('Vacant Dirty');
                $("#cleanStatus").val(1);
                $("#to_status").val(2);
                $("#type").val(4);
              }
              else if(id==3){
                $("#description").text('Occupied');
                $("#cleanStatus").val(3);
                $("#to_status").val(1);
                $("#type").val(4);
              }
              else if(id==4){
                $("#description").text('OUT OF ORDER');
                $("#cleanStatus").val(4);
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
                  'to_status': $("#to_status").val(),
                  'cleanStatus': $("#cleanStatus").val(),
                  'roomNotes': $("#houseNotes").val(),
                  'typeIssue': $("#typeIssue").val(),
                  'issueNotes': $("#issueNotes").val(),
                  
                };


              $.ajax({
                   type:"POST",
                   url: "{{route('housekeeping.roomStatusSaves')}}",
                   data: roomInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    
                        $("#modal-guest-edit").fadeOut(300, function(){
                          if(datas != ''){
                            $(currButton).removeClass(currClass);
                            $(currButton).addClass(datas);
                          }
                            

                        });
                   }
               });


      });
      ///$(".updateIssueButton").click(function() {

          $('#issuesTables tbody').on( 'click', 'button', function () {      
          
            var actionId = $(this).attr('data-value');
            var id = $(this).attr('value');
            

            
              var issueInfo = {
                  'cleanerId': $("#cleanerId").val(),
                  'actionId':actionId,
                  'id':id,
                };

              
                
              
              $.ajax({
                   type:"POST",
                   url: "{{route('housekeeping.issueStatusSaves')}}",
                   data: issueInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    
                        $('#issuesTables').DataTable({
                            processing: true,
                            serverSide: false,
                            "bDestroy": true,
                            ajax: 'housekeeping/dataTablesRoomIssuesHousekeeping/'+guestReservID,
                            lengthMenu: [
                                [ 5, 10, 25, 50, -1 ],
                                [ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                            ],
                            "scrollx":false,
                            columns: [
                            
                            { data: 'type', name: 'type'},
                              { data: 'notes', name: 'notes'},
                              {
                                "className":      'optionss',
                                "data":           null,
                                "render": function(data, type, full, meta){
                                      var valueHere=data.id;
                                       return '<button type="button" data-toggle="modal" class="btn-sm btn-default btn-hg btn-transparent edit-modal updateIssueButton" id="edit-modal" data-value="0" value="'+valueHere+'">Solve</button>';
                                }
                              }
                            ],
                            
                        });
                   }
               });
              
  
          });


        </script>

        
@endsection