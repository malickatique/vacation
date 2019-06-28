<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image as Image;
use Illuminate\Http\Request;
use App\Feature;
use App\Property;
use App\User;
use App\PropertyMetadata;
use App\PropertyFeature;
use App\PropertyOccasion;
use App\PropertyGallary;
use Auth;
class propertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteProperty($id)
    {
        //
        $propertyinfo = Property::where('id',$id)->first();

        if(!empty($propertyinfo['thumbnail'])){
            
            //If file exists then delete the older file
            $prevPic = public_path('/images/property/').$propertyinfo['thumbnail'];
            if(file_exists($prevPic)){
                @unlink($prevPic);
            }

            // $image_path = "images/property/".$propertyinfo['thumbnail']; 
            // if(File::exists($image_path)) {
            //     File::delete($image_path);
            // }
        }
        
        Property::where('id', '=', $id)->delete();
        // if(isset($propertyinfo)){  $propertyinfo->delete(); }

        $propertygallary_info = PropertyGallary::where('property_id',$id)->get(); 
        if(!empty($propertygallary_info)){
            foreach ($propertygallary_info as $key => $gallary) {

                if(!empty($gallary['media']))
                {
                    $currentPic = $gallary['media'];
                    // If file exists then delete the older file
                    $prevPic = public_path('/images/property/').$currentPic;
                    if(file_exists($prevPic)){
                        @unlink($prevPic);
                    }

                }
                $gallary->delete();
                
            }
        }

        PropertyMetadata::where('property_id',$id)->delete();
        PropertyFeature::where('property_id',$id)->delete();
        PropertyOccasion::where('property_id',$id)->delete();

        return ['message'=> 'Property deleted!'];
    }
    public function index()
    {   
        $user_id = Auth()->user()->id;
        $properties = Property::where('user_id', $user_id)->paginate(3);
        // return view('properties.index')->with('properties',  $properties);
        return $properties;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $features = Feature::all(); 
        // return view('properties.create')->with('features',  $features);
        return $features;
    }

    // public function create_image_gallary()
    // {
    //     // 
    //     return view('properties.create-two');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'type' => 'required',
            'location' => 'required',
            'status' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'floors' => 'required',
            'area' => 'required',
            'garages' => 'required',
            // 'thumbnail' => 'image|required|max:1999'
        ]);

        // image uploading
        // $image = $request->file('thumbnail');
        // $imagename = time().'.'.$image->getClientOriginalExtension();
        // $destinationPath = public_path('/images/property');
        
        //Image Upload
        //Request from profile Vue component

        // $currentPic = $property->thumbnail;
        $name = '';
        if( $request->thumbnail)
        {
            //We need a unique name of pic concatenamte time+extention
            //For picking file extension loop until find first semicolon
            //then record string backwards/reverse until / encountered
            //this will pick file extension
            $name = time().'.' .explode('/', explode(':', substr($request->thumbnail, 0, strpos($request->thumbnail, ';')))[1])[1];
            //Image Intervention class from a package named "ImageIntervention"
            //We use \ with Image so that we don't have to import its package here
            \Image::make($request->thumbnail)->save(public_path('/images/property/').$name);
            $request->merge( ['thumbnail' => $name] ); //Override,replace
            
            //If file exists then delete the older file
            // $prevPic = public_path('/images/property/').$currentPic;
            // if(file_exists($prevPic)){
            //     @unlink($prevPic);
            // }
        }

        // $request['availability_from'] = $request->availability[0];
        // $request['availability_to'] = $request->availability[1];

        $owner_id = Auth()->user()->id;
        $property = new Property;
        $property->user_id = $owner_id;
        $property->template_id = 1;
        $property->name = $request['name'];
        $property->description = $request['description'];
        // $property->availability_from = $request['availability_from']; 
        // $property->availability_to = $request['availability_to'];  
        // $property->per_night_rent = $request['per_night_rent'];
        $property->address = $request['address'];
        // $property->thumbnail = $imagename;
        $property->thumbnail = $name;
        // $property->thumbnail = $request['thumbnail'];
        $property->status = $request->status;
        $property->save();
        
        // uploading file
        // $image->move($destinationPath, $imagename);

        // meta data property
        $lastInsertedPropertyId = $property->id;
        $metadata = new PropertyMetadata;
        $metadata->property_id = $lastInsertedPropertyId;
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

        // multiple features 
        foreach ($request['features'] as $key => $value) {
            # code...
            $feature = new PropertyFeature;
            $feature->property_id = $lastInsertedPropertyId;
            $feature->feature_id =  $value;
            $feature->save();

        }
        foreach ($request->multipleOccasions as $value) {
            $occasion = new PropertyOccasion;
            $occasion->property_id = $lastInsertedPropertyId;
            $occasion->occasion_name =  $value['occasion_name'];
            $occasion->availability_from =  $value['availability'][0];
            $occasion->availability_to =  $value['availability'][1];
            $occasion->per_night_rent =  $value['per_night_rent'];
            $occasion->save();
        }

        // lastInsertedPropertyId

        // return redirect()->route('home')->with('status', 'Property Created successfully');

        // return view('properties.create-two')->with('property_id', $lastInsertedPropertyId);
        // return $occasion->property_id;
       return $lastInsertedPropertyId;
       
    }
 
    // public function store_gallary(Request $request)
    // {
    //     $image = $request->file('file');
    //     $imageName = $image->getClientOriginalName();
    //     $image->move(public_path('images/property/'),$imageName);
    //     $imageUpload = new PropertyGallary;
    //     $imageUpload->property_id = $request['property_id'];
    //     $imageUpload->media = $imageName;
    //     $imageUpload->type = 7;
    //     $imageUpload->save(); 
    //     return response()->json(['success'=>$imageName]);
    // }

    // public function destroy_gallary(Request $request)
    // {   

    //     $filename =  $request->get('filename');
    //     PropertyGallary::where('media',$filename)->delete();
    //     $path=public_path().'/images/property/'.$filename;
    //     if (file_exists($path)) {
    //         unlink($path);
    //     }
    //     return $filename;  

    // }

    // public function finish_gallary(){

    //     return redirect()->route('home')->with('status', 'Property has been created successfully');

    // }

    
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
        $property = Property::find($id);
        $metadata = PropertyMetadata::where('property_id', $id)->first();
        return view('properties.edit')->with(compact('property', 'metadata'));
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
        $property = Property::where('id',$id)->first();

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'type' => 'required',
            'location' => 'required',
            'status' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'floors' => 'required',
            'area' => 'required',
            'garages' => 'required',
            // 'thumbnail' => 'image|required|max:1999'
        ]);

        $name = '';
        $currentPic = $property->thumbnail;
        if( $request->thumbnail != $currentPic )
        {
            //We need a unique name of pic concatenamte time+extention
            //For picking file extension loop until find first semicolon
            //then record string backwards/reverse until / encountered
            //this will pick file extension
            $name = time().'.' .explode('/', explode(':', substr($request->thumbnail, 0, strpos($request->thumbnail, ';')))[1])[1];
            //Image Intervention class from a package named "ImageIntervention"
            //We use \ with Image so that we don't have to import its package here
            \Image::make($request->thumbnail)->save(public_path('/images/property/').$name);
            $request->merge( ['thumbnail' => $name] ); //Override,replace
            
            //If file exists then delete the older file
            $prevPic = public_path('/images/property/').$currentPic;
            if(file_exists($prevPic)){
                @unlink($prevPic);
            }
        }

        $owner_id = Auth()->user()->id;
        $property->user_id = $owner_id;
        $property->template_id = 1;
        $property->name = $request['name'];
        $property->description = $request['description'];
        $property->address = $request['address'];
        // $property->thumbnail = $imagename;
        $property->thumbnail = $name;
        // $property->thumbnail = $request['thumbnail'];
        $property->status = $request->status;
        $property->save();
        
        // uploading file
        // $image->move($destinationPath, $imagename);

        // meta data property
        $lastInsertedPropertyId = $property->id;
        $metadata = PropertyMetadata::where('property_id',$lastInsertedPropertyId)->first();
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

        // multiple features 


        //Delete existing records
        // PropertyFeature::where('property_id', '=', $lastInsertedPropertyId)->delete();
        // foreach ($request['feature'] as $key => $value) {
        //     # code...
        //     $feature = new PropertyFeature;
        //     $feature->property_id = $lastInsertedPropertyId;
        //     $feature->feature_id =  $value;
        //     $feature->save();
        // }
        
        //Delete existing records
        PropertyOccasion::where('property_id', '=', $lastInsertedPropertyId)->delete();
        foreach ($request->multipleOccasions as $value) {
            $occasion = new PropertyOccasion;
            $occasion->property_id = $lastInsertedPropertyId;
            $occasion->occasion_name =  $value['occasion_name'];
            $occasion->availability_from =  $value['availability'][0];
            $occasion->availability_to =  $value['availability'][1];
            $occasion->per_night_rent =  $value['per_night_rent'];
            $occasion->save();
        }

        // lastInsertedPropertyId

        // return redirect()->route('home')->with('status', 'Property Created successfully');

        // return view('properties.create-two')->with('property_id', $lastInsertedPropertyId);
        // return $occasion->property_id;
        return "success";
        
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

        return redirect('/property')->with('status', 'Property Removed');

    }

    //Owner Panel requests
    public function getProperty($id)
    {
        //
        $data = [];
        $property = Property::find($id);
        $data['property_id'] = $property->id;
        $data['user_id'] = $property->user_id;
        $data['template_id'] = $property->template_id;
        $data['name'] = $property->name;
        $data['description'] = $property->description;
        $data['address'] = $property->address;
        $data['thumbnail'] = $property->thumbnail;
        $data['status'] = $property->status;

        $multipleOccasions = PropertyOccasion::where('property_id', $id)->get();
        $index = 0;
        $Occasions = [];
        foreach ($multipleOccasions as $occasion => $value) {
            $Occasions[$index]['occasion_name'] = $value['occasion_name'];
            $Occasions[$index]['per_night_rent'] = $value['per_night_rent'];
            $Occasions[$index]['availability'][0] = $value['availability_from'];
            $Occasions[$index]['availability'][1] = $value['availability_to'];
            $index++;
        }
        $data['multipleOccasions'] = $Occasions;

        // $propertyFeature = PropertyFeature::where('property_id', $id)->first();
        // $data['feature_id'] = $propertyFeature->feature_id;

        $metadata = PropertyMetadata::where('property_id', $id)->first();
        $data['meta_id'] = $metadata->id;
        $data['type'] = $metadata->type;
        $data['status'] = $metadata->status;
        $data['location'] = $metadata->location;
        $data['bedrooms'] = $metadata->bedrooms;
        $data['bathrooms'] = $metadata->bathrooms;
        $data['floors'] = $metadata->floors;
        $data['garages'] = $metadata->garages;
        $data['area'] = $metadata->area;
        $data['size'] = $metadata->size;
    
        return $data;
    }
    public function getPropertiesView(){
        return Property::latest()->paginate(5);
    }
    public function propertyDetailView($id)
    {
        //
        $data = [];
        $property = Property::find($id);
        $data['property_id'] = $property->id;
        $data['user_id'] = $property->user_id;
        $data['template_id'] = $property->template_id;
        $data['title'] = $property->name;
        $data['description'] = $property->description;
        $data['address'] = $property->address;
        $data['thumbnail'] = $property->thumbnail;
        $data['status'] = $property->status;

        $multipleOccasions = PropertyOccasion::where('property_id', $id)->get();
        $index = 0;
        $Occasions = [];
        foreach ($multipleOccasions as $occasion => $value) {
            $Occasions[$index]['occasion_name'] = $value['occasion_name'];
            $Occasions[$index]['per_night_rent'] = $value['per_night_rent'];
            $Occasions[$index]['availability'][0] = $value['availability_from'];
            $Occasions[$index]['availability'][1] = $value['availability_to'];
            $index++;
        }
        $data['multipleOccasions'] = $Occasions;

        // $propertyFeature = PropertyFeature::where('property_id', $id)->first();
        // $data['feature_id'] = $propertyFeature->feature_id;

        $metadata = PropertyMetadata::where('property_id', $id)->first();
        $data['meta_id'] = $metadata->id;
        $data['type'] = $metadata->type;
        $data['status'] = $metadata->status;
        $data['location'] = $metadata->location;
        $data['bedrooms'] = $metadata->bedrooms;
        $data['bathrooms'] = $metadata->bathrooms;
        $data['floors'] = $metadata->floors;
        $data['garages'] = $metadata->garages;
        $data['area'] = $metadata->area;
        $data['size'] = $metadata->size;

        $pictures = PropertyGallary::where('property_id', $id)->get();
        $data['pictures'] = $pictures;

        $features = PropertyFeature::select('feature_id')->with('feature')
        ->where('property_id', $id)->get();
        $data['features'] = $features;

        $owner = User::where('id', '=', $property->user_id)->first();
        $data['name'] = $owner->name;
        $data['email'] = $owner->email;
        $data['user_image'] = $owner->user_image;

        return $data;
    }
    public function propertyPictures(Request $request)
    {
        foreach ($request->pictures as $picture) 
        {
            $imageUpload = new PropertyGallary;
            $name = '';
            $name = time().'.' .explode('/', explode(':', substr($picture['name'], 0, strpos($picture['name'], ';')))[1])[1];
                //Image Intervention class from a package named "ImageIntervention"
                //We use \ with Image so that we don't have to import its package here
                \Image::make($picture['name'])->save(public_path('/images/property/').$name);
            
            $imageUpload->property_id = $request['property_id'];
            $imageUpload->media = $name;
            $imageUpload->type = 1;
            $imageUpload->save(); 
        }
        return "Success!";
    }
}
