<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use File;

class settingController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function view_setting(){

        $settings = Setting::all();
        return view('admin.setting.view')->with('settings' , $settings);

    }

    public function edit_setting($name){
        
        $setting = Setting::where('name', $name)->first();
        return view('admin.setting.edit')->with('setting', $setting);

    }

    public function update_setting(Request $request, $id){

        if(isset($request['site_logo'])){

            $site_logo = Setting::where('id', $id)->first();
            if(!empty($site_logo['value'])){
                $image_path = "images/setting/".$site_logo['value']; 
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // update
            $image = $request->file('site_logo');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/setting');

            $site_logo->value = $imagename;
            $site_logo->save();

            $image->move($destinationPath, $imagename);

            return redirect('/setting')
            ->with('status', 'Setting updated!');

            
        }

        if(isset($request['footer_logo'])){
           
            $footer_logo = Setting::where('id', $id)->first();
            if(!empty($footer_logo['value'])){
                $image_path = "images/setting/".$footer_logo['value']; 
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // update
            $image = $request->file('footer_logo');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/setting');

            $footer_logo->value = $imagename;
            $footer_logo->save();

            $image->move($destinationPath, $imagename);

            return redirect('/setting')
            ->with('status', 'Setting updated!');


            
        }

        if(isset($request['sticky_logo'])){
           
            $sticky_logo = Setting::where('id', $id)->first();
            if(!empty($sticky_logo['value'])){
                $image_path = "images/setting/".$sticky_logo['value']; 
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // update
            $image = $request->file('sticky_logo');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/setting');

            $sticky_logo->value = $imagename;
            $sticky_logo->save();

            $image->move($destinationPath, $imagename);

            return redirect('/setting')
            ->with('status', 'Setting updated!');


            
        }

        if(isset($request['value'])){
            
            $setting = Setting::where('id', $id)->first();
            $setting->value = $request->input('value');
            $setting->save();

            return redirect('/setting')
            ->with('status', 'Setting updated!');

            
        }


    }


}
