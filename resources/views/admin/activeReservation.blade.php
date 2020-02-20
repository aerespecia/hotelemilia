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
      <hr class="m-t-5 c-red"/>
          <div class="header">
            <h2><strong>Active Reservation List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-sm-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Name</th>
                <th>Room</th>
                <th>Type</th>
                <th>Rate</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
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
                title: 'Active Reservations',
                autoPrint: false
            }
        ],
        ajax: '{!! route('admin.dataTablesActiveReservationList') !!}',
        columns: [            
            { data: 'guestNames', name: 'guestNames' },
            { data: 'roomName', name: 'roomName' },
            { data: 'RoomType' , name: 'RoomType' },
            { data: 'RoomTypeRate', name: 'RoomTypeRate' },
            { data: 'arrivalDate' , name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate' },
            
        ],
        
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


@endsection