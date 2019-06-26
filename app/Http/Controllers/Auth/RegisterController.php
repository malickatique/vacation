<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Page;
use App\Country;
use App\User;
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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use App\OwnerMetadata;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/ownerDash';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm(){
        
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

        return view('auth.register')->with($data);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
            'cvvNumber' => 'required'
        ]);

        

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   

        $p_image = $data['profile'];
        $p_imagename = time().'.'.$p_image->getClientOriginalExtension();
        $p_destinationPath = public_path('/images/user/owner');
        $p_image->move($p_destinationPath, $p_imagename);


        // $input = $request->all();
        $register =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => 'owner',
            'password' => bcrypt($data['password']),
            'user_image' => $p_imagename
        ]);

        $last_user_id = $register->id;

        // payments input are here
        $input = array(
            'card_no' => $data['card_no'], 
            'ccExpiryMonth' => $data['ccExpiryMonth'], 
            'ccExpiryYear' => $data['ccExpiryYear'], 
            'cvvNumber' => $data['cvvNumber'], 
            'amount' => 0, 
            '_token' => $data['_token'], 
        );

            $input = array_except($input,array('_token'));            
            $stripe = Stripe::make('pk_test_ApRYZ0Nq7mZjT0HVYDUdSGuJ00mRxiIvo3');

            
            // try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $data['card_no'],
                        'exp_month' => $data['ccExpiryMonth'],
                        'exp_year'  => $data['ccExpiryYear'],
                        'cvc'       => $data['cvvNumber'],
                    ],
                ]);


                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('register');
                    die();
                }

                $payment =  OwnerMetadata::create([
                    'user_id' => $last_user_id,
                    'card_number' => $data['card_no'],
                    'exp_month' => $data['ccExpiryMonth'],
                    'exp_year' => $data['ccExpiryYear'],
                    'sec_code' => $data['cvvNumber'],
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


        $image = $data['driving_license'];
        // $image = $request->file('image');

        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/license');
        $image->move($destinationPath, $imagename);

        $ownerData =  Owner::create([
            'user_id' => $last_user_id,
            'name' => $data['name'],
            'surname' => $data['surname'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'address' => $data['address'],
            'number' => $data['number'],
            'driving_license' => $imagename
        ]);

        

        // Mail::send('mails.welcome_mail', $data, function($message) use ($data) {
        //     $message->to($data['email'])->subject
        //        ('Welcome Notification');
        //     $message->from('ovrteam@admin.com','OVR');
        //  });

        return $register;

        


    }
}
