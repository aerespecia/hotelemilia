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

use DB;
use PDF;


class FrontDeskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware(['frontdesk','auth']);
    }

    public function roomStatusSave(Request $req){
        $room = RoomInfo::findOrFail($req->get('from'));
        $room->status = $req->get('to');
        $room->save();
        
        DB::table('housekeepings')->insert(
            ['from_status' => $req->get('from'), 'to_status' =>  $req->get('to')]
        );
        
        
        $today = time();
        
        $rooms = RoomInfo::all();
        
        $roomStatusColor = array('green','red','yellow','orange','white','dark','light','blue');
        
        
        $roomStatus = array('VR','OCC','VD','BLO','OOO','NS','SO','HU');
        
        $roomStatusText = array('Vacant Ready','Occupied','Vacant Dirty','Blocked','Out of Order','No Show','Slept Out','House Use');
        
        $reservationsToday = DB::table('room_reservations')->whereDate('arrivalDate','=',date('Y-m-d'))->get();
        
        $blockedRooms = array();
        
        foreach($reservationsToday as $rt){
            array_push($blockedRooms, $rt->roomId);
        }



        
        $user=Auth::user();
        
        $date = date('F j, Y');
        


       return view('frontdesk.index',compact('user','date','rooms','roomStatus','roomStatusColor','blockedRooms'));
   }

   public function addCharges(Request $req){

    $room_charge = new RoomCharge();
    $room_charge->guestReservationId = $req->get('guest');
    $room_charge->os_id = $req->get('os');
    $room_charge->item_name = $req->get('item');
    $room_charge->type = $req->get('type');
    $room_charge->price = $req->get('price');
    $room_charge->lessDiscount = $req->get('less');
    $room_charge->account_type = $req->get('accType');
    $room_charge->chargeType = $req->get('chargeType');
    $room_charge->updatedBy = Auth::user()->id;
    $room_charge->save();

}

public function index(Request $req){

// $ServiceURL = "http://192.168.43.252:8080/api-hesm/save-booking";
//       $PostedValues = array("accessId" => "hotelEmiliaWeb",
//                             "config" => "2",
//                             "checkInDate" => "2019-01-28",
//                             "checkOutDate" => "2019-01-29",
//                             "bpFirstName" => "WUhoo",
//                             "bpLastName" => "Doe",
//                             "bpContactNo" => "09392869413",
//                             "bpEmail" => "johndoe@gmail.com",
//                             "bookingReferenceNo" => "0216544889324675",
//                             "paypalReference" => "PL125479325412",
//                             "totalAmount" => "13455.00",
//                             "roomTypeIds" => ['1','2'],
//                             "roomTypesCount" => ['2','1'],
//                             "roomTypesRate" => ['2047.50','2632.50'],);
//       $PostString = json_encode($PostedValues);
//       $Request = curl_init($ServiceURL);
//       curl_setopt($Request, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($Request, CURLINFO_HEADER_OUT, true);
//       curl_setopt($Request, CURLOPT_POST, true);
//       curl_setopt($Request, CURLOPT_POSTFIELDS, $PostString);

// curl_setopt($Request, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($PostString)));
// $PostResponse = curl_exec($Request);
// curl_close ($Request);
// $Response = json_decode($PostResponse);

    $dateMain = date_format(date_create($req->get('date-main')),"Y-m-d");
    $random = $this->randomGenerator();

    $today = time();
    $date = date('F j, Y');
    $hiddenDate = $date;

    $rooms_list = DB::table('room_types')
    ->join('room_infos','room_infos.type','=','room_types.id')
    ->orderby("room_types.id","asc")
    ->select([
        'room_types.id as roomType_id',
        'room_infos.id',
        'room_types.name as roomType',
        'room_infos.roomName',
        'room_infos.status',
        'room_infos.roomNo',
        'room_infos.floorNo',
    ])->get();


    $rooms2 = DB::table('room_infos')
    ->whereBetween('roomName', [200, 299])
    ->orderby('roomName')
    ->select(
        [
            'id',
            'roomName',
            'status',
            DB::raw('
                case status
                when "0" then "bg-green"
                when "1" then "bg-red"
                when "2" then "bg-yellow"
                when "3" then "bg-orange"
                when "4" then "bg-white"
                when "5" then "bg-dark"
                when "6" then "bg-light"
                when "7" then "bg-blue"
                end as statusColor'),
            DB::raw('
                case status
                when "0" then "green"
                when "1" then "red"
                when "2" then "yellow"
                when "3" then "orange"
                when "4" then "white"
                when "5" then "dark"
                when "6" then "light"
                when "7" then "blue"
                end as statusColor2'),
                /*
                CleanStatus
                1-Dirty
                2-Cleaned
                3-Out of Order
                */

                DB::raw('
                    case cleanStatus
                    when "1" then "bg-orange"
                    when "2" then "bg-green"
                    when "3" then "bg-red"
                    when "4" then "bg-purple"
                    end as cleanStatus
                    '),
                DB::raw('
                    case status
                    when "0" then "Vacant Ready"
                    when "1" then "Occupied"
                    when "2" then "Vacant Dirty"
                    when "3" then "Blocked"
                    when "4" then "Out of Order"
                    when "5" then "No Show"
                    when "6" then "Slept Out"
                    when "7" then "House Use"
                    end as statusText'),

                
            ]
        )
    ->get();

    $rooms3 = DB::table('room_infos')
    ->whereBetween('roomName', [300, 399])
    ->orderby('roomName')
    ->select(
        [
            'id',
            'roomName',
            'status',
            DB::raw('
                case status
                when "0" then "bg-green"
                when "1" then "bg-red"
                when "2" then "bg-yellow"
                when "3" then "bg-orange"
                when "4" then "bg-white"
                when "5" then "bg-dark"
                when "6" then "bg-light"
                when "7" then "bg-blue"
                end as statusColor'),
            DB::raw('
                case status
                when "0" then "green"
                when "1" then "red"
                when "2" then "yellow"
                when "3" then "orange"
                when "4" then "white"
                when "5" then "dark"
                when "6" then "light"
                when "7" then "blue"
                end as statusColor2'),
                /*
                CleanStatus
                1-Dirty
                2-Cleaned
                3-Out of Order
                */

                DB::raw('
                    case cleanStatus
                    when "1" then "bg-orange"
                    when "2" then "bg-green"
                    when "3" then "bg-red"
                    when "4" then "bg-purple"
                    end as cleanStatus
                    '),
                DB::raw('
                    case status
                    when "0" then "Vacant Ready"
                    when "1" then "Occupied"
                    when "2" then "Vacant Dirty"
                    when "3" then "Blocked"
                    when "4" then "Out of Order"
                    when "5" then "No Show"
                    when "6" then "Slept Out"
                    when "7" then "House Use"
                    end as statusText'),
            ]
        )
    ->get();


    $rooms4 = DB::table('room_infos')
    ->whereBetween('roomName', [400, 499])
    ->orderby('roomName')
    ->select(
        [
           'id',
           'roomName',
           'status',
           DB::raw('
            case status
            when "0" then "bg-green"
            when "1" then "bg-red"
            when "2" then "bg-yellow"
            when "3" then "bg-orange"
            when "4" then "bg-white"
            when "5" then "bg-dark"
            when "6" then "bg-light"
            when "7" then "bg-blue"
            end as statusColor'),
           DB::raw('
            case status
            when "0" then "green"
            when "1" then "red"
            when "2" then "yellow"
            when "3" then "orange"
            when "4" then "white"
            when "5" then "dark"
            when "6" then "light"
            when "7" then "blue"
            end as statusColor2'),
                /*
                CleanStatus
                1-Dirty
                2-Cleaned
                3-Out of Order
                */

                DB::raw('
                    case cleanStatus
                    when "1" then "bg-orange"
                    when "2" then "bg-green"
                    when "3" then "bg-red"
                    when "4" then "bg-purple"
                    end as cleanStatus
                    '),
                DB::raw('
                    case status
                    when "0" then "Vacant Ready"
                    when "1" then "Occupied"
                    when "2" then "Vacant Dirty"
                    when "3" then "Blocked"
                    when "4" then "Out of Order"
                    when "5" then "No Show"
                    when "6" then "Slept Out"
                    when "7" then "House Use"
                    end as statusText'),
            ]
        )
    ->get();


    $roomStatusColor = array('green','red','yellow','orange','white','dark','light','blue');


    $roomStatus = array('VR','OCC','VD','BLO','OOO','NS','SO','HU');

    $roomStatusText = array('Vacant Ready','Occupied','Vacant Dirty','Blocked','Out of Order','No Show','Slept Out','House Use');

    $reservationsToday = DB::table('room_reservations')->where('status','!=',1)->whereDate('arrivalDate','<=',$dateMain)->whereDate('depatureDate','>=',$dateMain)->get();


    if($dateMain){
       //     $reservationsToday = DB::table('room_reservations')->whereDate('arrivalDate','<=',$dateMain)->get();

        $date = date_format(date_create($req->get('date-main')),"F j, Y");
        $hiddenDate = $date;
    }

    else{
      //      $reservationsToday = DB::table('room_reservations')->whereDate('arrivalDate','<=',$dateMain)->get();

        $date = date('F j, Y');

        $hiddenDate = $date;
    } 


    $blockedRooms = array();
    $doneRooms = array();


    foreach($reservationsToday as $rt){
      if((strtotime($dateMain) >= strtotime($rt->arrivalDate) && strtotime($dateMain) <= strtotime($rt->depatureDate)))
          array_push($blockedRooms, $rt->roomId);
  }

  foreach($rooms_list as $rl){
     $tempOccupiedStatus = 0;
     foreach($reservationsToday as $rt){

         if($rt->roomId == $rl->id){
             $tempOccupiedStatus = $rt->occupied_status;
         }

     }
     $rooms[] = ['id'=>$rl->id,'room_typeId'=>$rl->roomType_id,'roomName' => $rl->roomName, 'status' => $rl->status,'occupied_status'=>$tempOccupiedStatus];
 }


 $user=Auth::user();

 $roomTypes = DB::table('room_types')
 ->join('room_infos','room_infos.type','=','room_types.id')
 ->select([
    'room_types.id',
    'room_types.name as roomType',
    'room_infos.roomNo',
    'room_infos.roomName',

])->get();

 $roomsCheck = DB::table('room_infos')
 ->join('room_types','room_infos.type','=','room_types.id')
 ->where('room_infos.id','!=',37)
 ->orderby('roomName')
 ->select([
    'room_infos.roomName',
    'room_infos.roomNo',
    'room_infos.type',
    'room_infos.id',
    'room_types.name as roomType',
    'room_types.room_rate as rate',
])
 ->get();
// $Response = "test";




//UPDATE ROOM TYPE
   


 // $ServiceURL = "https://www.hotelemilia.ph/api-save-room-inv";
 // $PostedValues = array(
 // "ConfigType" => 'Sandbox',
 // "UserID" => sha1("H0t3l3m1l1a"),
 // "SystemID" => 1,
 // "SchedDate" => '2019-01-29',
 // "RegularRate" => 2047.50,
 // "PromoRate" => 0,
 // "AvailableRoom" => 0,
 // "Remarks" => ''
 // );

 // $PostString = "";
 // foreach( $PostedValues as $key => $value ){
 // $PostString .= "$key=" . urlencode( $value ) . "&";
 // }
 // $PostString = rtrim( $PostString, "& " );
 // $Request = curl_init($ServiceURL);
 // curl_setopt($Request, CURLOPT_HEADER, 0);
 // curl_setopt($Request, CURLOPT_RETURNTRANSFER, 1);
 // curl_setopt($Request, CURLOPT_POSTFIELDS, $PostString);
 // curl_setopt($Request, CURLOPT_SSL_VERIFYPEER, FALSE);
 // $PostResponse = curl_exec($Request);
 // curl_close ($Request);

 // $Response = json_decode($PostResponse);

 $testCurl = function_exists('curl_version');
 return view('frontdesk.index',compact('user','date','rooms','rooms2','rooms3','rooms4','roomsCheck','roomStatus','roomStatusColor','blockedRooms','random','hiddenDate','rooms_list'));
}


  public function apiOnlineReservation(Request $req){

        // return "hello";
        // $inputs = $req->all();

        // $user = new User;
        // $user->username = $inputs["username"];
        // $user->firstName = $inputs["firstName"];
        // $user->save();

        $inputs = $req->all();

       //return $req;
        $user = new User;
        $user->name = $inputs["name"];
        $user->username = $inputs["username"];
        $user->role = $inputs["role"];
        $user->email = $inputs["email"];
        $user->save();
   }


public function modalView(Request $req, $id){
    $dateMain = date_format(date_create($req->get('dateMain')),"Y-m-d");

    if($dateMain){
        $date_query = $dateMain;
    }
    else
        $date_query = date('Y-m-d');

    $departureInfo = DB::table('transactions as t')
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->join('guests as g','gr.guestId','=','g.id')
    ->join('room_infos as r','rr.roomId','=','r.id')
    ->join('room_types as rt','rt.id','=','r.type')
    ->where('r.id','=',$id)
    ->where('rr.depatureDate','=',$date_query)
    ->select([
        'rr.arrivalDate',
        'rr.depatureDate',
        'g.firstName',
        'g.familyName',
        'g.account_id',
    ])
    ->get();

    $roomInfo = DB::table('room_infos as r')
    ->join('room_types as rt','rt.id','=','r.type')
    ->where('r.id','=',$id)
    ->select([
        'r.roomName',
        'rt.name as roomType',

    ])
    ->first();

    return collect(["roomInfo" => $roomInfo,"departure"=>$departureInfo]);

}

public function retrievePhotos(Request $req){
    $inputs = $req->all();


    $path = $inputs['id']."-issue.jpg";
    return $path;

}

public function retrieveIdFront(Request $req){
    $inputs = $req->all();


    $path = $inputs['id']."-front.jpg";
    return $path;

}

public function retrieveIdBack(Request $req){
    $inputs = $req->all();


    $path = $inputs['id']."-back.jpg";
    return $path;

}


public function getImage($filename) {
 $path = storage_path().'/app/issues/'.$filename;
 $type = "image/jpeg";
 header('Content-Type:'.$type);
 header('Content-Length: ' . filesize($path));
 readfile($path);
}

public function getImageIdFront($filename) {
 $path = storage_path().'/app/id-front/'.$filename;
 $type = "image/jpeg";
 header('Content-Type:'.$type);
 header('Content-Length: ' . filesize($path));
 readfile($path);
}

public function getImageIdBack($filename) {
 $path = storage_path().'/app/id-back/'.$filename;
 $type = "image/jpeg";
 header('Content-Type:'.$type);
 header('Content-Length: ' . filesize($path));
 readfile($path);
}



public function modalBlockedOcc(Request $req, $id){

    $dateMain = date_format(date_create($req->get('dateMain')),"Y-m-d");

    $results = [];

    if($dateMain){
        $date_query = $dateMain;
    }
    else
        $date_query = date('Y-m-d');

    $blockedRoomInfo = DB::table('transactions')
    ->join('room_reservations','room_reservations.transactionId','=','transactions.id')
    ->join('discount_details','room_reservations.discountId','=','discount_details.id')
    ->join('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->join('guests','guests.id','=','guest_reservations.guestId')
    ->join('room_infos','room_infos.id','=','room_reservations.roomId')
    ->join('room_types','room_infos.type','=','room_types.id')
    ->where('room_infos.id','=',$id)
    ->where('guest_reservations.status','=',2)
    ->where('room_reservations.arrivalDate','<=',$date_query)
    ->where('room_reservations.depatureDate','>=',$date_query)
    ->select([
        'transactions.code',
        'transactions.id',
        'room_types.name',
        'room_infos.roomName',
        'guests.firstName',
        'guests.familyName',
        'discount_details.name as discountName',
        'discount_details.type as discountType',
        'discount_details.discountValue',
        'room_types.room_rate as rate',
        'guest_reservations.id as gReservId',
        'room_reservations.id as roomReservId',
        'room_reservations.arrivalDate',
        'room_reservations.noOfDays',  'room_reservations.depatureDate'

    ])
    ->get();

    $roomCharges =  DB::table('transactions')
    ->join('room_reservations','room_reservations.transactionId','=','transactions.id')
    ->join('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->join('room_charges as rc','rc.guestReservationId','=','guest_reservations.id')
    ->join('room_infos','room_infos.id','=','room_reservations.roomId')
    ->where('room_infos.id','=',$id)
    ->where('guest_reservations.status','=',2)
    ->where('room_reservations.arrivalDate','<=',$date_query)
    ->where('room_reservations.depatureDate','>=',$date_query)
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
    ])->get();


    return collect(["info" => $blockedRoomInfo,"charges" => $roomCharges]);
}


public function addChargeBooking(Request $req, $id){



    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->where('rr.id','=',$id)
    ->select([
        'gr.id as gReservId',
        'g.firstName',
        'g.familyName',
    ])
    ->get();

    $roomCharges = DB::table('room_charges as rc')
    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
    ->join('room_reservations as rr','gr.roomReservationId','=','rr.id')
    ->where('rr.id','=',$id)
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
    ])->get();


    return collect(["info" => $guests,"charges" => $roomCharges]);
}



public function modalBlocked(Request $req, $id){

    $dateMain = date_format(date_create($req->get('dateMain')),"Y-m-d");

    if($dateMain){
        $date_query = $dateMain;
    }
    else
        $date_query = date('Y-m-d');

    $results = [];

    $blockedRoomInfo = DB::table('transactions')
    ->leftJoin('room_reservations','room_reservations.transactionId','=','transactions.id')
    ->leftJoin('clients','transactions.clientId','=','clients.id')
    ->leftJoin('institutions','transactions.institutionId','=','institutions.id')
    ->leftJoin('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->leftJoin('guests','guests.id','=','guest_reservations.guestId')

    ->join('room_infos',function($join) use ($id, $date_query)
    {
        $join->on( 'room_reservations.roomId','=','room_infos.id')
        ->where('room_infos.id', '=', $id)
        ->where('room_reservations.arrivalDate','<=',$date_query);
    })
    ->leftJoin('room_types','room_infos.type','=','room_types.id')
    ->select([
        'transactions.code',
        'transactions.id',
        'room_types.name',
        'room_types.id as roomTypeId',
        'room_infos.roomName',
        'clients.firstname as clientFirstName',
        'clients.lastName as clientLastName',
        'institutions.name as groupName',
        'room_reservations.arrivalDate',
        'room_reservations.depatureDate'

    ])
    ->get();


    
    foreach($blockedRoomInfo as $bi){
        $results = ['id' => $bi->id,'clientFirstName' => $bi->clientFirstName,'clientLastName'=>$bi->clientLastName,'groupName'=>$bi->groupName,'name'=>$bi->name,'roomName'=>$bi->roomName,'code'=>$bi->code,'arrivalDate'=>date_format(date_create($bi->arrivalDate),"M j, Y"),'depatureDate'=>date_format(date_create($bi->depatureDate),"M j, Y")];
    }

    return response()->json($results);
}

public function blockedViewGuest($id){
    $viewGuestList = DB::table('guests')
    ->leftJoin('guest_reservations','guests.id','=','guest_reservations.guestId')
    ->where('guest_reservations.status','=',3)
    ->leftJoin('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')

    ->join('transactions',function($join) use ($id)
    {
        $join->on( 'room_reservations.transactionId','=','transactions.id')
        ->where('transactions.id', '=', $id);
    })
    ->select([
        'guests.firstName',
        'guests.familyName',
        'guest_reservations.status',
        'guests.contactNo'
    ])
    ->distinct()
    ->get();
    
    return response()->json($viewGuestList);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function addRoomTemp(Request $req){
        $room = new RoomInfo();
        $room->roomName = $req->get('roomName');
        $room->type = $req->get('type');
        $room->floorno = $req->get('floorno');
        $room->rate = $req->get('rate');
        $room->roomNo = $req->get('roomNo');
        $room->save();

        
    }
    
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
    
    public function dataTablesAmmendmentTables(Request $request, $id){
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

        $users = DB::table('room_amendments')


        ->join('users as ru', 'room_amendments.userId', '=', 'ru.id')
        ->join('room_infos as rt', 'room_amendments.roomToId', '=', 'rt.id')
        ->join('room_infos as rf', 'room_amendments.roomFromId', '=', 'rf.id')
        ->join('room_reservations', 'room_amendments.roomReservationId', '=', 'room_reservations.id')

        ->join('transactions', 'transactions.id', '=', 'room_reservations.transactionId')
        ->join('clients', 'clients.id', '=', 'transactions.clientId')
        ->join('institutions', 'institutions.id', '=', 'clients.institutionId')
        ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
        ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
        ->join('guests', 'guests.id','=','guest_reservations.guestId')
        ->where('transactions.id','=',$id)
        ->groupby('room_amendments.id')
        ->select(
            [

                DB::raw('
                    concat(guests.firstname," ",guests.familyName)
                    AS guest'),
                'transactions.code',
                DB::raw('
                    institutions.name 
                    AS instiName'),
                DB::raw('
                    rf.roomName as roomFroms'),
                'rt.roomName as roomTo',
                'ru.username',
                'room_amendments.notes'
            ]
        );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }
    
    function accountNoGenerator(){

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

        return $five."".$seven."".$nine."".$alpha[$eight]."".$alpha[$six];
    }


    // public function store(Request $request

    //     $user=Auth::user();
    //     //
    //     $inputs = $request->all();

    //     $institutions = new Institution;
    //     $roomReservTemp = 0;

    //     if($inputs['instiID']==0){
    //         $institutions->name = $inputs['institutionName'];
    //         $institutions->type = $inputs['institutionType'];
    //         $institutions->address = $inputs['institutionAddress'];
    //         $institutions->contactNo = $inputs['institutionContactNo'];
    //         $institutions->email = $inputs['instiEmail'];
    //         $institutions->save();

    //         $institutionsId = $institutions->id;
    //     }
    //     else
    //         $institutionsId = $inputs['instiID'];




    //     $clients = new Client;


    //     if($inputs['clientID']==0){
    //         $clients->firstname = $inputs['firstName'];
    //         $clients->lastName = $inputs['lastName'];
    //         $clients->contactNo = $inputs['contactNo'];
    //         $clients->title = $inputs['title'];
    //         $clients->institutionId= $institutionsId;
    //         $clients->email = $inputs['clientEmail'];
    //         $clients->save();
    //         $clientId = $clients->id;
    //     }
    //     else
    //         $clientId = $inputs['clientID'];



    //     $transaction = new Transaction;
    //     $transaction->code = $this->randomGenerator(); 
    //     $transaction->chargeType = $inputs['chargeType'];
    //     $transaction->clientId = $clientId;
    //     $transaction->madeThru = $inputs['madeThru'];
    //     $transaction->guaranteed = $inputs['guaranteed'];
    //     $transaction->guaranteedNote = $inputs['guaranteedArrangementsNotes'];
    //     $transaction->specialRequestNotes = $inputs['specialRequest'];
    //     $transaction->billingType = $inputs['billArrange'];
    //     $transaction->billingNote = $inputs['billingArrangementsNotes'];
    //     $transaction->institutionId = $institutionsId;
    //     $transaction->save();
    //     $transactionId = $transaction->id;


    //     $roomReservation = new RoomReservation;

    //     $rooms = $inputs['roomId'];

    //     $departDate = date_format(date_create($inputs['departureDate']),"Y-m-d");

    //     foreach($rooms as $r)
    //     {
    //         $roomReservation->transactionId = $transactionId;
    //         $roomReservation->roomId = $r;
    //         $roomReservation->arrivalDate = date_format(date_create($inputs['arrivalDate']),"Y-m-d");
    //     //    $roomReservation->depatureDate = $departDate;
    //         $roomReservation->initialDepartureDate = $departDate;
    //         $roomReservation->checkInTime = $inputs['checkIntimepicker'];
    //         $roomReservation->checkOutTime = $inputs['checkOuttimepicker'];
    //         $roomReservation->discountId = $inputs['discountType'];
    //         $roomReservation->billingType = $inputs['billArrange'];
    //         $roomReservation->billingNote = $inputs['billingArrangementsNotes'];
    //         $roomReservation->save();
    //         $roomReservationId = $roomReservation->id;
    //         $roomReservTemp = $roomReservationId;
    //         $roomReservation = new RoomReservation;
    //     }

    //     $names = "";
    //     $names2 = "";

    //     $inputs = $request->all();


    //     $compFirstNames = $inputs['guestNamesListed'];




    //     foreach($compFirstNames as $cfn)
    //     {

    //         $namesDev= NULL;
    //         $namesDev=explode("#",$cfn);

    //         $guest = new Guest;

    //         if($namesDev[0]==0){

    //             $guest->firstName = $namesDev[2];
    //             $guest->familyName = $namesDev[3];
    //             $guest->contactNo = $namesDev[4];

    //             $guest->save();
    //             $guestId = $guest->id; 
    //         }
    //         else
    //             $guestId=$namesDev[0];


    //          $guestReservation = new GuestReservation;


    //          $guestReservation->guestId = $guestId;
    //          $guestReservation->roomReservationId = $roomReservTemp;
    //          $guestReservation->status = 3;

    //          $guestReservation->save();
    //          $guestReservationId = $guestReservation->id;            

    //     }


    //     //var_dump($inputs);





    //     // $transaction = new transaction;

    //     // $transaction->clientId = $clientId;
    //     // $transaction->type = 1;
    //     // $transaction->status = 1;


    //     // $transaction->save();
    //     // $transactionId = $transaction->id;

    //     // $roomReservation = new roomReservation;

    //     // $roomReservation->transactionId = $transactionId;
    //     // $roomReservation->roomId = 1;
    //     // $roomReservation->arrivalDate = $inputs['arrivalDate'];
    //     // $roomReservation->depatureDate = $inputs['departureDate'];
    //     // $roomReservation->type = 1;
    //     // $roomReservation->status = 1;

    //     // $roomReservation->save();
    //     // $roomReservationId = $roomReservation->id;
    //     $rooms = RoomInfo::all();

    //      $discounts = DB::table('discount_details as dd')->select([
    //         'dd.id',
    //         'dd.name',
    //         'dd.discountValue',
    //         ])->get();

    //     return view('frontdesk.reservation',compact('user','rooms','discounts'));
    // }

    public function storeProceed(Request $request){

        $user=Auth::user();
        //
        $inputs = $request->all();

     //   return $inputs;
        
        $institutions = new Institution;
        $roomReservTemp = 0;

        if($inputs['instiID']==0){
            $institutions->name = $inputs['institutionName'];
            $institutions->type = $inputs['institutionType'];
            $institutions->address = $inputs['institutionAddress'];
            $institutions->contactNo = $inputs['institutionContactNo'];
            $institutions->email = $inputs['instiEmail'];
            $institutions->save();

            $institutionsId = $institutions->id;
        }
        else
            $institutionsId = $inputs['instiID'];

        


        $clients = new Client;


        if($inputs['clientID']==0){
            $clients->firstname = $inputs['firstName'];
            $clients->lastName = $inputs['lastName'];
            $clients->contactNo = $inputs['contactNo'];
            $clients->title = $inputs['title'];
            $clients->institutionId= $institutionsId;
            $clients->email = $inputs['clientEmail'];
            $clients->save();
            $clientId = $clients->id;
        }
        else
            $clientId = $inputs['clientID'];
        
        $transCode = $this->randomGenerator();
        
        $transaction = new Transaction;
        $transaction->code = $transCode; 
        $transaction->clientId = $clientId;
        $transaction->madeThru = $inputs['madeThru'];
        $transaction->guaranteed = 2;
        $transaction->guaranteedNote = "";
        $transaction->specialRequestNotes = $inputs['specialRequest'];
        $transaction->billingType = $inputs['billArrange'];
        $transaction->billingNote = $inputs['billingArrangementsNotes'];
        $transaction->institutionId = $institutionsId;
        $transaction->updatedBy = Auth::user()->id;
        $transaction->chargeType = $inputs["chargeType"];
        $transaction->save();
        $transactionId = $transaction->id;

        
        $roomReservation = new RoomReservation;

        $rooms = $inputs['roomId'];

        
        foreach($rooms as $r)
        {
            $roomReservation->transactionId = $transactionId;
            $roomReservation->roomId = $r;
            $roomReservation->arrivalDate = date_format(date_create($inputs['arrivalDate']),"Y-m-d");
            $roomReservation->depatureDate = date_format(date_create($inputs['departureDate']),"Y-m-d");
            $roomReservation->initialArrivalDate = date_format(date_create($inputs['arrivalDate']),"Y-m-d");
            $roomReservation->initialDepartureDate = date_format(date_create($inputs['departureDate']),"Y-m-d");
            $roomReservation->checkInTime = date("H:i", strtotime($inputs["checkInTime"]));
            $roomReservation->checkOutTime = date("H:i", strtotime($inputs["checkOutTime"]));

            $roomReservation->discountId = $inputs['discountType'.$r];

            $rt = DB::table('room_infos as ri')
            ->where('ri.id','=',$r)
            ->join('room_types as rt','rt.id','=','ri.type')
            ->select(['rt.room_rate'])
            ->first();



            $ds = DiscountDetails::findOrFail($inputs['discountType'.$r]);

            if($ds->type == 1)
                $roomReservation->FinalRoomRate = $rt->room_rate-(($rt->room_rate/1.19)*$ds->discountValue);
            if($ds->type == 2)
                $roomReservation->FinalRoomRate = $rt->room_rate-$ds->discountValue;

            $roomReservation->billingType = $inputs['billArrange'];
            $roomReservation->billingNote = $inputs['billingArrangementsNotes'];
            $roomReservation->save();
            $roomReservationId = $roomReservation->id;
            $roomReservTemp = $roomReservationId;
            $roomReservation = new RoomReservation;
        }

        $names = "";
        $names2 = "";
        
        $inputs = $request->all();
        $compFirstNames = NULL;
        
        if($request->get('guestNamesListed'))
            $compFirstNames = $inputs['guestNamesListed'];
        

        if($compFirstNames){
            foreach($compFirstNames as $cfn)
            {

                $namesDev= NULL;
                $namesDev=explode("#",$cfn);

                $guest = new Guest;

                if($namesDev[0]==0){

                    $guest->firstName = $namesDev[2];
                    $guest->familyName = $namesDev[3];
                    $guest->contactNo = $namesDev[4];

                    $guest->save();
                    $guestId = $guest->id; 
                }
                else
                    $guestId=$namesDev[0];


                $guestReservation = new GuestReservation;


                $guestReservation->guestId = $guestId;
                $guestReservation->roomReservationId = $roomReservTemp;
                $guestReservation->status = 3;

                $guestReservation->save();
                $guestReservationId = $guestReservation->id;            

            }
        }

        

        $rooms = RoomInfo::all();
        
        $discounts = DB::table('discount_details as dd')->select([
            'dd.id',
            'dd.name',
            'dd.discountValue',
        ])->get();
        
      //  return $inputs;
        
        return redirect()->route('frontdesk.guestRegistration', ['reservID' => $transCode]);

     //    return $inputs;
    }
    

    public function getCalendarDetails(){

        $rooms = RoomReservation::join('room_infos as ri','ri.id','=','room_reservations.roomId')
        ->join('room_types as rt','rt.id','=','ri.type')
        ->join('transactions as t','t.id','=','room_reservations.transactionId')
        ->join('clients as c','c.id','=','t.clientId')
        ->join('institutions as i','i.id','=','t.institutionId')
        ->where('t.status','!=',2)
     //   ->where('room_reservations.reserveType','!=',1)
        ->select([
            'room_reservations.id as riId',
            'ri.id as roomId',
            'ri.roomName',
            'rt.name as roomType',
            'room_reservations.arrivalDate',
            'room_reservations.depatureDate',
            'room_reservations.checkInTime',
            'room_reservations.checkOutTime',
            'room_reservations.occupied_status',
            'room_reservations.reserveType',
            't.guaranteed',
            'c.lastName',
            't.code',
            'i.name as institutionName',
        ])
        ->get();
        return $rooms;
    }

    public function addRoomsToBooking(Request $request){



       $inputs = $request->all();

       $rooms = $inputs["roomId"];
       $roomReservation = new RoomReservation;

       foreach($rooms as $r)
       {
        $roomReservation->transactionId = $inputs['transactionID'];
        $roomReservation->roomId = $r;
        $roomReservation->arrivalDate = date_format(date_create($inputs['arrival2']),"Y-m-d");
        $roomReservation->initialArrivalDate = date_format(date_create($inputs['arrival2']),"Y-m-d");
        $roomReservation->depatureDate = date_format(date_create($inputs['departure2']),"Y-m-d");
        $roomReservation->initialDepartureDate = date_format(date_create($inputs['departure2']),"Y-m-d");
        $roomReservation->checkInTime = $inputs['checkInTime'];
        $roomReservation->checkOutTime = $inputs['checkOutTime'];

        $rt = DB::table('room_infos as ri')
        ->where('ri.id','=',$r)
        ->join('room_types as rt','rt.id','=','ri.type')
        ->select(['rt.room_rate'])
        ->first();


        $ds = DiscountDetails::findOrFail($inputs['discountType'.$r]);

        if($ds->type == 1)
            $roomReservation->FinalRoomRate = $rt->room_rate-($rt->room_rate*$ds->discountValue);
        if($ds->type == 2)
            $roomReservation->FinalRoomRate = $rt->room_rate-$ds->discountValue;


        $roomReservation->discountId = $inputs['discountType'.$r];
        $roomReservation->billingType = $inputs['billingType'];
        $roomReservation->billingNote = $inputs['billingNote'];
        $roomReservation->save();
        $roomReservationId = $roomReservation->id;
        $roomReservTemp = $roomReservationId;
        $roomReservation = new RoomReservation;
    }

    return redirect()->route('frontdesk.guestRegistration', ['reservID' => $inputs["code"]]);



}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function checkRoomAvailability(Request $request){
       $arrival = date_format(date_create($request->get('arrival')),"Y-m-d");
       $departure = date_format(date_create($request->get('departure')),"Y-m-d");

       $results = array();

     //    $query = DB::select('SELECT * FROM room_reservations WHERE arrivalDate >="'.$arrival.'" and depatureDate <= "'.$departure.'"');

        ///original available rooms query

       $query = DB::table('room_reservations')
       ->whereBetween('arrivalDate',[$arrival,$departure])
       ->orWhereBetween('depatureDate',[$arrival,$departure])
       ->get();

       $query2 = DB::table('room_reservations')
       ->whereDate('arrivalDate','<',$arrival)
       ->whereDate('depatureDate','>',$arrival)
       ->whereDate('arrivalDate','<',$departure)
       ->whereDate('depatureDate','>',$departure)
       ->get();

       $departingRooms = DB::table('room_reservations as rr')
       ->join('room_infos as ri','rr.roomId','=','ri.id')
       ->join('room_types as rt','rt.id','=','ri.type')
       ->join('transactions as t','t.id','=','rr.transactionId')

       ->whereDate('rr.depatureDate','=',$arrival)
       ->groupBy('rr.id')
       ->select(
        [
            'rr.id',
            'ri.roomName',
            'ri.id as roomId',
            'rt.name as roomType',
            'rr.depatureDate',
            DB::raw('
                case ri.status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as status'),
            't.code',
            DB::raw('
                case rr.occupied_status
                when "1" then "Checked In"
                when "2" then "Checked Out"
                else "BLO"
                end as remarks'),

        ]
    )
       ->orderBy('roomType')
       ->get();

       $arrivingRooms = DB::table('room_reservations as rr')
       ->join('room_infos as ri','rr.roomId','=','ri.id')
       ->join('room_types as rt','rt.id','=','ri.type')
       ->join('transactions as t','t.id','=','rr.transactionId')
       ->whereDate('rr.arrivalDate','=',$departure)
       ->groupBy('rr.id')
       ->select(
        [
            'rr.id',
            'ri.roomName',
            'ri.id as roomId',
            'rt.name as roomType',
            'rr.arrivalDate',
            DB::raw('
                case ri.status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as status'),
            't.code',
            DB::raw('
                case rr.occupied_status
                when "1" then "Checked In"
                when "2" then "Checked Out"
                else "BLO"
                end as remarks'),
        ]
    )
       ->orderBy('roomType')
       ->get();

       foreach($query as $q){
        if(!in_array($q->roomId, $results))
            array_push($results,$q->roomId);
    }

    foreach($query2 as $q2){
        if(!in_array($q2->roomId, $results))
            array_push($results,$q2->roomId);
    }

        // $query3 = DB::table('room_reservations as rr')
        //         ->join('room_infos as ri','ri.id','=','rr.roomId')
        //         ->where('rr.depatureDate','=',date('Y-m-d'))
        //         ->where('ri.status','=',0)
        //         ->where('ri.cleanStatus','=',2)
        //         ->select([
        //             'rr.roomId'
        //             ])
        //         ->get();

    $query4 = DB::table('room_infos as ri')
    ->where('ri.status','=',4)
    ->where('ri.cleanStatus','=',4)
    ->get();

   //      // $query5 = DB::table('room_infos as ri')
   //      //         ->where('ri.status','=',2)
   //      //         ->where('ri.cleanStatus','=',1)
   //      //         ->get();




    foreach($query4 as $q4){
        array_push($results,$q4->id);

    }

    // foreach($query5 as $q){
    //          array_push($results, $q->id);
    // }
    // $roomsQuery3 = array();
    //    foreach($query3 as $q3){

    //             array_push($roomsQuery3, $q3->roomId);
    //     }
    //     $finalResult = array();

        //return $roomsQuery3;

        // foreach($results as $r)
        // {
        //     if(!in_array($r, $roomsQuery3))
        //         array_push($finalResult, $r);

        // }


    return collect(["results"=>$results,"departingRooms" =>$departingRooms,"arrivingRooms"=>$arrivingRooms]);


}



public function checkOut(Request $req){

   $user=Auth::user();
   $code = $req->get('reservID');
   $client = 'NONE';
   $guests = NULL;
   $rooms = NULL;
   $registExist = false;
   $transactionId = NULL;

   $changeDepart = date_format(date_create(date('F j, Y')),"Y-m-d");

   if($code){

    $roomReserveID = $req->get('reserveId');

    DB::table('room_reservations as rr')->where('rr.id','=',$roomReserveID)->join('guest_reservations as gr','rr.id','=','gr.roomReservationId')->update(['gr.status'=>4]);

    DB::table('room_reservations as rr')->where('rr.id','=',$roomReserveID)->update(['rr.status'=>1]);



    DB::table('room_reservations as rr')->where('rr.id','=',$roomReserveID)->join('room_infos as r','r.id','=','rr.roomId')->update(['r.status'=>2,'r.cleanStatus'=>1,'rr.occupied_status'=>2,'rr.depatureDate'=>$changeDepart]);

    $registExist = true;
    $transaction = DB::table('transactions')->where('code',$code)->first();

    $transactionId = $transaction->id;

    $client = $transaction->clientId;

    $rooms = DB::table('room_infos')
    ->leftJoin('room_reservations','room_infos.id','=','room_reservations.roomId')
    ->leftJoin('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->leftJoin('guests','guests.id','=','guest_reservations.guestId')
    ->join('transactions',function($join) use ($transactionId)
    {
        $join->on( 'room_reservations.transactionId','=','transactions.id')
        ->where('transactions.id', '=', $transactionId);
    })
    ->select(
        [
            'room_infos.id',
            'room_reservations.id as reserveid',
            'room_infos.roomName',
            'guests.firstName as firstName',
            'guest_reservations.status as guest_status',
            'guest_reservations.id as gReservId',
            'guests.id as guestId',
            'guests.familyName as lastName',
        ]
    )
    ->get();


    $bookedRooms=[];

    foreach($rooms as $r){
        if(!in_array($r->roomName,$bookedRooms))
            array_push($bookedRooms, $r->roomName);
    }


}



    //    $activeReservations = DB::

        //code goes here...
return view('frontdesk.guest-folio',compact('user','client','transactionId','rooms','bookedRooms','registExist','code'));
}


public function checkOutAllRooms(Request $req){

   $user=Auth::user();

   $changeDepart = date_format(date_create(date('F j, Y')),"Y-m-d");
   $transactionId = $req->get('transactionID');

   DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->join('room_infos as r','r.id','=','rr.roomId')->update(['r.status'=>2,'r.cleanStatus'=>1,'rr.occupied_status'=>2,'rr.depatureDate'=>$changeDepart,'rr.initialDepartureDate'=>$changeDepart]);

   DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->join('guest_reservations as gr','rr.id','=','gr.roomReservationId')->update(['gr.status'=>4]);

   DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->update(['rr.status'=>1]);




}

public function checkOutGuest(Request $req){

    $roomReserveId = $req->get('roomReserveId');

    $changeDepart = date_format(date_create(date('F j, Y')),"Y-m-d");

    DB::table('room_reservations as rr')->where('rr.id','=',$roomReserveId)->join('room_infos as r','r.id','=','rr.roomId')->update(['r.status'=>2, 'r.cleanStatus'=>1,'rr.occupied_status'=>2,'rr.status'=>1,'rr.depatureDate'=>$changeDepart,'rr.initialDepartureDate'=>$changeDepart]);

    GuestReservation::where('roomReservationId','=',$roomReserveId)->update(['status'=>4]);





       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);

        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);
        //return response()->json($roomReserve);

}


public function billOut(Request $req){

   $user=Auth::user();
   $code = $req->get('reservID');
   $totalBill = $req->get('totalBill');
   $client = 'NONE';
   $guests = NULL;
   $rooms = NULL;
   $registExist = false;
   $transactionId = NULL;

   $changeDepart = date_format(date_create(date('F j, Y')),"Y-m-d");

   if($code){


    $registExist = true;
    $transaction = DB::table('transactions')->where('code',$code)->first();

    $transactionId = $transaction->id;

    DB::table('transactions as t')->where('t.id','=',$transactionId)->update(["totalTransactionBill" => floatval($totalBill),"status"=>1]);

    $client = $transaction->clientId;

    $rooms = DB::table('room_infos')
    ->leftJoin('room_reservations','room_infos.id','=','room_reservations.roomId')
    ->leftJoin('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->leftJoin('guests','guests.id','=','guest_reservations.guestId')
    ->join('transactions',function($join) use ($transactionId)
    {
        $join->on( 'room_reservations.transactionId','=','transactions.id')
        ->where('transactions.id', '=', $transactionId);
    })
    ->select(
        [
            'room_infos.id',
            'room_reservations.id as reserveid',
            'room_infos.roomName',
            'guests.firstName as firstName',
            'guest_reservations.status as guest_status',
            'guest_reservations.id as gReservId',
            'guests.id as guestId',
            'guests.familyName as lastName',
        ]
    )
    ->get();


    $bookedRooms=[];

    foreach($rooms as $r){
        if(!in_array($r->roomName,$bookedRooms))
            array_push($bookedRooms, $r->roomName);
    }


}



    //    $activeReservations = DB::

        //code goes here...
return view('frontdesk.guest-folio',compact('user','client','transactionId','rooms','bookedRooms','registExist','code'));
}

public function getRoomBlockedDetails($id){

   $roomID = $id;

   $guestsRes = DB::table('guests')
   ->leftJoin('guest_reservations','guests.id','=','guest_reservations.guestId')
   ->leftJoin('room_reservations','room_resservations.id','=','guest_reservations.roomReservationId')
   ->leftJoin('transactions','transactions.id','=','room_reservations.transactionId')
   ->join('room_infos',function($join) use ($roomID)
   {
    $join->on( 'room_reservations.roomId','=','room_infos.id')
    ->where('room_infos.id', '=', $roomID);
})
   ->select(
    [

        'guests.firstNaame',


    ]
)
   ->get();
}




public function show($id){
        //
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
    
    //ATOA DEFINED FUNCTIONS
    
    public function reservation(){


        //get user....
        //see reservation view on how to call user...
        $user=Auth::user();
        
        $rooms = DB::table('room_infos')
        ->join('room_types','room_infos.type','=','room_types.id')
        ->where('room_infos.id','!=',37)
        ->select([
            'room_infos.roomName',
            'room_infos.roomNo',
            'room_infos.type',
            'room_infos.id',
            'room_types.name as roomType',
            'room_types.room_rate as rate',
        ])
        ->get();
        
        
        $accTypes = DB::table('account_types as acc')->select([
            'acc.id',
            'acc.name',
        ])->get();
        $discounts = DB::table('discount_details as dd')->select([
            'dd.id',
            'dd.name',
            'dd.discountValue',
        ])->get();
        //code goes here...


        return view('frontdesk.reservation',compact('user','rooms','discounts','accTypes'));
    }
    
    public function reservationList(){

        $user=Auth::user();
        
        //code goes here...
        return view('frontdesk.reservation-list',compact('user'));
    }
    
    public function dataTables(){
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);
        $users = DB::table('Clients')
        ->join('Transactions', 'Clients.id', '=', 'Transactions.clientId')
        ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
        ->join('institutions', 'institutions.id', '=', 'Clients.institutionId')
        ->select(
            [
                'Clients.id',
                'Clients.firstname',
                'Clients.lastname',
                'Transactions.specialRequestNotes',
                'Transactions.guaranteedNote',
                DB::raw('institutions.name AS instiName'),
                DB::raw('CONCAT(room_reservations.arrivalDate, " - ", room_reservations.depatureDate) AS dateTransaction'),
                'Transactions.created_at',
                'Transactions.updated_at'
            ]
        )
        ->groupBy('Transactions.id');


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }


    public function dataTablesDailyArrivalList(){
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);
        $users = DB::table('Clients')
        ->join('Transactions', 'Clients.id', '=', 'Transactions.clientId')
        ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
        ->join('institutions', 'institutions.id', '=', 'Clients.institutionId')
        ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
        ->where('room_reservations.arrivalDate','=','curdate()')
        ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
        ->join('guests', 'guests.id','=','guest_reservations.guestId')
        ->groupby('room_infos.id')
        ->select(
            [
                'Clients.id',
                'Clients.firstname',
                'room_infos.roomName',
                DB::raw('
                    institutions.name 
                    AS instiName'),
                DB::raw('
                    case room_infos.type
                    when "1" then "Family Suites"
                    when "2" then "Single Room"
                    end as RoomType
                    '),

                DB::raw('
                    case room_infos.type
                    when "1" then "1200"
                    when "2" then "600"
                    end as RoomTypeRate'),
                DB::raw('
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ",")
                    AS guestNames'),

                DB::raw('
                    case room_reservations.billingType
                    when "0" then "Guest Account"
                    when "2" then "GTD Company"
                    end as billingType'),
                
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                'Transactions.created_at',
                'Transactions.updated_at'
            ]
        );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }


    public function dataTablesDailyDepatureList(){
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);
        $users = DB::table('Clients')
        ->join('Transactions', 'Clients.id', '=', 'Transactions.clientId')
        ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
        ->join('institutions', 'institutions.id', '=', 'Clients.institutionId')
        ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
        ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
        ->join('guests', 'guests.id','=','guest_reservations.guestId')
        ->groupby('room_infos.id')
        ->select(
            [
                'room_reservations.id',
                'Clients.firstname',
                'room_infos.roomName',
                DB::raw('
                    institutions.name 
                    AS instiName'),
                DB::raw('
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ",")
                    AS guestNames'),
                DB::raw('
                    dateDiff(room_reservations.depatureDate,room_reservations.arrivalDate)
                    AS dateNights'),
                DB::raw('
                    case room_infos.type
                    when "1" then "Family Suites"
                    when "2" then "Single Room"
                    end as RoomType
                    '),

                DB::raw('
                    case room_infos.type
                    when "1" then "1200"
                    when "2" then "600"
                    end as RoomTypeRate'),

                DB::raw('
                    case room_reservations.billingType
                    when "0" then "Guest Account"
                    when "2" then "GTD Company"
                    end as billingType'),
                
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                'Transactions.created_at',
                'Transactions.updated_at'
            ]
        );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }




    public function dataTablesRoomOccupancyBulletinList(){        
        $users = DB::table('Clients')
        ->join('Transactions', 'Clients.id', '=', 'Transactions.clientId')
        ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
        ->join('institutions', 'institutions.id', '=', 'Clients.institutionId')
        ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
        ->where('room_reservations.arrivalDate','>=','curdate()')
        ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
        ->join('guests', 'guests.id','=','guest_reservations.guestId')
        ->select(
            [
                'room_reservations.id',
                'room_infos.roomName',
                DB::raw('"" AS blanks'),
                
                DB::raw('
                    case room_infos.type
                    when "1" then "Family Suites"
                    when "2" then "Single Room"
                    end as RoomType
                    '),


                DB::raw('
                    if(room_reservations.arrivalDate = curdate(), 
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ","), 
                    "&nbsp")
                    as guestNamesArrival'),


                DB::raw('
                    if(room_reservations.arrivalDate = curdate(), 
                    Clients.firstname, 
                    "&nbsp")
                    as firstnameArival'),

                DB::raw('
                    if(room_reservations.arrivalDate = curdate(), 
                    case room_infos.type
                    when "1" then "1200"
                    when "2" then "600"
                    end, "&nbsp") as RoomTypeRateArival'),                
                
                DB::raw('
                    if(room_reservations.arrivalDate = curdate(),
                    case room_reservations.billingType
                    when "0" then "Guest Account"
                    when "2" then "GTD Company"
                    end, 
                    "&nbsp") as billingTypeArival
                    '),   
                
                DB::raw('
                    if(room_reservations.arrivalDate = curdate(),
                    room_reservations.arrivalDate,
                    "&nbsp") as arrivalDateArival
                    '),

                DB::raw('
                    if(room_reservations.arrivalDate = curdate(),
                    room_reservations.depatureDate, "&nbsp") as depatureDateArival'),



                DB::raw('
                    if((curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY)), 
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ","), 
                    "&nbsp")
                    as guestNamesStaying'),

                DB::raw('
                    if((curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY)), 
                    Clients.firstname, "&nbsp") as firstnameStaying'),

                DB::raw('
                    if(curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY) , case room_infos.type
                    when "1" then "1200"
                    when "2" then "600"
                    end, "&nbsp") as RoomTypeRateStaying'),                

                
                DB::raw('
                    if(curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY), 
                    case room_reservations.billingType
                    when "0" then "Guest Account"
                    when "2" then "GTD Company"
                    end, "&nbsp") as billingTypeStaying'),   
                
                DB::raw('
                    if(curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY),
                    room_reservations.arrivalDate, "&nbsp") as arrivalDateStaying'),

                DB::raw('
                    if(curdate() between DATE_ADD(room_reservations.arrivalDate, INTERVAL 1 DAY)  and DATE_SUB(room_reservations.depatureDate,INTERVAL 1 DAY),
                    room_reservations.depatureDate, "&nbsp") as depatureDateStaying'),




                DB::raw('
                    if(curdate() = room_reservations.depatureDate, 
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ","), 
                    "&nbsp")
                    as guestNamesDepature'),


                DB::raw('
                    if(curdate() = room_reservations.depatureDate, Clients.firstname, "&nbsp") as firstnameDepature'),

                DB::raw('
                    if(curdate() = room_reservations.depatureDate,
                    case room_infos.type
                    when "1" then "1200"
                    when "2" then "600"
                    end, "&nbsp") as RoomTypeRateDepature'),                

                
                DB::raw('
                    if(curdate() = room_reservations.depatureDate, case room_reservations.billingType
                    when "0" then "Guest Account"
                    when "2" then "GTD Company"
                    end, "&nbsp") as billingTypeDepature'),   
                
                DB::raw('
                    if(curdate() = room_reservations.depatureDate, room_reservations.arrivalDate, "&nbsp") as arrivalDateDepature'),

                DB::raw('
                    if(curdate() = room_reservations.depatureDate, room_reservations.depatureDate, "&nbsp") as depatureDateDepature'),



            ]
        );


return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function addDownpayment(Request $req){

    $roomReserveId = $req->get('roomReserveId');
    $noOfDays = $req->get('noOfdays');

    $roomReserve = RoomReservation::findOrFail($roomReserveId);

    $numDays= $roomReserve->noOfdays;

    $dateMain = date_format(date_create($req->get('dateMain')),"Y-m-d");



    if($dateMain){
        $date_query = $dateMain;
    }
    else
        $date_query = date('Y-m-d');
    RoomReservation::where('id','=',$roomReserveId)->update(['noOfDays'=>$numDays+$noOfDays]);


    $blockedRoomInfo = DB::table('transactions')
    ->join('room_reservations','room_reservations.transactionId','=','transactions.id')
    ->join('discount_details','room_reservations.discountId','=','discount_details.id')
    ->join('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->join('guests','guests.id','=','guest_reservations.guestId')
    ->join('room_infos','room_infos.id','=','room_reservations.roomId')
    ->join('room_types','room_infos.type','=','room_types.id')
    ->where('room_infos.id','=',$roomReserve->roomId)
    ->where('guest_reservations.status','=',2)
    ->where('room_reservations.arrivalDate','<=',$date_query)
    ->where('room_reservations.depatureDate','>=',$date_query)

    ->select([
        'transactions.code',
        'transactions.id',
        'room_types.name',
        'room_infos.roomName',
        'guests.firstName',
        'guests.familyName',
        'discount_details.name as discountName',
        'discount_details.type as discountType',
        'discount_details.discountValue',
        'room_types.room_rate as rate',
        'guest_reservations.id as gReservId', 'room_reservations.arrivalDate',
        'room_reservations.id as roomReservId',  'room_reservations.noOfDays',  'room_reservations.depatureDate'

    ])
    ->get();
       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);

        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);
    return response()->json($blockedRoomInfo);

}


public function guaranteeDownpayment(Request $req){

    $downpayment = $req->get('downpayment');
    $transID = $req->get('transID');


    Transaction::where('id','=',$transID)->update(['downpayment'=>$downpayment,'guaranteed'=>1]);

    return $transID;
}

public function dailyGuestArrival(){

    $user = Auth::user();

    return view('frontdesk.daily-guest-arrival',compact('user'));
}

public function checkInGuest(Request $req){

    $roomReserveId = $req->get('roomReserveId');

    $changeArriv = date_format(date_create(date('F j, Y')),"Y-m-d");



    DB::table('room_reservations as rr')
    ->where('rr.id','=',$roomReserveId)
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->update(['r.status'=>1, 'r.cleanStatus'=>3,'rr.arrivalDate'=>$changeArriv,'rr.initialArrivalDate'=>$changeArriv]);

    $roomReserv = RoomReservation::where('id','=',$roomReserveId)->update(['occupied_status'=>1,'noOfdays'=>1]);

    GuestReservation::where('roomReservationId','=',$roomReserveId)->where('status','=',1)->update(['status'=>2]);





       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);

        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);
      //  return response()->json($roomReserve);

}

public function checkInAllGuest(Request $req){

    $transactionId = $req->get('transactionID');

    $changeArriv = date_format(date_create(date('F j, Y')),"Y-m-d");

    DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->join('room_infos as r','r.id','=','rr.roomId')->update(['r.status'=>1, 'r.cleanStatus'=>3,'rr.arrivalDate'=>$changeArriv,'rr.initialArrivalDate'=>$changeArriv]);

    RoomReservation::where('transactionId','=',$transactionId)->update(['occupied_status'=>1]);


    DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')->where('gr.status','=',1)->update(['gr.status'=>2]);
       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);

        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);

     //   $newRoomReserv = RoomReservation::where('transactionId','=',$transactionId)->first();

     //   return $newRoomReserv;

}

public function noShow(Request $req){

    $transId = $req->get('transId');

    Transaction::where('id','=',$transId)->update(['status'=>2]);

       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);

        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);
    return response()->json($transId);

}

public function roomBillView($id){

    $roomReserv = RoomReservation::findOrFail($id);
    $roomReservID = $roomReserv->id;

    $amendments = DB::table('room_amendments as ra')
    ->join('transactions as t','ra.transactionId','=','t.id')
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->where('ra.roomReservationId','=',$roomReservID)
    ->select([

        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.id as idAmend',
        'dd.discountValue as discountValueAmend',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();

    $transactions = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->where('rr.id','=',$roomReservID)
    ->join('guests as g','g.id','=','gr.guestId')
    ->join('discount_details as dd','rr.discountId','=','dd.id')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->join('room_types as rt','r.type','=','rt.id')
    ->select([
        't.code',
        'g.firstName',
        'g.familyName',
        'g.account_id',
        'g.houseNo',
        'g.brgy',
        'g.city',
        'g.country',
        'g.contactNo',
        'i.name as instiName',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.id',
        'rr.noOfDays',
        'rt.room_rate as rate',
        'rt.id',
        'dd.name as discountName',
        'dd.id',
        'dd.discountValue',
        'gr.guest_registration_no',
        'gr.id',
        'gr.billType',
        'gr.chargeType',
        'r.roomName',
        'rt.name as roomType',
    ])->get();


    $charges = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->where('rr.id','=',$roomReservID)
    ->join('room_charges as rc','rc.guestReservationId','=','gr.id')
    ->join('guests as g','g.id','=','gr.guestId')
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
    ])->get();


    $roomRes = collect(["amendments" => $amendments,"guest" => $transactions,"charges"=>$charges]);

//         $roomRes = DB::table('transactions')
//                        ->leftJoin('room_reservations','transactions.id','=','room_reservations.transactionId')
//                          ->join('discount_details','room_reservations.discountId','=','discount_details.id')
//                        ->leftJoin('room_amendments as ra','transactions.id','=','ra.transactionId')
//                        ->join('room_infos as ri2','ra.roomId','=','ri2.id')
//                        ->join('room_types as rt2','ri2.type','=','rt2.id')
//                        ->leftJoin('clients','clients.id','=','transactions.clientId')
//                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
//                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
//                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
//                        ->join('guest_reservations',function($join) use ($roomReservID)
//                            {
//                                $join->on( 'guest_reservations.roomReservationId','=','room_reservations.id')
//                                        ->where('room_reservations.id', '=', $roomReservID)
//                                        ->where('guest_reservations.status','!=',3);
//                            })
//                        ->leftJoin('room_charges','room_charges.guestReservationId','=','guest_reservations.id')
//             ->leftJoin('guests','guest_reservations.guestId','=','guests.id')->select(
//                                [
//                                'transactions.id',
//                                'guests.firstName',
//                                'guests.familyName',
//                                'guests.account_id',
//                                'guests.id',
//                                'institutions.name as instiName',
//                                'room_reservations.arrivalDate',
//                                'room_reservations.depatureDate',
//                                 'room_reservations.noOfDays',
//                                'room_charges.id as rcID',
//                                'ra.noOfDays as amendDays',
//                                'room_types.room_rate as rate',
//                                'ra.id as amendId',
//                                'ra.created_at as amendDate',
//                                'rt2.room_rate as amendRate',
//                                'ri2.roomName as amendRoomName',
//                                'rt2.name as amendRoomType',
//                                'discount_details.name as discountName',
//                                'discount_details.discountValue',
//                                'guest_reservations.guest_registration_no',
//                                'transactions.code',
//                                'guests.houseNo',
//                                'guests.brgy',
//                                'guests.city',
//                                'guests.country',
//                                'guests.contactNo',
//                                'guest_reservations.billType',
//                                'guest_reservations.chargeType',
//                                'transactions.specialRequestNotes',
//                                'room_infos.roomName',
//                                'room_types.name as roomType',
//                                'room_charges.item_name',
//                                'room_charges.created_at as chargeCreated',
//                                'room_charges.price',
//                                'room_charges.os_id',
//                                'room_charges.account_type',
//                                ]
//                                )
//                        ->get();


    $results = array();

    return $roomRes;
}

public function dataTablesAddGuest(){
    $users = DB::table('guests as g')
    ->select([
        'g.id',
        'g.familyName',
        'g.firstName',
        'g.contactNo'
    ]);

    return Datatables::of($users)->make(true);
}
public function dataTablesGuestList()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

    $users = DB::table('guests')
    ->select(
        [
            'guests.id',
            DB::raw('
                concat(guests.firstName," ",guests.familyName)
                AS name'),
            DB::raw('
                contactNo
                AS contactNo'),


        ]
    );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function removeGuest($id){
    $guest = DB::table('guest_reservations as gr')
    ->join('guests as g','gr.guestId','=','g.id')
    ->where('gr.id','=',$id)
    ->select([
        'g.firstName',
        'g.familyName',
    ])->first();

    return response()->json($guest);
}

public function removeRoom($id){

    $room = DB::table('room_reservations as rr')
    ->where('rr.id','=',$id)
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->join("room_types as rt",'rt.id','=','r.type')
    ->select([
        'r.roomName',
        'rt.name as roomType',
        'r.status',
    ])->first();




    

    return response()->json($room);
}

public function confirmRemoveGuest($id){
    $guestReserv = GuestReservation::findOrFail($id);

    $guestReserv->delete();

}

public function confirmRemoveRoom($id){
    $roomReserv = RoomReservation::findOrFail($id);
    $tempRoomReservID = $roomReserv->id;


    $room = RoomInfo::findOrFail($roomReserv->roomId);

    if($room->status == 1 ){


        $room->status = 0;
        $room->cleanStatus = 2;

        $room->save();
    }


    $transactionID = Transaction::findOrFail($roomReserv->transactionId);

    $roomReserv->delete();

    $anotherRoom = DB::table('transactions as t')
    ->where('t.id','=',$transactionID)
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->select(['rr.id',])->first();


    DB::table('guest_reservations as gr')
    ->where('gr.roomReservationId','=',$tempRoomReservID)->update(['gr.status' => 3,'gr.roomReservationId'=>$anotherRoom->id]);





    return $anotherRoom;



}

public function addGuestSave(Request $req){

    $transID = $req->get('transID');

    $transaction = Transaction::findOrFail($transID);

    $roomReserv = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$transID)
    ->first();



    $inputs = $req->all();


    $compFirstNames = $inputs['guestNamesListed'];

    //    return $compFirstNames;


    foreach($compFirstNames as $cfn)
    {

        $namesDev= NULL;
        $namesDev=explode("#",$cfn);

        $guest = new Guest;

        if($namesDev[0]==0){

            $guest->firstName = $namesDev[2];
            $guest->familyName = $namesDev[3];
            $guest->contactNo = $namesDev[4];

            $guest->save();
            $guestId = $guest->id; 
        }
        else
            $guestId=$namesDev[0];


        $guestReservation = new GuestReservation;


        $guestReservation->guestId = $guestId;
        $guestReservation->roomReservationId = $roomReserv->id;
        $guestReservation->status = 3;

        $guestReservation->save();
        $guestReservationId = $guestReservation->id;            

    }

      //  return $guestReservationId;
    return redirect()->route('frontdesk.guestRegistration', ['reservID' => $transaction->code]);
    
}

public function extendStay(Request $req){

    $dateExtend = date_format(date_create($req->get('dateExtend')),"Y-m-d");
    $id = $req->get('roomReserve');


    RoomReservation::where('id','=',$id)->update(['depatureDate'=>$dateExtend]);
    $roomReserv = RoomReservation::findOrFail($id);
    return response()->json($roomReserv);

}

public function billStatementView($id){
    $transID = $id;

    $amendments = DB::table('room_amendments as ra')
    ->join('transactions as t','ra.transactionId','=','t.id')
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->where('t.id','=',$transID)
    ->select([
        'ra.FinalRoomRate',
        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.discountValue',
        'dd.type as discountType',
        'dd.id as idAmend',
        'ra.arrivalDate as amendArriv',
        'ra.depatureDate as amendDepart',
        'dd.discountValue as discountValueAmend',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();

    $transactions = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->where('t.id','=',$transID)
    ->join('discount_details as dd','rr.discountId','=','dd.id')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->join('room_types as rt','r.type','=','rt.id')
    ->select([
        't.code',
        't.status as transStatus',
        'i.name as instiName',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.created_at as roomReservCreated',
        'rr.updated_at as roomReservUpdated',
        'rr.initialDepartureDate',
        'rr.id',
        'rr.noOfDays',
        'rr.FinalRoomRate',
        'rt.room_rate as rate',
        'rt.id',
        'dd.name as discountName',
        'dd.id',
        'dd.discountValue',
        'dd.type as discountType',
        'r.roomName',
        'rt.name as roomType',
    ])->get();


    $charges = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->where('t.id','=',$transID)
    ->join('room_charges as rc','rc.guestReservationId','=','gr.id')
    ->join('guests as g','g.id','=','gr.guestId')
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
        'g.firstName',
        'g.familyName',
        'g.account_id',
        'g.houseNo',
        'g.brgy',
        'g.city',
        'g.country',
        'g.contactNo',
    ])->get();


    $transactionDetails = collect(["amendments" => $amendments,"guest" => $transactions,"charges"=>$charges]);

//        $transactionDetails = DB::table('room_charges')
//                        ->leftJoin('guest_reservations','room_charges.guestReservationId','=','guest_reservations.id')
//                        ->leftJoin('guests','guest_reservations.guestId','=','guests.id')
//                        ->leftJoin('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
//                         ->join('transactions',function($join) use ($transID)
//                            {
//                                $join->on( 'room_reservations.transactionId','=','transactions.id')
//                                        ->where('transactions.id', '=', $transID);
//                            })
//                        ->leftJoin('clients','clients.id','=','transactions.clientId')
//                        ->join('discount_details','room_reservations.discountId','=','discount_details.id')
//                        ->leftJoin('room_amendments as ra','transactions.id','=','ra.transactionId')
//                        ->join('room_infos as ri2','ra.roomId','=','ri2.id')
//                        ->join('room_types as rt2','ri2.type','=','rt2.id')
//                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
//                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
//                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
//             ->select(
//                                [
//                                'transactions.id',
//                                'guests.firstName',
//                                'guests.familyName',
//                                'guests.account_id',
//                                'guests.id',
//                                'institutions.name as instiName',
//                                'room_reservations.arrivalDate',
//                                'room_reservations.depatureDate', 
//                                 'room_reservations.noOfDays',
//                                'room_charges.id as rcID',
//                                'ra.noOfDays as amendDays',
//                                'room_types.room_rate as rate',
//                                'ra.id as amendId',
//                                'ra.created_at as amendDate',
//                                'rt2.room_rate as amendRate',
//                                'ri2.roomName as amendRoomName',
//                                'rt2.name as amendRoomType',
//                                'discount_details.name as discountName',
//                                'discount_details.discountValue',
//                                'guest_reservations.guest_registration_no',
//                                'transactions.code',
//                                'guests.houseNo',
//                                'guests.brgy',
//                                'guests.city',
//                                'guests.country',
//                                'guests.contactNo',
//                                'guest_reservations.billType',
//                                'guest_reservations.chargeType',
//                                'transactions.specialRequestNotes',
//                       
//                                'room_infos.roomName',
//                                'room_types.name as roomType',
//                                'room_charges.item_name',
//                                'room_charges.created_at as chargeCreated',
//                                'room_charges.price',
//                                'room_charges.os_id',
//                                'room_charges.account_type',
//                                ]
//                                )
//                        ->get();
//                       
// 
//        $results = array();

    return $transactionDetails;
}

public function guestRegistration(Request $req){



    $user=Auth::user();
    $code = $req->get('reservID');
    $client = 'NONE';
    $guests = NULL;
    $rooms = NULL;
  $reservArriv = NULL;
  $reservDepart = NULL;
    $reservCheckIn = NULL;
       $reservCheckOut = NULL;
       $reservBillArrange = NULL;
       $reservBillNote = NULL;


    $transactionId = NULL;
    $registExist = false;
    $downpayments = NULL;
    $notes = NULL;
    $sales = NULL;
    
    $roomsToAdd = DB::table('room_infos')
                ->join('room_types','room_infos.type','=','room_types.id')
                ->select([
                    'room_infos.roomName',
                    'room_infos.roomNo',
                    'room_infos.type',
                    'room_infos.id',
                    'room_types.name as roomType',
                    'room_types.room_rate as rate',
                ])
                ->get();

    if($code){
      

    $registExist = true;
    $transaction = DB::table('transactions')->where('code',$code)->first();
    $roomcharges = RoomCharge::where('os_id',$code)->first();
    $folio = GuestReservation::where('folioNos',$code)->first();

    if(!$transaction && $roomcharges){
        $transaction = DB::table('room_charges as rc')
                        ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
                        ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                        ->join('transactions as t','t.id','=','rr.transactionId')
                        ->where('rc.os_id',$code)
                        ->select([
                            't.id',
                            't.specialRequestNotes',
                            't.clientId',
                            't.institutionId',
                            't.status',
                            't.code',
                            't.guaranteed',
                            't.withHoldingTax',
                        ])
                        ->first();

        $code = $transaction->code;
    }

    
    if(!$transaction && $folio){
        $transaction = DB::table('guest_reservations as gr')
                        ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                        ->join('transactions as t','t.id','=','rr.transactionId')
                        ->where('gr.folioNos',$code)
                        ->select([
                            't.id',
                            't.specialRequestNotes',
                            't.clientId',
                            't.institutionId',
                            't.status',
                            't.code',
                            't.guaranteed',
                            't.withHoldingTax',
                        ])
                        ->first();

        $code = $transaction->code;
    }

    $notes = $transaction->specialRequestNotes;
    $transactionId = $transaction->id;
        
    $client = $transaction->clientId;

    $clientD = Client::findOrFail($client);

    $instiD = Institution::findOrFail($transaction->institutionId);

    $ammendTotal = 0;
    $guestCharges = 0;
    
    $guests = DB::table('guests')
                    ->join('guest_reservations','guests.id','=','guest_reservations.guestId')
                    ->join('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
                    ->join('room_infos','room_reservations.roomId','=','room_infos.id')
                    ->join('transactions','transactions.id','=','room_reservations.transactionId')
                    ->where('transactions.id','=',$transactionId)
                    ->where('guest_reservations.status','=',1)
                    ->orWhere('guest_reservations.status','=',2)
                    ->orWhere('guest_reservations.status','=',4)
                    ->select(
                            [
                            'guests.id',
                            'guests.firstName',
                            'guests.middleName',
                            'guests.familyName',
                            'guests.houseNo',
                            'guests.brgy',
                            'guests.city',
                            'guests.country',
                            'guests.postalCode',
                            'guests.nationality',
                            'guests.contactNo',
                            'guests.email',
                            'guests.dob',
                            'guests.designation',
                            'guests.passNo',
                            'guests.passExpiry',
                            'guests.passIssue',
                            'guests.otherId',
                            'guests.account_id',
                            'room_reservations.roomId',
                            'room_infos.roomName',
                            'guest_reservations.id as grId',
                            'guest_reservations.roomReservationId',
                            'guest_reservations.status'
                            ]
                            )
                    ->get();
        
        $amendments = DB::table('room_amendments as ra')
                    ->where('ra.transactionId','=',$transactionId)
                    ->join('discount_details as dd','ra.discountId','=','dd.id')
                    ->join('room_infos as r','r.id','=','ra.roomId')
                    ->join('room_types as rt','rt.id','=','r.type')
                    ->select([
                        'ra.FinalRoomRate',
                        'ra.fullRackRateEdit',

                        'ra.noOfDays as amendDays',
                        'ra.id as amendId',
                        'ra.created_at as amendDate',
                        'dd.name as discountNameAmend',
                        'dd.discountValue',
                        'dd.type as discountType',
                        'dd.id as idAmend',
                        'ra.arrivalDate as amendArriv',
                        'ra.depatureDate as amendDepart',
                        'dd.discountValue as discountValueAmend',
                        'ra.roomTypeBill',
                        'ra.finalRoomNo',
                        'rt.room_rate as amendRate',
                        'r.roomName as amendRoomName',
                        'rt.name as amendRoomType',
                    ])->get();
    
    foreach($amendments as $a){
        $datediff2 = strtotime($a->amendDepart) - strtotime($a->amendArriv);
        $days2 = floor($datediff2 / (60 * 60 * 24));
        $ammendTotal+=$a->FinalRoomRate*$days2;
    }

    $guestCharges = DB::table('room_charges as rc')
                    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
                    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                    ->join('guests as g','g.id','=','guestId')
                    ->where('rr.transactionId','=',$transactionId)
                    ->select([
                            'rc.id as rcID',
                            'rc.item_name',
                            'rc.created_at as chargeCreated',
                            'rc.price',
                            'rc.os_id',
                            'rc.account_type',
                            'rc.lessDiscount',
                            'rc.type',
                            'rr.id as reserveid',
                            DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),
                        ])
                    ->get();
        

        $rooms = DB::table('room_infos')
                    ->join('room_types','room_types.id','=','room_infos.type')
                    ->join('room_reservations','room_infos.id','=','room_reservations.roomId')
                    ->join('discount_details as dd','dd.id','=','room_reservations.discountId')
                    ->join('transactions','transactions.id','=','room_reservations.transactionId')
                    ->where('transactions.id','=',$transactionId)
                    ->select(
                            [
                                'room_infos.id',
                                'room_reservations.id as reserveid',
                                'dd.discountValue',
                                'dd.name as discountName',
                                'dd.type as discountType',
                                'room_infos.roomName',
                                'room_types.name as roomType',
                                'room_types.room_rate as roomRate',
                                'room_reservations.FinalRoomRate',
                                'room_reservations.arrivalDate',
                                'room_reservations.depatureDate',
                                'room_reservations.noOfdays',
                            ]
                            )
                    ->get();
    
    $amendments = DB::table('room_amendments as ra')
                    ->where('ra.transactionId','=',$transactionId)
                    ->join('discount_details as dd','ra.discountId','=','dd.id')
                    ->join('room_infos as r','r.id','=','ra.roomId')
                    ->join('room_types as rt','rt.id','=','r.type')
                    ->select([
                        'ra.FinalRoomRate',
                        'ra.fullRackRateEdit',

                        'ra.noOfDays as amendDays',
                        'ra.id as amendId',
                        'ra.created_at as amendDate',
                        'dd.name as discountNameAmend',
                        'dd.discountValue',
                        'dd.type as discountType',
                        'dd.id as idAmend',
                        'ra.arrivalDate as amendArriv',
                        'ra.depatureDate as amendDepart',
                        'dd.discountValue as discountValueAmend',
                        'ra.roomTypeBill',
                        'ra.finalRoomNo',
                        'rt.room_rate as amendRate',
                        'r.roomName as amendRoomName',
                        'rt.name as amendRoomType',
                    ])->get();
    
    $guestCharges = DB::table('room_charges as rc')
                    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
                    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                    ->join('guests as g','g.id','=','guestId')
                    ->where('rr.transactionId','=',$transactionId)
                    ->select([
                            'rc.id as rcID',
                            'rc.item_name',
                            'rr.id as reserveid',
                            'rc.created_at as chargeCreated',
                            'rc.price',
                            'rc.os_id',
                            'rc.account_type',
                            'rc.lessDiscount',
                            'rc.type',
                            DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),
                        ])
                    ->get();
    

    foreach($amendments as $a){
        $datediff2 = strtotime($a->amendDepart) - strtotime($a->amendArriv);
        $days2 = floor($datediff2 / (60 * 60 * 24));
        $ammendTotal+=$a->FinalRoomRate*$days2;
    }


          $sales = DB::table('transactions')
            ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('room_types', 'room_types.id', '=', 'room_infos.type')
            ->leftjoin('room_amendments',function($join)
                {
                    $join->on('room_amendments.roomReservationId', '=', 'room_reservations.id')->where('room_amendments.status','=','1');
                })
            ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
            ->leftjoin('room_charges', 'room_charges.guestReservationId', '=', 'guest_reservations.id')
            ->where('transactions.id','=',$transactionId)
            ->groupby('room_reservations.id')
            ->orderby('transactions.updated_at')
            ->select(
                [
                    'transactions.updated_at as reservationDate',
                    'transactions.code',
                    'room_infos.roomName',
                    'room_reservations.id as reserveid',
                    DB::raw("sum(if(room_charges.chargeType = 2, room_charges.price, 0)) as creditCharges"),
                    DB::raw("concat(DATE_FORMAT(room_reservations.initialArrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.initialDepartureDate,'%b %d %Y')) as reservationPeriod"),
                    DB::raw("DATEDIFF(room_reservations.initialDepartureDate, room_reservations.initialArrivalDate) as days"),
                    
                    'room_reservations.FinalRoomRate as roomRate',
                    DB::raw("sum(if(room_charges.type = 1, room_charges.price, 0)) as fnb"),
                    DB::raw("sum(if(room_charges.type = 2, room_charges.price, 0)) as roomService"),
                    DB::raw("sum(if(room_charges.type = 3, room_charges.price, 0)) as miniBar"),

                    DB::raw("case transactions.status
                        when 100 then 'Fully Paid'
                        when 1000 then 'Partial Paid'
                        end as statusTransactions"),

                    DB::raw("sum(if(room_charges.type = 1, room_charges.lessDiscount, 0)) as fnbDiscount"),
                    DB::raw("sum(if(room_charges.type = 2, room_charges.lessDiscount, 0)) as roomServiceDiscount"),
                    DB::raw("sum(if(room_charges.type = 3, room_charges.lessDiscount, 0)) as miniBarDiscount"),

                    DB::raw("sum(if(room_charges.type <>4, room_charges.lessDiscount, 0)) as totalChargeDiscount"),

                    DB::raw("sum(if(room_charges.type = 4, room_charges.price, 0)) as shuttleService"),

                    DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),
                    

                    DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + sum(if(room_charges.price is not null and room_charges.type <> 4, room_charges.price, 0)) as totalBill"),

                    DB::raw('((((DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL,if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + sum(if(room_charges.price is not null and room_charges.type <> 4, room_charges.price, 0)))/1.12) * .10) as serviceCharge'),
                ]
            )->get();
      
       $getDates = DB::table('room_reservations as rr')->where('rr.transactionId','=',$transactionId)->first();

       $reservArriv = $getDates->arrivalDate;
       $reservDepart = $getDates->depatureDate;
       $reservCheckIn = $getDates->checkInTime;
       $reservCheckOut = $getDates->checkOutTime;
       $reservBillArrange = $getDates->billingType;
       $reservBillNote = $getDates->billingNote;

      
   
        $bookedRooms=[];

        $downpayments = DB::table('downpayments as dp')
                            ->join('users as u','u.id','=','dp.user_id')
                            ->where('dp.transactionId','=',$transactionId)
                            ->select([
                                    'dp.amount',
                                      DB::raw('
                                        (CASE 
                                        WHEN dp.paidThru = 1 THEN "Cash" 
                                        WHEN dp.paidThru = 2 THEN "Credit Card"
                                        WHEN dp.paidThru = 3 THEN "Cheque"
                                        WHEN dp.paidThru = 4 THEN "Bank Deposit"  
                                        END) AS paidThru'
                                    ),
                                    'dp.notes',
                                    'dp.created_at',
                                    'u.firstName',
                                    'dp.roomReservationId',
                                    'u.lastName',
                          
                                ])
                            ->get();
        
        foreach($rooms as $r){
            if(!in_array($r->roomName,$bookedRooms))
            array_push($bookedRooms, $r->roomName);
        }
    
    }
    $discountDetails = DB::table('discount_details')->get();
    

    
    
//    $activeReservations = DB::
    
    //code goes here...
  return view('frontdesk.guest-registration',compact('user','notes','client','reservArriv','reservDepart','reservCheckIn','reservCheckOut','reservBillArrange','reservBillNote','downpayments','guests','rooms','roomsToAdd','bookedRooms','registExist','code','transaction','sales','transactionId','instiD','clientD','discountDetails','ammendTotal','guestCharges'));
    
    
//    return $guests;
    
//        return $rooms;
         
}

 public function updateCheckOutTime(Request $req){

    $room = RoomReservation::findOrFail($req->get('rrID'));

    $room->checkOutTime = date("H:i", strtotime($req->get('checkOutTime')));
    $room->checkInTime = date("H:i", strtotime($req->get('checkInTime')));
    $room->arrivalDate = date_format(date_create($req->get('arrivalDate')),"Y-m-d");
    $room->depatureDate = date_format(date_create($req->get('departureDate')),"Y-m-d");
    $room->FinalRoomRate = $req->get("finalRoomRate");
    $room->discountId = $req->get("discountId");
    $room->roomTypeBill = $req->get("finalRoomType");
    $room->save();
    return $room;
}

public function getRoomDetails($id){
        $roomSelectedReserv = RoomReservation::findOrFail($id);
        
        
        $room = DB::table('room_reservations as rr')
                ->where('rr.id','=',$id)
                ->join('room_infos as r','r.id','=','rr.roomId')
                ->join('room_types as rt','rt.id','=','r.type')
                ->select([
                   'rr.id',
        'r.roomName',
        'rt.name as roomType',
        'rr.occupied_status',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.FinalRoomRate',
        'rr.discountId',
        'rr.roomTypeBill',
        DB::raw('DATE_FORMAT(rr.checkOutTime,"%I:%i %p") as checkOutTime'),
        DB::raw('DATE_FORMAT(rr.checkInTime,"%I:%i %p") as checkInTime'),
        DB::raw('DATE_FORMAT(rr.initialArrivalDate,"%c/%e/%Y") as initialArrivalDate'),
        DB::raw('DATE_FORMAT(rr.initialDepartureDate,"%c/%e/%Y") as initialDepartureDate'),
        DB::raw('DATE_FORMAT(rr.arrivalDate,"%m/%d/%Y") as actualArrivalDate'),
        DB::raw('DATE_FORMAT(rr.depatureDate,"%m/%d/%Y") as actualDepartureDate'),
                ])
                ->get();

         $guests = DB::table('guest_reservations as gr')
                ->where('gr.roomReservationId','=',$id)
                ->join('guests as g','g.id','=','gr.guestId')
                ->select([
                    'g.firstName',
                    'g.familyName',
                ])
                ->get();
        

        return collect(['room' => $room,'guest'=>$guests]);
    }


public function getRoomDetailsByRoomId($id){


    $discounts = DB::table('discount_details as dd')
    ->select([
        'dd.id',
        'dd.name as discountName',
        'dd.discountValue',
        'dd.status',
        'dd.type',
    ])
    ->get();

    $room = DB::table('room_infos as r')
    ->where('r.id','=',$id)
    ->join('room_types as rt','rt.id','=','r.type')
    ->select([
        'r.id',
        'r.roomName',
        'rt.name as roomType',
        'rt.room_rate',
    ])
    ->get();

    $collections = collect(['room' => $room,'discounts' => $discounts]);

    return $collections;
}

public function roomOccupancyBulletin(){
    $user=Auth::user();

    return view('frontdesk.room-occupancy-bulletin',compact('user'));
}

public function dailyDepartureList(){

    $user=Auth::user();

    return view('frontdesk.daily-departure-list',compact('user'));
}

public function guestFolio(Request $req){



   $user=Auth::user();
   $code = $req->get('reservID');
   $client = 'NONE';
   $guests = NULL;
   $rooms = NULL;
   $registExist = false;
   $transactionId = NULL;

   if($code){

    $registExist = true;
    $transaction = DB::table('transactions')->where('code',$code)->first();

    $transactionId = $transaction->id;

    $client = $transaction->clientId;

    $rooms = DB::table('room_infos')
    ->leftJoin('room_reservations','room_infos.id','=','room_reservations.roomId')
    ->leftJoin('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
    ->leftJoin('guests','guests.id','=','guest_reservations.guestId')
    ->join('transactions',function($join) use ($transactionId)
    {
        $join->on( 'room_reservations.transactionId','=','transactions.id')
        ->where('transactions.id', '=', $transactionId);
    })
    ->select(
        [
            'room_infos.id',
            'room_reservations.id as reserveid',
            'room_infos.roomName',
            'guests.firstName as firstName',
            'guest_reservations.status as guest_status',
            'guest_reservations.id as gReservId',
            'guests.id as guestId',
            'guests.familyName as lastName',
        ]
    )
    ->get();


    $bookedRooms=[];

    foreach($rooms as $r){
        if(!in_array($r->roomName,$bookedRooms))
            array_push($bookedRooms, $r->roomName);
    }


}



    //    $activeReservations = DB::

        //code goes here...
return view('frontdesk.guest-folio',compact('user','client','transactionId','rooms','bookedRooms','registExist','code'));

    //    return $rooms;

        //code goes here...

}


public function nightAudit(Request $req){


    $user=Auth::user();
    $dateMain = date_format(date_create($req->get('date-main')),"Y-m-d");


    if($dateMain){
       //     $reservationsToday = DB::table('room_reservations')->whereDate('arrivalDate','<=',$dateMain)->get();

        $date = date_format(date_create($req->get('date-main')),"F j, Y");
        $hiddenDate = $date;
    }

    else{
      //      $reservationsToday = DB::table('room_reservations')->whereDate('arrivalDate','<=',$dateMain)->get();
        //    $dateMain = date('F j, Y');
        $date = date('F j, Y');

        $hiddenDate = $date;
    }

//         $rooms = DB::table('room_infos')
//                    ->leftJoin('room_types','room_types.id','=','room_infos.type')
//                    ->select([
//                        'room_infos.roomNo',
//                        'room_types.name as roomType',
//                    ])
//                    ->get();

       //  $transactionsCharge = 



    $roomChargesAudit = DB::table('room_charges as rc')
    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
    ->join('guests as g','g.id','=','gr.guestId')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where(DB::raw("DATE_FORMAT(rc.created_at,'%Y-%m-%d')"),'=',$dateMain)
    ->join('transactions as t','t.id','=','rr.transactionId')
    ->join('users as u','u.id','=','rc.updatedBy')
    ->select([
        'rc.item_name',
        'rc.price',
        'rc.account_type',
        'rr.id as roomReservationId',
        'rc.os_id',
        't.id as transID',
        'ri.roomName',
        DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),
        DB::raw('
            case rc.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'
        ),
        DB::raw("concat(left(u.firstName,1),'. ',u.lastName) as foInCharge"),
    ])
    ->get();

    $downpayments = DB::table('downpayments as d')
    ->join('transactions as t','t.id','=','d.transactionId')
    ->join('users as u','u.id','=','d.user_id')
    ->where(DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d')"),'=',$dateMain)
    ->select([
        'd.os_id',
        'd.amount',
        'd.notes',
        'd.roomReservationId',
        't.id as transID',
        DB::raw('
            case d.paidThru
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'
        ),
        DB::raw("concat(left(u.firstName,1),'. ',u.lastName) as foInCharge"),
    ])
    ->get();

    $transactions= DB::table('transactions as t')
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->where('rr.arrivalDate','<=',$dateMain)
    ->where('rr.depatureDate','>=',$dateMain)
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('account_types as ac','ac.id','=','i.type')

    ->select([
        't.id',
        'ac.name as accountName',
        't.code',
        DB::raw("concat(c.firstName,' ', c.lastName) as bookingPerson"),
        'i.name as institutionName',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.id as roomReserveId',
        't.status as transactionStatus',
        'rr.occupied_status',
        't.guaranteed',
    ])
    ->get();



    $roomsIn = DB::table('room_infos')
    ->join('room_reservations as rr','rr.roomId','=','room_infos.id')
    ->where('rr.arrivalDate','<=',$dateMain)
    ->where('rr.depatureDate','>=',$dateMain)

    ->join('discount_details as dd','rr.discountId','=','dd.id')
    ->join('room_types','room_infos.type','=','room_types.id')
    ->join('transactions','transactions.id','=','rr.transactionId')
    ->select([
        'room_infos.roomNo',
        'room_infos.roomName',
        'room_infos.id',
        'room_types.name as roomType',
        'room_types.room_rate as rate',
        'transactions.id as transID',
        'rr.depatureDate',
        'rr.arrivalDate',
        'dd.discountValue',
        'dd.id as discountId',
        'dd.name as discountName',
        'dd.type as discountType',
        'rr.id as roomReservationId',
        'rr.FinalRoomRate',
        DB::raw('
            case room_infos.status
            when "0" then "Vacant Ready"
            when "1" then "Occupied"
            when "2" then "Vacant Dirty"
            when "3" then "Blocked"
            when "4" then "Out of Order"
            when "5" then "No Show"
            when "6" then "Slept Out"
            when "7" then "House Use"
            else "Blocked"
            end as roomStatus
            '),

    ])
    ->get();



    $roomsCount = DB::table('room_infos')
    ->where('room_infos.status','=',1)
    ->get();



    $guestsArrivals = DB::table('room_reservations as rr')
    ->where('rr.arrivalDate','<=',$dateMain)
    ->where('rr.depatureDate','>=',$dateMain)
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->join('guests','gr.guestId','=','guests.id')
    ->select([
        'rr.roomId',
        'guests.firstName',
        'guests.familyName',

    ])
    ->get();

    $totalRooms = count($roomsCount);
        //code goes here...
    return view('frontdesk.night-audit',compact('user','date','hiddenDate','dateMain','roomChargesAudit','transactions','downpayments','guestsArrivals','roomsIn','totalRooms'));

     //   return $transactions;
      //  return $guestsArrivals;
      //  return $rooms;
}


public function amendments(){
    $user=Auth::user();

        //code goes here...
      //  return view('frontdesk.amendments',compact('user'));
}


   //////////////////Room Issue

public function dataTablesArrivalList()
{


   $roomsArrivals = DB::table('room_infos')
   ->join('room_reservations as rr','rr.roomId','=','room_infos.id')
   ->where('arrivalDate','=',$dateMain)
   ->join('discount_details as dd','rr.discountId','=','dd.id')
   ->join('room_types','room_infos.type','=','room_types.id')
   ->join('transactions','transactions.id','=','rr.transactionId')
   ->select([
    'room_infos.roomNo',
    'room_infos.id',
    'room_types.name as roomType',
    'room_types.room_rate as rate',
    'rr.depatureDate',
    'dd.discountValue',
    DB::raw('
        (CASE 
        WHEN transactions.chargeType = 1 THEN "Cash" 
        WHEN transactions.chargeType = 2 THEN "Credit Card" 
        END) AS chargeType'
    ),
    DB::raw('
        (CASE 
        WHEN transactions.billingType = 1 THEN "CTC" 
        WHEN transactions.billingType = 2 THEN "GA"
        ELSE 0 
        END) AS billingType'
    ),

]);


   return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}




public function dataTablesRoomList()
{
    $users = DB::table('room_infos')
    ->select(
        [
            'id',
            'roomName',
            DB::raw('
                case type
                when "1" then "Family Suites"
                when "2" then "Single Room"
                when "3" then "Double Standard"
                when "4" then "Double Deluxe"
                when "5" then "Twin Share"
                when "6" then "Twin Share Deluxe"
                when "7" then "Triple Sharing"
                when "8" then "Hospitality Suite"
                when "9" then "PWD Room"
                when "10" then "Single Deluxe Room"
                end as type'),

            DB::raw('
                case status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as status'),




        ]
    );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function dataTablesHousekeepingHistory()
{
    $user=Auth::user();
    $users = DB::table('housekeepings')
    ->join('room_infos', 'room_infos.id', '=', 'housekeepings.roomInfoId')
    ->where('housekeepings.cleanerId','=',$user->id)
    ->orderby('housekeepings.created_at','desc')
    ->select(
        [
            'housekeepings.id',
            'room_infos.roomName',

            DB::raw('
                case housekeepings.type
                when "1" then "Prepared"
                when "2" then "Cleaned"
                when "3" then "Repaired"
                when "4" then "Out of Order"
                end as type'),

            DB::raw("DATE_FORMAT(housekeepings.created_at,'%b %d %Y %h:%i %p') as created_at"),

            DB::raw('
                case housekeepings.from_status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as from_status'),
            DB::raw('
                case housekeepings.to_status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as to_status')
        ]
    );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}
    ////post data
public function issueStatusSaves(Request $req){
    $inputs = $req->all();
    $user=Auth::user();
    DB::table('room_issues')
    ->where('id', $inputs['id'])
    ->update(array(
        'status' => $inputs['actionId'],
        'updateById' => $user->id,
    ));

}

public function deleteDiscountAjax(Request $req){
    $inputs = $req->all();
    DB::table('discount_details')->where('id', '=', $inputs['id'])->delete();
    return 'Success';
}
public function roomissue(){
    $user=Auth::user();



    $roomsAll = DB::table('room_infos')
    ->leftjoin('room_issues', 'room_infos.id', '=', 'room_issues.roomId')
    ->orderby('roomName')
    ->groupby('room_infos.roomName')
    ->select(
        [
            'room_infos.id',
            'roomName',
            DB::raw('sum(if(room_issues.status=1,1,0))  as issueCount'),
            DB::raw('if(sum(if(room_issues.status=1,1,0)) > 0, "bg-red", "bg-green") as cleanStatus'),
                /*
                CleanStatus
                1-Dirty
                2-Cleaned
                3-Out of Order
                */


                DB::raw('
                    case room_infos.status
                    when "0" then "Vacant Ready"
                    when "1" then "Occupied"
                    when "2" then "Vacant Dirty"
                    when "3" then "Blocked"
                    when "4" then "Out of Order"
                    when "5" then "No Show"
                    when "6" then "Slept Out"
                    when "7" then "House Use"
                    end as status'),

                
            ]
        )
    ->get();



    return view('frontdesk.roomissue',compact('user', 'roomsAll'));
}



public function roomStatusSaves(Request $req){
    $inputs = $req->all();
    $user=Auth::user();
    if($inputs['typeIssue']>1)
    {
        $roomIssue = new RoomIssue;

        $roomIssue->roomId = $inputs['roomId'];
        $roomIssue->cleanerId = $user->id;
        $roomIssue->type = $inputs['typeIssue'];
        $roomIssue->notes = $inputs['issueNotes'];
        $roomIssue->status = 1;
        $roomIssue->save();


    }

    if($inputs['cleanStatus']!='' && $inputs['cleanStatus']>0)
    {
        DB::table('room_infos')
        ->where('id', $inputs['roomId'])
        ->update(array(
            'status' => $inputs['to_status'],
            'cleanStatus' => $inputs['cleanStatus'],
            'roomNotes' => $inputs['roomNotes'],


        ));

        $housekeep = new Housekeeping;

        $housekeep->roomInfoId = $inputs['roomId'];
        $housekeep->cleanerId = $inputs['cleanerId'];
        $housekeep->type = $inputs['type'];
        $housekeep->from_status = $inputs['from_status'];
        $housekeep->to_status = $inputs['to_status'];
        $housekeep->roomNotes = $inputs['roomNotes'];
        $housekeep->save();

        if($inputs['cleanStatus'] == 1)
        {
            return 'bg-orange';
        }
        elseif($inputs['cleanStatus'] == 2)
        {
            return 'bg-green';
        }
        elseif($inputs['cleanStatus'] == 3)
        {
            return 'bg-red';
        }
        else{
            return '';
        }
    }



}




public function dataTablesHousekeepingHistoryRoom($id)
{
    $user=Auth::user();
    $users = DB::table('housekeepings')
    ->join('room_infos', 'room_infos.id', '=', 'housekeepings.roomInfoId')
    ->join('users', 'users.id', '=', 'housekeepings.cleanerId')
    ->where('room_infos.id','=',$id)
    ->orderby('housekeepings.created_at','desc')
    ->select(
        [
            'housekeepings.id',
            'room_infos.roomName',
            DB::raw("concat(users.firstname,' ', users.lastname) as cleanerName"),
            DB::raw('
                case housekeepings.type
                when "1" then "Prepared"
                when "2" then "Cleaned"
                when "3" then "Repaired"
                when "4" then "Out of Order"
                end as type'),

            DB::raw("DATE_FORMAT(housekeepings.created_at,'%b %d %Y %h:%i %p') as created_at"),

            DB::raw('
                case housekeepings.from_status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as from_status'),
            DB::raw('
                case housekeepings.to_status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as to_status')
        ]
    );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}
public function reservationCalendar(){

    $users = DB::table('room_reservations')
    ->join('transactions', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('room_infos', 'room_infos.id','=','room_reservations.roomId')
    
    ->orderby('room_reservations.arrivalDate')
    ->groupby('room_reservations.id')
    ->select(
        [
            DB::raw('room_reservations.id as id'),
            DB::raw('room_infos.roomName as title'),
            DB::raw('concat(room_reservations.arrivalDate,"T00:00:00") as start'),
            DB::raw('concat(room_reservations.depatureDate,"T23:59:00") as end'),
            DB::raw("CASE 
                WHEN transactions.guaranteed = 2 && room_reservations.arrivalDate > date('Y-m-d') THEN 'red'
                WHEN transactions.guaranteed = 1 && room_reservations.arrivalDate >= date('Y-m-d') THEN 'green'
                END AS color"),

        ]
    )->get();

        //     $rooms = DB::table('room_infos as r')
        //         ->join('room_types as rt','rt.id','=','r.type')
        //         ->select([
        //             'r.id',
        //             DB::raw('concat(r.roomName," (",rt.name,")") as title')
        //         ])
        //         ->get();

        // return collect(["rooms"=>$rooms,"reservations"=>$reservations]);
        //return json_encode($users);
    return Response::json($users);
}

public function reservationCalendarViewRegistration($id){
    $roomItems = DB::table('room_reservations')
    ->join('transactions', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('institutions', 'institutions.id', '=', 'transactions.institutionId')
    ->join('clients', 'clients.id', '=', 'transactions.clientId')
    ->where('room_reservations.id','=',$id)
    ->select(
        [
            DB::raw("concat(clients.firstname,' ',clients.lastname) as clientName"),
            DB::raw("clients.contactNo as clientContactNo"),
            DB::raw("clients.email as clientEmail"),

            DB::raw("institutions.name as instiName"),
            DB::raw("institutions.contactNo as instiContactNo"),
            DB::raw("institutions.email as instiEmail"),

            DB::raw("transactions.code as transactionCode"),
            DB::raw("transactions.status as transactionStatus"),
            DB::raw("transactions.guaranteed as guaranteed"),
            DB::raw("transactions.chargeType as chargeType"),
            DB::raw("transactions.madeThru as madeThru"),
            DB::raw("transactions.billingType as billArrange"),

            DB::raw("transactions.specialRequestNotes as specialRequestNotes"),
            DB::raw("transactions.guaranteedNote as guaranteedNote"),
            DB::raw("transactions.billingNote as billingNote"),

            DB::raw('DATE_FORMAT(room_reservations.arrivalDate,"%d/%m/%Y") as arrivalDateRoom'),
            DB::raw('DATE_FORMAT(room_reservations.depatureDate,"%d/%m/%Y") as depatureDateRoom'),
            DB::raw("room_reservations.noOfdays as noDaysPaid"),
            DB::raw("room_reservations.discountId as discountStatus"),


        ]
    )->get();

    return response()->json($roomItems);
}


public function dataTablesRoomIssuesHousekeeping($id)
{
    $user=Auth::user();
    $users = DB::table('room_issues')
    ->join('room_infos', 'room_infos.id', '=', 'room_issues.roomId')
    ->join('users', 'users.id', '=', 'room_issues.cleanerId')
    ->where('room_issues.status','=',1)
    ->where('room_infos.id','=',$id)
    ->orderby('room_issues.created_at','desc')
    ->select(
        [

            'room_issues.id',
            DB::raw('concat(users.firstname, " ", users.lastname) as cleanerNames'),
            DB::raw('
                case room_issues.type
                when "0" then "Vacant Ready"
                when "1" then "Lost And Found Item"
                when "2" then "Lost of Hotel Item"
                when "3" then "Broken Items"
                when "10" then "Lost Items"
                when "100" then "Others"
                end as type'),
            'room_issues.notes'
        ]
    );
    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}





    //////view Popout
public function roomInfo($id){
    $users = DB::table('room_infos')
    ->join('room_issues', 'room_infos.id', '=', 'room_issues.roomId')
    ->where('room_issues.status','=', 1)
    ->where('room_infos.id','=', $id)
    ->select(
        [
            'room_infos.id',
            'roomName',
            DB::raw('count(room_issues.id) as countIssues'),
            DB::raw('
                case room_infos.type
                when "1" then "Family Suites"
                when "2" then "Single Room"
                when "3" then "Double Standard"
                when "4" then "Double Deluxe"
                when "5" then "Twin Share"
                when "6" then "Twin Share Deluxe"
                when "7" then "Triple Sharing"
                when "8" then "Hospitality Suite"
                when "9" then "PWD Room"
                when "10" then "Single Deluxe Room"
                end as type'),
            DB::raw('room_infos.status as fromStatus'),
            DB::raw('room_infos.roomNotes as roomNotes'),

            DB::raw('
                case room_infos.status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as status'),



        ]
    )->get();

    return response()->json($users);
}




public function resUpdate(Request $req, $id){

    $roomRes = RoomReservation::findOrFail($id);
    $prevRoom = $roomRes->roomId;


    $RoomAmendment = new RoomAmendment;
        //protected $fillable = ['status','id','roomToId','roomFromId','roomReservationId','userId','notes'];
    $RoomAmendment->roomFromId = $prevRoom;
    $RoomAmendment->roomToId = $req->get('roomId');
    $RoomAmendment->roomReservationId = $req->get('guestSRRID');
    $RoomAmendment->userId = Auth::user()->id;
    $RoomAmendment->notes = $req->get('notes');
    $RoomAmendment->status = $req->get('chargeRoom');

    $RoomAmendment->noOfDays = 0;

    if($req->get('chargeRoom')==1)
    {
        $RoomAmendment->transactionId = $roomRes->transactionId;
        $RoomAmendment->roomId = $roomRes->roomId;

        $RoomAmendment->noOfDays = $roomRes->noOfdays;
        $RoomAmendment->arrivalDate = $roomRes->arrivalDate;
        $RoomAmendment->depatureDate = date('Y-m-d');
        $RoomAmendment->checkInTime = $roomRes->checkInTime;
        $RoomAmendment->checkOutTime =$roomRes->checkOutTime;
        $RoomAmendment->discountId = $roomRes->discountId;
        $RoomAmendment->billingType = $roomRes->billingType;

        $rt = DB::table('room_infos as ri')
        ->where('ri.id','=',$roomRes->roomId)
        ->join('room_types as rt','rt.id','=','ri.type')
        ->select(['rt.room_rate'])
        ->first();


        $ds = DiscountDetails::findOrFail($roomRes->discountId);

        if($ds->type == 1)
            $RoomAmendment->FinalRoomRate = $rt->room_rate-($rt->room_rate*$ds->discountValue);
        if($ds->type == 2)
            $RoomAmendment->FinalRoomRate = $rt->room_rate-$ds->discountValue;


        $RoomAmendment->billingNote = $roomRes->billingNote;
        $RoomAmendment->roomReservationstatus = $roomRes->status;
        $RoomAmendment->save();

    }


    $RoomAmendment->save();

    $rt2 = DB::table('room_infos as ri')
    ->where('ri.id','=',$req->get('roomId'))
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select(['rt.room_rate'])
    ->first();


    $ds2 = DiscountDetails::findOrFail($roomRes->discountId);

    if($ds2->type == 1)
        $roomRes->FinalRoomRate = $rt2->room_rate-($rt2->room_rate*$ds2->discountValue);
    if($ds2->type == 2)
        $roomRes->FinalRoomRate = $rt2->room_rate-$ds2->discountValue;

   //     $roomRes->arrivalDate = date('Y-m-d');
    $roomRes->roomId =  $req->get('roomId');
    $roomRes->noOfDays = 1;

    $roomRes->save();

    return 'success';
}
public function ammendmentRooms(Request $req){

    $user=Auth::user();
    $code = $req->get('reservID');
    $client = 'NONE';
    $guests = NULL;
    $rooms = NULL;
    $registExist = false;

    if($code){

        $registExist = true;
        $transaction = DB::table('transactions')->where('code',$code)->first();
        
        $transactionId = $transaction->id;

        $client = $transaction->clientId;

        $guests = DB::table('transactions')
        ->join('room_reservations', 'room_reservations.transactionId', '=','transactions.id')
        ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
        ->join('guests','guests.id','=','guest_reservations.guestId')
        ->leftJoin('room_infos','room_reservations.roomId','=','room_infos.id')
        ->where('transactions.id','=',$transactionId)
        ->select(
            [
                DB::raw('concat(guests.firstName," ", guests.familyName) as guestNamesGroup'),
                'guests.id',
                'guests.firstName',
                'guests.middleName',
                'guests.familyName',
                'guests.houseNo',
                'guests.brgy',
                'guests.city',
                'guests.country',
                'guests.postalCode',
                'guests.nationality',
                'guests.contactNo',
                'guests.email',
                'guests.dob',
                'guests.designation',
                'guests.passNo',
                'guests.passExpiry',
                'guests.passIssue',
                'guests.otherId',
                'room_reservations.roomId',
                'room_infos.roomName',
                'guest_reservations.id as grId',
                'guest_reservations.status',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                'room_reservations.id as rrId'
            ]
        )
        ->get();


        $guestsOld = DB::table('guests')
        ->leftJoin('guest_reservations','guests.id','=','guest_reservations.guestId')
        ->leftJoin('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
        ->leftJoin('room_infos','room_reservations.roomId','=','room_infos.id')
        ->join('transactions',function($join) use ($transactionId)
        {
            $join->on( 'room_reservations.transactionId','=','transactions.id')
            ->where('transactions.id', '=', $transactionId);
        })
        ->select(
            [
                DB::raw('group_concat(concat(guests.firstName," ", guests.familyName) SEPARATOR ", ") as guestNamesGroup'),
                'guests.id',
                'guests.firstName',
                'guests.middleName',
                'guests.familyName',
                'guests.houseNo',
                'guests.brgy',
                'guests.city',
                'guests.country',
                'guests.postalCode',
                'guests.nationality',
                'guests.contactNo',
                'guests.email',
                'guests.dob',
                'guests.designation',
                'guests.passNo',
                'guests.passExpiry',
                'guests.passIssue',
                'guests.otherId',
                'room_reservations.roomId',
                'room_infos.roomName',
                'guest_reservations.id as grId',
                'guest_reservations.status',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                'room_reservations.id as rrId'
            ]
        )
        ->get();

        
        $rooms = RoomInfo::all();
        


        
        
    }



    //    $activeReservations = DB::

        //code goes here...
    return view('frontdesk.amendments',compact('user','client','guests','rooms','registExist','code'));

    //     return $rooms;
}



public function reservationDetails($id){
    $transID = $id;

    $transactionDetails = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->where('t.id','=',$transID)        
    ->join('discount_details as dd','rr.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->join('institutions as i','t.institutionId','=','i.id')
    ->join('account_types as ac','ac.id','=','i.type')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('room_types as rt','r.type','=','rt.id')
    ->select([
        't.code',
        't.id as transID',
        'i.name as instiName',
        'i.address as instiAddress',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.checkInTime',
        'rr.checkOutTime',
        'ac.name as accountType',
        'c.firstname as clientFirstName',
        'c.lastName as clientLastName',
        'c.contactNo as clientContact',
        'c.title as clientTitle',
        'dd.name as discountName',
        'dd.id',
        'dd.discountValue',
        DB::raw('
            case t.madeThru
            when "1" then "Walk In"
            when "2" then "Email"
            when "3" then "Phone"
            end as madeThru'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            end as guaranteed'),



    ])->first();

    $rooms = DB::table('room_infos as r')
    ->join('room_types as rt','rt.id','=','r.type')
    ->join('room_reservations as rr','rr.roomId','=','r.id')
    ->join('transactions as t','t.id','=','rr.transactionId')
    ->where('t.id','=',$transID)
    ->select([
        'r.roomNo',
        'rt.name as roomType',
        'rt.room_rate as rate',
    ])
    ->get();

    $guests = DB::table('transactions as t')
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->where('t.id','=',$transID)
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->join('guests as g','g.id','=','gr.guestId')
    ->select([
        'g.firstName',
        'g.familyName',
        'g.account_id',
        'g.contactNo',
    ])
    ->get();


    $results = array();

    return collect(["transaction"=>$transactionDetails,"rooms"=>$rooms,"guests"=>$guests]);
}

public function reservationDetailsTwo($id){
    $rrId = $id;

    $tDetails = DB::table('transactions as t')
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->where('rr.id','=',$rrId)
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('users as u','u.id','=','t.updatedBy')
    ->select([
        't.code',
        't.id as transID',
        't.specialRequestNotes as notes',
        't.created_at',
        DB::raw('DATE_FORMAT(t.created_at, "%M %d, %Y") as  formatCreatedAt'),
        DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
        'i.name as instiName',
        'c.title',
        'c.contactNo as clientContact',
        'i.address as instiAddress',
        'i.contactNo as instiContact',
        'rr.arrivalDate',

        'rr.depatureDate',
        DB::raw('DATE_FORMAT(rr.checkInTime,"%r") as checkInTime'),
        DB::raw('DATE_FORMAT(rr.checkOutTime,"%r") as checkOutTime'),
        'u.firstName',
        'u.lastName',
        DB::raw('
            case t.madeThru
            when "1" then "WALK IN"
            when "2" then "EMAIL"
            when "3" then "PHONE"
            else "N/A"
            end as madeThru'),
        DB::raw('
            case i.type
            when "1" then "INDIVIDUAL"
            when "2" then "GOVERNMENT"
            when "3" then "SCHOOL"
            when "4" then "COMPANY"
            when "5" then "ORGANIZATION"
            when "6" then "TRAVEL AGENCY"
            else "N/A"
            end as accountType'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            else "N/A"
            end as guaranteed'),
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->first();

    $rooms = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$tDetails->transID)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'dd.name as discountName',
        'rr.FinalRoomRate',
        'dd.discountValue',
        'dd.type as discountType',
    ])
    ->get();

    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where('rr.transactionId','=',$tDetails->transID)
    ->select([
        DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),

        'g.contactNo',
        'ri.roomName',
    ])
    ->get();

    return collect(["tDetails"=>$tDetails,"rooms"=>$rooms,"guests"=>$guests]);
}



public function printPreviewFolio($id){

    $guestReserv = GuestReservation::findOrFail($id);
    $guestReservID = $guestReserv->id;
    $user=Auth::user();

    $amendments = DB::table('room_amendments as ra')
    ->join('transactions as t','ra.transactionId','=','t.id')
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->where('ra.roomReservationId','=',$guestReserv->roomReservationId)
    ->select([
        'ra.FinalRoomRate',
        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.discountValue',
        'dd.type as discountType',
        'dd.id as idAmend',
        'ra.roomTypeBill',
        'ra.finalRoomNo',
        'ra.arrivalDate as amendArriv',
        'ra.depatureDate as amendDepart',
        'dd.discountValue as discountValueAmend',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();

    $guestResInfo = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('transactions as t','t.id','=','rr.transactionId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->where('gr.id','=',$id)
    ->select([
        'rr.FinalRoomRate',
        'dd.name as discountName',
        'dd.type as discountType',
        'dd.discountValue',
        'rr.arrivalDate',
        'rr.initialDepartureDate',
        'rr.initialArrivalDate',
        'rr.depatureDate',
        'rr.roomTypeBill',
        'rr.updated_at as roomUpdatedAt',
        'rt.name as roomType',
        'ri.roomName',
        'gr.guest_remarks',
        'gr.guest_registration_no',
        'g.account_id',
        'i.name as instiName',
        'g.*',
        't.code',
        't.id as transactionId',
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->first();



    $guestCount = DB::table('guest_reservations as gr')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->where('rr.transactionId','=',$guestResInfo->transactionId)
    ->select([
        DB::raw('count(gr.id) as count')
    ])
    ->first();


    $guestCharges = DB::table('transactions as t')
    ->join('room_reservations as rr','t.id','=','rr.transactionId')
    ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
    ->where('gr.id','=',$id)
    ->join('room_charges as rc','rc.guestReservationId','=','gr.id')
    ->join('guests as g','g.id','=','gr.guestId')
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
        'rc.type',
    ])->get();

    $downpayments = DB::table('downpayments as d')
    ->join('transactions as t','t.id','=','d.transactionId')
    ->where('t.id','=',$guestResInfo->transactionId)
    ->select([
        'd.os_id',
        'd.amount',
        'd.notes',
        DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d') as chargeCreated"),

    ])
    ->get();


    return view('frontdesk.print-preview-folio',compact('amendments','downpayments','guestResInfo','guestCharges','guestCount','roomRate','user'));

}

public function printPreviewGuest($id){


    $user=Auth::user();

    $g = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('transactions as t','t.id','=','rr.transactionId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->where('gr.id','=',$id)
    ->select([
        'rr.FinalRoomRate',
        'dd.name as discountName',
        'dd.type as discountType',
        'dd.discountValue',
        'rr.arrivalDate',
        'rr.initialDepartureDate',
        'rr.initialArrivalDate',
        'rr.depatureDate',
        'rt.name as roomType',
        'ri.roomName',
        'gr.guest_remarks',
        'gr.guest_registration_no',
        'gr.folioNos',
        'g.account_id',
        'i.name as instiName',
        'g.*',
        't.code',
        't.id as transactionId',
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "Charge to Company"
            when "2" then "Guest Account"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->first();

    $firstDown = DB::table('downpayments as d')
    ->where('d.transactionId','=',$g->transactionId)
    ->select()->first();

    $guestCount = DB::table('guest_reservations as gr')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->where('rr.transactionId','=',$g->transactionId)
    ->select([
        DB::raw('count(gr.id) as count')
    ])
    ->first();

    $roomCount = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$g->transactionId)
    ->select([
        DB::raw('count(rr.id) as count')
    ])
    ->first();


    return view('frontdesk.print-preview-guest-registration',compact('g','user','firstDown','guestCount','roomCount'));

     //   return $guest;
     //   return $roomCount;
}


public function printPreviewRoombill($id){

    $roomId = $id;
    $user = Auth::user();

    $amendments = DB::table('room_amendments as ra')
    ->where('ra.roomReservationId','=',$id)
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->select([
        'ra.FinalRoomRate',
        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.discountValue',
        'dd.type as discountType',
        'dd.id as idAmend',
        'ra.roomTypeBill',
        'ra.finalRoomNo',
        'ra.arrivalDate as amendArriv',
        'ra.depatureDate as amendDepart',
        'dd.discountValue as discountValueAmend',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();



    $transDetails = DB::table('transactions as t')
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->where('rr.id','=',$id)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('users as u','u.id','=','t.updatedBy')
    ->select([
        't.code',
        't.specialRequestNotes',
        't.id as transID',
        't.created_at',
        't.withHoldingTax',
        DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
        'i.name as instiName',
        'c.title',
        'c.contactNo as clientContact',
        'i.address as instiAddress',
        'i.contactNo as instiContact',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.checkInTime',
        'rr.checkOutTime',
        'rr.FinalRoomRate',
        'rr.id as roomReservationId',
        'rr.initialArrivalDate',
        'rt.name as roomType',
        'ri.roomName',
        'rr.updated_at as roomUpdatedAt',
        'dd.name as discountName',
        'dd.discountValue',
        'dd.type as discountType',
        'u.firstName',
        'u.lastName',
        DB::raw('
            case t.madeThru
            when "1" then "WALK IN"
            when "2" then "EMAIL"
            when "3" then "PHONE"
            else "N/A"
            end as madeThru'),
        DB::raw('
            case i.type
            when "1" then "INDIVIDUAL"
            when "2" then "GOVERNMENT"
            when "3" then "SCHOOL"
            when "4" then "COMPANY"
            when "5" then "ORGANIZATION"
            when "6" then "TRAVEL AGENCY"
            else "N/A"
            end as accountType'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            else "N/A"
            end as guaranteed'),
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "100" then "Fully Paid"
            when "1000" then "Partial"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->first();

    $withHoldingTax = 0;

    if($transDetails->withHoldingTax != null)
        $withHoldingTax = $transDetails->withHoldingTax;

    $roomsCount = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$transDetails->transID)
    ->select([
        "rr.id"
    ])
    ->get();

    $finalRoomCount = count($roomsCount);

    $rooms = DB::table('room_reservations as rr')
    ->where('rr.id','=',$id)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'dd.name as discountName',
        'rr.FinalRoomRate',
        'rr.roomTypeBill',
        'rr.updated_at as roomUpdatedAt',
        'rr.depatureDate',
        'rr.id as roomReservationId',
        'rr.arrivalDate',
        'dd.discountValue',
        'rt.room_rate as roomRate',
        'dd.type as discountType',
    ])
    ->get();

    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where('rr.id','=',$id)
    ->select([
        DB::raw("concat(left(g.firstName,1),'. ',g.familyName) as guestName"),
        'g.contactNo',
        'ri.roomName',
    ])
    ->get();

    $guestCharges = DB::table('room_charges as rc')
    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
    ->join('guests as g','g.id','=','gr.guestId')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->where('rr.id','=',$id)
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.lessDiscount',
        'rc.account_type',
        'rc.type',
        DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),
    ])
    ->get();

    $downpayments = DB::table('downpayments as d')
    ->join('transactions as t','t.id','=','d.transactionId')
    ->join('room_reservations as rr','rr.id','=','d.roomReservationId')
    ->where('rr.id','=',$id)
    ->select([
        'd.os_id',
        'd.amount',
        'd.notes',
        DB::raw('
            (CASE 
            WHEN d.paidThru = 1 THEN "Cash" 
            WHEN d.paidThru = 2 THEN "Credit Card"
            WHEN d.paidThru = 3 THEN "Cheque"  
            END) AS paidThru'
        ),
        DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d') as chargeCreated"),
        'd.roomReservationId',

    ])
    ->get();

      //  return $roomCharges;
    return view('frontdesk.print-preview-roombill',compact('transDetails','guestCharges','amendments','guests','rooms','downpayments','user','finalRoomCount','withHoldingTax'));
}

public function printPreviewBillstatement($id){

    $transId = $id;
    $user = Auth::user();

    $amendments = DB::table('room_amendments as ra')
    ->where('ra.transactionId','=',$id)
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->select([
        'ra.FinalRoomRate', 
        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.discountValue',
        'dd.type as discountType',
        'dd.id as idAmend',
        'ra.arrivalDate as amendArriv',
        'ra.depatureDate as amendDepart',
        'dd.discountValue as discountValueAmend',
        'ra.roomTypeBill',
        'ra.finalRoomNo',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();



    $transDetails = DB::table('transactions as t')
    ->where('t.id','=',$id)
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('users as u','u.id','=','t.updatedBy')
    ->select([
        't.code',
        't.specialRequestNotes',
        't.id as transID',
        't.created_at',
        DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
        'i.name as instiName',
        'c.title',
        'c.contactNo as clientContact',
        'i.address as instiAddress',
        'i.contactNo as instiContact',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.checkInTime',
        'rr.checkOutTime',
        'rr.FinalRoomRate',
        'rr.initialArrivalDate',
        'rt.name as roomType',
        'ri.roomName',
        'rr.updated_at as roomUpdatedAt',
        'dd.name as discountName',
        'dd.discountValue',
        'dd.type as discountType',
        't.withHoldingTax',
        'u.firstName',
        'u.lastName',
        DB::raw('
            case t.madeThru
            when "1" then "WALK IN"
            when "2" then "EMAIL"
            when "3" then "PHONE"
            else "N/A"
            end as madeThru'),
        DB::raw('
            case i.type
            when "1" then "INDIVIDUAL"
            when "2" then "GOVERNMENT"
            when "3" then "SCHOOL"
            when "4" then "COMPANY"
            when "5" then "ORGANIZATION"
            when "6" then "TRAVEL AGENCY"
            else "N/A"
            end as accountType'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            else "N/A"
            end as guaranteed'),
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "100" then "Fully Paid"
            when "1000" then "Partial"
            when "3" then "House Use"
            when "999" then "Send Bill"
            else "N/A"
            end as transStatus'),
    ])
    ->first();

    $arrivalDate = $transDetails->arrivalDate;
    $departureDate = $transDetails->depatureDate;



    foreach($amendments as $am){
        if(strtotime($am->amendArriv) < strtotime($arrivalDate)){
            $arrivalDate = $am->amendArriv;
        }

        if(strtotime($am->amendDepart) > strtotime($departureDate)){
            $departureDate = $am->amendDepart;
        }
    }



    $rooms = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$id)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'dd.name as discountName',
        'rr.FinalRoomRate',
        'rr.roomTypeBill',
        'rr.id as roomReservationId',
        'rr.updated_at as roomUpdatedAt',
        'rr.depatureDate',
        'rr.arrivalDate',

        'dd.discountValue',
        'rt.room_rate as roomRate',
        'dd.type as discountType',
    ])
    ->get();

    foreach($rooms as $rr){
        if(strtotime($rr->arrivalDate) < strtotime($arrivalDate)){
            $arrivalDate = $rr->arrivalDate;
        }

        if(strtotime($rr->depatureDate) > strtotime($departureDate)){
            $departureDate = $rr->depatureDate;
        }
    }


    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where('rr.transactionId','=',$id)
    ->select([
        DB::raw("concat(left(g.firstName,1),'. ',g.familyName) as guestName"),
        'g.contactNo',
        'ri.roomName',
    ])
    ->get();

    $guestCharges = DB::table('room_charges as rc')
    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('guests as g','g.id','=','guestId')
    ->where('rr.transactionId','=',$id)
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
        'rc.lessDiscount',
        'rc.type',
        DB::raw("concat(g.firstName,' ',g.familyName) as guestName"),
    ])
    ->get();

    $downpayments = DB::table('downpayments as d')
    ->join('transactions as t','t.id','=','d.transactionId')
    ->where('t.id','=',$id)
    ->select([
        'd.os_id',
        'd.amount',
        'd.notes',
        DB::raw('
            (CASE 
            WHEN d.paidThru = 1 THEN "Cash" 
            WHEN d.paidThru = 2 THEN "Credit Card"
            WHEN d.paidThru = 3 THEN "Cheque"  
            END) AS paidThru'
        ),
        DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d') as chargeCreated"),
        'd.roomReservationId',

    ])
    ->get();

      //  return $roomCharges;
    return view('frontdesk.print-preview-billstatement',compact('transDetails','guestCharges','amendments','guests','rooms','downpayments','user','arrivalDate','departureDate'));
}

public function printPreviewBillstatementModal($id){

    $transId = $id;
    $user = Auth::user();

    $amendments = DB::table('room_amendments as ra')
    ->where('ra.transactionId','=',$id)
    ->join('discount_details as dd','ra.discountId','=','dd.id')
    ->join('room_infos as r','r.id','=','ra.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->select([
        'ra.FinalRoomRate',
        'ra.noOfDays as amendDays',
        'ra.id as amendId',
        'ra.created_at as amendDate',
        'dd.name as discountNameAmend',
        'dd.discountValue',
        'dd.type as discountType',
        'dd.id as idAmend',
        'ra.arrivalDate as amendArriv',
        'ra.depatureDate as amendDepart',
        'dd.discountValue as discountValueAmend',
        'rt.room_rate as amendRate',
        'r.roomName as amendRoomName',
        'rt.name as amendRoomType',
    ])->get();



    $transDetails = DB::table('transactions as t')
    ->where('t.id','=',$id)
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('users as u','u.id','=','t.updatedBy')
    ->select([
        't.code',
        't.specialRequestNotes',
        't.created_at',
        DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
        'i.name as instiName',
        'c.title',
        'c.contactNo as clientContact',
        'i.address as instiAddress',
        'i.contactNo as instiContact',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.checkInTime',
        'rr.checkOutTime',
        'rr.FinalRoomRate',
        'rr.initialArrivalDate',
        'rt.name as roomType',
        'ri.roomName',
        'rr.updated_at as roomUpdatedAt',
        'dd.name as discountName',
        'dd.discountValue',
        'dd.type as discountType',
        'u.firstName',
        'u.lastName',
        DB::raw('
            case t.madeThru
            when "1" then "WALK IN"
            when "2" then "EMAIL"
            when "3" then "PHONE"
            else "N/A"
            end as madeThru'),
        DB::raw('
            case i.type
            when "1" then "INDIVIDUAL"
            when "2" then "GOVERNMENT"
            when "3" then "SCHOOL"
            when "4" then "COMPANY"
            when "5" then "ORGANIZATION"
            when "6" then "TRAVEL AGENCY"
            else "N/A"
            end as accountType'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            else "N/A"
            end as guaranteed'),
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->get();

    $rooms = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$id)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'dd.name as discountName',
        'rr.FinalRoomRate',
        'rr.updated_at as roomUpdatedAt',
        'rr.depatureDate',
        'rr.arrivalDate',
        'dd.discountValue',
        'rt.room_rate as roomRate',
        'dd.type as discountType',
    ])
    ->get();

    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where('rr.transactionId','=',$id)
    ->select([
        DB::raw("concat(left(g.firstName,1),'. ',g.familyName) as guestName"),
        'g.contactNo',
        'ri.roomName',
    ])
    ->get();

    $guestCharges = DB::table('room_charges as rc')
    ->join('guest_reservations as gr','gr.id','=','rc.guestReservationId')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->where('rr.transactionId','=',$id)
    ->select([
        'rc.id as rcID',
        'rc.item_name',
        'rc.created_at as chargeCreated',
        'rc.price',
        'rc.os_id',
        'rc.account_type',
        'rc.type',
    ])
    ->get();

    $downpayments = DB::table('downpayments as d')
    ->join('transactions as t','t.id','=','d.transactionId')
    ->where('t.id','=',$id)
    ->select([
        'd.os_id',
        'd.amount',
        'd.notes',
        DB::raw('
            (CASE 
            WHEN d.paidThru = 1 THEN "Cash" 
            WHEN d.paidThru = 2 THEN "Credit Card"
            WHEN d.paidThru = 3 THEN "Cheque"  
            END) AS paidThru'
        ),
        DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d') as chargeCreated"),

    ])
    ->get();

      //  return $roomCharges;
    return collect(["trans"=>$transDetails,"amendments"=>$amendments,"downpayments"=>$downpayments,"guestCharges"=>$guestCharges,"guests"=>$guests,"rooms"=>$rooms]);


}

public function datatablesClients(){
    $users = DB::table('clients')
    ->select(
        [
            'clients.id',
            DB::raw('
                concat(clients.firstname," ",clients.lastName)
                AS name'),
            'clients.contactNo',
            'clients.title',
        ]
    );

       // if($users)
    return Datatables::of($users)->make(true);


}

public function dataTablesActiveReservationList()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);


    $users = DB::table('transactions')
    ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
    ->join('room_types','room_types.id','=','room_infos.type')
    ->join('institutions','institutions.id','=','transactions.institutionId')
    ->join('account_types','account_types.id','=','institutions.type')
    ->join('clients','clients.id','=','transactions.clientId')
    ->where('transactions.guaranteed','=',2)
    ->where('room_reservations.occupied_status','=',0)
    ->where('transactions.status','!=',1)
    ->groupBy('transactions.id')
    ->orderBy('transactions.id','desc')
    ->select(
        [
         'transactions.id',
         'transactions.status',
         'institutions.name as institutionName',
         'account_types.name as institutionType',
         DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),
         DB::raw('group_concat(room_infos.roomName separator ", ") as roomNames'),  
         'transactions.code',
         'room_reservations.initialArrivalDate as arrivalDate',
         'room_reservations.depatureDate',
         DB::raw("DATE_FORMAT(transactions.created_at,'%b %d, %Y %h:%i %p') as dateMade"),
     ]
 );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function dataTablesGuaranteedReservationList()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);


    $users = DB::table('transactions')
    ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
    ->join('room_types','room_types.id','=','room_infos.type')
    ->join('institutions','institutions.id','=','transactions.institutionId')
    ->join('account_types','account_types.id','=','institutions.type')
    ->join('clients','clients.id','=','transactions.clientId')
    ->where('transactions.guaranteed','=',1)
    ->where('transactions.status','!=',1)
    ->where('room_reservations.occupied_status','=',0)
    ->groupBy('transactions.id')
    ->orderBy('transactions.id','desc')
    ->select(
        [
         'transactions.id',
         'transactions.status',
         'institutions.name as institutionName',
         'account_types.name as institutionType',
         DB::raw('group_concat(room_infos.roomName separator ", ") as roomNames'), 
         DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
         'transactions.code',
         'room_reservations.initialArrivalDate as arrivalDate',
         'room_reservations.depatureDate',
         DB::raw("DATE_FORMAT(transactions.created_at,'%b %d, %Y %h:%i %p') as dateMade"),
     ]
 );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function dataTablesStayingReservationList()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);


    $users = DB::table('transactions')
    ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
    ->join('room_types','room_types.id','=','room_infos.type')
    ->join('institutions','institutions.id','=','transactions.institutionId')
    ->join('account_types','account_types.id','=','institutions.type')
    ->join('clients','clients.id','=','transactions.clientId')
    ->where('room_reservations.occupied_status','=',1)
    ->where('transactions.status','!=',1)
    ->groupBy('transactions.id')
    ->orderBy('transactions.id','desc')
    ->select(
        [
         'transactions.id',
         'institutions.name as institutionName',
         'account_types.name as institutionType',
         DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
         'transactions.code',
         'room_reservations.initialArrivalDate as arrivalDate',
         DB::raw('group_concat(room_infos.roomName separator ", ") as roomNames'), 
         'room_reservations.depatureDate',
         'transactions.status',

     ]
 );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function dataTablesCheckedOutList()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);


    $users = DB::table('transactions')
    ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
    ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
    ->join('room_types','room_types.id','=','room_infos.type')
    ->join('institutions','institutions.id','=','transactions.institutionId')
    ->join('account_types','account_types.id','=','institutions.type')
    ->join('clients','clients.id','=','transactions.clientId')
    ->where('room_reservations.occupied_status','=',2)
    ->where('room_reservations.depatureDate','=',date('Y-m-d'))
    ->groupBy('transactions.id')
    ->orderBy('transactions.id','desc')
    ->select(
        [
         'transactions.id',
         'institutions.name as institutionName',
         'account_types.name as institutionType',
         DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
         'transactions.code',
         'room_reservations.initialArrivalDate as arrivalDate',
         'room_reservations.depatureDate',
         DB::raw('group_concat(room_infos.roomName separator ", ") as roomNames'), 
         'transactions.status',

     ]
 );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}


public function datatablesInstitutions()
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

    $users = DB::table('institutions')
    ->join('account_types as acc','institutions.type','=','acc.id')
    ->select(
        [
            'institutions.id',
            'institutions.name as name',
            'institutions.contactNo as contactNo',
            'acc.name as type',

        ]
    );


    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function getInstitution($id){
    $insti = DB::table('institutions as i')
    ->where('i.id','=',$id)
    ->first();

    return response()->json($insti);
}


public function getClient($id){
    $clients = DB::table('clients as c')
    ->where('c.id','=',$id)
    ->first();

    return response()->json($clients);
}

public function getDiscount($id){
    $discounts = DB::table('discount_details as dd')
    ->where('dd.id','=',$id)
    ->select([
        'dd.id',
        'dd.name as discountName',
        'dd.discountValue',
        'dd.status',
        'dd.type',
    ])
    ->get();

    return collect(['discounts'=>$discounts]);
}

public function dataTablesGuestReservationList($id)
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

        // $users = DB::table('transactions as t')
        //     ->join('room_reservations as rr','rr.transactionId','=','t.id')
        //     ->join('room_infos as r','r.id','=','rr.roomId')
        //     ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
        //     ->join('guests as g','g.id','=','gr.guestId')
        //     ->where('t.id','=',$id)
        //     ->orderBy('r.roomNo','asc')
        //     ->select(
        //         [
        //         'gr.id',
        //        DB::raw('
        //         case gr.status
        //             when "3" then "N/A"
        //             else r.roomName
        //         end as roomName'),
        //         DB::raw('
        //             concat(g.firstName," ",g.familyName)
        //             AS name'),
        //         'g.account_id',

        //         ]
          //      );

  $users = DB::table('guest_reservations as gr')
  ->join('room_reservations as rr','gr.roomReservationId','=','rr.id')
  ->join('transactions as t','rr.transactionId','=','t.id')
  ->where('t.id','=',$id)
  ->join('room_infos as r','r.id','=','rr.roomId')
  ->join('guests as g','g.id','=','gr.guestId')
  ->orderBy('r.roomNo','asc')
  ->select(
    [
        'gr.id',
        DB::raw('
            case gr.status
            when "3" then "N/A"
            else r.roomName
            end as roomName'),
        DB::raw('
            concat(g.firstName," ",g.familyName)
            AS name'),
        'g.account_id',

    ]
);

  return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

public function dataTablesRoomReservationList($id)
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

    $users = DB::table('transactions as t')
    ->where('t.id','=',$id)
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->join('room_infos as r','r.id','=','rr.roomId')
    ->join('room_types as rt','rt.id','=','r.type')
    ->select(
        [
            'rr.id',
            'r.roomName',
            'rr.occupied_status',
            'rt.name as roomType',
        ]
    );

    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}

    // public function specialRequestList()
    // {
    //     $users = DB::table('transactions')
    //         ->join('room_reservations', 'room_reservations.transactionId','=','transactions.id')
    //         ->join('room_infos','room_infos.id','=','room_reservations.roomId')
    //         ->where("room_reservations.arrivalDate", ">=", date('Y-m-d'))
    //         ->orWhere("room_reservations.depatureDate","<=",date('Y-m-d'))
    //         ->orderby('special_requests.requestDate')
    //         ->select(
    //             [
    //                 'special_requests.id',
    //                 'room_infos.roomName',
    //                 DB::raw('concat(room_infos.roomName," - ",transactions.code) as roomTransaction'),
    //                 DB::raw("DATE_FORMAT(special_requests.requestTime, '%h:%i %p') as requestTime"),
    //                 'special_requests.note',
    //             ]
    //             )->get();

    //     return $users;
    //     //return Datatables::of(Users::query())->make(true);
    // }


public function datatablesSpecialRequestList($id)
{
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

    $users = DB::table('transactions')
    ->join('room_reservations', 'room_reservations.transactionId','=','transactions.id')
    ->join('special_requests','special_requests.roomReservationId', '=', 'room_reservations.id')
    ->join('room_infos','room_infos.id','=','room_reservations.roomId')
    ->where('transactions.id','=',$id)
    ->whereRaw("concat(requestDate,' ',requestTime) > now()")            
    ->orderby('special_requests.requestDate')
    ->select(
        [
            'special_requests.id',
            'room_infos.roomName',
            DB::raw("DATE_FORMAT(special_requests.requestDate,'%b. %d, %Y') as requestDate"),
            DB::raw("DATE_FORMAT(special_requests.requestTime, '%h:%i %p') as requestTime"),
            'special_requests.note',
        ]
    );

    return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
}


public function closeTransaction(Request $req){
    $inputs = $req->all();

    $trans = DB::table('transactions as t')
    ->where('t.id','=',$inputs["transID"])
    ->update(["t.status"=>$inputs["status"],"t.totalTransactionBill"=>$inputs["grandTotal"]]);

    $transa = DB::table('transactions as t')
    ->where('t.id','=',$inputs["transID"])
    ->first();


    return redirect()->route('frontdesk.guestRegistration', ['reservID' => $transa->code]);

}

public function saveSpecialRequest(Request $req){
    $inputs = $req->all();
    if($inputs['durationRequest']==0)
    {
        DB::table('special_requests')->insert(
            [
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"), 
                'roomReservationId' => $inputs['roomRequest'], 
                'requestDate' => date_format(date_create($inputs['dateRequest']),"Y-m-d"), 
                'requestTime' => date("H:i", strtotime($inputs['timeRequest'])), 
                'note' => $inputs['noteRequest'], 
                'status' => 1,
            ]
        );
    }
    elseif($inputs['durationRequest']==1)
    {
        $depatureDate = DB::table('room_reservations')
        ->where('room_reservations.id', '=',$inputs['id'])
        ->select(
            [
                DB::raw('datediff(room_reservations.depatureDate,"'.date_format(date_create($inputs['dateRequest']),"Y-m-d").'") as daysDiff')
            ]
        )->get();

        foreach($depatureDate as $dd)
        {
            $dateDiff = $dd->daysDiff;

            for($i=0;$i<$dateDiff;$i++)
            {
                $datesHere = date('Y-m-d',strtotime(date_format(date_create($inputs['dateRequest']),"Y-m-d")) + (24*3600*$i));
                DB::table('special_requests')->insert(
                    [
                        'created_at' => date("Y-m-d H:i:s"), 
                        'updated_at' => date("Y-m-d H:i:s"), 
                        'roomReservationId' => $inputs['id'], 
                        'requestDate' => $datesHere, 
                        'requestTime' => $inputs['timeRequest'], 
                        'note' => $inputs['noteRequest'], 
                        'status' => 1,
                    ]
                );
            }


        }
    }



    return 'success';

}

public function deleteSpecialRequestAjax(Request $req){
    $inputs = $req->all();
    DB::table('special_requests')->where('id', '=', $inputs['id'])->delete();
    return 'Success';
}

public function retrieveRoomTransaction(Request $req){
    $inputs = $req->all();
    $user=Auth::user();
    $rooms = DB::table('transactions')
    ->join('room_reservations','room_reservations.transactionId','=','transactions.id')
    ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
    ->where('transactions.id', '=',$inputs['id'])
    ->groupby('room_infos.id')
    ->select(
        [
            'room_reservations.id',
            'room_infos.roomName as name'
        ]
    )->get();

    return $rooms;

}

public function transactionSummary($id){
    $transaction = DB::table('transactions as t')
    ->where('t.id','=',$id)
    ->join('room_reservations as rr','rr.transactionId','=','t.id')
    ->join('clients as c','c.id','=','t.clientId')
    ->join('institutions as i','i.id','=','t.institutionId')
    ->join('users as u','u.id','=','t.updatedBy')
    ->select([
        't.code',
        't.specialRequestNotes as notes',
        DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
        'i.name as instiName',
        'c.title',
        'c.contactNo as clientContact',
        'i.address as instiAddress',
        'rr.arrivalDate',
        'rr.depatureDate',
        'rr.checkInTime',
        'rr.checkOutTime',
        DB::raw('
            case t.madeThru
            when "1" then "WALK IN"
            when "2" then "EMAIL"
            when "3" then "PHONE"
            else "N/A"
            end as madeThru'),
        DB::raw('
            case i.type
            when "1" then "INDIVIDUAL"
            when "2" then "GOVERNMENT"
            when "3" then "SCHOOL"
            when "4" then "COMPANY"
            when "5" then "ORGANIZATION"
            when "6" then "TRAVEL AGENCY"
            else "N/A"
            end as accountType'),
        DB::raw('
            case t.guaranteed
            when "1" then "Yes"
            when "2" then "No"
            else "N/A"
            end as guaranteed'),
        DB::raw('
            case t.chargeType
            when "1" then "Cash"
            when "2" then "Debit/Credit Card"
            when "3" then "Cheque"
            else "N/A"
            end as chargeType'),
        DB::raw('
            case t.billingType
            when "1" then "CTC"
            when "2" then "GA"
            else "N/A"
            end as billingType'),
        DB::raw('
            case t.status
            when "0" then "Ongoing"
            when "1" then "Billed"
            when "2" then "No Show"
            when "3" then "House Use"
            else "N/A"
            end as transStatus'),
    ])
    ->first();

    $rooms = DB::table('room_reservations as rr')
    ->where('rr.transactionId','=',$id)
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('discount_details as dd','dd.id','=','rr.discountId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'dd.name as discountName',
        'rr.FinalRoomRate',
        'dd.discountValue',
        'dd.type as discountType',
    ])
    ->get();

    $guests = DB::table('guests as g')
    ->join('guest_reservations as gr','gr.guestId','=','g.id')
    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->where('rr.transactionId','=',$id)
    ->select([
        'g.firstName',
        'g.familyName',
        'g.contactNo',
        'ri.roomName',
    ])
    ->get();


    return collect(["transaction"=>$transaction,"rooms"=>$rooms,"guests"=>$guests]);
}

public function changeTransactionStatus(Request $req){

    $inputs = $req->all();

    if($inputs["status"]==2){
        $trans = DB::table('transactions as t')
        ->join('room_reservations as rr','rr.transactionId','=','t.id')
        ->join('room_infos as ri','ri.id','=','rr.roomId')
        ->where('t.id','=',$inputs["tID"])
        ->update(['t.status'=>$inputs["status"],'ri.status'=>0,'ri.cleanStatus'=>2,'rr.arrivalDate'=>"",'rr.depatureDate'=>"",'rr.occupied_status'=>3]); 
    }

    if($inputs["status"]==3){
      $trans = DB::table('transactions as t')
      ->join('room_reservations as rr','rr.transactionId','=','t.id')
      ->join('room_infos as ri','ri.id','=','rr.roomId')
      ->where('t.id','=',$inputs["tID"])
      ->update(['t.status'=>$inputs["status"],'ri.status'=>7]); 
  }
  else{
    $trans = DB::table('transactions as t')->where('t.id','=',$inputs["tID"])->update(['t.status'=>$inputs["status"]]);  
}

$transaction = Transaction::findOrFail($inputs["tID"]);

return $transaction->status;
}

public function printRoomStatusReport(){
    $rooms = DB::table('room_infos')
    ->join('room_types', 'room_types.id', '=', 'room_infos.type')

    ->select(
        [
            'room_infos.id',
            'room_infos.roomName',
            'room_infos.type as roomType',
            'room_types.name as type',

            DB::raw('
                case room_infos.status
                when "0" then "Vacant Ready"
                when "1" then "Occupied"
                when "2" then "Vacant Dirty"
                when "3" then "Blocked"
                when "4" then "Out of Order"
                when "5" then "No Show"
                when "6" then "Slept Out"
                when "7" then "House Use"
                end as status')
        ]
    )
    ->orderBy('roomName')
    ->get();

    $roomRes = DB::table('room_reservations as rr')
    ->where('rr.arrivalDate','<=',date('Y-m-d'))
    ->where('rr.depatureDate','>=',date('Y-m-d'))
    ->get();

    $blockedRooms = array();

    foreach($roomRes as $r)
        array_push($blockedRooms, $r->roomId);

    return view('frontdesk.print-room-status-report',compact('rooms','blockedRooms'));
}

public function printDailyRoomGuestCount(Request $req){



    $rooms = DB::table('room_reservations as rr')
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('room_types as rt','rt.id','=','ri.type')
    ->where('rr.arrivalDate','<=',date('Y-m-d'))
    ->where('rr.depatureDate','>=',date('Y-m-d'))
    ->select([
        'ri.roomName',
        'rt.name as roomType',
        'rr.id as roomReservationId',
        'rr.arrivalDate',
        'rr.depatureDate',
        DB::raw('
            case rr.occupied_status
            when "1" then "Checked In"
            when "2" then "Checked Out"
            else "BLO"
            end as remarks'),
    ])
    ->orderBy('roomType')
    ->get();

    $guestList = DB::table('guest_reservations as gr')
    ->join('guests as g','g.id','=','gr.guestId')
    ->whereIn('gr.status',array(1,2,4))
    ->select(
        [
            'g.firstName',
            'g.familyName',
            'gr.roomReservationId',
        ]
    )
    ->get();

    return view('frontdesk.print-daily-room-guest-report',compact('rooms','guestList'));

}

public function roomOccupancyReport(Request $req){

    $inputs = $req->all();

    $dateStart = date_format(date_create($inputs["dateStart"]),"Y-m-d");
    $dateEnd = date_format(date_create($inputs["dateEnd"]),"Y-m-d");


    $roomsArrival = DB::table('room_reservations as rr')   
    ->where('rr.arrivalDate',">=",$dateStart)
    ->where("rr.arrivalDate","<=",$dateEnd)
    ->select([
        "rr.arrivalDate",
        DB::raw('sum(if(rr.arrivalDate is not null, 1,0)) as roomsArrival')
    ]) 
    ->groupby("rr.arrivalDate")
    ->get();

    $roomsCheckIn = DB::table('room_reservations as rr')
    ->leftjoin(DB::raw('(select roomReservationId, count(id) as numGuests from guest_reservations group by roomReservationId) as guestCount'), function ($join) {
        $join->on('guestCount.roomReservationId', '=', 'rr.id');
    })
    ->join('room_infos as ri','ri.id','=','rr.roomId')
    ->join('room_types as rt','ri.type','=','rt.id')

    ->where('rr.arrivalDate',">=",$dateStart)
    ->where("rr.arrivalDate","<=",$dateEnd)
    ->orwhere('rr.depatureDate',"<=",$dateStart)
    ->where("rr.depatureDate",">=",$dateEnd)
    ->orwhere('rr.arrivalDate',"<=",$dateStart)
    ->where("rr.depatureDate",">=",$dateEnd)
    ->orwhere('rr.arrivalDate',"<=",$dateStart)
    ->where("rr.depatureDate",">=",$dateStart)
    ->orwhere('rr.arrivalDate',"<=",$dateEnd)
    ->where("rr.depatureDate",">=",$dateEnd)
    ->select([
        "rr.id",
                       //     "guestCount.numGuests",
        "rr.arrivalDate",
        "rr.depatureDate",
        "rt.max_people as numGuests",
                       //     DB::raw('sum(if(rr.arrivalDate is not null, 1,0)) as roomsArrival')
    ]) 
                       // ->groupby("rr.depatureDate")
                       // ->groupby("rr.arrivalDate")
    ->get();

    $dates = [];
    $tempDate = $dateStart;



    for($i = date("d",strtotime($dateStart));$i<= date("d",strtotime($dateEnd));$i++){
       $tempDate = date("Y",strtotime($dateStart))."-".date("m",strtotime($dateStart))."-".sprintf("%02d", $i);
       array_push($dates,$tempDate);
   }
        // while($tempDate != $dateEnd){
        //        $datePlus1 = date("d",strtotime($dateStart))+1;
        //  $tempDate = date("Y",strtotime($dateStart))."-".date("m",strtotime($dateStart))."-".$datePlus1;
        //     array_push($dates,$tempDate);
        // }

    //     return $dates;
    //   return $dates;
    //  return $roomsCheckIn;

   return view('frontdesk.print-room-occupancy-report',compact('roomsCheckIn','dates'));
}


public function getCheckOutReport(Request $req){

    $inputs = $req->all();

    $checkOutDate = date_format(date_create($inputs["date-checkOut"]),"Y-m-d");

    $roomReservations = RoomReservation::where("depatureDate","=",$checkOutDate)
    ->join("room_infos as ri","ri.id","=","room_reservations.roomId")
    ->join("room_types as rt","rt.id","=","ri.type")
    ->join("transactions as t","t.id","=","room_reservations.transactionId")
    ->join("clients as c","c.id","=","t.clientId")
    ->orderby("room_reservations.arrivalDate","asc")
    ->select([
        DB::raw("concat(c.firstname,' ',c.lastName) as bookingPerson"),
        DB::raw("concat(ri.roomName,' - ',rt.name) as room"),
        "room_reservations.arrivalDate",
        DB::raw("date_format(room_reservations.checkInTime,'%r') as checkInTime"),
        DB::raw("date_format(room_reservations.checkOutTime,'%r') as checkOutTime"),
        "room_reservations.depatureDate",
        DB::raw('
            case room_reservations.occupied_status
            when "1" then "Checked In"
            when "2" then "Checked Out"
            when "0" then "N/A"
            else "N/A"
            end as status'),

    ])
    ->get();

    return view('frontdesk.print-preview-checkoutreport',compact('checkOutDate','roomReservations'));
}



public function printPreviewReservation($id){



   $tDetails = DB::table('transactions as t')
   ->where('t.id','=',$id)
   ->join('room_reservations as rr','rr.transactionId','=','t.id')
   ->join('clients as c','c.id','=','t.clientId')
   ->join('institutions as i','i.id','=','t.institutionId')
   ->join('users as u','u.id','=','t.updatedBy')
   ->select([
    't.code',
    't.specialRequestNotes as notes',
    't.created_at',
    DB::raw("concat(c.firstName,' ',c.lastName) as clientName"),
    'i.name as instiName',
    'c.title',
    'c.contactNo as clientContact',
    'i.address as instiAddress',
    'i.contactNo as instiContact',
    'rr.arrivalDate',
    'rr.depatureDate',
    'rr.checkInTime',
    'rr.checkOutTime',
    'u.firstName',
    'u.lastName',
    DB::raw('
        case t.madeThru
        when "1" then "WALK IN"
        when "2" then "EMAIL"
        when "3" then "PHONE"
        else "N/A"
        end as madeThru'),
    DB::raw('
        case i.type
        when "1" then "INDIVIDUAL"
        when "2" then "GOVERNMENT"
        when "3" then "SCHOOL"
        when "4" then "COMPANY"
        when "5" then "ORGANIZATION"
        when "6" then "TRAVEL AGENCY"
        else "N/A"
        end as accountType'),
    DB::raw('
        case t.guaranteed
        when "1" then "Yes"
        when "2" then "No"
        else "N/A"
        end as guaranteed'),
    DB::raw('
        case t.chargeType
        when "1" then "Cash"
        when "2" then "Debit/Credit Card"
        when "3" then "Cheque"
        else "N/A"
        end as chargeType'),
    DB::raw('
        case t.billingType
        when "1" then "CTC"
        when "2" then "GA"
        else "N/A"
        end as billingType'),
    DB::raw('
        case t.status
        when "0" then "Ongoing"
        when "1" then "Billed"
        when "2" then "No Show"
        when "3" then "House Use"
        else "N/A"
        end as transStatus'),
])
   ->first();

   $rooms = DB::table('room_reservations as rr')
   ->where('rr.transactionId','=',$id)
   ->join('room_infos as ri','ri.id','=','rr.roomId')
   ->join('discount_details as dd','dd.id','=','rr.discountId')
   ->join('room_types as rt','rt.id','=','ri.type')
   ->select([
    'ri.roomName',
    'rt.name as roomType',
    'dd.name as discountName',
    'rr.FinalRoomRate',
    'dd.discountValue',
    'dd.type as discountType',
])
   ->get();

   $guests = DB::table('guests as g')
   ->join('guest_reservations as gr','gr.guestId','=','g.id')
   ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
   ->join('room_infos as ri','ri.id','=','rr.roomId')
   ->where('rr.transactionId','=',$id)
   ->select([
    'g.firstName',
    'g.familyName',
    'g.contactNo',
    'ri.roomName',
])
   ->get();

   return view('frontdesk.print-preview-reservation',compact('guests','rooms','tDetails'));
       // return $roomsAndGuests;
}


public function saveReservationNotes(Request $req){
    $transID = $req->get('transID');

    $t = Transaction::find($transID);
    $t->specialRequestNotes = $req->get('notes');
    $t->save();

    return $t;
}

public function managerCheck(Request $req){
    $username = $req->get('username');
    $password = $req->get('password');

    $u = User::where('username',$username)->first();


    if($u)
    {
        if (Hash::check($password, $u->password))
        {
            if($u->role == '4')
                return 1;
            else
                return 2;
        }
        else
            return 2;
    }
    else
        return 2;

}

public function makeDownpayment(Request $req){
    $inputs = $req->all();
    

    foreach($inputs['payment'] as $key=>$value)
    {

        if($value != NULL){
            $dp = new Downpayment();
            $dp->transactionId = $inputs["transID"];
            $dp->amount = $value;
            $dp->paidThru = $inputs['paidthru'.$key];
            $dp->notes = $inputs['notes'.$key];
            $dp->roomReservationId = $key;
            $dp->user_id = Auth::user()->id;
            $dp->save();
        }



    }


    
    $t = Transaction::find($inputs["transID"]);

    $t->guaranteed = 1;
    $t->save();


        // if($downpayment)
        //     $dp = $downpayment;


    return redirect()->route('frontdesk.guestRegistration', ['reservID' => $t->code]);

}

public function addFileToGuest(Request $req){

}

public function saveWithHoldingTax(Request $req){

    $trans = Transaction::find($req->get('transID'));

    $trans->withHoldingTax = $req->get('amount');
    $trans->save();

    return  $trans->withHoldingTax;
}


}
