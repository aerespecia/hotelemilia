@extends('layouts.frontdeskLayout')

@section('content')
 
<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
               <li><a href="{{route('frontdesk.guestFolio')}}"><i class="icon-note"></i><span>Guest Folio</span></a></li>
                <li><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>Night Audit</span></a></li>
                <li><a href="{{route('frontdesk.amendments')}}"><i class="icon-note"></i><span>Amendments</span></a></li>
                <li class="nav-active active"><a href="{{route('frontdesk.roomissue')}}"><i class="icon-note"></i><span>Issues</span></a></li>
              </ul>
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN USER DROPDOWN -->
               
          
           
              
            
              
              <!-- END USER DROPDOWN -->
              <!-- BEGIN NOTIFICATION DROPDOWN -->
            
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN MESSAGES DROPDOWN -->
              
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="{{url('assets/global/images/avatars/avatar11_big.png')}}" alt="user image">
                <span class="username">Hi, {{$user->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <a href="{{url('/logout')}}"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
             
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content p-l-40 p-r-40 p-t-10">
            
            
            <hr class="m-t-5 c-red"/>
          <div class="header">
            <h2><strong>Issue Status</strong></h2>
          </div>
          <div class="header">
          <hr class="m-b-0"/>
          </div>
          
      <div class="header">

        <h2><strong>Room Status</strong></h2>
        <hr class="m-b-0"/>
    </div>
     <div class="panel panel-transparent p-t-5 bd-6 p-b-10 m-l-20 m-r-20" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                  <div class="panel-header">
                  <h3 class="m-b-0">ROOM STATUS CODES:</h3>
                  </div>
                    <div class="panel-content">
                            <div class="row">
                                 <div class="col-md-12">
                            <div class="col-md-6">
                                <h5><span class="bg-green p-5 bd-6">&nbsp;&nbsp;&nbsp;&nbsp;</span> - No Issue</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><span class="bg-red p-5 bd-6">&nbsp;&nbsp;&nbsp;&nbsp;</span> - w/ Issue</h5>
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
                          <li><a href="#tab3_0" data-toggle="tab"><i class="icon-home"></i> All Floor</a></li>
                          
                        </ul>
                        <div class="tab-content">
                         
                          <div class="tab-pane fade active in" id="tab3_0">
                            @foreach($roomsAll as $r)
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
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View Room Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW ROOM INFORMATIONS</strong></h2><hr/>
                    </div>
                        <ul class="nav nav-tabs nav-primary">
                        <li class="active tabsRoomLi" id="firstTabLi"><a href="#tab2_1" data-toggle="tab" class="tabsRooms"><i class="icon-home"></i>Issue Room Report</a></li>
                        <li class="tabsRoomLi"><a href="#tab2_2" data-toggle="tab" class="tabsRooms"><i class="icon-user"></i> Room Issues </a></li>
                        
                        </ul>
                    
                        <div class="panel-content">
                        <div class="tab-content">
                         <div class="tab-pane fade active in tabsRoomPane" id="tab2_1"> 
                            <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <input type="hidden" id="roomId" name="roomId" value="">
                                
                                <input type="hidden" id="type" name="type" value="">
                                <input type="hidden" id="from_status" name="from_status" value="">
                                <input type="hidden" id="to_status" name="to_status" value="">
                                <input type="hidden" id="cleanStatus" name="cleanStatus" value="">
                                <input type="hidden" id="currStatus" name="currStatus" value="">

                              <label class="control-label">Type</label>
                                <select id="typeIssue" name="typeIssue" class="form-control">
                                  <option value="0">Type of Issue</option>
                                  <option value="1">Lost And Found Items</option>
                                  <option value="2">Lost Of Hotel Items</option>
                                  <option value="3">Broken Items</option>
                                  <option value="10">Lost Items</option>
                                  <option value="100">Others</option>
                                </select>
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


                    
                   

                       

                        <div class="tab-pane fade tabsRoomPane" id="tab2_2">
                          
                              <div class="panel-content">
                          <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <table id="issuesTables" class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>Issued By</th>
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

                                        <div class="col-sm-6">
                                          <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                                          <div class="form-group">
                                            <img src="" id="previewImage" name="previewImage" style="width:100%">
                                          </div>
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
                </div>
              </div>
            </div>
          </div>
            
        </div>

        <script>
        var currClass = "";
        var currButton;
        var guestReservID;
        

        $(".roomstatusChange").click(function() {     
            guestReservID = $(this).attr('data-value');
           $("#previewImage").attr("src","");
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
                ajax: 'dataTablesHousekeepingHistoryRoom/'+guestReservID,
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
                ajax: 'dataTablesRoomIssuesHousekeeping/'+guestReservID,
                lengthMenu: [
                    [ 5, 10, 25, 50, -1 ],
                    [ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                
                columns: [
                  
                { data: 'cleanerNames', name: 'cleanerNames'},
                  { data: 'type', name: 'type'},
                  { data: 'notes', name: 'notes'},
                  {
                    "className":      'optionss',                    
                    "data":           null,
                    "render": function(data, type, full, meta){
                          var valueHere=data.id;
                           return '<button type="button" class="btn-sm btn-default btn-hg btn-transparent edit-modal updateIssueButton" id="edit-modal" data-value="0" value="'+valueHere+'">Solve</button><button type="button" data-toggle="modal" class="btn-sm btn-default btn-hg btn-transparent" data-value="1" value="'+valueHere+'">View Photos</button>';
                    }
                  }
                ],
                
            });

            
        

            $.get("roomInfo/"+guestReservID,function(data){
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
                $("#description").text('PREPARED');
                $("#type").val(1);
                $("#cleanStatus").val(2);
                if($("#from_status").val()==2)
                  $("#to_status").val(0);
                
              }
              else if(id==2){
                $("#description").text('CLEANED');
                $("#cleanStatus").val(2);
                $("#to_status").val('');
                $("#type").val(2);
              }
              else if(id==3){
                $("#description").text('REPAIRED');
                $("#cleanStatus").val(2);
                $("#type").val(3);
                alert($("#from_status").val());
                if($("#from_status").val()==2 || $("#from_status").val()==4)
                  $("#to_status").val(0);
                
              }
              else if(id==4){
                $("#description").text('OUT OF ORDER');
                $("#cleanStatus").val(3);
                $("#to_status").val(4);
                $("#type").val(4);
              }

              alert($("#cleanStatus").val());
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
                   url: "{{route('frontdesk.roomStatusSaves')}}",
                   data: roomInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    //alert(datas);
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
            if(actionId=="0")
            {
              var issueInfo = {
                  'cleanerId': $("#cleanerId").val(),
                  'actionId':actionId,
                  'id':id,
                };

              $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.issueStatusSaves')}}",
                   data: issueInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    //alert(datas);
                        $('#issuesTables').DataTable({
                            processing: true,
                            serverSide: false,
                            "bDestroy": true,
                            ajax: 'dataTablesRoomIssuesHousekeeping/'+guestReservID,
                            lengthMenu: [
                                [ 5, 10, 25, 50, -1 ],
                                [ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
                            ],
                            "scrollx":false,
                            columns: [
                              { data: 'cleanerNames', name: 'cleanerNames'},
                              { data: 'type', name: 'type'},
                              { data: 'notes', name: 'notes'},
                              {
                                "className":      'optionss',
                                "data":           null,
                                "render": function(data, type, full, meta){
                                      var valueHere=data.id;
                                       return '<button type="button" class="btn-sm btn-default btn-hg btn-transparent edit-modal updateIssueButton" id="edit-modal" data-value="0" value="'+valueHere+'">Solve</button><button type="button" data-toggle="modal" class="btn-sm btn-default btn-hg btn-transparent" value="'+valueHere+'">View Photos</button>';
                                }
                              }
                            ],
                            
                        });
                   }
               });
            }
            else if(actionId=="1")
            {

              var issueInfo = {
                  'id':id,
                };

              $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.retrievePhotos')}}",
                   data: issueInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    alert(datas);
                        //var rawData = btoa(unescape(encodeURIComponent(datas)));
                        var imagePath = "{{ url('frontdesk/images') }}/"+datas;
                        $("#previewImage").attr("src",imagePath);
                       
                        //document.getElementById('previewImage').setAttribute( 'src', 'data:image/jpeg;base64,'+rawData );
                   }
               });

            }

            
            

            //alert(id);
              

              
                
              
              
              
  
          });


        </script>

@endsection