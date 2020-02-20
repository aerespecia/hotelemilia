<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Client;
use App\Transaction;
use App\RoomReservation;
use App\GuestReservation;
use App\Guest;
use App\Institution;
use App\Http\Requests;
use App\RoomInfo;
use DB;
use Yajra\Datatables\Datatables;

class FrontDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware(['frontdesk','auth']);
    }
    
    public function index()
    {
      
        
        
         $user=Auth::user();
        
        $date = date('F j, Y');

//Family Suites
        














        //
        return view('frontdesk.index',compact('user','date'));
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

    function randomGenerator(){
        $one = rand(1,9);
        $two = rand(0,25);
        $three = rand(0,25);
        $four = rand(1,9);
        $five = rand(1,9);
        $six = rand(0,25);
        $seven = rand(1,9);
        $eight = rand(0,25);
        $nine = rand(1,9);

        $alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        return $one."".$alpha[$two]."".$alpha[$three]."-".$four."".$five."".$alpha[$six]."-".$seven."".$alpha[$eight]."".$nine;
   }


    public function store(Request $request)
    {
  
        $inputs = $request->all();
        
        $institutions = new Institution;


        $institutions->name = $inputs['institutionName'];
        $institutions->type = $inputs['institutionType'];
        $institutions->address = $inputs['institutionAddress'];
        $institutions->contactNo = $inputs['institutionContactNo'];

        $institutions->save();
        
        $institutionsId = $institutions->id;


        $clients = new Client;


        $clients->firstname = $inputs['firstName'];
        $clients->lastName = $inputs['lastName'];
        $clients->contactNo = $inputs['contactNo'];
        $clients->title = $inputs['title'];
        $clients->institutionId= $institutionsId;

        $clients->save();
        $clientId = $clients->id;

        
        $transaction = new Transaction;
        $transaction->code = $this->randomGenerator(); 
        $transaction->chargeType = $inputs['chargeType'];
        $transaction->clientId = $clientId;
        $transaction->madeThru = $inputs['madeThru'];
        $transaction->guaranteed = $inputs['guaranteed'];
        $transaction->guaranteedNote = $inputs['guaranteedArrangementsNotes'];
        $transaction->specialRequestNotes = $inputs['specialRequest'];
        
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
            $roomReservation->checkInTime = $inputs['checkIntimepicker'];
            $roomReservation->checkOutTime = $inputs['checkOuttimepicker'];
            $roomReservation->discountId = $inputs['discountType'];
            $roomReservation->billingType = $inputs['billArrange'];
            $roomReservation->billingNote = $inputs['billingArrangementsNotes'];
            $roomReservation->save();
            $roomReservationId = $roomReservation->id;
            $roomReservation = new RoomReservation;
        }

        $names = "";
        $names2 = "";
        
        $inputs = $request->all();


        $firstNames123 = $inputs['guestNames'];
        $compFirstNames=explode("||",$firstNames123);

        $lastnames123 = $inputs['guestNames'];
        $compLastnames123=explode("||",$lastnames123);

        $contacts123 = $inputs['guestNames'];
        $compContacts123=explode("||",$contacts123);



        foreach($compFirstNames as $cfn)
        {

            $namesDev= NULL;
            $namesDev=explode("#",$cfn);
           
            $guest = new guest;
            
            $guest->firstName = $namesDev[0];
            $guest->familyName = $namesDev[1];
            $guest->phone = $namesDev[2];

            $guest->save();
            $guestId = $guest->id;

            // $guestReservation = new guestReservation;
            
            // $guestReservation->roomReservationId = $roomReservationId;
            // $guestReservation->guestId = $guestId;

            // $guestReservation->save();
            // $guestReservationId = $guestReservation->id;            
            
        }


        //var_dump($inputs);





        // $transaction = new transaction;

        // $transaction->clientId = $clientId;
        // $transaction->type = 1;
        // $transaction->status = 1;


        // $transaction->save();
        // $transactionId = $transaction->id;

        // $roomReservation = new roomReservation;

        // $roomReservation->transactionId = $transactionId;
        // $roomReservation->roomId = 1;
        // $roomReservation->arrivalDate = $inputs['arrivalDate'];
        // $roomReservation->depatureDate = $inputs['departureDate'];
        // $roomReservation->type = 1;
        // $roomReservation->status = 1;

        // $roomReservation->save();
        // $roomReservationId = $roomReservation->id;
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
       
        $query = DB::table('room_reservations')->whereDate('arrivalDate','>=', date('Y-m-d'))->get();
        
      foreach($query as $q){
          
          if((strtotime($arrival) >= strtotime($q->arrivalDate) && strtotime($arrival) <= strtotime($q->depatureDate)) || (strtotime($departure) >= strtotime($q->arrivalDate) && strtotime($departure) <= strtotime($q->depatureDate)))
            array_push($results,$q->roomId);
        }
         
      //  array_push($results, $departure);
 //     $results = ['ar' => $arrival, 'de' => $depart];
/*
    
    $results = array();

    $results2 = array(); 
    
    $queries = DB::table('users')
        ->where('firstName', 'LIKE', '%'.$term.'%')
        ->orWhere('lastName', 'LIKE', '%'.$term.'%')
        ->orWhere('userName', 'LIKE', '%'.$term.'%')
        ->take(10)->get();

    $unilevel = DB::select('select uni.user_id from purchases uni left join users u on uni.user_id = u.id where month(uni.updated_at) = '.date('n').'  and year(uni.updated_at) = '.date('Y'));

    $unilevel_list = array();

         foreach($unilevel as $q)
            array_push($unilevel_list, $q->user_id);
    */
    
/*
    foreach ($maintained as $m){
        array_push($results,$m->memberID);
    }
        */    

            return response()->json($results);
    }
    
    
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
    
    //ATOA DEFINED FUNCTIONS
    
    public function reservation()
    {


        //get user....
        //see reservation view on how to call user...
        $user=Auth::user();
        
        //code goes here...


        return view('frontdesk.reservation',compact('user'));
    }
    
    public function reservationList(){
        
        $user=Auth::user();
        
        //code goes here...
        return view('frontdesk.reservation-list',compact('user'));
    }

    public function dataTables()
    {
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


    public function dataTablesDailyArrivalList()
    {
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


    public function dataTablesDailyDepatureList()
    {
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




    public function dataTablesRoomOccupancyBulletinList()
    {        
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

    
    public function dailyGuestArrival(){
        
        $user = Auth::user();
        
        return view('frontdesk.daily-guest-arrival',compact('user'));
    }
    
    public function guestRegistration(){
        
        $user=Auth::user();
        
    //    $activeReservations = DB::
        
        //code goes here...
        return view('frontdesk.guest-registration',compact('user'));
    }
    public function roomOccupancyBulletin(){
        $user=Auth::user();
        
        return view('frontdesk.room-occupancy-bulletin',compact('user'));
    }
    
    public function dailyDepartureList(){
        
        $user=Auth::user();
        
        return view('frontdesk.daily-departure-list',compact('user'));
    }
    
    public function guestFolio(){
        
        $user=Auth::user();
        
        //code goes here...
        return view('frontdesk.guest-folio',compact('user'));
    }
    
    public function nightAudit(){
        $user=Auth::user();
        
        //code goes here...
        return view('frontdesk.night-audit',compact('user'));
    }
    
    public function amendments(){
        $user=Auth::user();
        
        //code goes here...
        return view('frontdesk.amendments',compact('user'));
    }
}
