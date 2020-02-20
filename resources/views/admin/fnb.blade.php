@extends('layouts.adminLayout')



@section('content')
 



<div class="main-content m-t-0 p-t-0">
        <!-- BEGIN TOPBAR -->
        
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
                    
          <div class="header">

              <h2><strong>Q CITIPARK</strong> DASHBOARD</h2>
              
          <hr class="m-b-0"/>
          </div>
     

          <div class="row">
            <div class="col-sm-12">
              <h3><strong>Billed Transactions</strong></h3>
              <p>Billed Transactions Per Day
              </p>
              <!----<canvas id="chartNewGuestCheckIn"  class="full" height="140"></canvas>-->
              <div id="container1" style="height: 400px"></div>
            </div>
          </div>


        </div>
        <!-- END PAGE CONTENT -->
      </div>



<script>
    







  $.ajax({
      url: "{!! route('admin.fnbTransactions') !!}",
      dataType: "JSON",
      success: function(datas){
        

          var done = [];
          var done2;
          var done3;
        
          var type1=[];
          var type2=[];
         

          datas.forEach(function(object){
              done2=[parseInt(object.timeStamps), object.totalBill]
              done.push(done2);
              if(object.types == 1)
              {
                type1.push(done2);
              }
              else if(object.types == 2)
              {
                type2.push(done2);
              }
          });


        $('#container1').highcharts('StockChart', {
            chart: {
                alignTicks: false
            },

            rangeSelector: {
                inputEnabled: $('#container1').width() > 480,
                selected: 1
            },

            title: {
                text: 'Food and Beverages and Room Service Summary'
            },

            series: [{
                type: 'column',
                name: 'Food and Beverages',
                data: type1,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            }, {
                type: 'column',
                name: 'Room Service',
                data: type2,
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

            ]
        });
     } 
    
});



    
    
 
  </script>


    

@endsection