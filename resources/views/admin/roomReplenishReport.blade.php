@extends('layouts.adminLayout')
@section('content')

<div class="main-content m-t-0 p-t-0">
    <!-- BEGIN PAGE CONTENT -->
  


  <div class="page-content">
    <div class="header">
        <h2><strong>Rooms Replenished</strong></h2>
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
                    <div class="col-md-12">
                     <table id="users-table" class="table table-striped">
                        <thead>
                            <tr>
                              <th>Room Name</th>
                              <th>Type</th>
                              <th>Item Replenished</th>
                              <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="header">
        <h2><strong>Item Per Week Replenished</strong></h2>
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
                    <div class="col-md-12">
                     <table id="userss-table" class="table table-striped">
                        <thead>
                            <tr>
                              
                              <th>Item Replenished</th>
                              <th># of Items</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                      </table>
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


<script>

$(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 
    var today = dd+'/'+mm+'/'+yyyy;


    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: false,
        "bDestroy": true,
        ajax: "{!! route('admin.dataTablesRoomItemReplenishList') !!}",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        dom: 'Bfrtip',
        buttons: [
        'pageLength',
            
            {
              extend: 'print',
              text: 'Print current page',
              title: '<center><h2><strong>Replenished Item Report - '+today+'</strong></h2></center>',

            }

        ],
        "scrollx":false,
        
        columns: [
            
            { data: 'roomName', name: 'roomName' },
            { data: 'type', name: 'type'},
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                var d=data;
                var stringTable = "";
                var res = d.itemsInventory.split(",");
                res.forEach(function(entry) {
                    var splitted = entry.split(":");
                    stringTable += '<tr><td>'+splitted[0]+'</td><td>'+splitted[1]+' pc/s</td>';
                });
                
                // `d` is the original data object for the row
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+stringTable+'</table>';
              }
            },
            { data:'created', name:'created'}
            
        ],
        
    });


  var table = $('#userss-table').DataTable({
        processing: true,
        serverSide: false,
        "bDestroy": true,
        ajax: "{!! route('admin.dataTablesItemReplenishList') !!}",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        dom: 'Bfrtip',
        buttons: [
        'pageLength',
            
            {
              extend: 'print',
              text: 'Print current page',
              title: '<center><h2><strong>Items Per Week Report - '+today+'</strong></h2></center>',

            }

        ],
        "scrollx":false,
        
        columns: [
            
            { data: 'name', name: 'name' },
            { data: 'noOfItem', name: 'noOfItem'},
            
            
        ],
        
    });



  




});
      

</script>               
@endsection
 