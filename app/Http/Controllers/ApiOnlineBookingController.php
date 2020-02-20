<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash; 

use App\Client;
use App\Transaction;
use App\RoomReservation;
use App\GuestReservation;
use App\Guest; 
use App\RoomCharge;   
use App\Institution; 
use App\RoomAmendment;
use App\Downpayment; 
use App\DiscountDetails;
use App\User;
use File;


use Input;
use Validator;
use Redirect;
use Session;
use Storage;
use Response;
use Carbon\Carbon;

use App\Http\Requests;
use App\RoomInfo;
use View;
use Yajra\Datatables\Datatables;
use App\RoomIssue;
use App\OnlineTransaction;

use DB;
use PDF;

class ApiOnlineBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function apiSaveOnlineBooking(Request $request){

      //return "Goods";

        $inputs=$request->all();



   //     return $inputs;
        if(sha1($inputs["accessId"]) != sha1("hotelEmiliaWeb"))
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "Invalid Access ID!"]);

        if($request->has("checkInDate") == false || $inputs["checkInDate"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Check In Date found"]);

        if($request->has("checkOutDate") == false || $inputs["checkOutDate"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Check Out Date found"]);

        if($request->has("bpFirstName") == false || $inputs["bpFirstName"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Booking Person First Name found"]);

        if($request->has("bpLastName") == false || $inputs["bpLastName"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Booking Person Last Name found"]);

        if($request->has("bpContactNo") == false || $inputs["bpContactNo"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Booking Person Contact No found"]);

        if($request->has("bpEmail") == false || $inputs["bpEmail"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Booking Person Email found"]);

        if($request->has("bookingReferenceNo") == false || $inputs["bookingReferenceNo"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Booking Reference found"]);

        if($request->has("paypalReference") == false || $inputs["paypalReference"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Paypal Reference found"]);

        if($request->has("totalAmount") == false || $inputs["totalAmount"] == "")
            return collect(["ResponseCode"=> 1, "ResponseMessage"=> "No Total Amount found"]);

        if($request->has("roomTypeIds") == false || count($inputs["roomTypeIds"]) == "")
            return collect(["ResponseCode"=> 1,"ResponseMessage" => "No Room Type Ids Found"]);

        if($request->has("roomTypesRate") == false || count($inputs["roomTypesRate"]) == "")
            return collect(["ResponseCode"=> 1,"ResponseMessage" => "No Room Types Rates Found"]);

        if($request->has("roomTypesCount") == false || count($inputs["roomTypesCount"]) == "")
            return collect(["ResponseCode"=> 1,"ResponseMessage" => "No Room Types Count Found"]);


        if($inputs["config"] == 2){
          $file = time() . 'sandboxOnline.json';
          $destinationPath=public_path()."/sandboxOnlineBookingTesting/json/";
          if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
          File::put($destinationPath.$file,$request);
      }

      else if($inputs["config"] == 1){
          $file = time() . 'liveOnline.json';
          $destinationPath=public_path()."/lineOnlineBooking/json/";
          if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
          File::put($destinationPath.$file,$request);

          $ot = new OnlineTransaction;
          $ot->accessId = sha1($inputs["accessId"]);
          $ot->sourceId = 1;
          $ot->checkInDate = $inputs["checkInDate"];
          $ot->checkOutDate = $inputs["checkOutDate"];
          $ot->bpFirstName = $inputs["bpFirstName"];
          $ot->bpLastName = $inputs["bpLastName"];
          $ot->bpContactNo = $inputs["bpContactNo"];
          $ot->bpEmail = $inputs["bpEmail"];
          $ot->bookingReferenceNo = $inputs["bookingReferenceNo"];
          $ot->paypalReference = $inputs["paypalReference"];
          $ot->totalAmount = $inputs["totalAmount"];
          $ot->status = 2;
          $ot->save();


          $clients = new Client;
          $clients->firstname = $inputs['bpFirstName'];
          $clients->lastName = $inputs['bpLastName'];
          $clients->contactNo = $inputs['bpContactNo'];


          $clients->institutionId= 1;
          $clients->email = $inputs['bpEmail'];
          $clients->save();



          $transCode = $this->randomGenerator();

          $transaction = new Transaction;
          $transaction->code = $transCode; 
          $transaction->clientId = $clients->id;
          $transaction->madeThru = 999;
          $transaction->guaranteed = 1;

          $transaction->billingType = 2;
          $transaction->institutionId = 1;
          $transaction->updatedBy = 1;
          $transaction->chargeType = 999;
          $transaction->save();



     //    $roomReservation = new RoomReservation;



          $arrival = date_format(date_create($request->get('checkInDate')),"Y-m-d");
          $departure = date_format(date_create($request->get('checkOutDate')),"Y-m-d");

          $results = array();
          $freeRooms = array();

     //    $query = DB::select('SELECT * FROM room_reservations WHERE arrivalDate >="'.$arrival.'" and depatureDate <= "'.$departure.'"');

        ///original available rooms query

          $rooms = RoomInfo::all();

          $query = DB::table('room_reservations')
          ->join('room_infos as ri','ri.id','=','room_reservations.roomId')
          ->join('room_types as rt','rt.id','=','ri.type')
          ->whereBetween('arrivalDate',[$arrival,$departure])
          ->orWhereBetween('depatureDate',[$arrival,$departure])
          ->select([
            'rt.id as roomTypeId',
            'ri.id as roomId',
        ])
          ->get();

          $query2 = DB::table('room_reservations')
          ->join('room_infos as ri','ri.id','=','room_reservations.roomId')
          ->join('room_types as rt','rt.id','=','ri.type')
          ->whereDate('arrivalDate','<',$arrival)
          ->whereDate('depatureDate','>',$arrival)
          ->whereDate('arrivalDate','<',$departure)
          ->whereDate('depatureDate','>',$departure)
          ->select([
            'rt.id as roomTypeId',
            'ri.id as roomId',
        ])
          ->get();



          foreach($query as $q){
            if(!in_array($q->roomId, $results))
                array_push($results,$q->roomId);
        }

        foreach($query2 as $q2){
            if(!in_array($q2->roomId, $results))
                array_push($results,$q2->roomId);
        }



        $query4 = DB::table('room_infos as ri')
        ->join('room_types as rt','rt.id','=','ri.type')
        ->where('ri.status','=',4)
        ->where('ri.cleanStatus','=',4)
        ->select([
            'rt.id as roomTypeId',
            'ri.id as roomId',
        ])
        ->get();



        foreach($query4 as $q4){
            array_push($results,$q4->roomId);

        }


        foreach($rooms as $r){
            if(!in_array($r->id, $results))
                array_push($freeRooms, $r->id);
        }

    //   return $freeRooms;

        $roomTypes = $inputs['roomTypeIds'];

        $roomTypesRate = $inputs["roomTypesRate"];
        $roomTypesCount = $inputs["roomTypesCount"];


        $tempArray = array();

        for($i = 0; $i < count($roomTypes) ; $i++){

            $tempCount = 1;

            foreach($freeRooms as $fr){
                $room = RoomInfo::findOrFail($fr);
                if($room->type == $roomTypes[$i] && $tempCount <= $roomTypesCount[$i]){


                    $roomReservation = new RoomReservation;
                    $roomReservation->transactionId = $transaction->id;
                    $roomReservation->roomId = $room->id;
                    $roomReservation->arrivalDate = $arrival;
                    $roomReservation->depatureDate = $departure;
                    $roomReservation->initialArrivalDate = $arrival;
                    $roomReservation->initialDepartureDate = $departure;
                    $roomReservation->FinalRoomRate = $roomTypesRate[$i];
                    $roomReservation->discountId = 1;
                    $roomReservation->reserveType= 1;
                    $roomReservation->checkInTime = "14:00:00";
                    $roomReservation->checkOutTime = "12:00:00";

                  
                    $roomReservation->save();

                      $dp = new Downpayment();
                    $dp->transactionId = $transaction->id;
                    $dp->amount = $roomTypesRate[$i];
                    $dp->paidThru = 999;
                    $dp->notes = "Hotel Emilia Website - ".$inputs["paypalReference"];
                    $dp->roomReservationId = $roomReservation->id;
                    $dp->user_id = 1;
                    $dp->save();
                    
                    $tempCount++;

                }
            }
        }
    }


      //  return $tempArray;




    return collect(["ResponseCode"=> "Success", "ResponseMessage"=> "Successfully saved online booking!"]);
}
public function store(Request $request)
{
        //

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function randomGenerator(){

        $trans = Transaction::all()->count();
        $transno = sprintf('%04d', $trans);

        $one = date('d');
        $two = date('y');
        $three = date('M');
        $four = date('N');
        $five = rand(1,9);
        $six = rand(0,25);
        $seven = rand(1,9);
        $eight = rand(0,25);
        $nine = rand(1,9);

        $alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        $countCheck = 1;

        do{

            $codeGenerated = $alpha[$eight]."".$alpha[$six]."".$five."".$seven."".$nine;  
            $countCheck =  Transaction::where('code',$codeGenerated)->count();


        }while($countCheck>0);


        return $codeGenerated;
    }

}

