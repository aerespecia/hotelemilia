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
              <p>Transactions Per Day
              </p>
              <!----<canvas id="chartNewGuestCheckIn"  class="full" height="140"></canvas>-->
              <div id="containerSorted" style="height: 400px; min-width: 310px"></div>
            </div>
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
    
//// Guest Checkin
  


    var chartNewGuestCheckIn;
    
    $(document).ready(function(){

   $.ajax({
      url: "{!! route('admin.chartBilledTransactionPerType') !!}",
      dataType: "JSON",
      success: function(datas){
        

          var done = [];
          var done2;
          var done3;
          var Types1=[];
          var Types2=[];
          var Types3=[];
          var Types4=[];
         

          datas.forEach(function(object){
              done2=[parseInt(object.timeStamps), object.count]
              done.push(done2);
              if(object.types == 0)
              {
                Types1.push(done2);
              }
              else if(object.types == 1)
              {
                Types2.push(done2);
              }
              else if(object.types == 100)
              {
                Types3.push(done2);
              }
              else if(object.types == 1000)
              {
                Types4.push(done2);
              }
              
          });
      
        
        $('#containerSorted').highcharts('StockChart', {
            rangeSelector : {
                selected : 1,
                inputEnabled: $('#container').width() > 480
            },

            title : {
                text : 'No. of Transactions per day per status'
            },

            series: [{
            name: 'Ongoing',
            data:Types1,
            },{
            name: 'Billed',
            data:Types2,
            },{
            name: 'Fully Paid',
            data:Types3,
            },{
            name: 'Partial Paid',
            data:Types4,
            }
            ],

        }); 

        
         
       }
    });




  $.ajax({
      url: "{!! route('admin.chartBilledTransaction') !!}",
      dataType: "JSON",
      success: function(datas){
        

          var done = [];
          var done2;
          var done3;
          
          var Types1=[];
          var Types2=[];

          datas.forEach(function(object){
              done2=[parseInt(object.timeStamps), object.totalBill]
              if(object.types == 100)
              {
                Types1.push(done2);
              }
              else if(object.types == 1000)
              {
                Types2.push(done2);
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
                text: 'Billed Transaction Per Day'
            },

            series: [{
                type: 'column',
                name: 'Fully Paid Transaction',
                data: Types1,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            },{
                type: 'column',
                name: 'Partial Paid Transaction',
                data: Types2,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            }]
        });

        
     } 
    
});
    });


    window.onload = function(){
              
    };



    
    
 
  </script>


    

@endsection