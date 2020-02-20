<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


use App\Http\Requests;

use Input;
use Validator;
use Redirect;
use Session;
 
use App\Guest;
use App\User;
use App\RoomCharge; 
use App\Shift;
use App\Client;
use App\Institution;
use App\DiscountDetails;
use App\Transaction;
use App\RoomInfo;
use DB;
use Yajra\Datatables\Datatables;

use Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    ////VIEWING
    public function guest(){
 
        return view('admin.guest',compact(''));
    }
    public function transactionsAnalysis(){

        return view('admin.transactionsAnalysis',compact(''));
    }
    public function roomCheckList(){

        return view('admin.roomCheckList',compact(''));
    }

    public function shiftCashReport(){
        return view('admin.shiftCashReport', compact(''));
    }

    
    public function transactions(){

        $discountDetails = DB::table('discount_details')->get();

        return view('admin.transactions',compact('discountDetails'));
    }

    public function roomManage(){
        $user=Auth::user();
        $roomTypes = DB::table('room_types')->get();
        
        return view('admin.roomManage',compact('user','roomTypes'));
    }
    

    public function booking(){
        

        return view('admin.booking',compact(''));
    }

    public function institution(){
        

        return view('admin.institution',compact(''));
    }

    public function roomstatus(){
        
        $user=Auth::user();


        return view('admin.roomstatus',compact('user'));
    
    }

    public function roomReplenishReport(){
        $user=Auth::user();
        return view('admin.roomReplenishReport',compact('user'));
    }

    public function periodSalesReport(){
        
        $user=Auth::user();


        return view('admin.periodSalesReport',compact('user'));
    
    }


    public function generatePeriodSalesReport(Request $request){
        $user=Auth::user();
        $inputs = $request->all();

        $fromDate = date_format(date_create($inputs['from']),"F d");
        $toDate = date_format(date_create($inputs['to']),"F d, Y");

        $sales = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin(DB::raw('(SELECT 
                      SUM(IF(room_charges.type = 1, price, 0)) AS fnb,
                      SUM(IF(room_charges.type = 2, price, 0)) AS roomService,
                      SUM(IF(room_charges.type = 3, price, 0)) AS miniBar,
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      
                      SUM(IF(room_charges.type = 1, lessDiscount, 0)) AS fnbDiscount,
                      SUM(IF(room_charges.type = 2, lessDiscount, 0)) AS roomServiceDiscount,
                      SUM(IF(room_charges.type = 3, lessDiscount, 0)) AS miniBarDiscount,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,
                      SUM(IF(room_charges.type <> 4, price, 0)) AS totalRoomCharge,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,
                      room_charges.guestReservationId
                    FROM
                      room_charges
                    GROUP BY guestReservationId) AS overallRoomCharges'), function($join)
                    {
                        $join->on('overallRoomCharges.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId,
                      created_at
                    FROM
                        downpayments
                    GROUP BY roomReservationId) AS overallDownpayments'), function($join)
                    {
                        $join->on('overallDownpayments.roomReservationId', '=', 'room_reservations.id');
                    })
                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['from']),"Y-m-d"))
                ->whereDate('room_reservations.depatureDate', '<=',  date_format(date_create($inputs['to']),"Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('room_reservations.depatureDate')
                ->orderby('room_infos.roomName')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        DB::raw("concat(DATE_FORMAT(room_reservations.initialArrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.depatureDate, room_reservations.initialArrivalDate) as days"),

                        DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),

                        
                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        'room_reservations.FinalRoomRate as roomRate',


                        DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),
                        

                        DB::raw('sum(overallRoomCharges.fnb) as fnb'),
                        DB::raw('sum(overallRoomCharges.roomService) as roomService'),
                        DB::raw('sum(overallRoomCharges.miniBar) as miniBar'),
                        DB::raw('sum(overallRoomCharges.shuttleService) as shuttleService'),
                        DB::raw('sum(overallRoomCharges.fnbDiscount) as fnbDiscount'),
                        DB::raw('sum(overallRoomCharges.roomServiceDiscount) as roomServiceDiscount'),
                        DB::raw('sum(overallRoomCharges.miniBarDiscount) as miniBarDiscount'),
                        DB::raw('sum(overallRoomCharges.shuttleServiceDiscount) as shuttleServiceDiscount'),
                        DB::raw('sum(overallRoomCharges.totalRoomCharge) as totalRoomCharge'),
                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as totalChargeDiscount'),


                        DB::raw('overallDownpayments.*'),


                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(sum(overallRoomCharges.totalRoomCharge) > 0, sum(overallRoomCharges.totalRoomCharge), 0) as totalBill"),

                        DB::raw('sum(overallRoomCharges.shuttleService) as netShuttleService'),

                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as netTotalDiscount'),

                        DB::raw('overallDownpayments.downpaymentsTotal as overallDownpaymentsNet'),


                        DB::raw('((((DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(overallRoomCharges.totalRoomCharge is not null, sum(overallRoomCharges.totalRoomCharge), 0))/1.12) * .05) as serviceCharge'),
                    ]
                )->get();
        $ammendRoomsClose = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['from']),"Y-m-d"))
                ->whereDate('room_reservations.depatureDate', '<=',  date_format(date_create($inputs['to']),"Y-m-d"))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')

                    ]
                )->get();






        return view('admin.generatePeriodSalesReport',compact('sales', 'user', 'ammendRoomsClose', 'fromDate', 'toDate'));
    }

    public function dailyCashReport(){
        $user=Auth::user();

        $sales = DB::table('room_reservations')
                ->join('transactions', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin('room_charges', 'room_charges.guestReservationId', '=', 'guest_reservations.id')
                ->leftjoin('downpayments', 'downpayments.roomReservationId', '=', 'room_reservations.id')
                ->whereDate('room_reservations.depatureDate', '>=', date("Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=', date("Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        
                        DB::raw("concat(DATE_FORMAT(room_reservations.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.initialDepartureDate, room_reservations.initialArrivalDate) as days"),
                        
                        'room_reservations.FinalRoomRate as roomRate',
                        DB::raw("sum(if(room_charges.type = 1 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)) as fnb"),
                        DB::raw("sum(if(room_charges.type = 2 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)) as roomService"),
                        DB::raw("sum(if(room_charges.type = 3 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)) as miniBar"),

                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        DB::raw("sum(if(room_charges.type = 1 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.lessDiscount, 0)) as fnbDiscount"),
                        DB::raw("sum(if(room_charges.type = 2 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.lessDiscount, 0)) as roomServiceDiscount"),
                        DB::raw("sum(if(room_charges.type = 3 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.lessDiscount, 0)) as miniBarDiscount"),

                        DB::raw("sum(if(room_charges.type <>4 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.lessDiscount, 0)) as totalChargeDiscount"),

                        DB::raw("sum(if(room_charges.type = 4 and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)) as shuttleService"),


                        
                        DB::raw("SUM(DISTINCT IF(downpayments.amount IS NOT NULL and downpayments.created_at between date_add(date_sub(curdate(), interval 1 day), interval '13:59' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), downpayments.amount, 0)) AS downpaymentsTotal"),

                        DB::raw("(room_reservations.FinalRoomRate) + sum(if(room_charges.price is not null and room_charges.type <> 4  and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)) as totalBill"),

                        DB::raw("((((room_reservations.FinalRoomRate) + sum(if(room_charges.price is not null and room_charges.type <> 4  and room_charges.created_at between date_add(date_sub(curdate(), interval 1 day), interval '14:00' HOUR_MINUTE) and date_add(curdate(), interval '13:59' HOUR_MINUTE), room_charges.price, 0)))/1.12) * .05) as serviceCharge"),
                    ]
                )->get();

        $ammendRooms = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')

                ->whereBetween('transactions.status',[100,1000])
                ->where(DB::raw('date(transactions.updated_at) = curdate()'))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')

                    ]
                )->get();

        $salesTotal = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('downpayments', 'downpayments.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin('room_charges', 'room_charges.guestReservationId', '=', 'guest_reservations.id')
                
                ->whereDate('room_reservations.depatureDate', '>=', date("Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=', date("Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        DB::raw("concat(DATE_FORMAT(room_reservations.initialArrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.depatureDate, room_reservations.initialArrivalDate) as days"),

                        DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),

                        
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


                        DB::raw("SUM(DISTINCT IF(downpayments.amount IS NOT NULL, downpayments.amount, 0)) AS downpaymentsTotal"),


                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + sum(if(room_charges.price is not null and room_charges.type <> 4, room_charges.price, 0)) as totalBill"),

                        DB::raw('((((DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL,if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + sum(if(room_charges.price is not null and room_charges.type <> 4, room_charges.price, 0)))/1.12) * .05) as serviceCharge'),
                    ]
                )->get();
        $ammendRoomsClose = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->whereDate('room_reservations.depatureDate', '>=', date("Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=', date("Y-m-d"))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')

                    ]
                )->get();




        return view('admin.dailyCashReport',compact('sales', 'user', 'ammendRooms', 'salesTotal', 'ammendRoomsClose'));
        //        return $sales;
    }



    public function shiftGenerateCashReport(Request $request){
        $user=Auth::user();
        $inputs = $request->all();

        $shift = $inputs['shift'];

        $scheduleFilter = "";
        $dateFilter = "".date_format(date_create($inputs['currDate']),"F d, Y")." |";

          if($shift == 1){
            $scheduleFilter = "between date_add('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval '06:00:00' HOUR_SECOND) and date_add('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval '13:59:59' HOUR_SECOND)";
            $dateFilter .= " 6:00 AM to 2:00 PM";
        }
        elseif($shift == 2){
            $scheduleFilter = "between date_add('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval '14:00:00' HOUR_SECOND) and date_add('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval '21:59:59' HOUR_SECOND)";
            $dateFilter .= " 2:00 PM to 10:00 PM";
        }
        elseif($shift == 3){
            $scheduleFilter = "between date_add(date_sub('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval 1 day), interval '22:00:00' HOUR_SECOND) and date_add('".date_format(date_create($inputs['currDate']),"Y-m-d")."', interval '05:59:59' HOUR_SECOND)";

            $dateFilter .= " 10:00 PM to 6:00 AM";
        }

        $salesCash = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.roomReservationId', '=', 'room_reservations.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')

                ->leftjoin(DB::raw('(SELECT 
                      SUM(IF(room_charges.type = 1, price, 0)) AS fnb,
                      SUM(IF(room_charges.type = 2, price, 0)) AS roomService,
                      SUM(IF(room_charges.type = 3, price, 0)) AS miniBar,
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      
                      SUM(IF(room_charges.type = 1, lessDiscount, 0)) AS fnbDiscount,
                      SUM(IF(room_charges.type = 2, lessDiscount, 0)) AS roomServiceDiscount,
                      SUM(IF(room_charges.type = 3, lessDiscount, 0)) AS miniBarDiscount,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,
                      SUM(IF(room_charges.type <> 4, price, 0)) AS totalRoomCharge,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,
                      room_charges.guestReservationId
                    FROM
                      room_charges
                      where room_charges.updated_at '.$scheduleFilter.'
                    GROUP BY guestReservationId) AS room_chargesSpecific'), function($join)
                    {
                        $join->on('room_chargesSpecific.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId,
                      paidThru,
                      created_at
                    FROM
                        downpayments
                      where downpayments.created_at '.$scheduleFilter.' and paidThru = 1
                    GROUP BY roomReservationId) AS downpaymentsSpecific'), function($join)
                    {
                        $join->on('downpaymentsSpecific.roomReservationId', '=', 'room_reservations.id');
                    })

                ->leftjoin(DB::raw('(SELECT 
                      
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,


                      SUM(IF(room_charges.type <> 4 and room_charges.type > 0, price, 0)) AS totalRoomCharges,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,

                      room_charges.guestReservationId,
                      room_charges.created_at
                    FROM
                      room_charges
                    GROUP BY room_charges.guestReservationId) AS overallRoomCharges'), function($join)
                    {
                        $join->on('overallRoomCharges.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId
                      
                    FROM
                        downpayments where paidThru = 1
                    GROUP BY roomReservationId) AS overallDownpayments'), function($join)
                    {
                        $join->on('overallDownpayments.roomReservationId', '=', 'room_reservations.id');
                    })

                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->orWhereDate('downpaymentsSpecific.created_at', '=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('room_reservations.depatureDate')
                ->orderby('room_infos.roomName')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        
                        DB::raw("concat(DATE_FORMAT(room_reservations.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.initialDepartureDate, room_reservations.initialArrivalDate) as days"),
                        
                        'room_reservations.FinalRoomRate as roomRate',

                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        DB::raw('sum(room_chargesSpecific.fnb) as fnb'),
                        DB::raw('sum(room_chargesSpecific.roomService) as roomService'),
                        DB::raw('sum(room_chargesSpecific.miniBar) as miniBar'),
                        DB::raw('sum(room_chargesSpecific.shuttleService) as shuttleService'),
                        DB::raw('sum(room_chargesSpecific.fnbDiscount) as fnbDiscount'),
                        DB::raw('sum(room_chargesSpecific.roomServiceDiscount) as roomServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.miniBarDiscount) as miniBarDiscount'),
                        DB::raw('sum(room_chargesSpecific.shuttleServiceDiscount) as shuttleServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.totalRoomCharge) as totalRoomCharge'),
                        DB::raw('sum(room_chargesSpecific.totalChargeDiscount) as totalChargeDiscount'),




                        DB::raw('downpaymentsSpecific.*'),
                       


                        DB::raw("TRUNCATE((room_reservations.FinalRoomRate) + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0), 2) as totalBill"),

                        

                        DB::raw("TRUNCATE((((room_reservations.FinalRoomRate + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0))/1.12) * .05), 2) as serviceCharge"),

                        

                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(sum(overallRoomCharges.totalRoomCharges) > 0, sum(overallRoomCharges.totalRoomCharges), 0) as overallTotalBill"),

                        
                        
                        DB::raw('sum(overallRoomCharges.totalRoomCharges) as totalRoomChargeNet'),


                        DB::raw('sum(overallRoomCharges.shuttleService) as netShuttleService'),


                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as netTotalDiscount'),

                        DB::raw('overallDownpayments.downpaymentsTotal as overallDownpaymentsNet'),

                    ]
                )->get();

        $salesCard = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.roomReservationId', '=', 'room_reservations.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')

                ->leftjoin(DB::raw('(SELECT 
                      SUM(IF(room_charges.type = 1, price, 0)) AS fnb,
                      SUM(IF(room_charges.type = 2, price, 0)) AS roomService,
                      SUM(IF(room_charges.type = 3, price, 0)) AS miniBar,
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      
                      SUM(IF(room_charges.type = 1, lessDiscount, 0)) AS fnbDiscount,
                      SUM(IF(room_charges.type = 2, lessDiscount, 0)) AS roomServiceDiscount,
                      SUM(IF(room_charges.type = 3, lessDiscount, 0)) AS miniBarDiscount,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,
                      SUM(IF(room_charges.type <> 4, price, 0)) AS totalRoomCharge,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,
                      room_charges.guestReservationId
                    FROM
                      room_charges
                      where room_charges.updated_at '.$scheduleFilter.'
                    GROUP BY guestReservationId) AS room_chargesSpecific'), function($join)
                    {
                        $join->on('room_chargesSpecific.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId,
                      paidThru,
                      created_at
                    FROM
                        downpayments
                      where downpayments.created_at '.$scheduleFilter.' and paidThru = 2
                    GROUP BY roomReservationId) AS downpaymentsSpecific'), function($join)
                    {
                        $join->on('downpaymentsSpecific.roomReservationId', '=', 'room_reservations.id');
                    })

                ->leftjoin(DB::raw('(SELECT 
                      
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,


                      SUM(IF(room_charges.type <> 4 and room_charges.type > 0, price, 0)) AS totalRoomCharges,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,

                      room_charges.guestReservationId,
                      room_charges.created_at
                    FROM
                      room_charges
                    GROUP BY room_charges.guestReservationId) AS overallRoomCharges'), function($join)
                    {
                        $join->on('overallRoomCharges.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId
                      
                    FROM
                        downpayments where paidThru = 2
                    GROUP BY roomReservationId) AS overallDownpayments'), function($join)
                    {
                        $join->on('overallDownpayments.roomReservationId', '=', 'room_reservations.id');
                    })

                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->orWhereDate('downpaymentsSpecific.created_at', '=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('room_reservations.depatureDate')
                ->orderby('room_infos.roomName')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        
                        DB::raw("concat(DATE_FORMAT(room_reservations.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.initialDepartureDate, room_reservations.initialArrivalDate) as days"),
                        
                        'room_reservations.FinalRoomRate as roomRate',

                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        DB::raw('sum(room_chargesSpecific.fnb) as fnb'),
                        DB::raw('sum(room_chargesSpecific.roomService) as roomService'),
                        DB::raw('sum(room_chargesSpecific.miniBar) as miniBar'),
                        DB::raw('sum(room_chargesSpecific.shuttleService) as shuttleService'),
                        DB::raw('sum(room_chargesSpecific.fnbDiscount) as fnbDiscount'),
                        DB::raw('sum(room_chargesSpecific.roomServiceDiscount) as roomServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.miniBarDiscount) as miniBarDiscount'),
                        DB::raw('sum(room_chargesSpecific.shuttleServiceDiscount) as shuttleServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.totalRoomCharge) as totalRoomCharge'),
                        DB::raw('sum(room_chargesSpecific.totalChargeDiscount) as totalChargeDiscount'),




                        DB::raw('downpaymentsSpecific.*'),
                       


                        DB::raw("TRUNCATE((room_reservations.FinalRoomRate) + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0), 2) as totalBill"),

                        

                        DB::raw("TRUNCATE((((room_reservations.FinalRoomRate + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0))/1.12) * .05), 2) as serviceCharge"),

                        

                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(sum(overallRoomCharges.totalRoomCharges) > 0, sum(overallRoomCharges.totalRoomCharges), 0) as overallTotalBill"),

                        
                        
                        DB::raw('sum(overallRoomCharges.totalRoomCharges) as totalRoomChargeNet'),


                        DB::raw('sum(overallRoomCharges.shuttleService) as netShuttleService'),


                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as netTotalDiscount'),

                        DB::raw('overallDownpayments.downpaymentsTotal as overallDownpaymentsNet'),

                    ]
                )->get();

        $salesCheque = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.roomReservationId', '=', 'room_reservations.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')

                ->leftjoin(DB::raw('(SELECT 
                      SUM(IF(room_charges.type = 1, price, 0)) AS fnb,
                      SUM(IF(room_charges.type = 2, price, 0)) AS roomService,
                      SUM(IF(room_charges.type = 3, price, 0)) AS miniBar,
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      
                      SUM(IF(room_charges.type = 1, lessDiscount, 0)) AS fnbDiscount,
                      SUM(IF(room_charges.type = 2, lessDiscount, 0)) AS roomServiceDiscount,
                      SUM(IF(room_charges.type = 3, lessDiscount, 0)) AS miniBarDiscount,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,
                      SUM(IF(room_charges.type <> 4, price, 0)) AS totalRoomCharge,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,
                      room_charges.guestReservationId
                    FROM
                      room_charges
                      where room_charges.updated_at '.$scheduleFilter.'
                    GROUP BY guestReservationId) AS room_chargesSpecific'), function($join)
                    {
                        $join->on('room_chargesSpecific.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId,
                      paidThru,
                      created_at
                    FROM
                        downpayments
                      where downpayments.created_at '.$scheduleFilter.' and paidThru = 3
                    GROUP BY roomReservationId) AS downpaymentsSpecific'), function($join)
                    {
                        $join->on('downpaymentsSpecific.roomReservationId', '=', 'room_reservations.id');
                    })

                ->leftjoin(DB::raw('(SELECT 
                      
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,


                      SUM(IF(room_charges.type <> 4 and room_charges.type > 0, price, 0)) AS totalRoomCharges,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,

                      room_charges.guestReservationId,
                      room_charges.created_at
                    FROM
                      room_charges
                    GROUP BY room_charges.guestReservationId) AS overallRoomCharges'), function($join)
                    {
                        $join->on('overallRoomCharges.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId
                      
                    FROM
                        downpayments where paidThru = 3
                    GROUP BY roomReservationId) AS overallDownpayments'), function($join)
                    {
                        $join->on('overallDownpayments.roomReservationId', '=', 'room_reservations.id');
                    })

                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->orWhereDate('downpaymentsSpecific.created_at', '=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('room_reservations.depatureDate')
                ->orderby('room_infos.roomName')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        
                        DB::raw("concat(DATE_FORMAT(room_reservations.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.initialDepartureDate, room_reservations.initialArrivalDate) as days"),
                        
                        'room_reservations.FinalRoomRate as roomRate',

                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        DB::raw('sum(room_chargesSpecific.fnb) as fnb'),
                        DB::raw('sum(room_chargesSpecific.roomService) as roomService'),
                        DB::raw('sum(room_chargesSpecific.miniBar) as miniBar'),
                        DB::raw('sum(room_chargesSpecific.shuttleService) as shuttleService'),
                        DB::raw('sum(room_chargesSpecific.fnbDiscount) as fnbDiscount'),
                        DB::raw('sum(room_chargesSpecific.roomServiceDiscount) as roomServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.miniBarDiscount) as miniBarDiscount'),
                        DB::raw('sum(room_chargesSpecific.shuttleServiceDiscount) as shuttleServiceDiscount'),
                        DB::raw('sum(room_chargesSpecific.totalRoomCharge) as totalRoomCharge'),
                        DB::raw('sum(room_chargesSpecific.totalChargeDiscount) as totalChargeDiscount'),




                        DB::raw('downpaymentsSpecific.*'),
                       


                        DB::raw("TRUNCATE((room_reservations.FinalRoomRate) + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0), 2) as totalBill"),

                        

                        DB::raw("TRUNCATE((((room_reservations.FinalRoomRate + if(sum(room_chargesSpecific.totalRoomCharge) > 0, sum(room_chargesSpecific.totalRoomCharge), 0))/1.12) * .05), 2) as serviceCharge"),

                        

                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(sum(overallRoomCharges.totalRoomCharges) > 0, sum(overallRoomCharges.totalRoomCharges), 0) as overallTotalBill"),

                        
                        
                        DB::raw('sum(overallRoomCharges.totalRoomCharges) as totalRoomChargeNet'),


                        DB::raw('sum(overallRoomCharges.shuttleService) as netShuttleService'),


                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as netTotalDiscount'),

                        DB::raw('overallDownpayments.downpaymentsTotal as overallDownpaymentsNet'),

                    ]
                )->get();
            //    return $sales;

        $ammendRooms = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')

                ->whereBetween('transactions.status',[100,1000])
                ->whereDate('transactions.updated_at', '=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')


                    ]
                )->get();

        $salesTotal = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.roomReservationId', '=', 'room_reservations.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin(DB::raw('(SELECT 
                      SUM(IF(room_charges.type = 1, price, 0)) AS fnb,
                      SUM(IF(room_charges.type = 2, price, 0)) AS roomService,
                      SUM(IF(room_charges.type = 3, price, 0)) AS miniBar,
                      SUM(IF(room_charges.type = 4, price, 0)) AS shuttleService ,
                      
                      SUM(IF(room_charges.type = 1, lessDiscount, 0)) AS fnbDiscount,
                      SUM(IF(room_charges.type = 2, lessDiscount, 0)) AS roomServiceDiscount,
                      SUM(IF(room_charges.type = 3, lessDiscount, 0)) AS miniBarDiscount,
                      SUM(IF(room_charges.type = 4, lessDiscount, 0)) AS shuttleServiceDiscount,
                      SUM(IF(room_charges.type <> 4, price, 0)) AS totalRoomCharge,
                      SUM(IF(room_charges.type <> 4, lessDiscount, 0)) AS totalChargeDiscount,
                      room_charges.guestReservationId
                    FROM
                      room_charges
                    GROUP BY guestReservationId) AS overallRoomCharges'), function($join)
                    {
                        $join->on('overallRoomCharges.guestReservationId', '=', 'guest_reservations.id');
                    })
                ->leftjoin(DB::raw('(SELECT 
                      sum(amount) as downpaymentsTotal,
                      roomReservationId,
                      created_at
                    FROM
                        downpayments
                    GROUP BY roomReservationId) AS overallDownpayments'), function($join)
                    {
                        $join->on('overallDownpayments.roomReservationId', '=', 'room_reservations.id');
                    })
                
                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->orWhereDate('overallDownpayments.created_at', '=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('room_reservations.depatureDate')
                ->orderby('room_infos.roomName')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
                        DB::raw("concat(DATE_FORMAT(room_reservations.initialArrivalDate,'%b %d'), '-', DATE_FORMAT(room_reservations.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_reservations.depatureDate, room_reservations.initialArrivalDate) as days"),

                        DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),

                        
                        DB::raw("case transactions.status
                            when 100 then 'Fully Paid'
                            when 1000 then 'Partial Paid'
                            end as statusTransactions"),

                        'room_reservations.FinalRoomRate as roomRate',


                        DB::raw("if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) as ammendCharge"),
                         

                        DB::raw('sum(overallRoomCharges.fnb) as fnb'),
                        DB::raw('sum(overallRoomCharges.roomService) as roomService'),
                        DB::raw('sum(overallRoomCharges.miniBar) as miniBar'),
                        DB::raw('sum(overallRoomCharges.shuttleService) as shuttleService'),
                        DB::raw('sum(overallRoomCharges.fnbDiscount) as fnbDiscount'),
                        DB::raw('sum(overallRoomCharges.roomServiceDiscount) as roomServiceDiscount'),
                        DB::raw('sum(overallRoomCharges.miniBarDiscount) as miniBarDiscount'),
                        DB::raw('sum(overallRoomCharges.shuttleServiceDiscount) as shuttleServiceDiscount'),
                        DB::raw('sum(overallRoomCharges.totalRoomCharge) as totalRoomCharge'),
                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as totalChargeDiscount'),


                        DB::raw('overallDownpayments.*'),


                        DB::raw("(DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(sum(overallRoomCharges.totalRoomCharge) > 0, sum(overallRoomCharges.totalRoomCharge), 0) as totalBill"),

                        DB::raw('sum(overallRoomCharges.shuttleService) as netShuttleService'),

                        DB::raw('sum(overallRoomCharges.totalChargeDiscount) as netTotalDiscount'),

                        DB::raw('overallDownpayments.downpaymentsTotal as overallDownpaymentsNet'),


                        DB::raw('((((DATEDIFF(room_reservations.depatureDate, room_reservations.arrivalDate) * room_reservations.FinalRoomRate) + if((DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate) is not NULL, if(count(Distinct room_amendments.id)>1, sum(DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate), DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate),0) + if(overallRoomCharges.totalRoomCharge is not null, sum(overallRoomCharges.totalRoomCharge), 0))/1.12) * .05) as serviceCharge'),
                    ]
                )->get();
        $ammendRoomsClose = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->whereDate('room_reservations.depatureDate', '>=', date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=',  date_format(date_create($inputs['currDate']),"Y-m-d"))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')

                    ]
                )->get();




        return view('admin.generatedShiftCashReport',compact('salesCash','salesCard','salesCheque', 'user', 'ammendRooms', 'salesTotal', 'ammendRoomsClose', 'dateFilter'));
        //        return $sales;
    }




    public function dailySalesReport(){
        $user=Auth::user();

        $sales = DB::table('transactions')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->leftjoin('room_amendments',function($join)
                    {
                        $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                    })
                ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
                ->leftjoin('room_charges', 'room_charges.guestReservationId', '=', 'guest_reservations.id')
                
                ->whereDate('room_reservations.depatureDate', '=', date("Y-m-d"))
                ->groupby('room_reservations.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',
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

        $ammendRooms = DB::table('transactions')
                ->leftjoin('room_amendments',function($join)
                            {
                                $join->on('room_amendments.transactionId', '=', 'transactions.id')->where('room_amendments.status','=','1');
                            })
                ->join('room_infos', 'room_infos.id', '=', 'room_amendments.roomFromId')
                ->join('room_types', 'room_types.id', '=', 'room_infos.type')
                ->join('room_reservations', 'room_reservations.transactionId','=', 'transactions.id')
                ->whereDate('room_reservations.depatureDate', '>=', date("Y-m-d"))
                ->whereDate('room_reservations.arrivalDate', '<=', date("Y-m-d"))
                ->groupby('room_amendments.id')
                ->orderby('transactions.updated_at')
                ->select(
                    [
                        'transactions.updated_at as reservationDate',
                        'transactions.code',
                        'room_infos.roomName',

                        DB::raw("concat(DATE_FORMAT(room_amendments.arrivalDate,'%b %d'), '-', DATE_FORMAT(room_amendments.depatureDate,'%b %d %Y')) as reservationPeriod"),

                        DB::raw("DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) as days"),


                        'room_amendments.FinalRoomRate as roomRate',
                        'room_amendments.notes as notes',

                        DB::raw('DATEDIFF(room_amendments.depatureDate, room_amendments.arrivalDate) * room_amendments.FinalRoomRate totalAmmendRoom')

                    ]
                )->get();



        return view('admin.dailySalesReport',compact('sales', 'user', 'ammendRooms'));
    }

    

    public function staff(){
        
        $shifts = DB::table('shifts')
                ->where('status','=',1)
                ->select(
                    [
                        'id',
                        'name',
                        'shiftTime'
                    ]
                )->get();
        return view('admin.staff',compact('shifts'));
    }

    public function shifts(){
        
        
        return view('admin.shifts',compact(''));
    }

    public function roomPricing(){
        
        
        return view('admin.roomPricing',compact(''));
    }
   

    public function roomStatusSaves(Request $req){
        
        
        $inputs = $req->all();

        DB::table('room_infos')
                ->where('id', $inputs['roomId'])
                ->update(array(
                    'status' => $inputs['to_status'],
                ));

        $housekeep = new Housekeeping;
        
        $housekeep->roomInfoId = $inputs['roomId'];
        $housekeep->cleanerId = $inputs['cleanerId'];
        $housekeep->type = $inputs['type'];
        $housekeep->from_status = $inputs['from_status'];

        $housekeep->to_status = $inputs['to_status'];


    
        $housekeep->save();

        return 'Success';
        
    }

    public function dataTablesRoomList()
    {
        $users = DB::table('room_infos')
            ->join('room_types', 'room_types.id', '=', 'room_infos.type')
            ->select(
                [
                'room_infos.id',
                'room_infos.roomName',
                'room_types.name as type',

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
                    end as status')
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesRoomItemReplenishList()
    {
        $users = DB::table('room_replenishes')
            ->join('room_check_lists', 'room_check_lists.id', '=', 'room_replenishes.roomItemId')
            ->join('room_infos', 'room_infos.id', '=', 'room_replenishes.roomId')
            ->join('room_types', 'room_types.id', '=', 'room_infos.type')
            ->groupby('room_infos.id')
            ->select(
                [
                    'room_replenishes.id',
                    'room_infos.roomName',
                    'room_types.name as type',
                    DB::raw('group_concat(concat(room_check_lists.name,":",room_replenishes.noOfItem) SEPARATOR ",") as itemsInventory'),
                    DB::raw("DATE_FORMAT(room_replenishes.created_at,'%b %d %Y %h:%i %p') as created")
                    
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesItemReplenishList()
    {
        $users = DB::table('room_replenishes')
            ->join('room_check_lists', 'room_check_lists.id', '=', 'room_replenishes.roomItemId')
            ->whereRaw('room_replenishes.created_at between adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY) and adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY)')
            ->groupby('room_check_lists.id')
            ->select(
                [
                    'room_replenishes.id',
                    'room_check_lists.name',
                    'room_replenishes.noOfItem',
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    
    public function checkInReservation(){
        $user=Auth::user();

        return view('admin.checkInReservation',compact('user'));
    }

    public function guaranteedReservation(){
        $user=Auth::user();

        return view('admin.guaranteedReservation',compact('user'));
    }



    public function activeReservation(){
        $user=Auth::user();

        return view('admin.activeReservation',compact('user'));
    }
 


    public function archiveReservation(){
        

        return view('admin.archiveReservation',compact(''));
    }

    public function fnb(){
        

        return view('admin.fnb',compact(''));
    }
    public function roomHistory(){
        

        return view('admin.roomHistory',compact(''));
    }
    
    public function discount(){        
        return view('admin.discount',compact(''));
    }
    
    public function roomIssue(){        
        return view('admin.roomIssue',compact(''));
    }

    ///Datatables
    public function dataTablesRoomIssues()
    {
        $user=Auth::user();
        $users = DB::table('room_issues')
            ->join('room_infos', 'room_infos.id', '=', 'room_issues.roomId')
            ->join('users', 'users.id', '=', 'room_issues.cleanerId')
            ->where('room_issues.status','=',1)
            ->orderby('room_issues.created_at','desc')
            ->select(
                [
                    'room_infos.roomName as room',
                    'room_issues.id',
                    'users.username as issuedBy',
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


    public function dataTablesHousekeepingHistory()
    {
        $user=Auth::user();
        $users = DB::table('housekeepings')
            ->leftjoin('room_infos', 'room_infos.id', '=', 'housekeepings.roomInfoId')
            ->leftjoin('users', 'users.id', '=', 'housekeepings.cleanerId')
            ->orderby('housekeepings.created_at','desc')
            ->orderby('housekeepings.cleanerId','desc')
            ->select(
                [
                'housekeepings.id',
                'room_infos.roomName',

                DB::raw('concat(users.firstname," ", users.lastname) as cleanerName'),

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
                    concat(guests.firstname," ",guests.familyName)
                    AS name'),
                DB::raw('
                    concat(houseNo," ",brgy," ",city," ",country," ",postalCode)
                    AS Address'),
                DB::raw('
                    contactNo
                    AS contactNo'),
                DB::raw('
                    email
                    AS Email'),
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }


    public function dataTablesGuestForReservationList($id)
    {
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

        $users = DB::table('room_reservations')
            ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
            ->join('guests', 'guests.id', '=', 'guest_reservations.guestId')
            ->where('guests.id','=',$id)
            ->select(
                [
                'guests.id',
                DB::raw('
                    concat(guests.firstname," ",guests.familyName)
                    AS name'),
                DB::raw('
                    concat(houseNo," ",brgy," ",city," ",country," ",postalCode)
                    AS Address'),
                DB::raw('
                    contactNo
                    AS contactNo'),
                DB::raw('
                    email
                    AS Email'),
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }



    public function dataTablesBookingList()
    {

        $users = DB::table('clients')
            ->select(
                [
                'clients.id',
                DB::raw('
                    concat(clients.firstname," ",clients.lastname)
                    AS name'),
                DB::raw('
                    address
                    AS Address'),
                DB::raw('
                    contactNo
                    AS contactNo'),
                DB::raw('
                    title
                    AS title'),
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesRoomManage()
    {

        $users = DB::table('room_infos')
            ->join('room_types', 'room_types.id', '=', 'room_infos.type')
            ->select(
                [
                    'room_infos.id',
                    'room_infos.roomName',
                    'room_types.name',
                    DB::raw('
                    case cleanStatus
                    when "1" then "Vacant Dirty"
                    when "2" then "Vacant Cleaned"
                    when "3" then "Occupied"
                    when "4" then "Out of Order"
                    end as cleanStatus
                    '),
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
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }
    public function dataTablesRoomPricing()
    {

        $users = DB::table('room_types')
            ->select(
                [
                    'room_types.id',
                    'room_types.name',
                    DB::raw('room_types.room_rate as price'),
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesInstitutionList()
    {

        $users = DB::table('institutions')
            ->join('account_types', 'account_types.id', '=', 'institutions.type')
            ->select(
                [
                'institutions.id',
                DB::raw('
                    institutions.name
                    AS name'),
                DB::raw('
                    address
                    AS Address'),
                DB::raw('
                    contactNo
                    AS contactNo'),
                DB::raw('account_types.name as type'),
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablestransactions()
    {

        $users = DB::table('transactions')
            ->join('clients', 'clients.id','=','transactions.clientId' )
            ->join('institutions', 'institutions.id','=','transactions.institutionId' )
            ->join('room_reservations', 'room_reservations.transactionId', '=','transactions.id')            
            ->join('users', 'users.id', '=', 'transactions.updatedBy')
            ->groupby('transactions.id')
            ->select(
                [
                'transactions.id',
                DB::raw('if(sum(room_reservations.discountId)>0, "w/ Discount", "None") as discountStatus'),
                DB::raw('
                    concat(clients.firstname," ",clients.lastname)
                    AS clientName'),
                DB::raw('
                    institutions.name
                    AS institutionsName'),
                'code',
                 DB::raw('
                    case transactions.status
                    when "0" then "Ongoing "
                    when "1" then "Billed"
                    when "2" then "No Show"
                    when "3" then "House Use"
                    when "100" then "Fully Paid"
                    when "1000" then "Partial Paid"
                    end as transactionstatus'),
                 'users.username'
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

     public function dataTablesUsersList()
    {
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);

        $users = DB::table('users')
            ->select(
                [
                'username', 
                DB::raw('
                    case role
                    when "1" then "Frontdesk"
                    when "2" then "Administrator"
                    when "3" then "Housekeeping"
                    else role
                    end as Position'),
                'email',
                DB::raw('
                    concat(firstname," ",lastname)
                    AS name'),
                 'address', 'contactNo'
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesDiscountsList()
    {
        $users = DB::table('discount_details')
            ->select(
                [
                'id',
                'name', 
                'discountValue',
                DB::raw('
                    case type
                    when "1" then "Percentage"
                    when "2" then "Amount"
                    end as type'),

                DB::raw('
                    case status
                    when "0" then "Inactive"
                    when "1" then "Active"
                    end as status'),
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesRoomCheckListItems()
    {
        $users = DB::table('room_check_lists')
            ->select(
                [
                'id',
                'name', 
                DB::raw('
                    case status
                    when "0" then "Inactive"
                    when "1" then "Active"
                    end as status'),

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

    public function dataTablesGuaranteedReservationList()
    {
        $users = DB::table('transactions')
            ->leftjoin('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->leftjoin('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->leftjoin('room_types','room_types.id', '=', 'room_infos.type')
            ->leftjoin('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->leftjoin('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('transactions.status','=',0)
            ->where('transactions.guaranteed','=',1)
            ->where('room_reservations.arrivalDate','>=',date('Y-m-d'))
            ->groupby('room_reservations.id')
            ->select(
                [
                
                
                'room_infos.roomName',
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

    public function dataTablesActiveReservationList()
    {
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);


        $users = DB::table('transactions')
            ->leftjoin('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->leftjoin('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->leftjoin('room_types','room_types.id', '=', 'room_infos.type')
            ->leftjoin('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->leftjoin('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('transactions.status','=',0)
            ->where('transactions.guaranteed','=',2)
            ->where('room_reservations.arrivalDate','>=',date('Y-m-d'))
            ->groupby('room_reservations.id')
            ->select(
                [
                
                
                'room_infos.roomName',
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
    

    public function dataTablesArchiveReservationList()
    {
        $users = DB::table('transactions')
            ->leftjoin('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('clients', 'clients.id', '=', 'transactions.clientId')
            ->join('institutions', 'institutions.id', '=', 'transactions.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('room_types','room_types.id', '=', 'room_infos.type')
            ->leftjoin('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join(DB::raw('(SELECT 
    GROUP_CONCAT(DISTINCT(room_charges.os_id) SEPARATOR ", ") AS osNos,
    room_charges.guestReservationId,
    rr.transactionId 
  FROM
    room_charges 
    JOIN guest_reservations AS gr
    ON gr.id = room_charges.guestReservationId
    JOIN room_reservations AS rr
    ON rr.id = gr.roomReservationId
  GROUP BY guestReservationId
) AS osGroupOne'), function ($join) {
                $join->on('osGroupOne.transactionId', '=','transactions.id');
            })
          
            ->leftjoin('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('room_reservations.occupied_status',2)
            ->groupby('transactions.id')
            ->select(
                [
                
                'clients.id',
                'clients.firstname',
                'transactions.code',
                DB::raw('group_concat(room_infos.roomName separator ", ") as roomName'),
                'osGroupOne.osNos',
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
    public function dataTablesArchiveReservationListByGuest($id)
    {
        //$posts = DB::table('Transaction')->join('Client', 'Client.id', '=', 'Transaction.clientId')
        //->select(['Client.firstname', 'Client.lastname', 'Transaction.specialRequestNotes', 'Transaction.guaranteedNote', 'Client.created_at', 'Client.updated_at']);

         //var_dump($posts);
        //return Datatables::of($posts)->make(true);
        $users = DB::table('clients')
            ->join('transactions', 'clients.id', '=', 'transactions.clientId')
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('institutions', 'institutions.id', '=', 'clients.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->where('guests.id','=',$id)
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->groupby('guests.id')
            ->select(
                [
                
                DB::raw('Date(transactions.updated_at) as reservedDate'),
                'room_infos.roomName',
                
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                DB::raw('concat(clients.firstName," ",clients.lastName) as clientName'),
                
                ]
                );


        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

     public function dataTablesArchiveReservationListByClient($id)
    {
        $users = DB::table('clients')
            ->join('transactions', 'clients.id', '=', 'transactions.clientId')
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('institutions', 'institutions.id', '=', 'clients.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('clients.id','=',$id)
            
            ->groupby('transactions.id')
            ->select(
                [
                
                DB::raw('Date(transactions.updated_at) as reservedDate'),
                'transactions.code',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                DB::raw('group_concat(room_infos.roomName) AS roomNames')

                
                ]
                );

        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }


    public function dataTablesArchiveReservationListByTransaction($id)
    {
        $users = DB::table('clients')
            ->join('transactions', 'clients.id', '=', 'transactions.clientId')
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('discount_details', 'discount_details.id', '=', 'room_reservations.discountId')
            ->join('institutions', 'institutions.id', '=', 'clients.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->leftjoin('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->leftjoin('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('transactions.id','=',$id)
            
            ->groupby('room_reservations.id')
            ->select(
                [
                DB::raw('discount_details.name AS discountName'),
                DB::raw('roomName AS roomNames'),
                DB::raw('Date(transactions.updated_at) as reservedDate'),
                'room_reservations.id',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                
                DB::raw('
                    group_concat(concat(guests.firstname," ",guests.familyName) SEPARATOR ", ")
                    AS guestnames'),

                

                
                ]
                );

        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesRoomChargesByTransaction($id)
    {
        $users = DB::table('transactions')            
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('discount_details', 'discount_details.id', '=', 'room_reservations.discountId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->join('room_charges', 'room_charges.guestReservationId','=','guest_reservations.id')
            ->where('transactions.id','=',$id)
            ->select(
                [
                    'room_charges.id',
                    'room_charges.created_at',
                    DB::raw('concat(guests.firstName," ",guests.familyName) as guestName'),
                    'room_infos.roomName',
                    DB::raw('
                        case room_charges.type
                            when "1" then "FNB"
                            when "2" then "Room Service"
                        end as type'
                    ),
                    DB::raw('
                        case room_charges.account_type
                            when "1" then "Debit"
                            when "2" then "Credit"
                        end as acctype'
                    ),

                    'room_charges.os_id as OR',
                    'room_charges.item_name as itemName',
                    'room_charges.price as price',



                ]
                );

        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function dataTablesDownpaymentByTransaction($id)
    {
        $users = DB::table('transactions')            
            ->join('downpayments', 'transactions.id', '=', 'downpayments.transactionId')
            ->join('users', 'users.id', '=', 'downpayments.user_id')
            ->where('transactions.id','=',$id)
            ->select(
                [
                    'downpayments.id',
                    DB::raw("DATE_FORMAT(downpayments.created_at,'%b %d %Y %h:%i %p') as dateTime"),
                    DB::raw('
                        case downpayments.paidThru
                            when "1" then "Cash"
                            when "2" then "Credit Card"
                            when "3" then "Cheque"
                        end as paidThru'
                    ),
                    DB::raw('concat(users.firstName, " ", users.lastName) as frontdesk'),
                    'downpayments.amount',
                    'downpayments.notes',

                ]
                );

        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }

    public function retrieveGuestsTransaction(Request $request)
    {
        $inputs = $request->all();


        $users = DB::table('transactions')            
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('discount_details', 'discount_details.id', '=', 'room_reservations.discountId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('room_types', 'room_types.id', '=', 'room_infos.type')
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('transactions.id','=',$inputs['id'])
            ->groupby('guest_reservations.id')
            ->select(
                [
                    'guest_reservations.id',
                    DB::raw('concat(guests.firstName," ",guests.familyName," (",room_infos.roomName," - ",room_types.name,")") as name'),
                ]
                )->get();

        return $users;
        //return Datatables::of(Users::query())->make(true);
    }


    
    public function dataTablesArchiveReservationListByInstitution($id)
    {
        $users = DB::table('clients')
            ->join('transactions', 'clients.id', '=', 'transactions.clientId')
            ->join('room_reservations', 'transactions.id', '=', 'room_reservations.transactionId')
            ->join('institutions', 'institutions.id', '=', 'clients.institutionId')
            ->join('room_infos', 'room_infos.id', '=', 'room_reservations.roomId')
            ->join('guest_reservations', 'room_reservations.id','=','guest_reservations.roomReservationId')
            ->join('guests', 'guests.id','=','guest_reservations.guestId')
            ->where('institutions.id','=',$id)
            
            ->groupby('transactions.id')
            ->select(
                [
                
                DB::raw('Date(transactions.updated_at) as reservedDate'),
                'transactions.code',
                'room_reservations.arrivalDate',
                'room_reservations.depatureDate',
                DB::raw('group_concat(room_infos.roomName) AS roomNames')

                
                ]
                );

        return Datatables::of($users)->make(true);
        //return Datatables::of(Users::query())->make(true);
    }


    public function __construct()
    {
        $this->middleware(['admin','auth']);
    }
    
    public function index()
    {
        //
        $user=Auth::user();
        $discountDetails = DB::table('discount_details')->get();
        
        return view('admin.index',compact('user','discountDetails'));
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
    public function store(Request $request)
    {
        //

        $inputs = $request->all();
        if($inputs['updateMe']=='1')
        {
            DB::table('users')
                ->where('id', $inputs['idUser'])
                ->update(array('name' => $inputs['fname'], 'email' => $inputs['email'], 'address' => $inputs['address'], 'password' => bcrypt($inputs['password']), 'role' => $inputs['position'], 'firstname' => $inputs['fname'], 'lastname' => $inputs['lname'], 'contactNo' => $inputs['contactno'], 'username' => $inputs['username'], 'shiftId' => $inputs['shiftId']));
        }
        else{
            $users = new User;


            $roomReservTemp = 0;
            
            $users->name = $inputs['fname'];
            $users->email = $inputs['email'];
            $users->address = $inputs['address'];
            $users->password = bcrypt($inputs['password']);
            $users->role = $inputs['position'];
            $users->firstname = $inputs['fname'];
            $users->lastname = $inputs['lname'];
            $users->middlename = $inputs['mname'];
            $users->contactNo = $inputs['contactno'];
            $users->username = $inputs['username'];
            $users->shiftId = $inputs['shiftId'];

            $users->save();
        }
        
        $shifts = DB::table('shifts')
                ->where('status','=',1)
                ->select(
                    [
                        'id',
                        'name',
                        'shiftTime'
                    ]
                )->get();
                
        return view('admin.staff',compact('shifts'));
        
        
    }


    public function shiftsManage(Request $request)
    {

        $inputs = $request->all();
        if($inputs['updateMe']=='1')
        {
            DB::table('users')
                ->where('id', $inputs['idUser'])
                ->update(array('name' => $inputs['name'], 'shiftTime' => $inputs['timeIn'], 'status' => $inputs['status']));
                

        }
        else{
            $shifts = new shift;
            
            $shifts->name = $inputs['name'];
            $shifts->shiftTime = $inputs['timeIn'];
            $shifts->status = $inputs['status'];

            $shifts->save();
        }
        
        return view('admin.shifts', compact(''));
    }

    public function discountManage(Request $request)
    {

        $inputs = $request->all();
        
            $discount = new DiscountDetails;
            
            $discount->name = $inputs['name'];
            $discount->type = $inputs['type'];
            $discount->discountValue = $inputs['discountValue'];
            $discount->status = 1;

            $discount->save();
        
        
        return view('admin.discount', compact(''));
    }

    public function roomCheckListItemManage(Request $request)
    {   
        $inputs = $request->all();

        DB::table('room_check_lists')
        ->insert(
            [
            'name' => $inputs['name'], 
            'category' => $inputs['category'], 
            'status' => 1
            ]
        );
        
        return view('admin.roomCheckList', compact(''));
    }










    /////////////////////////////Statistic Controller


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




    ///for New check-in guest statistic
    public function chartNewGuestCheckIn(){
         $users = DB::table('guests')
            ->join('guest_reservations', 'guest_reservations.guestId', '=', 'guests.id')
            ->orwhere('guest_reservations.status', '2')
            ->orwhere('guest_reservations.status', '4')
            ->whereyear('guests.created_at','=',''.date("Y").'')
            ->select(
                    [
                DB::raw('sum(if(month(guests.created_at) = 1, 1, 0)) as January'),
                DB::raw('sum(if(month(guests.created_at) = 2, 1, 0)) as February'),
                DB::raw('sum(if(month(guests.created_at) = 3, 1, 0)) as March'),
                DB::raw('sum(if(month(guests.created_at) = 4, 1, 0)) as April'),
                DB::raw('sum(if(month(guests.created_at) = 5, 1, 0)) as May'),
                DB::raw('sum(if(month(guests.created_at) = 6, 1, 0)) as June'),
                DB::raw('sum(if(month(guests.created_at) = 7, 1, 0)) as July'),
                DB::raw('sum(if(month(guests.created_at) = 8, 1, 0)) as August'),
                DB::raw('sum(if(month(guests.created_at) = 9, 1, 0)) as September'),
                DB::raw('sum(if(month(guests.created_at) = 10, 1, 0)) as October'),
                DB::raw('sum(if(month(guests.created_at) = 11, 1, 0)) as November'),
                DB::raw('sum(if(month(guests.created_at) = 12, 1, 0)) as December'),
                ]
                )->get();
        //return json_encode($users);
        return Response::json($users);
    }


    public function chartNewGuestReservationCheckIn(){
         $users = DB::table('guests')
            ->join('guest_reservations', 'guest_reservations.guestId', '=', 'guests.id')
            ->orwhere('guest_reservations.status', '2')
            ->orwhere('guest_reservations.status', '4')
            ->whereyear('guest_reservations.updated_at','=',''.date("Y").'')
            ->select(
                    [
                DB::raw('sum(if(month(guest_reservations.updated_at) = 1, 1, 0)) as January'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 2, 1, 0)) as February'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 3, 1, 0)) as March'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 4, 1, 0)) as April'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 5, 1, 0)) as May'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 6, 1, 0)) as June'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 7, 1, 0)) as July'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 8, 1, 0)) as August'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 9, 1, 0)) as September'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 10, 1, 0)) as October'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 11, 1, 0)) as November'),
                DB::raw('sum(if(month(guest_reservations.updated_at) = 12, 1, 0)) as December'),
                ]
                )->get();
        //return json_encode($users);
        return Response::json($users);
    }

    public function chartCheckInRoom(){
         $users = DB::table('room_infos')
            ->join('room_reservations', 'room_reservations.roomId', '=', 'room_infos.id')
            ->join('guest_reservations', 'guest_reservations.roomReservationId', '=', 'room_reservations.id')
            ->orwhere('guest_reservations.status','=','2')
            ->orwhere('guest_reservations.status','=','4')
            ->groupby(DB::raw('day(room_reservations.created_at)'))
            ->groupby('room_infos.type')
            ->select(
                    [
                        DB::raw('ROUND(UNIX_TIMESTAMP(date(room_reservations.created_at)) * 1000) as timeStamps'),
                        
                        DB::raw('count(room_reservations.id) as count'),
                        DB::raw('room_infos.type as roomType')
                    ]
            )->get();
        //return json_encode($users);
        return Response::json($users);
    }

    public function chartBilledTransactionPerType(){
        
            $users = DB::table('transactions')            
            ->groupby(DB::raw('day(transactions.updated_at)'))
            ->orderby(DB::raw('transactions.updated_at', 'asc'))
            ->select(
                    [
                        DB::raw('ROUND(UNIX_TIMESTAMP(date(transactions.updated_at)) * 1000) as timeStamps'),
                        DB::raw('count(transactions.id) as count'),
                        DB::raw('transactions.status as types')
                    ]
            )->get();
        //return json_encode($users);
        return Response::json($users);
    }



    public function chartBilledTransaction(){
         $users = DB::table('transactions')
            ->orwhere('transactions.status','=','1000')
            ->orwhere('transactions.status','=','100')            
            ->groupby(DB::raw('day(transactions.updated_at)'))
            ->orderby(DB::raw('transactions.updated_at', 'asc'))
            ->select(
                    [
                        DB::raw('ROUND(UNIX_TIMESTAMP(date(transactions.updated_at)) * 1000) as timeStamps'),
                        DB::raw('sum(transactions.totalTransactionBill) as totalBill'),
                        DB::raw('transactions.status as types')
                    ]
            )->get();
        
        return Response::json($users);
    }



     

    public function fnbtransactions(){
         $users = DB::table('room_charges')
            ->groupby(DB::raw('day(room_charges.updated_at)'))
            ->groupby('room_charges.type')
            ->select(
                    [
                        DB::raw('ROUND(UNIX_TIMESTAMP(date(room_charges.created_at)) * 1000) as timeStamps'),
                        DB::raw('room_charges.price as totalBill'),
                        DB::raw('room_charges.type as types'),
                        
                    ]
            )->get();
        
        return Response::json($users);
    }




    public function userSearch(Request $request){


        $term = $request->get('term');
        
        $results = array();
 
        $queries = DB::table('users')
                    ->where('firstName', 'LIKE', '%'.$term.'%')
                    ->orWhere('middleName', 'LIKE', '%'.$term.'%')
                    ->orWhere('lastName', 'LIKE', '%'.$term.'%')
                    ->orWhere('username', 'LIKE', '%'.$term.'%')
                    ->take(10)->get();
          
        foreach ($queries as $q)
        {

            $results[] = ['value' => $q->firstName.' '.$q->lastName.' ('.$q->username.')', 'name' => $q->name, 'id' => $q->id,'address' => $q->address,'contactNo' => $q->contactNo,'email' => $q->email, 'firstName' => $q->firstName, 'lastName' => $q->lastName, 'middleName' => $q->middleName, 'role' => $q->role, 'username' => $q->username,];
            //$results[] = ['username' => $q->username,'email' => $q->email,'role' => $q->role,'firstName' => $q->firstName,'lastName' => $q->lastName,'middleName' => $q->middleName,'address' => $q->address,'contactNo' => $q->contactNo];
        }

         return response()->json($results);
    }

    public function guestViewRegistration($id){
        $guest = Guest::findOrFail($id);
        
        return response()->json($guest);
    }

    public function bookingViewRegistration($id){
        $booker = Client::findOrFail($id);
        
        return response()->json($booker);
    }

    public function roomViewRegistration($id){
        $rooms = RoomInfo::findOrFail($id);
        
        return response()->json($rooms);
    }

    public function roomReservationViewRegistration($id){
        $rooms = DB::table('room_reservations')
            ->where('room_reservations.id','=',$id)
            ->join('room_infos as r','r.id','=','room_reservations.roomId')
            ->join('room_types as rt','r.type','=','rt.id')
            ->select(
                [
                    'room_reservations.id',
                    DB::raw('DATE_FORMAT(room_reservations.arrivalDate,"%m/%d/%Y") as arrivalDate'),
                    DB::raw('DATE_FORMAT(room_reservations.depatureDate,"%m/%d/%Y") as depatureDate'),
                    DB::raw('DATE_FORMAT(room_reservations.initialArrivalDate,"%m/%d/%Y") as initialArrivalDate'),
                    DB::raw('DATE_FORMAT(room_reservations.initialDepartureDate,"%m/%d/%Y") as initialDepatureDate'),
                    'room_reservations.noOfdays',                    
                    'room_reservations.discountId',
                    'room_reservations.occupied_status as occupiedStatus',
                    'room_reservations.FinalRoomRate as FinalRoomRate',
                    'room_reservations.roomTypeBill as FinalRoomType',
                    'rt.name as roomType',
                    
                ]
                )->get();
        
        return response()->json($rooms);
    }

    public function roomTypeViewRegistration($id){
        $rooms = DB::table('room_types')
            ->where('id','=',$id)
            ->select(
                [
                    'room_types.id',
                    'room_types.name',
                    DB::raw('room_types.room_rate as price'),
                ]
                )->get();
        
        return response()->json($rooms);
    }

    public function discountViewRegistration($id){
        $discounts = DB::table('discount_details')
            ->where('id','=',$id)
            ->select(
                [
                    'discount_details.id',
                    'discount_details.name',
                    'discount_details.type',
                    'discount_details.discountValue',
                    'discount_details.status',
                    
                ]
                )->get();
        
        return response()->json($discounts);
    }


    public function roomCheckListViewRegistration($id){
        $roomItems = DB::table('room_check_lists')
            ->where('id','=',$id)
            ->select(
                [
                    'room_check_lists.id',
                    'room_check_lists.name',
                    'room_check_lists.status',
                    'room_check_lists.category',
                    
                ]
                )->get();
        
        return response()->json($roomItems);
    }


    public function institutionViewRegistration($id){
        $institution = Institution::findOrFail($id);
        
        return response()->json($institution);
    }

    public function transactionViewRegistration($id){
        $transactions = Transaction::findOrFail($id);
        
        return response()->json($transactions);
    }

    public function roomChargeViewRegistration($id){
        $users = DB::table('room_charges')            
            ->where('room_charges.id','=',$id)
            ->select(
                [   
                    'room_charges.id',
                    'room_charges.guestReservationId as guestReservationId',
                    'room_charges.type as type',
                    'room_charges.account_type as acctype',
                    'room_charges.os_id as OR',
                    'room_charges.item_name as itemName',
                    'room_charges.price as price',
                ]
                )->get();

        return $users;

    }

    public function downpaymentViewRegistration($id){
        $users = DB::table('downpayments')            
            ->where('downpayments.id','=',$id)
            ->select(
                [   
                    'downpayments.id',
                    'downpayments.paidThru as paidThru',
                    'downpayments.amount as amount',
                    'downpayments.notes as notes',
                ]
                )->get();

        return $users;

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
                    DB::raw("transactions.status as transactionstatus"),
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




    public function guestUpdateAjax(Request $req){
        $inputs = $req->all();
        
                
        
         Guest::where('id', $inputs['id'])
                ->update(array(
                    'firstName' =>  $inputs["firstName"],
                    'middleName' => $inputs["middleName"],
                    'familyName' => $inputs["familyName"],
                    'houseNo' =>    $inputs["houseNo"],
                    'brgy' =>    $inputs["brgy"],
                    'city' =>  $inputs["city"],
                    'country' =>    $inputs["country"],
                    'postalCode' =>  $inputs["postalCode"],
                    'nationality' =>  $inputs["nationality"],
                    'contactNo' =>  $inputs["contactNo"],
                    'email' =>  $inputs["email"],
                    'dob' =>  $inputs["dob"],
                    'designation' =>  $inputs["designation"],
                    'passNo' =>  $inputs["passNo"],
                    'passExpiry' =>  $inputs["passExpiry"],
                    'passIssue' => $inputs["passIssue"],
                    'otherId' =>    $inputs["otherId"],
                ));
        $queries = DB::getQueryLog();      
        return json_encode($queries);
    }

    public function clientUpdateAjax(Request $req){
        $inputs = $req->all();


         DB::table('clients')
                ->where('id', $inputs['id'])
                ->update(array(
                    'firstName' =>  $inputs["firstName"],
                    'lastname' => $inputs["familyName"],
                    'title' =>    $inputs["title"],
                    'contactNo' =>    $inputs["contactNo"],
                    'email' =>  $inputs["email"],
                    'address' =>  $inputs["address"],
                    
                ));


        return 'Success';
    }

    public function roomUpdateAjax(Request $req){
        $inputs = $req->all();


         DB::table('room_infos')
                ->where('id', $inputs['id'])
                ->update(array(
                    'status' =>  $inputs["status"],
                    'cleanStatus' => $inputs["cleanStatus"],
                    'type' => $inputs["roomType"],
                ));


        return 'Success';
    }

    public function roomTypeUpdateAjax(Request $req){
        $inputs = $req->all();


         DB::table('room_types')
                ->where('id', $inputs['id'])
                ->update(array(
                    'room_rate' =>  $inputs["rate"],                    
                ));


        return 'Success';
    }

    public function institutionUpdateAjax(Request $req){
        $inputs = $req->all();
        DB::table('institutions')
                ->where('id', $inputs['id'])
                ->update(array(
                    'name' =>  $inputs["name"],
                    'address' => $inputs["address"],
                    'contactNo' =>    $inputs["contactNo"],
                    'type' =>    $inputs["type"],
                ));


        return 'Success';
    }

    public function transactionUpdateAjax(Request $req){
        $inputs = $req->all();
        DB::table('transactions')
                ->where('id', $inputs['id'])
                ->update(array(
                    'status' =>  $inputs["status"],
                    'chargeType' =>  $inputs["chargeType"],
                    'madeThru' => $inputs["madeThru"],
                    'guaranteed' =>    $inputs["guaranteed"],
                    'billingType' =>    $inputs["billArrange"],
                    'guaranteedNote' =>    $inputs["guaranteedNote"],
                    'specialRequestNotes' =>    $inputs["specialRequestNotes"],
                    'billingNote' =>    $inputs["billingNote"],
                ));

        if($inputs['isRoomManage']>0){
            DB::table('room_reservations')
                ->where('id', $inputs['isRoomManage'])
                ->update(array(
                    'initialArrivalDate' =>  date_format(date_create($inputs['initialArrivalDate']),"Y-m-d"),
                    'initialDepartureDate' =>  date_format(date_create($inputs['initialDepatureDate']),"Y-m-d"),
                    'arrivalDate' =>  date_format(date_create($inputs['arrivalDateRoom']),"Y-m-d"),
                    'depatureDate' =>  date_format(date_create($inputs['depatureDateRoom']),"Y-m-d"),
                    'occupied_status' => $inputs["occupiedStatus"],
                    'discountId' =>    $inputs["discountStatus"],
                    'finalRoomRate' =>    $inputs["finalRoomRate"],
                    'roomTypeBill' => $inputs["finalRoomType"],
                ));
        }


        if($inputs['isRoomChargeManage']>0){
            DB::table('room_charges')
                ->where('id', $inputs['isRoomChargeManage'])
                ->update(array(
                    'guestReservationId' => $inputs["guestNameCharged"],
                    'type' => $inputs["roomChargeType"],
                    'price' => $inputs["priceCharge"],
                    'os_id' => $inputs["orCharge"],
                    'item_name' => $inputs["itemNameCharge"],
                    'account_type' => $inputs["accountChargeType"],

                ));
        }

        if($inputs['isDownpaymentManage']>0){
            DB::table('downpayments')
                ->where('id', $inputs['isDownpaymentManage'])
                ->update(array(
                    'paidThru' => $inputs["paidThruDownpayment"],
                    'amount' => $inputs["amountDownpayment"],
                    'notes' => $inputs["notesDownpayment"],
                ));
        }




        return 'Success';
    }
/////////////////////Housekeeping


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
        //DB::table('discount_details')->where('id', '=', $inputs['id'])->delete();

         DB::table('discount_details')
                ->where('id', $inputs['id'])
                ->update(array(
                    'name' =>  $inputs["names"],                    
                    'type' =>  $inputs["types"],
                    'discountValue' =>  $inputs["value"],
                    'status' =>  $inputs["status"],
                ));


        return 'Success';
    }

    public function deleteRoomChargeAjax(Request $req){
        $inputs = $req->all();
        DB::table('room_charges')->where('id', '=', $inputs['id'])->delete();
        return 'Success';
    }
    public function deleteDownpaymentAjax(Request $req){
        $inputs = $req->all();
        DB::table('downpayments')->where('id', '=', $inputs['id'])->delete();
        return 'Success';
    }

    public function updateRoomCheckListAjax(Request $req){
        $inputs = $req->all();
        //DB::table('discount_details')->where('id', '=', $inputs['id'])->delete();

         DB::table('room_check_lists')
                ->where('id', $inputs['id'])
                ->update(array(
                    'name' =>  $inputs["name"],                    
                    'status' =>  $inputs["status"],
                    'category' =>  $inputs["category"],
                ));


        return 'Success';
    }

    

    public function roomStatusSavesForAdmin(Request $req){
        $inputs = $req->all();
        
        if($inputs['typeIssue']>1)
        {
            $roomIssue = new RoomIssue;
                
            $roomIssue->roomId = $inputs['roomId'];
            $roomIssue->cleanerId = $inputs['cleanerId'];
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
                elseif($inputs['cleanStatus'] == 4)
                {
                    return 'bg-white';
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
                    when "1" then "Dirty"
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


