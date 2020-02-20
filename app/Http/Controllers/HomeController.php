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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

       public function apiOnlineReservation(Request $req){

        // return "HELLO"
        // $inputs = $req->all();

        // $user = new User;
        // $user->username = $inputs["username"];
        // $user->firstName = $inputs["firstName"];
        // $user->save();



       return collect(['name' => 'Abigail', 'state' => 'CA']);
   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->IsFrontDesk()) {
            return redirect('/frontdesk');
        }
        else if(Auth::user()->IsAdmin()){
            return redirect('/admin');
        }
        else if(Auth::user()->IsHousekeeping()){
            return redirect('/housekeeping');
        }
    }
}
