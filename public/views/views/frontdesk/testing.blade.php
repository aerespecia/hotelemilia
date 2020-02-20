@extends('layouts.frontdeskLayout')

@section('content')

<div class="header">
          <h4 class="pull-right">Today is: <strong>{{date('F j, Y')}}</strong></h4>
        </div>
          
          <div class="header">

            <h2><strong>Reservation</strong> Details</h2>
          
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="panel">
                <div class="panel-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4>Client Details</h4>
                      <hr/>
                      {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@store','name'=>'formregis','id'=>'FrontDeskController']) !!}
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Firstname</label>
                              <div class="append-icon">
                                <input type="text" name="firstName" class="form-control" minlength="3" placeholder="Enter firstname..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Lastname</label>
                              <div class="append-icon">
                                <input type="text" name="lastName" class="form-control" minlength="4" placeholder="Enter Lastname..." required>
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-8">
                            <div class="form-group">
                              <label class="control-label">Institution Name</label>
                              <div class="append-icon">
                                <input type="text" name="institutionName" class="form-control" placeholder="(e.g. DENR, Ateneo de Davao, Gensan Tours)" required>
                                <i class="fa fa-building-o"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Institution</label>
                              <div class="option-group">
                                <select id="institutionType" name="institutionType" class="language" required>
                                  <option value="EN" selected>Select Institution...</option>
                                  <option value="EN">Individual</option>
                                  <option value="FR">Company</option>
                                  <option value="SP">School</option>
                                  <option value="CH">Government</option>
                                  <option value="JP">Travel Agency</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-8">
                            <div class="form-group">
                              <label class="control-label">Address</label>
                              <div class="append-icon">
                                <input type="text" name="address" class="form-control" placeholder="Enter Address..." minlength="3" required>
                                <i class="fa fa-map-marker"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Contact No.</label>
                              <div class="append-icon">
                                <input type="text" name="contactNo" class="form-control" placeholder="Enter Contact No." minlength="3" required>
                                <i class="fa fa-mobile"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        
                     
                      </form>
                    </div>
                  </div>
              
                </div>
              </div>

              <div class="panel">
                <div class="panel-content">

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Arrival</label>
                            <div class="prepend-icon">
                              <input type="text" name="arrivalDate" class="date-picker form-control" placeholder="Select a date...">
                              <i class="icon-calendar"></i>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Departure</label>
                            <div class="prepend-icon">
                              <input type="text" name="departureDate" class="date-picker form-control" placeholder="Select a date...">
                              <i class="icon-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                      <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      
                      <br>
                      <form role="form" class="form-horizontal form-validation">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Discount Type
                          </label>
                          <div class="col-sm-9">
                           <div class="option-group">
                                <select id="discountType" name="discountType" style="width:250px;" required>
                                  <option value="0" selected>------- Discount Rates ------</option>
                                  <option value="1">Corporate (20%)</option>
                                  <option value="2">Travel Agency (25%)</option>
                                  <option value="3">Government (15%)</option>
                                  <option value="4">School/NGO</option>
                                  <option value="5">5-7 Days Stay Discount (20%)</option>
                                </select>
                              </div>
                          </div>
                        </div>

                        


                        <div class="form-group">
                          <label class="col-sm-3 control-label">Scanned Client Form
                          </label>
                          <div class="col-sm-9">
                            <div class="file">
                                <div class="option-group">
                                  <span class="file-button btn-primary">Choose File</span>
                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;" required>
                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
                                </div>
                              </div>
                      
                      </div>
                          </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Special Request/s
                          </label>
                          <div class="col-sm-9">
                            <textarea name="comment" rows="5" class="form-control" placeholder="Write Requests..." minlength="30" required></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-9 col-sm-offset-3">
                            <div class="pull-right">
                              <button type="submit" class="btn btn-embossed btn-primary m-r-20">MAKE RESERVATION</button>
                              
                            </div>
                          </div>
                        </div>
                      {!! Form::close() !!}
                    </div>
                  </div> 

                </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong> ADD ROOM</strong> </h2>
                </div>
               
                <div class="panel-content">

                 <div class="row m-t-10">
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Room List</label>
                          <select class="form-control form-white" id="roomNum" name="gender" data-style="white" data-placeholder="Select a room">
                            <option></option>
                            <option value="204">204 - Double Standard</option>
                            <option value="207">207 - Twin Sharing</option>
                            <option value="210">210 - Triple Sharing</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="text-center  m-t-20">
                          <button class="btn btn-embossed btn-primary" onclick="addRoom()"><i class="fa fa-plus"></i> Add Room</button>
                         
                        </div>
                      </div>
                    </div>
             
                </div>
              
                  
              </div>
              <div id="roomsPanel">

              </div>
              
            </div>
           
          </div>
          
          <!--- ADD GUEST MODAL -->
          <div class="modal fade" id="modal-select" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
              <h4 class="modal-title"><strong>ADD GUEST</strong> details</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <form id="addguest" role="form">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" id="firstName" name="firstName" class="form-control" minlength="3" placeholder="Enter firstname..." required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" id="familyName" name="familyName" class="form-control" minlength="3" placeholder="Enter first name..." required>
                        </div>
                      </div>
                    </div>
                    <div class="row m-t-10">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" id="address" name="address" class="form-control" minlength="3" placeholder="Enter address..." required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Gender</label>
                          <select class="form-control form-white" id="gender" name="gender" data-style="white" data-placeholder="Select a gender">
                            <option></option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row m-t-10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Contact Number</label>
                          <input type="text" id="contactNo" name="contactNo" class="form-control" minlength="3" placeholder="Enter contact..." required>
                        </div>
                      </div>
                  
                      <div class="col-md-6">
                      <div class="form-group">
                          <label>ID Presented</label>
                          <select multiple class="form-control" data-placeholder="Choose one or various IDs...">
                              <option></option>
                              <option value="TIN">TIN</option>
                              <option value="PHLH">PhilHealth</option>
                              <option value="SSS">SSS</option>
                          
                          </select>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-gray-light">
              <button onclick="myFunction()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal"><i class="fa fa-plus"></i> Add</button>
              <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
            
            </div>
          </div>
        </div>
      </div>
          
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2016 </span>
                <span>Q CITIPARK HOTEL</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>

          <script>
function myFunction() {

    var first = document.getElementById("firstName").value;
    var last = document.getElementById("familyName").value;
    var phone = document.getElementById("contactNo").value;

var tableIndex = document.getElementById("guestTableIndex").value;
    var table = document.getElementById(tableIndex);
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = first;
    cell2.innerHTML = last;
    cell3.innerHTML = phone;


    var counter = document.getElementById(tableIndex).rows.length-2;

var inputFirst = document.createElement("input");

var dash='[]';

inputFirst.setAttribute("type", "hidden");

inputFirst.setAttribute("name", "guestFirstName[]");

inputFirst.setAttribute("value", first+"#"+last+"#"+phone);

//append to form element that you want .
cell1.appendChild(inputFirst);



var inputLast = document.createElement("input");

inputLast.setAttribute("type", "hidden");

inputLast.setAttribute("name", "guestLastName");

inputLast.setAttribute("value", last);

//append to form element that you want .
cell2.appendChild(inputLast);

var inputPhone = document.createElement("input");

inputPhone.setAttribute("type", "hidden");

inputPhone.setAttribute("name", "phone[]");

inputPhone.setAttribute("value", phone);

//append to form element that you want .
cell3.appendChild(inputPhone);


}

function clearFunc(){
  var form = document.getElementById("addguest");
  form.reset();
}

function addRoom(){

  var roomNum = document.getElementById("roomNum").value;
  var x = document.getElementById("roomNum");


  var div = document.getElementById("roomsPanel");
  var string = '<div class="panel panel-default no-bd"><div class="panel-header"><h2 class="panel-title"><strong>ROOM: </strong>'+roomNum+' </h2></div><div class="panel-content"><input type="hidden" id="guestTableIndex" value="guestTable'+x.selectedIndex+'"/>  <div class="panel-content" style="overflow-y:auto;height:200px;"> <table id="guestTable'+x.selectedIndex+'" class="table table-hover"><thead><tr><th>First Name</th> <th>Last Name</th> <th>Phone</th> </tr> </thead> <tbody>  <tr><td></td><td></td> <td></td> </tr> </tbody> </table> </div>  </div> <hr/> <div class="text-center  m-t-20">  <button class="btn btn-embossed btn-primary" data-toggle="modal" data-target="#modal-select" onclick="clearFunc()"><i class="fa fa-plus"></i> Add Guest</button></div></div>';

  div.innerHTML +=string; 

  
    x.remove(x.selectedIndex);
/*
  var motherDiv = document.createElement("div");
  motherDiv.setAttribute("class", "panel panel-default no-bd");

  var panelHeader = document.createElement("div");
  panelHeader.setAttribute("class","panel-header");

  var head2 = document.createElement("h2");
  head2.innerHTML = "<strong>ROOM: "+roomNum+"</strong>";

  panelHeader.appendChild(head2);
  motherDiv.appendChild(panelHeader);

  var panelContentMain = document.createElement("div");
  panelContentMain.setAttribute("class","panel-content");

   var panelContent2 = document.createElement("div");
  panelContent2.setAttribute("class","panel-content");
  panelContent2.setAttribute("style","overflow-y:auto;height:200px;");

  var table = document.createElement("table");
  table.setAttribute("id","guestTable");
  table.setAttribute("class","table table-hover");

  var thead = document.createElement("thead");
  var trhead = document.createElement("tr");
  var th1 = document.createElement("th");
  th1.innerHTML = "First Name";
  var th2 = document.createElement("th");
  th2.innerHTML = "Last Name";
  var th3 = document.createElement("th");
  th3.innerHTML = "Phone";
  trhead.appendChild(th1);
  trhead.appendChild(th2);
  trhead.appendChild(th3);

  thhead.appendChild(trhead);

  table.appendChild(thhead);

  var tbody = document.createElement("tbody");
  var tr2 = document.createElement("tr");
  var td1 = document.createElement("td");
var td2 = document.createElement("td");
var td3 = document.createElement("td");
tr2.appendChild(td1);
tr2.appendChild(td2);
tr2.appendChild(td3);
tbody.appendChild(tr2);

table.appendChild(tbody);
panelContent2.appendChild(table);
panelContentMain.appendChild(panelContent2);

motherDiv.appendChild(panelContentMain);

  div.appendChild(motherDiv);


  var inputFirst = document.createElement("input");
  inputFirst.setAttribute("type", "text");

  inputFirst.setAttribute("name", "guestFirstName[]");

  inputFirst.setAttribute("value", "first");

  div2.appendChild(inputFirst);
  div.appendChild(div2);  */
}
</script>

@endsection