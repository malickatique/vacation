<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use App\User;

class EmailtemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        $EmailTemplates = Emailtemplate::all();
        //print_r($EmailTemplates);
        //exit;
        return view('admin.emailtemplate.show')->with('EmailTemplates', $EmailTemplates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emailtemplate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required|nullable|max:1999',
            ]);

        
        $Emailtemplate = new Emailtemplate;
        $Emailtemplate->name = $request->input('name');
        $Emailtemplate->content = $request->input('content');
        $Emailtemplate->save();
        return redirect('/admin/emailtemplate')->with('status', 'Email template created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Emailtemplate = new Emailtemplate;
        $result = $Emailtemplate->find($id);
        //print_r($result);
        return view('admin.emailtemplate.edit')->with('result',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Emailtemplate = Emailtemplate::find($id);
        $Emailtemplate->name = $request->input('name');
        $Emailtemplate->content = $request->input('content');
       
        $Emailtemplate->save();
        return redirect('/admin/emailtemplate')->with('status', 'Email template updated!');
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Emailtemplate = Emailtemplate::find($id);
        $Emailtemplate->delete($Emailtemplate->id);
        return redirect('/admin/emailtemplate')->with('status', 'Email Template Removed');
    }
}
