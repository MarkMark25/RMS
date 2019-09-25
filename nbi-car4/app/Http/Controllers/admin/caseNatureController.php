<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Nature;
use App\Logs;

class caseNatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory'); $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showData = DB::table('nature')
        ->where('natureAvailability','=','Available')
        ->get();
        return view ('admin.caseNature', compact('showData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validator = Validator::make($request->all(), [
            'nature' => 'required|unique:nature|max:255',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $nature = Nature::create([
                'nature'=>$request['nature'],
                'natureAvailability'=>$request['natureAvailability']
            ])->natureid;
            $lastid = $nature;
            $natureName=$request['nature'];
            $formDescription = $request['descriptionOne'];
            $insertDescription = $formDescription. ' '.$natureName;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' => $insertDescription,
            ]);
            $request->session()->flash('alert-success', 'Successfully add new case nature!');
            return redirect()->back();
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nature' => 'nullable|max:255',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $nature = Nature::findOrFail($request->natureid);
            $nature->update($request->all());
            $natureID = $request['natureid'];
            $natureName = $request['nature'];
            $formDescription = $request['descriptionOne'];
            $insertDescription = $formDescription. ' '.$natureName;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' => $insertDescription,
            ]);
            $request->session()->flash('alert-success', 'Nature details successfully updated!');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $nature = Nature::findOrFail($request->natureid);
        $nature->update($request->all());
        $natureID = $request['natureid'];
        $natureName = $request['nature'];
        $formDescription = $request['descriptionOne'];
        $insertDescription = $formDescription. ' '.$natureName;
        Logs::create([
            'userid' => $request['userid'],
            'action' => $request['action'],
            'description' => $insertDescription,
        ]);
        $request->session()->flash('alert-success', 'Case nature successfully archived!');
        return redirect()->back();
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
}
