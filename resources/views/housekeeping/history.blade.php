@extends('layouts.housekeepingLayout')



@section('content')


 
<div class="main-content m-t-0 p-t-0">
    <!-- BEGIN PAGE CONTENT -->
  


  <div class="page-content">
    <div class="header">

        <h2><strong>Room Status</strong></h2>
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
                           
                            
                          
                          </div>



        </div>
      </div>
    </div>
  </div>



       
                              
                              
</div>


<script>
$(function() {
	


    $('#users-table').DataTable({
        processing: true,
        serverSide: false,
        "bDestroy": true,
        ajax: "{!! route('housekeeping.dataTablesHousekeepingHistory') !!}",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        dom: 'Bfrtip',
        buttons: [
        'colvis',
        'pageLength',
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2]
                }
            }
        ],
        "scrollx":false,
        
        columns: [
            { data: 'roomName', name: 'roomName', width:"20%" },
            { data: 'type', name: 'type', width:"20%"},
            { data: 'from_status', name: 'from_status', width:"20%"},
            { data: 'to_status', name: 'to_status', width:"20%"},
            { data: 'created_at', name: 'created_at', width:"20%" },
        ],
        
    });

});
</script>               


        
@endsection
 