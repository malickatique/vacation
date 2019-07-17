<?php
namespace App\Http\Controllers;

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
use App\PropertyMetadata;
use App\Setting;

class pagesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth:admin', ['except' => ['main_page', 'dynamic_pages', 'show_properties', 'show_property_detail']]);
    }

    //site main page 
    public function main_page() {
        //
        $properties = Property::where('id', '>', '0')->take(4)
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

        //Properties by City

        $result = PropertyMetadata::where('state', 'LIKE', '%New York%')
        ->orWhere('city', 'LIKE', '%Newyork%')
        ->get();
        $byCity['New York'] = $result->count();

        $result = PropertyMetadata::where('state', 'LIKE', '%Chicago%')
        ->orWhere('city', 'LIKE', '%chicago%')
        ->get();
        $byCity['Chicago'] = $result->count();

        $result = PropertyMetadata::where('state', 'LIKE', '%Manhatten%')
        ->orWhere('city', 'LIKE', '%manhatten%')
        ->get();
        $byCity['Manhatten'] = $result->count();

        $result = PropertyMetadata::where('state', 'LIKE', '%Los Angeles%')
        ->orWhere('city', 'LIKE', '%Angeles%')
        ->get();
        $byCity['Los Angeles'] = $result->count();
        
        $result = PropertyMetadata::where('state', 'LIKE', '%San Francisco%')
        ->orWhere('city', 'LIKE', '%San Francisco%')
        ->get();
        $byCity['San Francisco'] = $result->count();
        
        $result = PropertyMetadata::where('state', 'LIKE', '%Austin%')
        ->orWhere('city', 'LIKE', '%Austin%')
        ->get();
        $byCity['Austin'] = $result->count();
        

        $data = array(
            'by_city' => $byCity,    
            'properties' => $properties,
            'navs' => $navs,
            'logo' => $logo,
            'footer_logo' => $footer_logo,
            'site_sticky_logo' => $site_sticky_logo,
            'footer_desc' => $footer_desc,
            'footer_contact' => $footer_contact,
            'footer_email' => $footer_email,
            'footer_trademark' => $footer_trademark,
        );

        return view('index')->with($data);
    }
    // site custom page
    public function dynamic_pages($slug) {

        $navs = Page::where('status', 1)->get();
        $page = Page::where('slug', $slug)->first();

        // global setting start
        $logo = Setting::where('name', 'site_logo')->first();
        $footer_logo = Setting::where('name', 'footer_logo')->first();
        $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
        $footer_desc = Setting::where('name', 'footer_desc')->first();
        $footer_contact = Setting::where('name', 'footer_contact')->first();
        $footer_email = Setting::where('name', 'footer_email')->first();
        $footer_trademark = Setting::where('name', 'footer_trademark')->first();
        // global setting end


        $pagefeatures = PageFeature::where('page_id', $page->id)
            ->get();

        $data = array(
            'navs' => $navs,
            'page' => $page,
            'pagefeatures' => $pagefeatures,
            'logo' => $logo,
            'footer_logo' => $footer_logo,
            'site_sticky_logo' => $site_sticky_logo,
            'footer_desc' => $footer_desc,
            'footer_contact' => $footer_contact,
            'footer_email' => $footer_email,
            'footer_trademark' => $footer_trademark,
        );

        foreach ($pagefeatures as $key => $feature) {

            if ($feature->feature === 'contact-us') {

                $contact = PageContact::where('page_id', $feature->page_id)
                    ->first();
                $data += array(
                    "contact" => $contact
                );

            }

            if ($feature->feature === 'gallary') {

                $gallary = PageGallary::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "gallary" => $gallary
                );

            }

            if ($feature->feature === 'grid-box') {

                $box_section = PageBox::where('page_id', $feature->page_id)
                    ->first();
                $boxes = PageBoxMetadata::where('grid_box_id', $box_section->id)
                    ->get();
                $data += array(
                    "box_section" => $box_section
                );
                $data += array(
                    "boxes" => $boxes
                );

            }

            if ($feature->feature === 'faq') {

                $questions = FaqQuestion::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "questions" => $questions
                );

            }

        }

        return view('site-page')->with($data);

    }


    // site all properties pages
    public function show_properties() {

        $properties = Property::where('id', '>', '0')->get();
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

        return view('all-properties')->with($data);

    }

    //single property detail on site
    public function show_property_detail($name, $id) {
        //
        $property = Property::find($id);
        $features = Property::find($id)->features;
        $occasions = Property::find($id)->occasions;
        $gallaries = Property::find($id)->gallary;

         // global setting start
         $logo = Setting::where('name', 'site_logo')->first();
         $footer_logo = Setting::where('name', 'footer_logo')->first();
         $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
         $footer_desc = Setting::where('name', 'footer_desc')->first();
         $footer_contact = Setting::where('name', 'footer_contact')->first();
         $footer_email = Setting::where('name', 'footer_email')->first();
         $footer_trademark = Setting::where('name', 'footer_trademark')->first();
         // global setting end
         
        $navs = Page::where('status', 1)->get();
        return view('property-detail')
            ->with(compact('property', 'features', 'occasions', 'gallaries', 'navs','logo', 'footer_logo', 'site_sticky_logo', 'footer_desc', 'footer_contact', 'footer_email', 'footer_trademark'));
    }

    // admin pages section


    public function index() {
        //
        $pages = Page::all();
        return view('admin.page.show')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, ['name' => 'required', 'title' => 'required', 'content' => 'required|nullable|max:1999', 'short_description' => 'nullable|max:1999', 'keywords' => 'required|max:1999', ]);

        $page = new Page;
        $page->name = $request->input('name');
        $page->title = $request->input('title');
        $slug = strtolower(str_replace(' ', '-', $request->input('name')));
        $page->slug = $slug;
        $page->content = $request->input('content');
        $page->short_description = $request->input('short_description');
        $page->keywords = $request->input('keywords');
        $page->type = $request->input('page_type');
        $page->status = 1;
        $page->save();

        $last_page_id = $page->id;

        if ($request->input('page_type') === 'custom') {

            foreach ($request->input('custom') as $key => $value) {
                $feature = new PageFeature;
                $feature->page_id = $last_page_id;
                $feature->feature = $value;
                $feature->status = 1;
                $feature->save();
            }

        }
        elseif ($request->input('page_type') === 'faq') {

            $feature = new PageFeature;
            $feature->page_id = $last_page_id;
            $feature->feature = 'faq';
            $feature->status = 1;
            $feature->save();

        }
        elseif ($request->input('page_type') === 'about-us') {

            foreach ($request->input('about') as $key => $value) {
                $feature = new PageFeature;
                $feature->page_id = $last_page_id;
                $feature->feature = $value;
                $feature->status = 1;
                $feature->save();
            }

        }
        elseif ($request->input('page_type') === 'contact-us') {

            $feature = new PageFeature;
            $feature->page_id = $last_page_id;
            $feature->feature = 'contact-us';
            $feature->status = 1;
            $feature->save();

        }

        return redirect()
            ->route('page.form-two', $last_page_id);

    }

    public function create_form_two($id) {

        $features = PageFeature::where('page_id', $id)->get();

        $data = array(
            'features' => $features,
            'id' => $id
        );

        return view('admin.page.create-two')->with($data);

    }

    public function store_form_two(Request $request) {

        if (isset($request['faq']) && $request['faq'] == 'enable') {

            foreach ($request['group-ab'] as $key => $value) {

                $question = new FaqQuestion;
                $question->page_id = $request['page_id'];
                $question->question = $value['question'];
                $question->answer = $value['answer'];
                $question->save();

            }

        }

        // PageContact
        if (isset($request['contact-us']) && $request['contact-us'] == 'enable') {

            $contact = new PageContact;
            $contact->page_id = $request['page_id'];
            $contact->address = $request['address'];
            $contact->email = $request['email'];
            $contact->contact = $request['contact'];
            $contact->map = $request['map'];
            $contact->save();

        }

        if (isset($request['grid-box']) && $request['grid-box'] == 'enable') {

            $box = new PageBox;
            $box->page_id = $request['page_id'];
            $box->section_heading = $request['section_heading'];
            $box->section_heading_paragraph = $request['section_heading_paragraph'];
            $box->save();

            $box_last_id = $box->id;

            foreach ($request['group-a'] as $key => $value) {

                $box_meta = new PageBoxMetadata;
                $box_meta->grid_box_id = $box_last_id;
                $box_meta->box_heading = $value['box_heading'];
                $box_meta->box_paragraph = $value['box_paragraph'];
                $box_meta->save();

            }

        }

        return redirect('/admin/page')
            ->with('status', 'Page added with all metadata');

    }

    // status updates here
    public function page_status(Request $request){

        $page_id = $request['page_id'];
        $status = $request['status'];

        if($status == 1){

            $page = Page::find($page_id);
            $page->status = 0;
            $page->save();

        }elseif($status == 0){
            
            $page = Page::find($page_id);
            $page->status = 1;
            $page->save();

        }

        return redirect('/admin/page')
            ->with('status', 'Page status updated');

    }


    //page gallary
    public function store_gallary(Request $request) {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/page-gallary') , $imageName);
        $imageUpload = new PageGallary;
        $imageUpload->page_id = $request['page_id'];
        $imageUpload->image = $imageName;
        $imageUpload->save();
        return response()
            ->json(['success' => $imageName]);
    }

    public function destroy_gallary(Request $request) {

        $filename = $request->get('filename');
        PageGallary::where('image', $filename)->delete();
        $path = public_path() . '/images/page-gallary' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //

        $page = Page::where('id', $id)->first();

        $pagefeatures = PageFeature::where('page_id', $page->id)
            ->get();

        $data = array(
            
            'page' => $page,
            'pagefeatures' => $pagefeatures
        );

        foreach ($pagefeatures as $key => $feature) {

            if ($feature->feature === 'contact-us') {

                $contact = PageContact::where('page_id', $feature->page_id)
                    ->first();
                $data += array(
                    "contact" => $contact
                );

            }

            if ($feature->feature === 'gallary') {

                $gallary = PageGallary::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "gallary" => $gallary
                );

            }

            if ($feature->feature === 'grid-box') {

                $box_section = PageBox::where('page_id', $feature->page_id)
                    ->first();
                $boxes = PageBoxMetadata::where('grid_box_id', $box_section->id)
                    ->get();
                $data += array(
                    "box_section" => $box_section
                );
                $data += array(
                    "boxes" => $boxes
                );

            }

            if ($feature->feature === 'faq') {

                $questions = FaqQuestion::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "questions" => $questions
                );

            }

        }

        return view('admin.page.view')->with($data); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $page = Page::where('id', $id)->first();

        $pagefeatures = PageFeature::where('page_id', $page->id)
            ->get();

        $data = array(
            
            'page' => $page,
            'pagefeatures' => $pagefeatures
        );

        foreach ($pagefeatures as $key => $feature) {

            if ($feature->feature === 'contact-us') {

                $contact = PageContact::where('page_id', $feature->page_id)
                    ->first();
                $data += array(
                    "contact" => $contact
                );

            }

            if ($feature->feature === 'gallary') {

                $gallary = PageGallary::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "gallary" => $gallary
                );

            }

            if ($feature->feature === 'grid-box') {

                $box_section = PageBox::where('page_id', $feature->page_id)
                    ->first();
                $boxes = PageBoxMetadata::where('grid_box_id', $box_section->id)
                    ->get();
                $data += array(
                    "box_section" => $box_section
                );
                $data += array(
                    "boxes" => $boxes
                );

            }

            if ($feature->feature === 'faq') {

                $questions = FaqQuestion::where('page_id', $feature->page_id)
                    ->get();
                $data += array(
                    "questions" => $questions
                );

            }

        }


        
        return view('admin.page.edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        
// xxxxxxx

        if(isset($_POST['contact-page']) && $_POST['contact-page'] === 'enable'){

            $contact = PageContact::where('page_id', $id)->first();
            $contact->address = $request->input('address');
            $contact->email = $request->input('email');
            $contact->contact = $request->input('contact');
            $contact->map = $request->input('map');
            $contact->save();

        }

        if(isset($_POST['box-section']) && $_POST['box-section'] === 'enable'){

            $box = PageBox::where('page_id', $id)->first();
            $box->section_heading = $request->input('section_heading');
            $box->section_heading_paragraph = $request->input('section_heading_paragraph');
            $box->save();

        }

        
        $page = Page::find($id);
        $page->name = $request->input('name');
        $page->title = $request->input('title');
        $page->slug = 'slug';
        $page->content = $request->input('content');
        $page->short_description = $request->input('short_description');
        $page->keywords = $request->input('keywords');
        $page->save();
        return redirect('/admin/page')
            ->with('status', 'Page updated!');
        $post->save();

    }


    public function edit_box($id){

        $box = PageBoxMetadata::find($id);
        return view('admin.page.edit-box')->with('box', $box);

    }

    public function update_box(Request $request, $id){

        $box = PageBoxMetadata::find($id);
        $box->box_heading = $request->input('box_heading');
        $box->box_paragraph = $request->input('box_paragraph');
        $box->save();

        return redirect('/admin/page')
        ->with('status', 'Page updated!');
        $post->save();

    }

    public function edit_question($id){

        $question = FaqQuestion::find($id);
        return view('admin.page.edit-question')->with('question', $question);

    }

    public function update_question(Request $request, $id){

        $question = FaqQuestion::find($id);
        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->save();

        return redirect('/admin/page')
        ->with('status', 'Page updated!');
        $post->save();

    }

    public function edit_pagegallary($id){

        $gallary = PageGallary::find($id);
        return view('admin.page.edit-gallary')->with('gallary', $gallary);

    }

    

        public function update_pagegallary(Request $request, $id){

            //del
            $gallary = PageGallary::find($id);

            $image_path = "images/page-gallary/".$gallary->image; 
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }

            // update
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/page-gallary');

            $gallary->image = $imagename;
            $gallary->save();

            $image->move($destinationPath, $imagename);

            return redirect('/admin/page')
            ->with('status', 'Page updated!');
            $post->save();
    
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {


        $page_gallary = PageGallary::where('page_id', $id)->get();
        
        foreach ($page_gallary as $key => $gallary) {
                if(!empty($gallary['image'])){
                    $image_path = "images/page-gallary/".$gallary['image']; 
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $gallary->delete();
        }


        $page_box = PageBox::where('page_id', $id)->get();

        foreach ($page_box as $key => $value) {
            # code...
            PageBoxMetadata::where('grid_box_id',$value->id)->delete();
            $value->delete();
            
        }

        PageFeature::where('page_id',$id)->delete();
        FaqQuestion::where('page_id',$id)->delete();
        PageContact::where('page_id',$id)->delete();
        Page::where('id',$id)->delete();
        

        return redirect('/admin/page')
            ->with('status', 'Page Removed');

    }





    // old code 

    //Page for Client side start
    // public function showCMSPage()
    // {
    //     $id = 1;
    //     $page = new page;
    //     $result = $page->find($id);
    //     return view('cmsPage')->with('result',$result);
    // }
    

    // public function faq()
    // {
    //     $id = 1;
    //     $page = new page;
    //     $result = $page->find($id);
    //     return view('faq')->with('result',$result);
    // }
    // public function contact()
    // {
    //     $id = 1;
    //     $page = new page;
    //     $result = $page->find($id);
    //     return view('contact')->with('result',$result);
    // }
    // public function copy($id) {
    //     $page = new page;
    //     $page = $page->find($id);
    //     $newPage = $page->replicate();
    //     $newPage->save();
    //     return redirect('/admin/page')
    //         ->with('status', 'Page copied!');
    // }

}

