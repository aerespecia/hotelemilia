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
            <h2><strong>Archive List</strong></h2>
          </div>
           
           <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Room</th>
                          <th>Type</th>
                          <th>Rate</th>
                          <th>OS No./s</th>
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
                title: 'Archive Reservations'
            }
        ],
        ajax: '{!! route('admin.dataTablesArchiveReservationList') !!}',
        columns: [
            { data: 'guestNames', name: 'guestNames' },
            { data: 'code', name: 'code' },
            { data: 'roomName', name: 'roomName' },
            { data: 'RoomType' , name: 'RoomType' },
            { data: 'RoomTypeRate', name: 'RoomTypeRate' },
            { data: 'osNos', name: 'osNos' },
            { data: 'arrivalDate' , name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate' },
        ]
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