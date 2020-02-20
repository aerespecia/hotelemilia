<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class SearchController extends Controller
{
    //

 
   public function clientSearch(Request $request){


    $term = $request->get('term');
    
    $results = array();

    $queries = DB::table('clients')
    ->where('firstname', 'LIKE', '%'.$term.'%')
    ->orWhere('lastName', 'LIKE', '%'.$term.'%')
    ->orWhere('middleName', 'LIKE', '%'.$term.'%')
    ->take(10)->get();

    foreach ($queries as $q)
    {
        $results[] = ['fname' => $q->firstname,'clientID' => $q->id,'lname' => $q->lastName,'value' => $q->firstname.' '.$q->lastName,'contactNo' => $q->contactNo,'title' => $q->title];
    }

    return response()->json($results);
}

public function instiSearch(Request $request){


    $term = $request->get('term');
    
    $results = array();

    $queries = DB::table('institutions')
    ->where('name', 'LIKE', '%'.$term.'%')
    ->take(10)->get();

    foreach ($queries as $q)
    {
        $results[] = ['name' => $q->name,'instiID' => $q->id,'type' => $q->type,'value' => $q->name,'contactNo' => $q->contactNo,'address' => $q->address];
    }

    return response()->json($results);
}

public function guestSearch(Request $request){


    $term = $request->get('term');
    
    $results = array();

    $queries = DB::table('guests')
    ->where('firstName', 'LIKE', '%'.$term.'%')
    ->orWhere('middleName', 'LIKE', '%'.$term.'%')
    ->orWhere('familyName', 'LIKE', '%'.$term.'%')
    ->take(10)->get();

    foreach ($queries as $q)
    {
        $results[] = ['fname' => $q->firstName,'guestID' => $q->id,'lname' => $q->familyName,'value' => $q->firstName.' '.$q->familyName,'contactNo' => $q->contactNo];
    }

    return response()->json($results);
}

}
