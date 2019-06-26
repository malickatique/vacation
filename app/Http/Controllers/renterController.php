<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Hash;
use App\Page;
use App\Country;
use App\User;
use App\Owner; // here renter now act as renter
use File;
use Illuminate\Support\Facades\Log;
class renterController extends Controller
{   
    public function __construct()
    {
        // $this->middleware('auth:admin', ['except' => ['renter_owner_view', 'renter_register_form', 'register_renter']]);
        $this->middleware('auth');
        $this->middleware('renter');
    }
    //
    public function dashboard()
    {
        $renters = User::where('user_type', 'renter')->get();
        return view('panels.renter')->with('renters', $renters);
    }
    // public function renter_owner_view()
    // {

    // // global setting start
    // $navs = Page::where('status', 1)->get();
    // $logo = Setting::where('name', 'site_logo')->first();
    // $footer_logo = Setting::where('name', 'footer_logo')->first();
    // $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
    // $footer_desc = Setting::where('name', 'footer_desc')->first();
    // $footer_contact = Setting::where('name', 'footer_contact')->first();
    // $footer_email = Setting::where('name', 'footer_email')->first();
    // $footer_trademark = Setting::where('name', 'footer_trademark')->first();
    // // global setting end

    // $data = array(
    //     'navs' => $navs,
    //     'logo' => $logo,
    //     'footer_logo' => $footer_logo,
    //     'site_sticky_logo' => $site_sticky_logo,
    //     'footer_desc' => $footer_desc,
    //     'footer_contact' => $footer_contact,
    //     'footer_email' => $footer_email,
    //     'footer_trademark' => $footer_trademark,
    // );


    //     return view('renter-owner-links')->with($data);
    // }


    // public function renter_register_form(){

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

    //     return view('renters.register-page')->with($data);

    // }


    // public function register_renter(Request $request){

    //     $this->validate($request, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //         'surname' => 'required|string|max:255',
    //         'country' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'zip' => 'required',
    //         'address' => 'required|string|',
    //         'number' => 'required',
    //         'driving_license' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
    //     ]);

    //     $image = $request['profile'];
    //     $imagename = time().'.'.$image->getClientOriginalExtension();
    //     $destinationPath = public_path('/images/user/renter');
    //     $image->move($destinationPath, $imagename);

    //     $user = new User;
    //     $user->name = $request['name'] .' '.$request['surname'];
    //     $user->email = $request['email'];
    //     $user->user_type = 'renter';
    //     $user->password = bcrypt($request['password']);
    //     $user->status = 2;
    //     $user->user_image = $imagename;
    //     $user->save();

    //     $last_user_id = $user->id;

    //     $dl_image = $request['driving_license'];
    //     $dl_imagename = time().'.'.$dl_image->getClientOriginalExtension();
    //     $dl_destinationPath = public_path('/images/license');
    //     $dl_image->move($dl_destinationPath, $dl_imagename);

    //     // here Owner now act as renter
    //     $renter = new Owner;
    //     $renter->user_id =  $last_user_id;
    //     $renter->name =  $request['name'];
    //     $renter->surname =  $request['surname'];
    //     $renter->city =  $request['city'];
    //     $renter->state =  $request['state'];
    //     $renter->zip =  $request['zip'];
    //     $renter->address =  $request['address'];
    //     $renter->number =  $request['number'];
    //     $renter->driving_license =  $dl_imagename;
    //     $renter->save();

    //     return redirect('/login')->with('status', 'Account created but inactive');
        

    // }

    // renter section for admin site with admin auth start here

    public function index()
    {
        
        $renters = User::where('user_type', 'renter')->get();
        return view('admin.renter.show')->with('renters', $renters);
    }

    // status updates here
    public function renter_status(Request $request){

        $user_id = $request['user_id'];
        $status = $request['status'];

        if($status == 1){

            $user = User::find($user_id);
            $user->status = 2;
            $user->save();

            $data = array(
                'name'=> $user->name,
                'email'=> $user->email
            );
       
        //   Mail::send('mails.renter_status_disable', $data, function($message) use ($data) {
        //      $message->to($data['email'])->subject
        //         ('Profile Status');
        //      $message->from('ovrteam@admin.com','OVR');
        //   });

        }elseif($status == 2){
            
            $user = User::find($user_id);
            $user->status = 1;
            $user->save();

                $data = array(
                    'name'=> $user->name,
                    'email'=> $user->email
                );
       
        //   Mail::send('mails.renter_status_enable', $data, function($message) use ($data) {
        //      $message->to($data['email'])->subject
        //         ('Profile Status');
        //      $message->from('ovrteam@admin.com','OVR');
        //   });

        }

        return redirect()->route('renter.index')->with('status', 'User modified');

    }

    public function destroy($id){



        $renter = Owner::where('user_id',$id)->first();
        if(!empty($renter['driving_license'])){

            $image_path = "images/license/".$renter['driving_license']; 
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $user = User::where('id',$id)->first();
        if(!empty($user['user_image'])){

            $user_image_path = "images/user/renter/".$user['user_image']; 
            if(File::exists($user_image_path)) {
                File::delete($user_image_path);
            }
        }


        if(isset($renter)){
            $renter->delete();
        }

        if(isset($renter)){
            $user->delete();
        }
        
        return redirect('/admin/renter')->with('status', 'Renter Removed');



    }


    public function view($id){
        
        $account = User::find($id);
        $renter = Owner::where('user_id', $id)->first();
        return view('admin.renter.view')->with(compact('renter', 'account'));

    }
    

    public function edit($id){

        $account = User::find($id);
        $renter = Owner::where('user_id', $id)->first();
        return view('admin.renter.edit')->with(compact('renter', 'account'));

    }

    public function update(Request $request, $id){

        $user = User::find($id);

        if(isset($request['profile'])){
           
            $user_image_path = "images/user/renter/".$user['user_image']; 
            if(File::exists($user_image_path)) {
                File::delete($user_image_path);
            }

            $image = $request['profile'];
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user/renter');
            $image->move($destinationPath, $imagename);


        }
       
        $user->name = $request['name'] .' '.$request['surname'];
        if(isset($request['profile'])){ $user->user_image = $imagename; }
        $user->save();


        $renter = Owner::where('user_id', $id)->first();
        $renter->name =  $request['name'];
        $renter->surname =  $request['surname'];
        $renter->city =  $request['city'];
        $renter->state =  $request['state'];
        $renter->zip =  $request['zip'];
        $renter->address =  $request['address'];
        $renter->number =  $request['number'];

        if(isset($request['driving_license'])){
           
            $user_image_path = "images/license/".$renter['driving_license']; 
            if(File::exists($user_image_path)) {
                File::delete($user_image_path);
            }

            $dl_image = $request['driving_license'];
            $dl_imagename = time().'.'.$dl_image->getClientOriginalExtension();
            $dl_destinationPath = public_path('/images/license');
            $dl_image->move($dl_destinationPath, $dl_imagename);

        }

        if(isset($request['driving_license'])){ $renter->driving_license =  $dl_imagename; }
        $renter->save();

        return redirect('/admin/renter')->with('status', 'Renter Updated');
        

    }

    public function add(){
        return view('admin.renter.add');
    }

    public function add_by_admin(Request $request){


        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'surname' => 'required|string|max:255',
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
        $user->status = 1;
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

        return redirect('/admin/renter')->with('status', 'Renter Created');
    }
    public function renter_profile()
    {
        Log::info('This is some useful information.');
        $id = Auth()->user()->id;
        return $account = User::find($id);
        // return view('admin.owner.view')->with(compact('owner', 'account', 'card_info'));
    }
    public function update_renter(Request $request)
    {
        $renter = Auth()->user();
        
        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            // 'phone' => 'required|regex:/[0-9]{11}/',
            // 'password' => 'sometimes|min:3',
        ]);

        //Request from profile Vue component
        $currentPic = $renter->user_image;
        if( $request->user_image != $currentPic)
        {
            //We need a unique name of pic concatenamte time+extention
            //For picking file extension loop until find first semicolon
            //then record string backwards/reverse until / encountered
            //this will pick file extension
            
            $name = time().'.' .explode('/', explode(':', substr($request->user_image, 0, strpos($request->user_image, ';')))[1])[1];
            //Image Intervention class from a package named "ImageIntervention"
            //We use \ with Image so that we don't have to import its package here
            \Image::make($request->user_image)->save(public_path('/images/user/renter/').$name);
            $request->merge( ['user_image' => $name] ); //Override,replace
            //If file exists then delete the older file
            $prevPic = public_path('/images/user/renter/').$currentPic;
            if(file_exists($prevPic)){
                @unlink($prevPic);
            }
        }
        //Update password appropriately
        if($request->password != ""){
            $request->password = Hash::make($request->password);
        }
        else{
            $request->password = $renter->password;
        }
        //Update record in Rider table
        $renter->name = $request->name;
        $renter->password = $request->password;
        // $renter->phone = $request->phone;
        $renter->user_image = $request->user_image;
        $renter->save();

        return "success";
    }


}
