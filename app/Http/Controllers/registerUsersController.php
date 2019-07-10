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

class registerUsersController extends Controller
{
    //qwd
    
    public function renter_owner_view()
    {

    // global setting start
    $navs = Page::where('status', 1)->get();
    $logo = Setting::where('name', 'site_logo')->first();
    $footer_logo = Setting::where('name', 'footer_logo')->first();
    $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
    $footer_desc = Setting::where('name', 'footer_desc')->first();
    $footer_contact = Setting::where('name', 'footer_contact')->first();
    $footer_email = Setting::where('name', 'footer_email')->first();
    $footer_trademark = Setting::where('name', 'footer_trademark')->first();
    // global setting end

    $data = array(
        'navs' => $navs,
        'logo' => $logo,
        'footer_logo' => $footer_logo,
        'site_sticky_logo' => $site_sticky_logo,
        'footer_desc' => $footer_desc,
        'footer_contact' => $footer_contact,
        'footer_email' => $footer_email,
        'footer_trademark' => $footer_trademark,
    );
        return view('renter-owner-links')->with($data);
    }
    
    public function renter_register_form(){

        $navs = Page::where('status', 1)->get();
        $logo = Setting::where('name', 'site_logo')->first();
        $footer_logo = Setting::where('name', 'footer_logo')->first();
        $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
        $footer_desc = Setting::where('name', 'footer_desc')->first();
        $footer_contact = Setting::where('name', 'footer_contact')->first();
        $footer_email = Setting::where('name', 'footer_email')->first();
        $footer_trademark = Setting::where('name', 'footer_trademark')->first();
        // global setting end

        $countries = Country::all();

        $data = array(
            'navs' => $navs,
            'logo' => $logo,
            'footer_logo' => $footer_logo,
            'site_sticky_logo' => $site_sticky_logo,
            'footer_desc' => $footer_desc,
            'footer_contact' => $footer_contact,
            'footer_email' => $footer_email,
            'footer_trademark' => $footer_trademark,
            'countries' => $countries,
        );

        return view('renters.register-page')->with($data);

    }
    public function register_renter(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'surname' => 'required|string|max:255',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required|string|',
            'number' => 'required',
            'driving_license' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image = $request['profile'];
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/user/renter');
        $image->move($destinationPath, $imagename);

        $user = new User;
        $user->name = $request['name'] .' '.$request['surname'];
        $user->email = $request['email'];
        $user->user_type = 'renter';
        $user->password = bcrypt($request['password']);
        $user->status = 2;
        $user->user_image = $imagename;
        $user->save();

        $last_user_id = $user->id;

        $dl_image = $request['driving_license'];
        $dl_imagename = time().'.'.$dl_image->getClientOriginalExtension();
        $dl_destinationPath = public_path('/images/license');
        $dl_image->move($dl_destinationPath, $dl_imagename);

        // here Owner now act as renter
        $renter = new Owner;
        $renter->user_id =  $last_user_id;
        $renter->name =  $request['name'];
        $renter->surname =  $request['surname'];
        $renter->city =  $request['city'];
        $renter->state =  $request['state'];
        $renter->zip =  $request['zip'];
        $renter->address =  $request['address'];
        $renter->number =  $request['number'];
        $renter->driving_license =  $dl_imagename;
        $renter->save();
        
        return redirect('/renterDash')->with('status', 'Account created but inactive');
        
    }
    // public function ownerRegisterView(){
        
    //     $navs = Page::where('status', 1)->get();
    //     $logo = Setting::where('name', 'site_logo')->first();
    //     $footer_logo = Setting::where('name', 'footer_logo')->first();
    //     $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
    //     $footer_desc = Setting::where('name', 'footer_desc')->first();
    //     $footer_contact = Setting::where('name', 'footer_contact')->first();
    //     $footer_email = Setting::where('name', 'footer_email')->first();
    //     $footer_trademark = Setting::where('name', 'footer_trademark')->first();
    //     // global setting end

    //     $countries = Country::all();

    //     $data = array(
    //         'navs' => $navs,
    //         'logo' => $logo,
    //         'footer_logo' => $footer_logo,
    //         'site_sticky_logo' => $site_sticky_logo,
    //         'footer_desc' => $footer_desc,
    //         'footer_contact' => $footer_contact,
    //         'footer_email' => $footer_email,
    //         'footer_trademark' => $footer_trademark,
    //         'countries' => $countries,
    //     );

    //     return view('auth.register')->with($data);
    // }
    public function register_owner_by_site(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'surname' => 'required|string|max:255',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required|string|',
            'number' => 'required',
            'driving_license' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
        ]);

        // stripe Payment Gateway start / checks

        $input = $request->all();

            $input = array_except($input,array('_token'));            
            $stripe = Stripe::make('pk_test_ApRYZ0Nq7mZjT0HVYDUdSGuJ00mRxiIvo3');
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year'  => $request->get('ccExpiryYear'),
                        'cvc'       => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('stripform');
                }



                // $charge = $stripe->charges()->create([
                //     'card' => $token['id'],
                //     'currency' => 'USD',
                //     'amount'   => 1,
                //     'description' => 'Add in wallet',
                // ]);
                // if($charge['status'] == 'succeeded') {
                //     /**
                //     * Write Here Your Database insert logic.
                //     */
                //     \Session::put('success','Money add successfully in wallet');
                //     // return redirect()->route('stripform');
                // } else {
                //     \Session::put('error','Money not add in wallet!!');
                //     return redirect()->route('register');
                // }



            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('register');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('register');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('register');
            }
        // \Session::put('error','All fields are required!!');
        
        // stripe Payment Gateway end

        $image = $request['profile'];
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/user/owner');
        $image->move($destinationPath, $imagename);

        $user = new User;
        $user->name = $request['name'] .' '.$request['surname'];
        $user->email = $request['email'];
        $user->user_type = 'owner';
        $user->password = bcrypt($request['password']);
        $user->status = 2;
        $user->user_image = $imagename;
        $user->save();

        $last_user_id = $user->id;

        $bill_info = new OwnerMetadata;
        $bill_info->user_id = $last_user_id;
        $bill_info->card_number = $request['card_no'];
        $bill_info->exp_month = $request['ccExpiryMonth'];
        $bill_info->exp_year = $request['ccExpiryYear'];
        $bill_info->sec_code = $request['cvvNumber'];
        $bill_info->save();
        

        $dl_image = $request['driving_license'];
        $dl_imagename = time().'.'.$dl_image->getClientOriginalExtension();
        $dl_destinationPath = public_path('/images/license');
        $dl_image->move($dl_destinationPath, $dl_imagename);

        // here Owner now act as owner
        $owner = new Owner;
        $owner->user_id =  $last_user_id;
        $owner->name =  $request['name'];
        $owner->surname =  $request['surname'];
        $owner->city =  $request['city'];
        $owner->state =  $request['state'];
        $owner->zip =  $request['zip'];
        $owner->address =  $request['address'];
        $owner->number =  $request['number'];
        $owner->driving_license =  $dl_imagename;
        $owner->save();

        return redirect('/ownerDash')->with('status', 'Account created but inactive');


    }
}
