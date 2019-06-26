<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Events\ChatEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
use App\Mail\SendMailable;
use App\Admin;
use App\PropertyMetadata;
use App\PropertyFeature;
use App\Feature;
use App\PropertyOccasion;
use App\PropertyGallary;
use App\Subscription;

class AdminController extends Controller
{
    protected $guard = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $properties = Property::all();
        $total_properties = $properties->count();

        $owners = User::where('user_type', 'owner')->get();
        $total_owners = $owners->count();

        $renters = User::where('user_type', 'renter')->get();
        $total_renters = $renters->count();

        $subscriptions = Subscription::all();
        $total_subscriptions = $subscriptions->count();



        $data = array(
            'total_properties' =>  $total_properties,
            'total_owners' => $total_owners,
            'total_renters' => $total_renters,
            'total_subscriptions' => $total_subscriptions

        );

        return view('admin.dashboard')->with($data);

    }

    public function adminProfile(){

        return view('admin/adminProfile');

    }


    public function changeProfilePicture(Request $request){

        $this->validate($request, [
	    	'image' => 'mimes:jpeg,bmp,png', //only allow this type extension file.
        ]);
        


        $file = $request->file('image');
        $guessExtension = $request->file('image')->guessExtension();
        $randomStr = $this->randomNum();
        $file->move('images/users', $randomStr.'.'.$guessExtension);
        $imageName = $randomStr.'.'.$guessExtension;
        
        // Get admin id
        $id = Auth::user()->id;

        $admin = new Admin;
        $admin = $admin->find($id);
        $admin->imageurl = $imageName;
        $admin->save();
        $request->session()->put('imageurl', $imageName);
        return redirect('/admin/profile')->with('status', 'Profile image has been updated.');

    }
    
    public function randomNum(){

        $length = 10;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return time()."_".$randomString;

    }

    public function changePassword(Request $request){

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'retype_password' => 'required',
        ]);

        $oldPassword = Auth::user()->password;
        $typed_old_password = $request->input('old_password');

        if(Hash::check($typed_old_password, $oldPassword)){

            //get admin id
            $id = Auth::user()->id;
            $admin = new Admin;
            $admin = $admin->find($id);
            if($request->input('new_password') == $request->input('retype_password')){
                $admin->password = bcrypt($request->input('new_password'));
                $admin->save();
                return redirect('/admin/profile')->with('status', 'Password Changed!');
            }
            else{
                return redirect('/admin/profile')->with('status', 'Can not change password!');
            }
        }
        else{
            return redirect('/admin/profile')->with('status', 'Old password is not correct');
        }
    }

    public function changeInfo(Request $request){
         //get admin id
        $id = Auth::user()->id;
        $admin = new Admin;
        $admin = $admin->find($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->save();
        return redirect('/admin/profile')->with('status', 'Information updated');
    }


    // properties section start here

    public function listAllProperties(){

        $properties = Property::all();
        return view('admin/property/allproperties')->with('properties',  $properties);

    }

    public function addProperty(){
        
        $features = Feature::all();
        $owners = User::where('user_type', 'owner')->get();
        return view('admin/property/addProperty')->with(compact('features', 'owners'));

    }

    public function storeProperty(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'per_night_rent' => 'required',
            'description' => 'required',
            'availability_from' => 'required',
            'availability_to' => 'required',
            'type' => 'required',
            'status' => 'required',
            'thumbnail' => 'image|required|max:1999'
        ]);

        // image uploading
        $image = $request->file('thumbnail');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/property');
    
        $owner_id = $request['user_id'];
        $property = new Property;
        $property->user_id = $owner_id;
        $property->template_id = 1;
        $property->name = $request['title'];
        $property->description = $request['description'];
        $property->availability_from = $request['availability_from']; 
        $property->availability_to = $request['availability_to'];  
        $property->per_night_rent = $request['per_night_rent'];
        $property->address = $request['address'];
        $property->thumbnail = $imagename;
        // 2 mean pending
        $property->status = 2;
        $property->save();
        
        // uploading file
        $image->move($destinationPath, $imagename);

        // meta data property
        $lastInsertedPropertyId = $property->id;
        $metadata = new PropertyMetadata;
        $metadata->property_id = $lastInsertedPropertyId;
        $metadata->type = $request['type'];
        $metadata->status = $request['status'];
        $metadata->location = $request['location'];
        $metadata->bedrooms = $request['bedroom'];
        $metadata->bathrooms = $request['bathroom'];
        $metadata->floors = $request['floor'];
        $metadata->garages = $request['garage'];
        $metadata->area = $request['area'];
        $metadata->size = $request['size'];
        $metadata->save();

        // multiple features 
        foreach ($request['feature'] as $key => $value) {
            # code...
            $feature = new PropertyFeature;
            $feature->property_id = $lastInsertedPropertyId;
            $feature->feature_id =  $value;
            $feature->save();

        }

        foreach ($request['group-a'] as $key => $value) {

            $occasion = new PropertyOccasion;
            $occasion->property_id = $lastInsertedPropertyId;
            $occasion->occasion_name =  $value['occasion_name'];
            $occasion->availability_from =  $value['occasion_availability_from'];
            $occasion->availability_to =  $value['occasion_availability_to'];
            $occasion->per_night_rent =  $value['occasion_per_night_rent'];
            $occasion->save();

        }

        //return redirect()->route('/admin/allproperties')->with('status', 'Property Created successfully');
        return redirect('/admin/allproperties')->with('status', "Property Created successfully ");
    }

    public function add_property_section_two_gallary(){
        return view('admin.property.add-gallary');
    }

    public function owner_property_detail($id){

        $property = Property::find($id);
        $features = Property::find($id)->features;
        $occasions = Property::find($id)->occasions;
        $gallaries = Property::find($id)->gallary;
        
        return view('admin.owner.owner-property-detail')->with(compact('property', 'features', 'occasions', 'gallaries'));

    }

    public function destroyProperty($id)
    {

        $propertyinfo = Property::where('id',$id)->first(); 
        if(!empty($propertyinfo['thumbnail'])){

            $image_path = "images/property/".$propertyinfo['thumbnail']; 
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if(isset($propertyinfo)){  $propertyinfo->delete(); }

        $propertygallary_info = PropertyGallary::where('property_id',$id)->get(); 
        if(!empty($propertygallary_info)){
            foreach ($propertygallary_info as $key => $gallary) {

                if(!empty($gallary['media'])){

                    $image_path = "images/property/gallary/".$gallary['media']; 
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $gallary->delete();
                
            }
        }

        PropertyMetadata::where('property_id',$id)->delete();
        PropertyFeature::where('property_id',$id)->delete();
        PropertyOccasion::where('property_id',$id)->delete();

        return redirect('/admin/allproperties')->with('status', "Property Deleted successfully ");

    }

    public function editproperty($id){
           
        $property = Property::find($id);
        $metadata = PropertyMetadata::where('property_id', $id)->first();

        $data = array(
            'property' => $property, 
            'metadata' => $metadata, 
        );

        return view('admin.property.edit-property')->with($data);


    }


    public function updateProperty(Request $request, $id){


        $property = Property::find($id);
        if(isset($request['thumbnail'])){
           
            $property_feature_image_path = "images/property/".$property['thumbnail']; 
            if(File::exists($property_feature_image_path)) {
                File::delete($property_feature_image_path);
            }

            $image = $request['thumbnail'];
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/property');
            $image->move($destinationPath, $imagename);


        }
       
        $property->name = $request['name'];
        $property->description = $request['description'];
        $property->availability_from = $request['availability_from'];
        $property->availability_to = $request['availability_to'];
        $property->per_night_rent = $request['per_night_rent'];
        $property->address = $request['address'];
        if(isset($request['thumbnail'])){ $property->thumbnail = $imagename; }
        $property->save();

        

        $metadata = PropertyMetadata::where('property_id', $id)->first();
        $metadata->type = $request['type'];
        $metadata->status = $request['status'];
        $metadata->location = $request['location'];
        $metadata->bedrooms = $request['bedrooms'];
        $metadata->bathrooms = $request['bathrooms'];
        $metadata->floors = $request['floors'];
        $metadata->garages = $request['garages'];
        $metadata->area = $request['area'];
        $metadata->size = $request['size'];
        $metadata->save();


        return redirect('/admin/allproperties')->with('status', "Property updated successfully ");


    }



    // properties section end here


    // pages section start here

    public function list(){
        $admin = Admin::where('id', '!=', 1)->get();
        //print_r($admin);
        return view('admin/list')->with('admins',  $admin);
    }

    public function edit($id){
        $admin = new Admin;
        $admin = $admin->find($id);
        return view('admin/edit')->with('result',  $admin);
    }
    public function update(Request $request, $id){
        $admin = new Admin;
        $admin = $admin->find($id);
        $admin->name =  $request->input('name');
        $admin->email = $request->input('email');
        $admin->status = $request->input('status');
        $admin->save();
        return redirect('/admin/list')->with('status', 'Information updated');
    }

    public function adminView($id){
        $admin = new Admin;
        $admin = $admin->find($id);
        return view('admin/adminView')->with('result',  $admin);
    }

    public function userDestroy($id){
        $admin = new admin;
        $admin = $admin->find($id);
        $admin->delete($admin->id);
        return redirect('/admin/list')->with('status', "Admin user Removed $id ");
    }
    
    public function addUser(){
        return view('admin/addUser');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = new Admin;
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->job_title = 'admin';
        $admin->password = $request->input('password');
        $admin->status = $request->input('status');
        $admin->save();
        return redirect('/admin/list')->with('status', 'admin user created!');
    }

    //Owners Manipulations
    public function getOwners()
    {
        $owners = User::where('user_type', 'owner')->get();
        return view('admin.owner.show')->with('owners', $owners);
    }
    public function storeOwner(Request $request)
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
    public function addOwner()
    {
        return view('admin/owner/addUser');
    }
    public function updateOwner(Request $request, $id)
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
    public function destroyOwner(Request $request)
    {
        
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
    public function editOwner($id){
        $result = User::find($id); 
        $card_info = OwnerMetadata::where('user_id', $id)->first();
        return view('admin.owner.edit')->with(compact('result', 'card_info'));

    }
    public function createOwner()
    {
        return view('admin/owner/addUser');
    }
    public function showOwner($id)
    {
        //
        $account = User::find($id);
        $owner = Owner::where('user_id', $id)->first();
        $card_info = OwnerMetadata::where('user_id', $id)->first();
        return view('admin.owner.view')->with(compact('owner', 'account', 'card_info'));

    }

    //Renter Manipulations
    public function indexRenter()
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

    public function destroyRenter($id){



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


    public function viewRenter($id){
        
        $account = User::find($id);
        $renter = Owner::where('user_id', $id)->first();
        return view('admin.renter.view')->with(compact('renter', 'account'));

    }
    

    public function editRenter($id){

        $account = User::find($id);
        $renter = Owner::where('user_id', $id)->first();
        return view('admin.renter.edit')->with(compact('renter', 'account'));

    }

    // status updates here
    public function owner_status(Request $request){

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
       
        //   Mail::send('mails.owner_status_disable', $data, function($message) use ($data) {
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
       
        //   Mail::send('mails.owner_status_enable', $data, function($message) use ($data) {
        //      $message->to($data['email'])->subject
        //         ('Profile Status');
        //      $message->from('ovrteam@admin.com','OVR');
        //   });

        }

        return redirect()->route('owner.index')->with('status', 'User modified');

    }

    public function owner_properties($id){

        $owner_properties = Property::where('user_id', $id)->get();
        return view('admin.owner.owner-properties')->with('owner_properties', $owner_properties);

    }
    public function updateRenter(Request $request, $id){

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

    public function addRenter(){
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
}
