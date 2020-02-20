<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Client;
use App\Transaction;
use App\RoomReservation;
use App\GuestReservation;
use App\Guest;
use App\RoomCharge;
use App\Institution;
use App\RoomAmendment;

use Input;
use Validator;
use Redirect;
use Session;
use Storage;
use Response;
 

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
    
    public function pdfTest(Request $request){
                $users = DB::table("users")->get();

        view()->share('users',$users);

 $user=Auth::user();
        $rooms = RoomInfo::all();
        
        if($request->has('download')){
            $html = View::make('frontdesk.print-preview',compact('user'))->render();
            
            $pdf = PDF::loadHTML($html);

            return PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->inline('pdfview.pdf');
           // return PDF::loadFile('http://www.github.com')->inline('github.pdf');

        }


        return view('pdfview');
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
        $room_charge->account_type = $req->get('accType');
        $room_charge->save();
        
    }
    
    public function index(Request $req){
        
      
        
        
        $dateMain = date_format(date_create($req->get('date-main')),"Y-m-d");
        $random = $this->randomGenerator();

        $today = time();
        $date = date('F j, Y');
        $hiddenDate = $date;
        
        $rooms_list = DB::table('room_types')
                    ->join('room_infos','room_infos.type','=','room_types.id')
                    ->select([
                        'room_types.id as roomType_id',
                        'room_infos.id',
                        'room_types.name as roomType',
                        'room_infos.roomName',
                        'room_infos.status',
                        'room_infos.roomNo',
                    ])->get();
        
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
                    ->select([
                        'room_infos.roomName',
                        'room_infos.roomNo',
                        'room_infos.type',
                        'room_infos.id',
                        'room_types.name as roomType',
                        'room_types.room_rate as rate',
                    ])
                    ->get();
            
    // return $rooms;
    //   return $roomsType1; 
        return view('frontdesk.index',compact('user','date','rooms','roomsCheck','roomStatus','roomStatusColor','blockedRooms','random','hiddenDate','roomsType1'));
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

    public function getImage($filename) {
       $path = storage_path().'/app/issues/'.$filename;
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

        return $alpha[$eight]."".$alpha[$six]."".$five."".$seven."".$nine;
   }
    
    public function dataTablesAmmendmentTables(Request $request){
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
            ->join('institutions', 'institutions.id', '=', 'Clients.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->groupby('room_amendments.id')
            ->select(
                [
                
                DB::raw('
                    concat(guests.Firstname," ",guests.familyName)
                    AS guest'),
                'Transactions.code',
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
        $transaction->chargeType = $inputs['chargeType'];
        $transaction->clientId = $clientId;
        $transaction->madeThru = $inputs['madeThru'];
        $transaction->guaranteed = $inputs['guaranteed'];
        $transaction->guaranteedNote = $inputs['guaranteedArrangementsNotes'];
        $transaction->specialRequestNotes = $inputs['specialRequest'];
        $transaction->billingType = $inputs['billArrange'];
        $transaction->billingNote = $inputs['billingArrangementsNotes'];
        $transaction->institutionId = $institutionsId;
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
            $roomReservation->initialDepartureDate = date_format(date_create($inputs['departureDate']),"Y-m-d");
            $roomReservation->checkInTime = $inputs['checkIntimepicker'];
            $roomReservation->checkOutTime = $inputs['checkOuttimepicker'];


            $roomReservation->discountId = $inputs['discountType'.$r];
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
        
        flash('New Reservation has been made. Reservation ID: '.$transCode);
        
        return redirect()->route('frontdesk.guestRegistration', ['reservID' => $transCode]);
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
        
//        $subQuery=DB::table('room_reservations')
//               ->whereRaw('
//               (room_reservations.arrivalDate <= '.$arrival.' AND room_reservations.depatureDate >= '.$arrival.')
//               OR (room_reservations.arrivalDate < '.$departure.' AND room_reservations.depatureDate >= '.$departure.' )
//               OR ('.$arrival.' <= room_reservations.arrivalDate AND '.$departure.' >= depatureDate)')
//                ->get();
//        
//        $query = DB::table('room_reservations')
//            ->whereIn('room_reservation.id', $subQuery)
//            
//            ->get();
     foreach($query as $q){
            array_push($results,$q->roomId);
        }
        
      foreach($query2 as $q){
            array_push($results,$q->roomId);
        }
         
            return response()->json($results);
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
        
        $roomReserve = RoomReservation::findOrFail($roomReserveId);
        
        GuestReservation::where('roomReservationId','=',$roomReserveId)->where('status','=',1)->update(['status'=>2]);
        
        $roomReserv = RoomReservation::where('id','=',$roomReserveId)->update(['occupied_status'=>1,'noOfdays'=>1]);
        
        DB::table('room_reservations as rr')->where('rr.id','=',$roomReserveId)->join('room_infos as r','r.id','=','rr.roomId')->update(['r.status'=>1, 'r.cleanStatus'=>3]);
        
       // RoomInfo::where('id','=',$roomReserve->roomId)->update(['status'=>1]);
        
        //Purchase::where('created_at','>=','2016-09-14 23:19:25')->update(['is_paid'=>5]);
        return response()->json($roomReserve);
        
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
    
    public function confirmRemoveGuest($id){
        $guestReserv = GuestReservation::findOrFail($id);
        
        $guestReserv->delete();
      
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
                                'rr.id',
                                'rr.noOfDays',
                                'rt.room_rate as rate',
                                'rt.id',
                                'dd.name as discountName',
                                'dd.id',
                                'dd.discountValue',
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
        $transactionId = NULL;
        $registExist = false;
        $notes = NULL;
        
        if($code){
          
        $registExist = true;
        $transaction = DB::table('transactions')->where('code',$code)->first();
        $notes = $transaction->specialRequestNotes;
        $transactionId = $transaction->id;
            
        $client = $transaction->clientId;
        
        $guests = DB::table('guests')
                        ->join('guest_reservations','guests.id','=','guest_reservations.guestId')
                        ->join('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
                        ->join('room_infos','room_reservations.roomId','=','room_infos.id')
                        ->join('transactions','transactions.id','=','room_reservations.transactionId')
                        ->where('transactions.id','=',$transactionId)
                        ->where('guest_reservations.status','=',1)
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
      return view('frontdesk.guest-registration',compact('user','notes','client','guests','rooms','bookedRooms','registExist','code','transactionId'));
        
    //    return $guests;
        
//        return $rooms;
             
    }


    
    public function getRoomDetails($id){
        $roomSelectedReserv = RoomReservation::findOrFail($id);
        
        
        $room = DB::table('room_reservations as rr')
                ->where('rr.id','=',$id)
                ->join('room_infos as r','r.id','=','rr.roomId')
                ->join('room_types as rt','rt.id','=','r.type')
                ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
                ->join('guests as g','g.id','=','gr.guestId')
                ->select([
                    'rr.id',
                    'r.roomName',
                    'rt.name as roomType',
                    'rr.occupied_status',
                    'g.firstName',
                    'g.familyName',
                    'rr.arrivalDate',
                    'rr.depatureDate',
                    'rr.initialDepartureDate',
                ])
                ->get();
        
        return response()->json($room);
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
                        
                    ])
                    ->get();
        
        $roomsStaying = DB::table('room_infos')
                    ->join('room_reservations as rr','rr.roomId','=','room_infos.id')
                    ->where('rr.arrivalDate','<',$dateMain)
                     ->where('rr.depatureDate','>',$dateMain)
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
                    ])
                    ->get();
        
        $roomsDepart = DB::table('room_infos')
                    ->join('room_reservations as rr','rr.roomId','=','room_infos.id')
                     ->where('rr.depatureDate','=',$dateMain)
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
                    ])
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
           
                
        //code goes here...
        return view('frontdesk.night-audit',compact('user','date','hiddenDate','roomsArrivals','guestsArrivals','roomsStaying','roomsDepart'));
      //  return $guestsArrivals;
      //  return $rooms;
    }
    
    public function amendments(){
        $user=Auth::user();
        
        //code goes here...
      //  return view('frontdesk.amendments',compact('user'));
    }
    
   
   //////////////////Room Issue



    
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

    /////////for special Request transaction Retreival
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
            ->where('transactions.status','!=',1)
            ->where('room_reservations.occupied_status','!=',2)
            ->where('room_reservations.status','!=',1)
            ->whereraw('room_reservations.arrivalDate>=curdate()')
            ->orderby('room_reservations.arrivalDate')
            ->groupby('room_reservations.id')
            ->select(
                    [
                        DB::raw('room_reservations.id as id'),
                        DB::raw('room_infos.roomName as title'),
                        DB::raw('concat(room_reservations.arrivalDate) as start'),
                        DB::raw('concat(room_reservations.depatureDate) as end'),
                        DB::raw("CASE 
                                    WHEN transactions.guaranteed = 2 && room_reservations.arrivalDate > date('Y-m-d') THEN 'red'
                                    WHEN transactions.guaranteed = 1 && room_reservations.arrivalDate >= date('Y-m-d') THEN 'green'
                                END AS color"),
                        
                    ]
            )->get();
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
        $RoomAmendment->userId = $req->get('currentUserId');
        $RoomAmendment->notes = $req->get('notes');
        $RoomAmendment->status = $req->get('chargeRoom');

        $RoomAmendment->noOfDays = 0;

        if($req->get('chargeRoom')==1)
        {
            $RoomAmendment->transactionId = $roomRes->transactionId;
            $RoomAmendment->roomId = $roomRes->roomId;
            
            $RoomAmendment->noOfDays = $roomRes->noOfdays;
            $RoomAmendment->arrivalDate = $roomRes->arrivalDate;
            $RoomAmendment->depatureDate = $roomRes->depatureDate;
            $RoomAmendment->checkInTime = $roomRes->checkInTime;
            $RoomAmendment->checkOutTime =$roomRes->checkOutTime;
            $RoomAmendment->discountId = $roomRes->discountId;
            $RoomAmendment->billingType = $roomRes->billingType;
            $RoomAmendment->billingNote = $roomRes->billingNote;
            $RoomAmendment->roomReservationstatus = $roomRes->status;
            $RoomAmendment->save();
            
        }
            

        $RoomAmendment->save();

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
                                DB::raw('
                                    case t.billingType
                                    when "1" then "Charge to Company"
                                    when "2" then "Guest Account"
                                    end as billingType'),
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
    
    public function printPreviewReservation($id){
     
            
        $transID = $id;
        $roomsAndGuests = DB::table('transactions')->where('transactions.id','=',$transID)
                        ->leftJoin('room_reservations','room_reservations.transactionId','=','transactions.id')
             ->leftJoin('guest_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
                        ->leftJoin('guests','guest_reservations.guestId','=','guests.id')
                        ->leftJoin('clients','clients.id','=','transactions.clientId')
                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
                        ->leftJoin('account_types','institutions.type','=','account_types.id')
                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
             ->select(
                                [
                                'transactions.id',
                                'guests.firstName',
                                'guests.familyName',
                                'guests.account_id',
                                'guests.id as guestId',
                                'clients.firstname as clientFirstName',
                                'clients.lastName as clientLastName',
                                'clients.contactNo as clientContact',
                                'clients.title as clientTitle',
                                'institutions.name as instiName',
                                'institutions.address as instiAddress',
                                'account_types.name as accountType',
                                'room_reservations.arrivalDate',
                                'room_reservations.depatureDate',
                                'room_reservations.checkInTime',
                                'room_reservations.checkOutTime',
                                'guest_reservations.guest_registration_no',
                                'transactions.code',
                                'guests.houseNo',
                                'guests.brgy',
                                'guests.city',
                                'guests.country',
                                'guests.contactNo',
                                'guest_reservations.billType',
                                'guest_reservations.chargeType',
                                 'transactions.specialRequestNotes',
                                'transactions.madeThru',
                                'room_infos.rate',
                                'room_infos.roomName',
                                'room_infos.roomNo',
                                'room_types.name as roomType',
                              
                                ]
                                )->orderBy('roomNo')
                        ->get();
        
        $tDetails = DB::table('guests')
                        ->leftJoin('guest_reservations','guests.id','=','guest_reservations.guestId')
                        ->leftJoin('room_reservations','guest_reservations.roomReservationId','=','room_reservations.id')
                         ->join('transactions',function($join) use ($transID)
                            {
                                $join->on( 'room_reservations.transactionId','=','transactions.id')
                                        ->where('transactions.id', '=', $transID);
                            })
                        ->leftJoin('clients','clients.id','=','transactions.clientId')
                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
                        ->leftJoin('account_types','institutions.type','=','account_types.id')
                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
             ->select(
                                [
                                'transactions.id',
                                'guests.firstName',
                                'guests.familyName',
                                'guests.account_id',
                                'guests.id',
                                'clients.firstname as clientFirstName',
                                'clients.lastName as clientLastName',
                                'clients.contactNo as clientContact',
                                'clients.title as clientTitle',
                                'institutions.name as instiName',
                                'institutions.address as instiAddress',
                                'account_types.name as accountType',
                                'room_reservations.arrivalDate',
                                'room_reservations.depatureDate',
                                'room_reservations.checkInTime',
                                'room_reservations.checkOutTime',
                                'guest_reservations.guest_registration_no',
                                'transactions.code',
                                'guests.houseNo',
                                'guests.brgy',
                                'guests.city',
                                'guests.country',
                                'guests.contactNo',
                                'guest_reservations.billType',
                                'guest_reservations.chargeType',
                                 'transactions.specialRequestNotes',
                                'transactions.madeThru',
                                'room_infos.rate',
                                'room_infos.roomName',
                                'room_infos.roomNo',
                                'room_types.name as roomType',
                              
                                ]
                                )->first();
        
        return view('frontdesk.print-preview-reservation',compact('tDetails','roomsAndGuests'));
       // return $roomsAndGuests;
    }
    
    
 
    public function printPreviewFolio($id){
         
        $guestReserv = GuestReservation::findOrFail($id);
        $guestReservID = $guestReserv->id;
        $user=Auth::user();
        
          $amendments = DB::table('transactions as t')
                        ->join('room_reservations as rr','rr.transactionId','=','t.id')
                        ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
                        ->join('room_amendments as ra','ra.transactionId','=','t.id')
                        ->join('discount_details as dd','ra.discountId','=','dd.id')
                        ->join('room_infos as r','r.id','=','ra.roomId')
                        ->join('room_types as rt','rt.id','=','r.type')
                        ->where('gr.id','=',$guestReservID)
                        ->select([
                            't.id',
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
        
         $guestResInfo = DB::table('transactions as t')
                            ->join('room_reservations as rr','t.id','=','rr.transactionId')
                            ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
                            ->where('gr.id','=',$id)
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
                            ])->first();
            
            $roomRate = $guestResInfo->rate - ($guestResInfo->rate * $guestResInfo->discountValue);
        
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
                                ])->get();

        
        return view('frontdesk.print-preview-folio',compact('amendments','guestResInfo','guestCharges','roomRate','user'));

    }
    
    public function printPreviewRoombill($id){
        
        $user = Auth::user();
        
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
        
         $roomDetails = DB::table('transactions as t')
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
                                'r.roomName',
                                'r.roomNo',
                                'rt.name as roomType',
                            ])->first();
        
     
            $roomCharges = DB::table('transactions as t')
                            ->join('room_reservations as rr','t.id','=','rr.transactionId')
                            ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
                            ->where('rr.id','=',$roomReservID)
                            ->join('room_charges as rc','rc.guestReservationId','=','gr.id')
                            ->join('guests as g','g.id','=','gr.guestId')
                            ->select([
                                'g.firstName',
                                'g.familyName',
                                'rc.id as rcID',
                                'rc.item_name',
                                'rc.created_at as chargeCreated',
                                'rc.price',
                                'rc.os_id',
                                'rc.account_type',
                                ])->get();
        
      //  return $roomCharges;
        return view('frontdesk.print-preview-roombill',compact('roomDetails','user','roomCharges','amendments'));
    }
    
    public function printPreviewBillstatement($id){
        
        $transId = $id;
        $user = Auth::user();
        
        $amendments = DB::table('room_amendments as ra')
                        ->join('transactions as t','ra.transactionId','=','t.id')
                        ->join('discount_details as dd','ra.discountId','=','dd.id')
                        ->join('room_infos as r','r.id','=','ra.roomId')
                        ->join('room_types as rt','rt.id','=','r.type')
                        ->where('t.id','=',$transId)
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
        
         $rooms = DB::table('transactions as t')
                            ->join('room_reservations as rr','t.id','=','rr.transactionId')
                            ->where('t.id','=',$transId)        
                            ->join('discount_details as dd','rr.discountId','=','dd.id')
                            ->join('room_infos as r','r.id','=','rr.roomId')
                            ->join('room_types as rt','r.type','=','rt.id')
                            ->select([
                                'rr.arrivalDate',
                                'rr.depatureDate',
                                'rr.id',
                                'rr.noOfDays',
                                'rt.room_rate as rate',
                                'rt.id',
                                'dd.name as discountName',
                                'dd.id',
                                'dd.discountValue',
                                'r.roomName',
                                'r.roomNo',
                                'rt.name as roomType',
                            ])->get();
        
            $transDetails =DB::table('transactions as t')
                            ->join('room_reservations as rr','t.id','=','rr.transactionId')
                            ->where('t.id','=',$transId)        
                            ->join('discount_details as dd','rr.discountId','=','dd.id')
                            ->join('room_infos as r','r.id','=','rr.roomId')
                            ->join('institutions as i','t.institutionId','=','i.id')
                            ->join('room_types as rt','r.type','=','rt.id')
                            ->select([
                                't.code',
                                'i.name as instiName',
                                'i.address as instiAddress',
                                'rr.arrivalDate',
                                'rr.depatureDate',
                                'rr.id',
                                'rr.noOfDays',
                                'rt.room_rate as rate',
                                'rt.id',
                                'dd.name as discountName',
                                'dd.id',
                                'dd.discountValue',
                                'r.roomName',
                                'r.roomNo',
                                'rt.name as roomType',
                            ])->first();
        
     
            $roomCharges = DB::table('transactions as t')
                            ->join('room_reservations as rr','t.id','=','rr.transactionId')
                            ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
                            ->where('t.id','=',$transId)
                            ->join('room_charges as rc','rc.guestReservationId','=','gr.id')
                            ->join('guests as g','g.id','=','gr.guestId')
                            ->select([
                                'g.firstName',
                                'g.familyName',
                                'rc.id as rcID',
                                'rc.item_name',
                                'rc.created_at as chargeCreated',
                                'rc.price',
                                'rc.os_id',
                                'rc.account_type',
                                ])->get();
        
            
      
        
      //  return $roomCharges;
        return view('frontdesk.print-preview-billstatement',compact('transDetails','roomCharges','amendments','rooms','user'));
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
            ->where('room_reservations.arrivalDate','>',date('Y-m-d'))
            ->groupBy('transactions.id')
            ->orderBy('transactions.id','desc')
            ->select(
                [
               'transactions.id',
                'transactions.status',
                'institutions.name as institutionName',
                'account_types.name as institutionType',
                DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
                'transactions.code',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
            
                
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
            ->where('transactions.status','!=',1)
            ->where('transactions.guaranteed','=',1)
            ->where('room_reservations.occupied_status','!=',2)
            ->where('room_reservations.arrivalDate','>=',date('Y-m-d'))
            ->groupBy('transactions.id')
            ->orderBy('transactions.id','desc')
            ->select(
                [
               'transactions.id',
                'transactions.status',
                'institutions.name as institutionName',
                'account_types.name as institutionType',
                DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
                'transactions.code',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
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
            ->where('transactions.status','!=',1)
            ->where('transactions.guaranteed','=',1)
            ->where('room_reservations.arrivalDate','<=',date('Y-m-d'))
            ->groupBy('transactions.id')
            ->orderBy('transactions.id','desc')
            ->select(
                [
               'transactions.id',
                'institutions.name as institutionName',
                'account_types.name as institutionType',
                DB::raw('concat(clients.firstname," ",clients.lastName) as clientName'),  
                'transactions.code',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
            
                
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
            ->whereRaw("concat(requestDate,' ',requestTime) > '".date('Y-m-d H:i:s')."'")
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


    //////////////for scpeial request list
    public function specialRequestList()
    {
        $users = DB::table('transactions')
            ->join('room_reservations', 'room_reservations.transactionId','=','transactions.id')
            ->join('special_requests','special_requests.roomReservationId', '=', 'room_reservations.id')
            ->join('room_infos','room_infos.id','=','room_reservations.roomId')
            ->where("requestDate", "=", date('Y-m-d'))
            ->where("requestTime",">",date('H:i:s'))
            ->orderby('special_requests.requestDate')
            ->select(
                [
                    'special_requests.id',
                    'room_infos.roomName',
                    DB::raw('concat(room_infos.roomName," - ",transactions.code) as roomTransaction'),
                    DB::raw("DATE_FORMAT(special_requests.requestTime, '%h:%i %p') as requestTime"),
                    'special_requests.note',
                ]
                )->get();

        return $users;
        //return Datatables::of(Users::query())->make(true);
    }


    
    public function dataTablesGuestReservationList($id)
    {
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

        $users = DB::table('transactions as t')
            
            ->join('room_reservations as rr','rr.transactionId','=','t.id')
            ->join('room_infos as r','r.id','=','rr.roomId')
            ->join('guest_reservations as gr','gr.roomReservationId','=','rr.id')
            ->join('guests as g','g.id','=','gr.guestId')
            ->where('t.id','=',$id)
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
}
