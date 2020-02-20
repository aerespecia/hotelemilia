@extends('layouts.adminLayout')



@section('content')
 
 


<div class="main-content m-t-0 p-t-0">
        <!-- BEGIN TOPBAR -->
        
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin page-calendar">
                    
          <div class="header">

              <h2><strong>Q CITIPARK</strong> DASHBOARD</h2>
              
          <hr class="m-b-0"/>
          </div>
            <div class="row">
            <div class="col-md-12 p-0 no-bd">
                  <div class="widget">
                    <div class="widget-body">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="fullcalendar"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           <div class="row">
            <div class="col-sm-5">
              <h3><strong>New Guest</strong> Check In</h3>
              <p>No. of New Guests that Check-in within a year.
              </p>
              <canvas id="chartNewGuestCheckIn"  class="full" height="140"></canvas>
              
            </div>

            <div class="col-sm-2">
              
              
            </div>


            <div class="col-sm-5 align-right">
              <h3><strong>Guest</strong> Check In</h3>
              <p>No of Guest(Old and New) that Check-in within a year.
              </p>
              <canvas id="chartNewGuestReservationCheckIn"  class="full" height="140"></canvas>
              
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <h3><strong>Room Type</strong> Check In</h3>
              <p>No. of Reservation per room type per day
              </p>
              <!----<canvas id="chartNewGuestCheckIn"  class="full" height="140"></canvas>-->
              <div id="container" style="height: 400px; min-width: 310px"></div>
            </div>
          </div>

          

<div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>View Reservation Information: </strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    
                    <div class="row"><br/>
                        <h2 align="center"><strong>VIEW RESERVATION INFORMATIONS</strong></h2><hr/>
                    </div>
                    
                    <div class="row"><br/>
                        <h3><strong>CLIENT, INSTITUTION AND TRANSACTION INFORMATIONS</strong></h3>
                    </div>
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                          <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Client Name</label>
                                <input readonly type="text" name="clientName" id="clientName" class="form-control" placeholder="No Value" minlength="3" value="" >
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Contact No.</label>
                                <input readonly type="text" name="clientContactNo" id="clientContactNo" class="form-control" placeholder="No Value" minlength="3" >
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Email</label>
                                <input readonly type="text" name="clientEmail" id="clientEmail" class="form-control" placeholder="No Value" minlength="3" >
                            </div>
                          </div>


                          </div>
                        </div>
                      </div>
          <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">

                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Institution Name</label>
                                <input readonly type="text" name="instiName" id="instiName" class="form-control" placeholder="No Value" minlength="3" value="" >
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Contact No.</label>
                                <input readonly type="text" name="instiContactNo" id="instiContactNo" class="form-control" placeholder="No Value" minlength="3" >
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Email</label>
                                <input readonly type="text" name="instiEmail" id="instiEmail" class="form-control" placeholder="No Value" minlength="3" >
                            </div>
                          </div>


                        </div>
                      </div>
                      <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">



                        <div class="row">


                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Code</label>
                                <input readonly type="text" name="transactionCode" id="transactionCode" class="form-control" placeholder="No Value" minlength="3" >
                            </div>
                          </div>

                            
                            <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Status</label>
                              <select disabled id="transactionStatus" name="transactionStatus" class="form-control" >
                                  <option value="0" selected>Ongoing</option>
                                  <option value="1">Billed</option>
                              </select>
                            </div>
                          </div>


                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Guaranteed To</label>
                              <select disabled id="guaranteed" name="guaranteed" class="form-control" >
                                  <option value="1" selected>Yes</option>
                                  <option value="2">No</option>
                              </select>
                            </div>
                          </div>



                          </div>
                        


                         <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Charge Type</label>
                              <select disabled id="chargeType" name="chargeType" class="form-control" >
                                  <option value="1" selected>Cash</option>
                                  <option value="2">Credit Card</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Made Thru</label>
                                <select disabled id="madeThru" name="madeThru" class="form-control">
                                  <option value="1" selected>Walk In</option>
                                  <option value="2">Email</option>
                                  <option value="3">Phone</option>
                                
                                </select>
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Billing Type</label>
                              <select disabled id="billArrange" name="billArrange" class="form-control" >
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
                                <textarea readonly class="form-control" id="specialRequestNotes" name="specialRequestNotes"></textarea>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Guaranteed Note</label>
                                <textarea readonly class="form-control" id="guaranteedNote" name="guaranteedNote"></textarea>
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Billing Note</label>
                                <textarea readonly class="form-control" id="billingNote" name="billingNote"></textarea>
                            </div>
                          </div>                             
                     
                        </div>
                        
                        
                            
                        </div>
                        <div class="row">
                          <h3><strong>ROOM RESERVATION INFORMATIONS</strong></h3>
                        </div>
                        <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                        <label class="form-label">Arrival</label>
                        <div class="prepend-icon">
                          <input readonly type="hidden" name="isRoomManage" id="isRoomManage" value="">
                          <input readonly type="text" name="arrivalDateRoom" id="arrivalDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                          </div>
                          
                          <div class="col-sm-3">
                            <div class="form-group">
                        <label class="form-label">Departure</label>
                        <div class="prepend-icon">
                          <input readonly type="text" name="depatureDateRoom" id="depatureDateRoom" class="b-datepicker form-control" placeholder="Select a date...">
                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label">No. of Days Paid</label>
                                <input readonly type="noDaysPaid" name="noDaysPaid" id="noDaysPaid" class="form-control" placeholder="No Value" minlength="1">
                            </div>
                          </div>
                            
                            <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Discount Status</label>
                              <select disabled id="discountStatus" id="discountStatus" name="discountStatus" class="form-control">
                                @foreach($discountDetails as $dd)
                                  <option value="{{$dd->id}}" selected>{{$dd->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        </div>
                        </div>
                    <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Email</th>
            </tr>
        </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
            </div>
          </div>
               </div>
            </div>
                

                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                    
                </div>
              
            </div>
          </div>
            
        </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>



<script>
    
//// Guest Checkin
  


    var chartNewGuestCheckIn;
    
    $(document).ready(function(){
    $('#users-table tbody').on( 'click', 'button', function () {        
        var guestReservID = this.value;
        
                
    });


    
    $.ajax({
      url: "{!! route('admin.chartNewGuestCheckIn') !!}",
      dataType: "JSON",
      success: function(data){
          chartNewGuestCheckIn = {
            labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],

            datasets : [
              {
                label: "First DataSets",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(151,187,205,1)",
                data : [data[0].January,data[0].February ,data[0].March ,data[0].April ,data[0].May ,data[0].June ,data[0].July ,data[0].August ,data[0].September ,data[0].October ,data[0].November ,data[0].December ]
              }
              
            ]

          }

          var ctx1 = document.getElementById("chartNewGuestCheckIn").getContext("2d");
              var chart1 = new Chart(ctx1).Line(chartNewGuestCheckIn, {
                responsive: true
              });

              
       }
    });
   
    
  
        
    $.ajax({
      url: "{!! route('admin.reservationCalendar') !!}",
      dataType: "JSON",
      success: function(data){
          
             $('#fullcalendar').fullCalendar({

              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
              
              events: data,
              eventRender: function(event, element) {
                  element.attr("data-id",event.id);
                  element.attr("data-toggle","modal");
                  element.attr("data-target","#modal-guest-edit");

                  
              },
              eventClick: function(event, jsEvent, view) {
                
                var guestReservID = $(this).attr("data-id");
                $.get("admin/reservationCalendarViewRegistration/"+guestReservID,function(datas){
                    console.log(datas);
                    //$('#typeIssue').val(0).change();
                    //$(this).attr('border-color');

                    $("#clientName").val(datas[0].clientName);
                    $("#clientContactNo").val(datas[0].clientContactNo);
                    $("#clientEmail").val(datas[0].clientEmail);

                    $("#instiName").val(datas[0].instiName);
                    $("#instiContactNo").val(datas[0].instiContactNo);
                    $("#instiEmail").val(datas[0].instiEmail);

                    $("#transactionCode").val(datas[0].transactionCode);
                    $("#transactionStatus").val(datas[0].transactionStatus).change();
                    $("#chargeType").val(datas[0].chargeType).change();
                    $("#madeThru").val(datas[0].madeThru).change();
                    $("#guaranteed").val(datas[0].guaranteed).change();
                    $("#billArrange").val(datas[0].billingType).change();

                    $("#guaranteedNote").html(datas[0].guaranteedNote);
                    $("#specialRequestNotes").html(datas[0].specialRequestNotes);
                    $("#billingNote").html(datas[0].billingNote);
                    

                    $("#arrivalDateRoom").val(datas[0].arrivalDateRoom);
                    $("#depatureDateRoom").val(datas[0].depatureDateRoom);
                    $("#noDaysPaid").val(datas[0].noDaysPaid);
                    $("#discountStatus").val(datas[0].discountStatus).change();
                    
                    
                    
                    $(".guest-edit-close").val(datas[0].id);
                    
                    if(data.account_id)
                        $("#account-id").html(datas[0].account_id);
                    else
                        $("#account-id").html("NEW GUEST");

                    $('#users-table').DataTable({
                    processing: true,
                    serverSide: false,
                    "bDestroy": true,
                    ajax: 'admin/dataTablesGuestForReservationList/'+guestReservID,
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'Address', name: 'Address' },
                        { data: 'contactNo' , name: 'contactNo' },
                        { data: 'Email', name: 'Email' },
                    
                    ]
                });

                  
                });
                  

                  // change the border color just for fun
                  //$(this).css('border-color', 'red');

              }

            });

          }    
       
    });


  
    $.ajax({
      url: "{!! route('admin.chartNewGuestReservationCheckIn') !!}",
      dataType: "JSON",
      success: function(data){
          chartNewGuestReservationCheckIn = {
            labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],

            datasets : [
              {
                label: "First DataSets",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(151,187,205,1)",
                data : [data[0].January,data[0].February ,data[0].March ,data[0].April ,data[0].May ,data[0].June ,data[0].July ,data[0].August ,data[0].September ,data[0].October ,data[0].November ,data[0].December ]
              }
              
            ]

          }

          var ctx2 = document.getElementById("chartNewGuestReservationCheckIn").getContext("2d");
              var chart2 = new Chart(ctx2).Line(chartNewGuestReservationCheckIn, {
                responsive: true
              });
       }
    });




    $.ajax({
      url: "{!! route('admin.chartNewGuestReservationCheckIn') !!}",
      dataType: "JSON",
      success: function(data){
          chartNewGuestReservationCheckIn = {
            labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],

            datasets : [
              {
                label: "First DataSets",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(151,187,205,1)",
                data : [data[0].January,data[0].February ,data[0].March ,data[0].April ,data[0].May ,data[0].June ,data[0].July ,data[0].August ,data[0].September ,data[0].October ,data[0].November ,data[0].December ]
              }
              
            ]

          }

          var ctx2 = document.getElementById("chartNewGuestReservationCheckIn").getContext("2d");
              var chart2 = new Chart(ctx2).Line(chartNewGuestReservationCheckIn, {
                responsive: true
              });
       }
    });












      $.ajax({
      url: "{!! route('admin.chartCheckInRoom') !!}",
      dataType: "JSON",
      success: function(datas){
        

          var done = [];
          var done2;
          var done3;
          var roomType1=[];
          var roomType2=[];
          var roomType3=[];
          var roomType4=[];
          var roomType5=[];
          var roomType6=[];
          var roomType7=[];
          var roomType8=[];
          var roomType9=[];
          var roomType10=[];

          datas.forEach(function(object){
              done2=[parseInt(object.timeStamps), object.count]
              done.push(done2);
              if(object.roomType == 1)
              {
                roomType1.push(parseInt(done2));
              }
              else if(object.roomType == 2)
              {
                roomType2.push(done2);
              }
              else if(object.roomType == 3)
              {
                roomType3.push(done2);
              }
              else if(object.roomType == 4)
              {
                roomType4.push(done2);
              }
              else if(object.roomType == 5)
              {
                roomType5.push(done2);
              }
              else if(object.roomType == 6)
              {
                roomType6.push(done2);
              }
              else if(object.roomType == 7)
              {
                roomType7.push(done2);
              }
              else if(object.roomType == 8)
              {
                roomType8.push(done2);
              }
              else if(object.roomType == 9)
              {
                roomType9.push(done2);
              }
              else if(object.roomType == 10)
              {
                roomType10.push(done2);
              }
              
          });
      
        
        


        $('#container').highcharts('StockChart', {
            chart: {
                alignTicks: false
            },

            rangeSelector: {
                inputEnabled: $('#container1').width() > 480,
                selected: 1
            },

            title: {
                text: 'Billed Transaction Per Day'
            },

            series: [
            {
                type: 'column',
                name: 'Single',
                data: roomType1,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'Single Deluxe',
                data: roomType2,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'Twin Share',
                data: roomType3,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            }

            ,

            {
                type: 'column',
                name: 'Family',
                data: roomType4,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'Triple Sharing',
                data: roomType5,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'PWD',
                data: roomType6,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'MATRIMONIAL',
                data: roomType7,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'MATRIMONIAL',
                data: roomType7,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'TWIN SHARING',
                data: roomType8,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'STANDARD DOUBLE',
                data: roomType9,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },

            {
                type: 'column',
                name: 'DOUBLE DELUXE',
                data: roomType10,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            }

            ]
        });


         
       }
    });






  
    });


    window.onload = function(){
              
    };



    
    
 
  </script>


    

@endsection