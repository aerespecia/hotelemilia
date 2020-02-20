<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Guest;
use App\RoomInfo;
use DB;
use App\Housekeeping;
use App\GuestReservation;
use App\RoomReservation;
use Carbon\Carbon;
use Auth;
use Input;
use Validator;
use Redirect;
use Session;
use Storage;


class GuestCrudController extends Controller
{
    //
    
    
                     
                     
                     
                     
    
    public function guestEdit($id){
        
        $guestR = GuestReservation::findOrFail($id);
        $guest = Guest::findOrFail($guestR->guestId);

        $path = storage_path().'/app/id-front/'.$guest->id.'-front.jpg';
        $path2 = storage_path().'/app/id-back/'.$guest->id.'-back.jpg';

        $idfront = "";
        $idback = "";

        if(file_exists($path)){
            $idfront = "Scanned ID (Front) Exist";
        }


         if(file_exists($path2)){
            $idback = "Scanned ID (Back) Exist";
        }
        
        
     //   $guestReserv = GuestReservation::where('id','=',$id)->get();
     //   $guestReservNo = $this->guestRegistrationNoGenerator();
       // $guest-results[] = array();
        
     //   foreach($guestReserv as $g)
    //        $guestId = $g->guestId;
       // $guest = Guest::where('id','=',$id)->update(['password'=>bcrypt("nEm001admin")])
      //  $results[] = [$guest,'code'=>$this->guestRegistrationNoGenerator()];
       // $results[] = $guestReserv;
        
   //     $guest = DB::table('guests')->where('id','=',$guestId)->get();
   /*     
        foreach($guest as $gt)
        {
            $results =['firstName' => $gt->firstName,'guestReservNoNF'=>$guestReservNo];
        } */
        return collect(['guest'=>$guest,'idfront'=>$idfront,'idback'=>$idback]);
        
    }
    
    public function roomStatusEdit($id){
        $room = RoomInfo::findOrFail($id);
            
        return response()->json($room);
    }
    
    
    
    public function guestRegisterEdit(Request $req, $id){
        
        $g = GuestReservation::findOrFail($id);
        $guestReserv = DB::table('guest_reservations as gr')
                    ->where('gr.id','=',$g->id)
                    ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                    ->join('room_infos as r','r.id','=','rr.roomId')
                    ->join('room_types as rt','rt.id','=','r.type')
                    ->select([
                        'gr.id',
                        'r.roomName',
                        'rt.name as roomType',
                        'gr.guest_registration_no',
                        'rr.id as roomReservId',
                        'gr.folioNos',
                    ])->first();
 
       // return response()->json($guestsRes
        return response()->json($guestReserv);
    }
    
     
    public function guestFolioView($id){
        $guestReserv = GuestReservation::findOrFail($id);
        $guestReservID = $guestReserv->id;

        $roomReserv = RoomReservation::findOrFail($guestReserv->roomReservationId);
        
        $getTrans = DB::table('room_reservations as rr')
                        ->where('rr.id','=',$guestReserv->roomReservationId)
                        ->select([
                                'rr.transactionId'
                            ])
                        ->first();

        $countGuests = DB::table('guest_reservations as gr')
                        ->join('room_reservations as rr','rr.id','=','gr.roomReservationId')
                        ->where('rr.transactionId','=',$getTrans->transactionId)
                        ->select([
                            DB::raw("count(gr.id) as guestCount")
                            ])
                        ->get();
//        $test1 = DB::table('transactions')
//                ->where('transactions.id','=',1);
//        
//        $test2 = DB::table('transactions')
//                ->where('transactions.id','=',$id)
//                ->union($test1)
//                ->get();
        
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
                            'ra.arrivalDate as amendArriv',
                            'ra.depatureDate as amendDepart',
                            'dd.discountValue as discountValueAmend',
                            'rt.room_rate as amendRate',
                            'r.roomName as amendRoomName',
                            'rt.name as amendRoomType',
                        ])->get();
        
         $transactions = DB::table('transactions as t')
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
                                't.downpayment',
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
                                'gr.guest_registration_no',
                                'gr.id',
                                 DB::raw('
                                    case t.billingType
                                    when "1" then "CTC"
                                    when "2" then "GA"
                                    end as billingType'),
                                 DB::raw('
                                    case t.chargeType
                                        when "1" then "Cash"
                                        when "2" then "Debit/Credit Card"
                                        when "3" then "Cheque"
                                        else "N/A"
                                    end as chargeType'),
                                 DB::raw('
                                    case t.status
                                        when "0" then "Ongoing"
                                        when "1" then "Billed"
                                        when "2" then "No Show"
                                        when "3" then "House Use"
                                        else "N/A"
                                    end as transStatus'),
                                'r.roomName',
                                'rt.name',
                            ])->get();
        
        
            $charges = DB::table('transactions as t')
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

            $downpayments = DB::table('downpayments as d')
                                ->join('transactions as t','t.id','=','d.transactionId')
                                ->where('t.id','=',$roomReserv->transactionId)
                                ->select([
                                        'd.os_id',
                                        'd.amount',
                                        DB::raw("DATE_FORMAT(d.created_at,'%Y-%m-%d') as chargeCreated"),

                                    ])
                                ->get();

         $guestsRes = collect(["amendments" => $amendments,"guest" => $transactions,"charges"=>$charges,"guestCount"=>$countGuests,"downpayments"=>$downpayments]);
             
//         $guestsRes = DB::table('transactions')
//                        ->leftJoin('room_reservations','transactions.id','=','room_reservations.transactionId')
//                       ->join('discount_details','room_reservations.discountId','=','discount_details.id')
//                        ->leftJoin('room_amendments as ra','transactions.id','=','ra.transactionId')
//                        ->join('room_infos as ri2','ra.roomId','=','ri2.id')
//                        ->join('room_types as rt2','ri2.type','=','rt2.id')
//                        ->leftJoin('clients','clients.id','=','transactions.clientId')
//                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
//                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
//                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
//                        ->join('guest_reservations',function($join) use ($guestReservID)
//                            {
//                                $join->on( 'guest_reservations.roomReservationId','=','room_reservations.id')
//                                        ->where('guest_reservations.id', '=', $guestReservID);
//                            })
//             ->join('room_charges',function($join) use ($guestReservID)
//                            {
//                                $join->on( 'room_charges.guestReservationId','=','guest_reservations.id')
//                                        ->where('guest_reservations.id', '=', $guestReservID);
//                            })
//             ->leftJoin('guests','guest_reservations.guestId','=','guests.id')->select(
//                                [
//                                'transactions.id',
//                                'guests.firstName',
//                                'guests.familyName',
//                                'guests.account_id',
//                                'institutions.name as instiName',
//                                'room_reservations.arrivalDate',
//                                'room_reservations.depatureDate',
//                                'room_reservations.noOfDays',
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
//                                'room_types.name',
//                                'room_charges.item_name',
//                                'room_charges.created_at as chargeCreated',
//                                'room_charges.price',
//                                'room_charges.os_id',
//                                'room_charges.account_type',
//                                ]
//                                )
//                        ->get();
//        
//        if(!$guestsRes){
//            $guestsRes = DB::table('transactions')
//                        ->leftJoin('room_reservations','transactions.id','=','room_reservations.transactionId')
//                        ->join('discount_details','room_reservations.discountId','=','discount_details.id')
//                        ->join('room_amendments as ra','transactions.id','=','ra.transactionId')
//                        ->join('room_infos as ri2','ra.roomId','=','ri2.id')
//                        ->join('room_types as rt2','ri2.type','=','rt2.id')
//                        ->leftJoin('clients','clients.id','=','transactions.clientId')
//                        ->leftJoin('institutions','institutions.id','=','transactions.institutionId')
//                        ->leftJoin('room_infos','room_infos.id','=','room_reservations.roomId')
//                        ->leftJoin('room_types','room_infos.type','=','room_types.id')
//                        ->join('guest_reservations',function($join) use ($guestReservID)
//                            {
//                                $join->on( 'guest_reservations.roomReservationId','=','room_reservations.id')
//                                        ->where('guest_reservations.id', '=', $guestReservID);
//                            })
//           
//             ->leftJoin('guests','guest_reservations.guestId','=','guests.id')->select(
//                                [
//                                'transactions.id',
//                                'guests.firstName',
//                                'guests.familyName',
//                                'guests.account_id',
//                                'institutions.name as instiName',
//                                'room_reservations.arrivalDate',
//                                'room_reservations.depatureDate',
//                                'room_reservations.noOfDays',
////                                'ra.noOfDays as amendDays',
////                                'ra.id as amendId',
////                                'rt2.room_rate as amendRate',
////                                'ra.created_at as amendDate',
////                                'ri2.roomName as amendRoomName',
////                                'rt2.name as amendRoomType',
//                                'discount_details.name as discountName',
//                                'discount_details.discountValue',
//                                'guest_reservations.guest_registration_no',
//                                'room_types.room_rate as rate',
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
//                                'room_types.name',
//                            //    'room_charges.item_name',
//                                ]
//                                )
//                        ->get();
//        }
        
        $results = array();
        
    /*   foreach($guestsRes as $gr)
            $results = ['firstname'=>$gr->firstName,'lastname'=>$gr->familyName,'billingType'=>$gr->billingType,'billingNote'=>$gr->billingNote,'chargeType'=>$gr->chargeType,'account_id'=>$gr->account_id,'grId'=>$gr->grId];
        */
        return $guestsRes;
    }
    
    public function guestRegisterUpdate(Request $req, $id){
        $guestReserv = GuestReservation::findOrFail($id);
            
        $reservationID = $this->guestRegistrationNoGenerator();
        $guestReserv->folioNos = $req->get('folioNos');
        $guestReserv->roomReservationId = $req->get('room');
        $guestReserv->status = 1;
        
        
        if($guestReserv->guest_registration_no == NULL)
            $guestReserv->guest_registration_no = $reservationID;
        
        $guestReserv->save();
        
        $room = DB::table('room_reservations as rr')
                ->where('rr.id','=',$guestReserv->roomReservationId)
                ->join('room_infos as r','r.id','=','rr.roomId')
                ->join('room_types as rt','rt.id','=','r.type')
                ->select([
                    'r.roomName',
                    'rt.name as roomType',
                ])->first();
        
        $results = ['guestReservID' => $guestReserv->guest_registration_no,'room' => $room->roomName." - ".$room->roomType];
        
        return response()->json($results);
    }
    
    public function guestUpdate(Request $req){
        
        $inputs = $req->all();
        
         $guest = Guest::findOrFail($req->get('guest-id'));
        

        $guest->firstName = $req->get('guest-fname');
        $guest->middleName = $req->get('guest-mname');
        $guest->familyName = $req->get('guest-lname');
        $guest->houseNo = $req->get('guest-housebldg');
        $guest->brgy = $req->get('guest-brgy');
        $guest->city = $req->get('guest-city');
        $guest->country = $req->get('guest-country');
        $guest->postalCode = $req->get('guest-postalcode');
        $guest->nationality = $req->get('guest-nationality');
        $guest->contactNo = $req->get('guest-contactNo');
        $guest->email = $req->get('guest-email');
        $guest->dob = $req->get('guest-dob');
        $guest->designation = $req->get('guest-designation');
        $guest->passNo = $req->get('guest-passno');
        $guest->passExpiry = $req->get('guest-passexp');
        $guest->passIssue = $req->get('guest-passissue');
        $guest->otherId = $req->get('guest-otherid');
        
        if($guest->account_id=="")
            $guest->account_id = $this->accountNoGenerator();
        $guest->save();
        
       // GuestReservation::where('id','=',$req->get('guestReserv'))->update(['roomReservationId'=>$req->get('room'),'status'=>1]);

        if(!empty($inputs['guest-idfront']))
            {
                $filename = $inputs['guest-id']."-front.".$inputs['guest-idfront']->getClientOriginalExtension();;
                Storage::put(
                    'id-front/'.$filename,
                    file_get_contents($inputs['guest-idfront']->getRealPath())
                );
            }


        if(!empty($inputs['guest-idback']))
            {
                $filename = $inputs['guest-id']."-back.".$inputs['guest-idback']->getClientOriginalExtension();;
                Storage::put(
                    'id-back/'.$filename,
                    file_get_contents($inputs['guest-idback']->getRealPath())
                );
            }

        return redirect()->route('frontdesk.guestRegistration', ['reservID' => $inputs["guest-code"]]);
   
     //   return $inputs['guest-scan-reg']->getClientOriginalExtension();
    }
    /*
    public function guestReservationUpdate(Request $req, $id){
        GuestReservation::where('id','=',$req->get('guestReserv'))->update(['roomReservationId'=>$req->get('room'),'status'=>1])   
    } */
    
    public function accountNoGenerator(){
       
      
        
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

        $codeGenerated = $five."".$seven."".$nine."".$alpha[$eight]."".$alpha[$six];
        $countCheck =  Guest::where('account_id',$codeGenerated)->count();
      

        }while($countCheck>0);

        return $codeGenerated;
   }
    
    public function guestRegistrationNoGenerator()
    {
        $trans = GuestReservation::all()->count();
        $guestNo = sprintf('%04d', $trans+1);
        
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

        return "GR-".$guestNo."-".$alpha[$six]."".$alpha[$eight]."".$five."".$seven."".$nine;
        
    }
    
    
}
