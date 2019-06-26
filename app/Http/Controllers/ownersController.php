<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Owner; // user_metadata
use App\User; // User login
use App\OwnerMetadata; //user_billing_info
use App\Property;
use App\Mail\OwnerActivationMail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use File;
use Hash;
use Session;
use Validator;
use URL;
use Redirect;
use Input;
// use Mail;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ownersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth:admin', ['except' => ['register_owner_by_site']]);
        $this->middleware('auth');
        $this->middleware('owner');
    }
   
    public function index()
    {
        $owners = User::where('user_type', 'owner')->get();
        return view('admin.owner.show')->with('owners', $owners);
    }


    public function dashboard()
    {
        $owners = User::where('user_type', 'owner')->get();
        return view('panels.owner')->with('owners', $owners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/owner/addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->user_type = 'owner';
        $user->password = Hash::make($request['password']);
        $user->status = 2;
        $user->save();

        $data = array(
            'id' =>  $user->id,
            'name'=> $user->name,
            'email'=> $user->email,
            'password' => $request['password']
        );
   
      Mail::send('mails.owner_activation_mail', $data, function($message) use ($data) {
         $message->to($data['email'])->subject
            ('Owner Profile Invitation');
         $message->from('ovr@team.com','OVR');
      });

      return redirect('/admin/owner')->with('status', 'User created, Profile request mail has been sent');


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
        $account = User::find($id);
        $owner = Owner::where('user_id', $id)->first();
        $card_info = OwnerMetadata::where('user_id', $id)->first();
        return view('admin.owner.view')->with(compact('owner', 'account', 'card_info'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $result = User::find($id); 
        $card_info = OwnerMetadata::where('user_id', $id)->first();
        return view('admin.owner.edit')->with(compact('result', 'card_info'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * */

    public function update(Request $request, $id)
    {
        $owner = owner::find($id);
        $owner->name = $request->input('name');
        $owner->surname = $request->input('surname');
        $owner->city = $request->input('city');
        $owner->state = $request->input('state');
        $owner->zip = $request->input('zip');
        $owner->address = $request->input('address');
        $owner->number = $request->input('number');
        $owner->save();
        return redirect('/admin/owner')->with('status', 'Owner updated!');
        //$post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // echo $id;

        $cardinfo = OwnerMetadata::where('user_id',$id)->first();
        $owner = Owner::where('user_id',$id)->first();
        if(!empty($owner['driving_license'])){

            $image_path = "images/license/".$owner['driving_license']; 
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $user = User::where('id',$id)->first();
        if(!empty($user['user_image'])){

            $user_image_path = "images/users/".$user['user_image']; 
            if(File::exists($user_image_path)) {
                File::delete($user_image_path);
            }
        }

        if(isset($cardinfo)){
            $cardinfo->delete();
        }

        if(isset($owner)){
            $owner->delete();
        }

        if(isset($user)){
            $user->delete();
        }
        
        return redirect('/admin/owner')->with('status', 'Owner Removed');

    }

    public function ownerView($id)
    {
        $user = new User;
        $result = $user->find($id);
        return view('admin.owner.view')->with('result',$result);
    }

    public function owner_profile()
    {
        $id = Auth()->user()->id;
        return $account = User::find($id);
        $owner = Owner::where('user_id', $id)->first();
        $card_info = OwnerMetadata::where('user_id', $id)->first();
        // return view('admin.owner.view')->with(compact('owner', 'account', 'card_info'));
    }

    public function owner_properties($id){

        $owner_properties = Property::where('user_id', $id)->get();
        return view('admin.owner.owner-properties')->with('owner_properties', $owner_properties);

    }

    // // status updates here
    // public function owner_status(Request $request){

    //     $user_id = $request['user_id'];
    //     $status = $request['status'];

    //     if($status == 1){

    //         $user = User::find($user_id);
    //         $user->status = 2;
    //         $user->save();

    //         $data = array(
    //             'name'=> $user->name,
    //             'email'=> $user->email
    //         );
       
    //     //   Mail::send('mails.owner_status_disable', $data, function($message) use ($data) {
    //     //      $message->to($data['email'])->subject
    //     //         ('Profile Status');
    //     //      $message->from('ovrteam@admin.com','OVR');
    //     //   });

    //     }elseif($status == 2){
            
    //         $user = User::find($user_id);
    //         $user->status = 1;
    //         $user->save();

    //             $data = array(
    //                 'name'=> $user->name,
    //                 'email'=> $user->email
    //             );
       
    //     //   Mail::send('mails.owner_status_enable', $data, function($message) use ($data) {
    //     //      $message->to($data['email'])->subject
    //     //         ('Profile Status');
    //     //      $message->from('ovrteam@admin.com','OVR');
    //     //   });

    //     }

    //     return redirect()->route('owner.index')->with('status', 'User modified');

    // }

    // owner property status updates here
    public function property_status(Request $request){

        $property_id = $request['property_id'];
        $status = $request['status'];
        

        if($status == 1){

            // disable code
            $property = Property::find($property_id);
            $property->status = 2;
            $property->save();

        }elseif($status == 2){
            
            //enable code
            $property = Property::find($property_id);
            $property->status = 1;
            $property->save();

        }

        if(isset($request['redirect'])){
            // redirect to main properties here
            return redirect()->route('admin.allproperties')->with('status', 'Property modified');

        }else{

            return redirect()->route('owner.ownerproperties', $property['user_id'])->with('status', 'Property modified');

        }


    }

    // public function owner_property_detail($id){

    //     $property = Property::find($id);
    //     $features = Property::find($id)->features;
    //     $occasions = Property::find($id)->occasions;
    //     $gallaries = Property::find($id)->gallary;
        
    //     return view('admin.owner.owner-property-detail')->with(compact('property', 'features', 'occasions', 'gallaries'));

    // }


    public function register_owner_by_site(Request $request){


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
            $stripe = Stripe::make('sk_test_Tuu7yqzEOT76lAvrY311Y8df');
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

        return redirect('/login')->with('status', 'Account created but inactive');


    }
    public function update_owner(Request $request)
    {
        $owner = Auth()->user();
        
        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            // 'phone' => 'required|regex:/[0-9]{11}/',
            // 'password' => 'sometimes|min:3',
        ]);

        //Request from profile Vue component
        $currentPic = $owner->user_image;
        if( $request->user_image != $currentPic)
        {
            //We need a unique name of pic concatenamte time+extention
            //For picking file extension loop until find first semicolon
            //then record string backwards/reverse until / encountered
            //this will pick file extension
            
            $name = time().'.' .explode('/', explode(':', substr($request->user_image, 0, strpos($request->user_image, ';')))[1])[1];
            //Image Intervention class from a package named "ImageIntervention"
            //We use \ with Image so that we don't have to import its package here
            \Image::make($request->user_image)->save(public_path('/images/user/owner/').$name);
            $request->merge( ['user_image' => $name] ); //Override,replace
            //If file exists then delete the older file
            $prevPic = public_path('/images/user/owner/').$currentPic;
            if(file_exists($prevPic)){
                @unlink($prevPic);
            }
        }
        //Update password appropriately
        if($request->password != ""){
            $request->password = Hash::make($request->password);
        }
        else{
            $request->password = $owner->password;
        }
        //Update record in Rider table
        $owner->name = $request->name;
        $owner->password = $request->password;
        // $owner->phone = $request->phone;
        $owner->user_image = $request->user_image;
        $owner->save();
        return "success";
    }


}
