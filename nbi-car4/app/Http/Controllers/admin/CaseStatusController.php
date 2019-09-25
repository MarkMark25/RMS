<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\CaseStatus;
use App\Logs;

class CaseStatusController extends Controller
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
        $showData = DB::table('case_status')
        ->get();
        return view ('admin.caseStatus', compact('showData'));
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
        $validator = Validator::make($request->all(), [
            'status' => 'required|unique:case_status,status|max:255',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $status = CaseStatus::create([
                'status'=>$request['status'],
            ])->statusid;
            $lastid = $status;
            $statusName=$request['status'];
            $formDescription = $request['descriptionOne'];
            $insertDescription = $formDescription. ' '.$statusName;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' => $insertDescription,
            ]);
            $request->session()->flash('alert-success', 'Successfully add new case status!');
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
            'status' => 'nullable|unique:case_status,status|max:255',
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $status = CaseStatus::findOrFail($request->statusid);
            $status->update($request->all());
            $statusID = $request['statusid'];
            $statusName=$request['status'];
            $formDescription = $request['descriptionOne'];
            $insertDescription = $formDescription. ' '.$statusName;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' => $insertDescription,
            ]);
            $request->session()->flash('alert-success', 'Case status successfully updated!');
            return redirect()->back();
        }
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
