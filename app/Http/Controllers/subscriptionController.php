<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\SubscriptionFeature;

class subscriptionController extends Controller
{   
    public function __construct() {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subscriptions = Subscription::all();
        $basic_features = Subscription::find(1)->option;
        $pro_features = Subscription::find(2)->option;

        $data = array(
            'subscriptions' => $subscriptions,
            'basic_features' => $basic_features,
            'pro_features' => $pro_features
        );

        return view('admin.subscription.index')->with($data);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $subscription = Subscription::find($id);
        return view('admin.subscription.edit-subscription')->with('subscription', $subscription);
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
        $subscription = Subscription::find($id);
        $subscription->detail = $request->input('detail');
        $subscription->price = $request->input('price');
        $subscription->save();

        return redirect()->route('subscription.index')->with('status', 'Subscription data is updated!');


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
    }

    // subscription custom functions

    public function enable_disable_subscription(Request $request, $id){


        $status = $request['status'];

        if($id == '1'){

            $disable = Subscription::where('id', 2)->first();
            $disable->status = 0;
            $disable->save();
            
            $sub = 'Free subscription is now activated on all user';
        }

        if($id == '2'){

            $disable = Subscription::where('id', 1)->first();
            $disable->status = 0;
            $disable->save();
            $sub = 'Pro subscription is now activated on all user';

        }
        

        $subscription = Subscription::find($id);
        $subscription->status = 1;
        $subscription->save();

        return redirect()->route('subscription.index')->with('status', $sub);

    }

    public function add_subscription_feature(){

        $subscriptions = Subscription::all();
        return view('admin.subscription.add-feature')->with('subscriptions', $subscriptions);

    }

    public function insert_subscription_feature(Request $request){
        
        $subscription_feature = new SubscriptionFeature;
        $subscription_feature->subscription_id = $request->input('subscription_id');
        $subscription_feature->feature_name = $request->input('feature_name');
        $subscription_feature->save();

        return redirect()->route('subscription.index')->with('status', 'Subscription feature is updated!');

    }


    // not secure but functioning accurate
    public function delete_feature(Request $request, $id){

        $subscription_feature = SubscriptionFeature::find($id);
        $subscription_feature->delete();
        return redirect()->route('subscription.index')->with('status', 'Subscription feature is delete!');


    }



}
