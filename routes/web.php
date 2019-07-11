<?php
use Illuminate\Http\Request;
// Attempt to any other route will be redirected to root
// Route::get('/{name}', function(){
//     return redirect ('/');
// })->where('name', '[A-Za-z]+');
//Clear Cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    // return 'DONE'; //Return anything
    return redirect ('/');
});

Route::get('/test', function(){
    return view('test');
});

//Blade templating
Route::get('/viewproperties', 'pagesController@show_properties')->name('show-properties');
Route::post('/searchProperties', 'PublicRequestsController@getSearchResults');
Route::get('/by-city/{city}', 'PublicRequestsController@by_city');

//Message Controller
Route::get('/getUsers', 'MessageController@getUsers');
Route::get('/getAllMessages', 'MessageController@getAllMessages');
Route::get('/fetchMe', 'MessageController@fetchMe');
Route::post('/chat', 'MessageController@chatWith');
Route::get('/getFriend/{id}', 'MessageController@getFriend');
//private messages
Route::get('messages/{user}', 'MessageController@getMessages');
Route::post('messages/{user}', 'MessageController@sendMessages');

//Register Users 
Route::get('/select','registerUsersController@renter_owner_view')->name('select-view');
Route::get('/renter','registerUsersController@renter_register_form')->name('renter-view');
Route::post('/renter/register','registerUsersController@register_renter')->name('register-renter');
Route::post('/owner/register','registerUsersController@register_owner_by_site')->name('register-site-owner');

//Properties Controller
Route::get('/deleteProperty/{id}', 'propertiesController@deleteProperty');
Route::resource('/property', 'propertiesController');
//Property requests from Owner
Route::get('/getProperty/{id}', 'propertiesController@getProperty');
//Property requests from Renter
Route::get('/getPropertiesView', 'propertiesController@getPropertiesView');
Route::get('/propertyDetailView/{id}', 'propertiesController@propertyDetailView');
Route::post('/propertyPictures', 'propertiesController@propertyPictures');

Route::get('/', 'pagesController@main_page');

Route::get('/privacy-policy','PublicRequestsController@privacy_policy')->name('privacy-policy');
Route::get('/terms-and-conditions','PublicRequestsController@terms_and_conditions')->name('terms-and-conditions');

//Property requests from public
Route::get('/getAllProperties', 'PublicRequestsController@getAllProperties');
Route::get('/propertyView/{id}', 'PublicRequestsController@propertyView');
Route::post('/getRelevantProperties', 'PublicRequestsController@getRelevantProperties');

//Owner
Route::get('/owner_profile', 'ownersController@owner_profile');
Route::post('/update_owner', 'ownersController@update_owner');
//Renter 
Route::get('/renter_profile', 'renterController@renter_profile');
Route::post('/update_renter', 'renterController@update_renter');

//Redirect to their dashboards
Route::get('/ownerDash', 'ownersController@dashboard')->name('owner');
Route::get('/renterDash', 'renterController@dashboard')->name('renter');
// Route::get('/Dash', 'Controller@dashboard')->name('admin');



// resources controller


//Admin manipulations
// Route::resource('/admin/owner', 'ownersController');
Route::get('/admin/owner', 'AdminController@getOwners')->name('owner.index');
Route::post('/admin/owner', 'AdminController@storeOwner')->name('owner.store');
Route::get('/admin/owner/create', 'AdminController@createOwner')->name('owner.create');
Route::get('/admin/owner/{owner}', 'AdminController@showOwner')->name('owner.show');
Route::put('/admin/owner/{owner}', 'AdminController@updateOwner')->name('owner.update');
Route::delete('/admin/owner/{owner}', 'AdminController@destroyOwner')->name('owner.destroy');
Route::get('/admin/owner/{owner}/edit', 'AdminController@editOwner')->name('owner.edit');

// renter controller routes for admin section
Route::get('/admin/renter','AdminController@indexRenter')->name('renter.index');
Route::post('/admin/renterstatus', 'AdminController@renter_status')->name('renter.renterstatus');
Route::delete('/admin/renter/destroy/{id}', 'AdminController@destroyRenter')->name('renter.destroy');
Route::get('/admin/renter/view/{id}','AdminController@viewRenter')->name('renter.view');
Route::get('/admin/renter/edit/{id}','AdminController@editRenter')->name('renter.edit');
Route::put('/admin/renter/update/{id}','AdminController@updateRenter')->name('renter.update');
Route::get('/admin/renter/add','AdminController@addRenter')->name('renter.create');
Route::post('/admin/renter/addbyadmin','AdminController@add_by_admin')->name('renter.admin.add');



Route::resource('/admin/page', 'pagesController');
Route::resource('/admin/usertype', 'userTypeController');
Route::resource('/property', 'propertiesController');
Route::resource('/admin/emailtemplate', 'EmailTemplateController');
Route::resource('/admin/subscription', 'subscriptionController');

//extend resource routes
Route::get('/gallary', 'AdminController@create_image_gallary');
Route::post('/gallary/upload/store', 'AdminController@store_gallary');
Route::post('/gallary/delete','AdminController@destroy_gallary');
Route::get('/gallary/finish','AdminController@finish_gallary')->name('gallary.final');
// pages extend
Route::get('/page/form/{id}','pagesController@create_form_two')->name('page.form-two');
Route::post('/page/formtwostore','pagesController@store_form_two')->name('page.store-two');

// page meta update
Route::get('/admin/page/box/{id}','pagesController@edit_box')->name('page.edit.box');
Route::put('/admin/box/{id}','pagesController@update_box')->name('page.update.box');
Route::get('/admin/page/question/{id}','pagesController@edit_question')->name('page.edit.question');
Route::put('/admin/question/{id}','pagesController@update_question')->name('page.update.question');
Route::get('/admin/page/pagegallary/{id}','pagesController@edit_pagegallary')->name('page.edit.pagegallary');
Route::put('/admin/pagegallary/{id}','pagesController@update_pagegallary')->name('page.update.pagegallary');


// setting controllers
Route::get('/setting','settingController@view_setting')->name('setting.view');
Route::get('/setting/{name}','settingController@edit_setting')->name('setting.edit');
Route::put('/setting/{id}','settingController@update_setting')->name('setting.update');

// messaging on admin panel
Route::get('/messaging','AdminController@view_threads')->name('chat.view');
Route::post('/thread','AdminController@view_single_chat')->name('thread.view');

//page gallary
Route::post('/pagegallary/upload/store', 'pagesController@store_gallary');
Route::post('/pagegallary/delete','pagesController@destroy_gallary');
Route::post('/admin/pagestatus', 'pagesController@page_status')->name('page.pagestatus');

// admin side add gallary form controllers
Route::get('/admin/add/property/gallary','AdminController@add_property_section_two_gallary')->name('admin.add.property.gallary');

// admin ownercontroller extend routes
Route::get('/admin/ownerproperties/{id}', 'AdminController@owner_properties')->name('owner.ownerproperties');
Route::get('/admin/ownerpropertydetail/{id}', 'AdminController@owner_property_detail')->name('owner.owner-property-detail');

Route::post('/admin/ownerstatus', 'AdminController@owner_status')->name('owner.ownerstatus');
Route::post('/admin/propertystatus', 'ownersController@property_status')->name('property.propertystatus');
Route::get('/page/{slug}', 'pagesController@dynamic_pages')->name('page.site.dynamic');

Route::get('/view/{title}/{id}', 'pagesController@show_property_detail')->name('single-property');

// user client side routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

// admin panel routes
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/panel', 'Auth\AdminLoginController@showloginform')->name('admin.login');
Route::get('/admin/profile', 'AdminController@adminProfile')->name('admin.profile');
Route::post('/admin/changepicture', 'AdminController@changeProfilePicture')->name('admin.changepicture');
Route::post('/admin/changepassword', 'AdminController@changePassword')->name('admin.changepassword');
Route::post('/admin/changeinfo', 'AdminController@changeInfo')->name('admin.changeinfo');
Route::get('/owner/view/{id}', 'ownersController@ownerView')->name('owner.ownerview');
Route::get('/admin/allproperties', 'AdminController@listAllProperties')->name('admin.allproperties');
Route::get('/admin/addproperty/', 'AdminController@addProperty')->name('admin.addproperty');
Route::delete('/destroyProperty/{id}', 'AdminController@destroyProperty')->name('admin.destroyProperty');
Route::get('/admin/editproperty/{id}', 'AdminController@editProperty')->name('admin.editproperty');
Route::get('/admin/destroyproperty', 'AdminController@destroyProperty')->name('admin.destroyproperty');
Route::get('/admin/list', 'AdminController@list')->name('admin.list');
Route::get('/admin/edit/{id}', 'AdminController@edit')->name('admin.edit');
Route::get('/admin/adduser', 'AdminController@addUser')->name('admin.adduser');
Route::post('/admin/store', 'AdminController@store')->name('admin.store');
Route::post('/admin/storeproperty', 'AdminController@storeProperty')->name('admin.storeproperty');

Route::get('/admin/editproperty/{id}', 'AdminController@editproperty')->name('admin.edit.property');
Route::put('/admin/updateProperty/{id}', 'AdminController@updateProperty')->name('admin.update.property');


Route::match(array('PUT', 'PATCH'), "/admin/update/{id}", array(
    'uses' => 'AdminController@update',
    'as' => 'admin.update'
));

Route::get('/admin/adminview/{id}', 'AdminController@adminView')->name('admin.adminview');
Route::delete('/admin/user/destroy/{id}', 'adminController@userDestroy')->name('admin.user.destroy');


//ajax call routes
Route::post('/ajax/get_state_data','AjaxCallcontroller@get_states');
Route::post('/ajax/get_city_data','AjaxCallcontroller@get_cities');

// owner activations route
Route::get('/owner/completeprofile/{id}','completeProfileController@profile_form');
Route::post('/complete_profile','completeProfileController@complete_profile')->name('complete-profile');


// owner register by site route
// Route::post('/owner/register','ownersController@register_owner_by_site')->name('register-site-owner');


// renter controller routes
// Route::get('/select','renterController@renter_owner_view')->name('select-view');


// Route::get('/renter','renterController@renter_register_form')->name('renter-view');
// Route::post('/renter/register','renterController@register_renter')->name('register-renter');

//subscription controller routes for admin section
Route::put('/enabledisable/subscription/{id}','subscriptionController@enable_disable_subscription')->name('subscription.enable-disable');
Route::get('/subscription/addfeature','subscriptionController@add_subscription_feature')->name('subscription-add-feature');
Route::post('/subscription/insertfeature','subscriptionController@insert_subscription_feature')->name('subscription-feature-insert');
Route::get('/subscription/deletefeature/{id}','subscriptionController@delete_feature')->name('subscription-feature-delete');

////////////////////////////////////////

//copy page

// Route::get('/admin/page/copy/{id}', 'pagesController@copy')->name('page.copy');
// Route::get('/aboutus', 'pagesController@showCMSPage')->name('aboutus');
// Route::get('/faq', 'pagesController@faq')->name('faq');
// Route::get('/contact', 'pagesController@contact')->name('contact');

// Route::get('/vue/{vue_capture?}', function () {
//         $properties = Property::where('status', 1)->take(4)
//         ->get();
//         $navs = Page::where('status', 1)->get();

//         // global setting start
//         $logo = Setting::where('name', 'site_logo')->first();
//         $footer_logo = Setting::where('name', 'footer_logo')->first();
//         $site_sticky_logo = Setting::where('name', 'site_sticky_logo')->first();
//         $footer_desc = Setting::where('name', 'footer_desc')->first();
//         $footer_contact = Setting::where('name', 'footer_contact')->first();
//         $footer_email = Setting::where('name', 'footer_email')->first();
//         $footer_trademark = Setting::where('name', 'footer_trademark')->first();
//         // global setting end

//         $data = array(
//             'properties' => $properties,
//             'navs' => $navs,
//             'logo' => $logo,
//             'footer_logo' => $footer_logo,
//             'site_sticky_logo' => $site_sticky_logo,
//             'footer_desc' => $footer_desc,
//             'footer_contact' => $footer_contact,
//             'footer_email' => $footer_email,
//             'footer_trademark' => $footer_trademark,
//         );

//         return view('index')->with($data);
//    })->where('vue_capture', '[\/\w\.-]*');  


//Default location of all other routes
Route::get('{path}', 'pagesController@main_page')->where( 'path' , '([A-z\d\-\/_.]+)?' );
// Route::get('{path}', 'renterController@dashboard')->where( 'path' , '([A-z\d\-\/_.]+)?' ); 