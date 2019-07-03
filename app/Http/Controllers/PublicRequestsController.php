<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;
use App\Property;
use App\User;
use App\Page;
use App\Setting;
use App\PropertyMetadata;
use App\PropertyFeature;
use App\PropertyOccasion;
use App\PropertyGallary;

class PublicRequestsController extends Controller
{
    //
    public function getAllProperties()
    {
        return Property::latest()->paginate(5);
    }
    public function privacy_policy(){
        return View('privacy-policy');
    }
    public function terms_and_conditions(){
        return View('terms-and-conditions');
    }
    public function propertyView($id)
    {
        //s
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
    
        $owner = User::where('id', '=', $property->user_id)->first();
        $data['name'] = $owner->name;
        $data['email'] = $owner->email;
        $data['user_image'] = $owner->user_image;

        
        $features = PropertyFeature::select('feature_id')->with('feature')
        ->where('property_id', $id)->get();

        $data['features'] = $features;

        return $data;
    }
    public function getRelevantProperties(Request $request)
    {
        if($request->lookingFor!='' & $request->location!='' & $request->cator!='')
        {
            return Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('address', 'LIKE', "%{$request->location}%" )
            ->where('status', 'LIKE', "%{$request->cator}%" )
            ->paginate(5);
        }
        else if($request->lookingFor!='' & $request->location!='')
        {
            return Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('address', 'LIKE', "%{$request->location}%" )
            ->paginate(5);
        }
        else if($request->lookingFor!='' & $request->cator!='')
        {
            return Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->where('status', 'LIKE', "%{$request->cator}%" )
            ->paginate(5);
        }
        else if($request->cator!='')
        {
            return Property::where('status', 'LIKE', "%{$request->cator}%")
            ->paginate(5);
        }
        else if($request->lookingFor!='' )
        {
            return Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('description', 'LIKE', "%{$request->lookingFor}%")
            ->paginate(5);
        }
        else if($request->location!='' )
        {
            return Property::where('name', 'LIKE', "%{$request->location}%" )
            ->orWhere('description', 'LIKE', "%{$request->description}%")
            ->paginate(5);
        }
        else{
            return Property::latest()->paginate(5);
        }

    }
    public function getSearchResults(Request $request)
    {
        
        if($request->lookingFor!='' & $request->location!='' & $request->cator!='')
        {
            $properties = Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('address', 'LIKE', "%{$request->location}%" )
            ->orWhere('status', 'LIKE', "%{$request->cator}%" )
            ->get();
        }
        else if($request->lookingFor!='' & $request->location!='')
        {
            $properties = Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('address', 'LIKE', "%{$request->location}%" )
            ->get();
        }
        else if($request->lookingFor!='' & $request->cator!='')
        {
            $properties = Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('status', 'LIKE', "%{$request->cator}%" )
            ->get();
        }
        else if($request->cator!='')
        {
            $properties = Property::where('status', 'LIKE', "%{$request->cator}%")
            ->get();
            if($request->cator == 'all')
            {
                //all cator
                $properties = Property::
                get();
            }
        }
        else if($request->lookingFor!='' )
        {
            $properties = Property::where('name', 'LIKE', "%{$request->lookingFor}%" )
            ->orWhere('description', 'LIKE', "%{$request->lookingFor}%")
            ->get();
        }
        else if($request->location!='' )
        {
            $properties = Property::where('name', 'LIKE', "%{$request->location}%" )
            ->orWhere('description', 'LIKE', "%{$request->description}%")
            ->get();
        }
        else{
            $properties = Property::latest()->get();
        }
        
        $navs = Page::where('status', 1)->get();
         // global setting start
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
            'properties' => $properties,
            'logo' => $logo,
            'footer_logo' => $footer_logo,
            'site_sticky_logo' => $site_sticky_logo,
            'footer_desc' => $footer_desc,
            'footer_contact' => $footer_contact,
            'footer_email' => $footer_email,
            'footer_trademark' => $footer_trademark,
        );
        // return $properties;
        return view('search-properties')->with($data);

    }
    public function by_city($city) 
    {
        $properties = Property::where('address', 'LIKE', "%{$city}%" )
        ->get();
        $navs = Page::where('status', 1)->get();
         // global setting start
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
            'properties' => $properties,
            'logo' => $logo,
            'footer_logo' => $footer_logo,
            'site_sticky_logo' => $site_sticky_logo,
            'footer_desc' => $footer_desc,
            'footer_contact' => $footer_contact,
            'footer_email' => $footer_email,
            'footer_trademark' => $footer_trademark,
        );
        // return $properties;
        return view('search-properties')->with($data);
    }
}
