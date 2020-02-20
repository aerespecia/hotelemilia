<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Input;
use Validator;
use Redirect;
use Session;
use Storage;

use DB;

use App\RoomInfo;

use App\Housekeeping;

use App\RoomIssue;
 

use Yajra\Datatables\Datatables;

class HousekeepingController extends Controller
{
    //
    public function checkInReservation(){
        $user=Auth::user();
        
        return view('housekeeping.checkInReservation',compact('user'));
    }
    public function index()
    {
        $user=Auth::user();

        $roomsAll = DB::table('room_infos')
        ->orderby('roomName')
        ->select(
                [
                'id',
                'roomName',
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
                    end as status'),
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
                    when "4" then "bg-white"
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
                    end as status'),

                
                ]
                )
        ->get();

        $rooms2 = DB::table('room_infos')
        ->whereBetween('roomName', [200, 299])
        ->orderby('roomName')
        ->select(
                [
                'id',
                'roomName',
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
                    end as status'),
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
                    end as status'),

                
                ]
                )
        ->get();

        $rooms3 = DB::table('room_infos')
        ->whereBetween('roomName', [300, 399])
        ->where("room_infos.id","!=",37)
        ->orderby('roomName')
        ->select(
                [
                'id',
                'roomName',
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
                    end as status'),
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
                    end as status'),

                
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
                    end as status'),
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
                    end as status'),

                
                ]
                )
        ->get();

        
        return view('housekeeping.index',compact('user','rooms2','rooms3','rooms4', 'roomsAll'));
    }

    public function history()
    {
        //
        $user=Auth::user();
        
        return view('housekeeping.history',compact('user'));
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

        DB::table('room_issues')
                ->where('id', $inputs['id'])
                ->update(array(
                    'status' => $inputs['actionId'],
                    'updateById' => $inputs['cleanerId'],
                ));

    }

    public function deleteDiscountAjax(Request $req){
        $inputs = $req->all();
        DB::table('discount_details')->where('id', '=', $inputs['id'])->delete();
        return 'Success';
    }



    public function roomStatusSaves(Request $req){
        $inputs = $req->all();
        
        if($inputs['typeIssue']>0)
        {
            $roomIssue = new RoomIssue;
                
            $roomIssue->roomId = $inputs['roomId'];
            $roomIssue->cleanerId = $inputs['cleanerId'];
            $roomIssue->type = $inputs['typeIssue'];
            $roomIssue->notes = $inputs['issueNotes'];
            $roomIssue->status = 1;

            $roomIssue->save();
            $rId = $roomIssue->id;
            if(!empty($inputs['file']))
            {
                $filename = $rId."-issue.".$inputs['file']->getClientOriginalExtension();;
                Storage::put(
                    'issues/'.$filename,
                    file_get_contents($inputs['file']->getRealPath())
                );
            }
                
            //$inputs['file']->storeAs('images', $filename);

            

            return redirect('housekeeping');
        }

        else if($inputs['cleanStatus']!='' && $inputs['cleanStatus']>0)
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
                elseif($inputs['cleanStatus'] == 4)
                {
                    return 'bg-white';
                }
                else{
                    return '';
                }

        }


        else if($inputs['replenishReport']==1)
        {
            //print_r($inputs['roomItemInventory']);
            foreach($inputs['roomItemInventory'] as $key=>$value)
            {
                DB::table('room_replenishes')->insert(
                    [
                    'created_at' => date("Y-m-d H:i:s"), 
                    'updated_at' => date("Y-m-d H:i:s"), 
                    'roomId' => $inputs['roomId'], 
                    'roomItemId' => $key,
                    'noOfItem' => $value,
                    ]
                );
            }

            return redirect('housekeeping');

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

    public function dataTablesRoomIssuesHousekeeping($id)
    {
        $user=Auth::user();
        $users = DB::table('room_issues')
            ->join('room_infos', 'room_infos.id', '=', 'room_issues.roomId')
            ->join('users', 'users.id', '=', 'room_issues.cleanerId')
            ->where('room_issues.status','=',1)
            ->where('room_issues.type','=',10)
            ->where('room_infos.id','=',$id)
            ->orderby('room_issues.created_at','desc')
            ->select(
                [

                    'room_issues.id',
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

    public function dataTablesRoomCheckListItems()
    {
        $users = DB::table('room_check_lists')
            ->where('status','=',1)
            ->select(
                [
                'id',
                'name', 
                DB::raw('
                    case category
                    when "0" then "Category"
                    when "1" then "Door"
                    when "2" then "Room"
                    when "3" then "Bathroom"
                    when "4" then "Bed"
                    when "100" then "Others"
                    end as category'),
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
            ->where('room_issues.type','=', 10)
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


    public function dataTablesCheckInReservationList()
    {
        $users = DB::table('transactions')
            ->leftjoin('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('clients', 'clients.id', '=', 'transactions.clientId')
            ->join('institutions', 'institutions.id', '=', 'transactions.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('room_types','room_types.id', '=', 'room_infos.type')
            ->leftjoin('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->leftjoin('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('room_reservations.occupied_status',1)
            ->groupby('transactions.id')
            ->select(
                [
                
                'clients.id',
                'clients.firstname',
                'transactions.code',
                DB::raw('group_concat(room_infos.roomName separator ", ") as roomName'),
                
                DB::raw('
                    institutions.name 
                    AS instiName'),
                'room_types.name as RoomType',

                'room_reservations.finalRoomRate as RoomTypeRate',
                DB::raw('
                    group_concat(concat(guests.Firstname," ",guests.familyName) SEPARATOR ",")
                    AS guestNames'),
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                'transactions.created_at',
                'transactions.updated_at'
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
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
}
