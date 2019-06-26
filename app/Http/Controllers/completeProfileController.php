<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Country;
use App\Owner; // here renter now act as renter
use File;
use App\Property;
use App\PageFeature;
use App\PageGallary;
use App\FaqCategory;
use App\FaqQuestion;
use App\PageContact;
use App\PageBox;
use App\PageBoxMetadata;
use App\Setting;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use App\OwnerMetadata;

class completeProfileController extends Controller
{
    //

    public function profile_form($id){
       
        $user = User::find($id);
        $countries = Country::all();

        $data = array(
            'user' => $user, 
            'countries' => $countries, 
        );

        return view('auth.complete-profile')->with($data);
        

        
    }
    public function complete_profile(Request $request){

       

        $account_configure_id = $request['owner_account_id'];

        // payments input are here
        $input = array(
            'card_no' => $request['card_no'], 
            'ccExpiryMonth' => $request['ccExpiryMonth'], 
            'ccExpiryYear' => $request['ccExpiryYear'], 
            'cvvNumber' => $request['cvvNumber'], 
            'amount' => 0, 
            '_token' => $request['_token'], 
        );

            $input = array_except($input,array('_token'));            
            $stripe = Stripe::make('sk_test_Tuu7yqzEOT76lAvrY311Y8df');

            
            // try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request['card_no'],
                        'exp_month' => $request['ccExpiryMonth'],
                        'exp_year'  => $request['ccExpiryYear'],
                        'cvc'       => $request['cvvNumber'],
                    ],
                ]);


                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('register');
                    die();
                }

                $payment =  OwnerMetadata::create([
                    'user_id' => $account_configure_id,
                    'card_number' => $request['card_no'],
                    'exp_month' => $request['ccExpiryMonth'],
                    'exp_year' => $request['ccExpiryYear'],
                    'sec_code' => $request['cvvNumber'],
                ]);



                // $charge = $stripe->charges()->create([
                //     'card' => $token['id'],
                //     'currency' => 'USD',
                //     'amount'   => 0,
                //     'description' => 'Add in wallet',
                // ]);
                // if($charge['status'] == 'succeeded') {
                    /**
                    * Write Here Your Database insert logic.
                    */


                    


                    // \Session::put('success','Money add successfully in wallet');
                // } else {

                    

                // }
            // } catch (Exception $e) {
            //     \Session::put('error',$e->getMessage());
            //     return redirect()->route('register');
            // } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            //     \Session::put('error',$e->getMessage());
            //     return redirect()->route('register');
            // } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            //     \Session::put('error',$e->getMessage());
            //     return redirect()->route('register');
            // }


        $image = $request['driving_license'];
        // $image = $request->file('image');

        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/license');
        $image->move($destinationPath, $imagename);

        $ownerData =  Owner::create([
            'user_id' => $account_configure_id,
            'name' => $request['name'],
            'surname' => $request['surname'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip' => $request['zip'],
            'address' => $request['address'],
            'number' => $request['number'],
            'driving_license' => $imagename
        ]);

        $user = User::find($account_configure_id);
        $user->status = 1;
        $user->save();

        return redirect('/login')->with('status', 'Profile has been completed! You can login now');

    }

}
