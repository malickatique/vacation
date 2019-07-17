<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Country;

class AjaxCallcontroller extends Controller
{
    //
    public function get_states(Request $request){

        $country_id = $request['country'];
        $states = State::where('country_id', $country_id)->get();
        return response()->json(['success'=> $states]);

    }

    public function get_cities(Request $request){

        $state_id = $request['state'];
        $cities = City::where('state_id', $state_id)->get();
        return response()->json(['success'=> $cities]);

    }

    public function get_countries(){

        $countries = Country::all();
        return response()->json(['success'=> $countries]);

    }



}
