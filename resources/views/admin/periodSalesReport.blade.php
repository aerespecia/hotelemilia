@extends('layouts.adminLayout')



@section('content')

<div class="main-content m-t-0 p-t-0">
  <div class="page-content">
  <div class="header">
  <h2><strong>Generate Period Sales Report</strong></h2>
  <hr class="m-b-0"/>
  </div>
  {!! Form::open(['method'=>'POST','action'=>'AdminController@generatePeriodSalesReport','name'=>'formregis','id'=>'AdminController','class'=>'wizard','data-style'=>'simple']) !!}
      <div class="row">
          <div class="col-lg-12">
              <div class="wizard-div current wizard-simple">
                  <div class="row">
                      <div class="col-md-12">
                      <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4><strong>Period Sales Report</strong></h4>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label class="form-label">From</label>
                                              <div class="prepend-icon">
                                                <input type="text" name="from" id="from" class="b-datepicker form-control" placeholder="Select a date...">
                                                <i class="icon-calendar"></i>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                              <label class="form-label">To</label>
                                              <div class="prepend-icon">
                                                <input type="text" name="to" id="to" class="b-datepicker form-control" placeholder="Select a date...">
                                                <i class="icon-calendar"></i>
                                              </div>
                                            </div>
                                        </div>
                                    </div>                                              
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary" id="saveRoomCheckList" name="saveRoomCheckList">Generate</button>
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
      </div>
  {{ Form::close() }}         
  </div>
</div>






@endsection