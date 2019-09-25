<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userLogsController extends Controller
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
        $showData = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                )
        ->orderBy('logs.created_at','DESC')
        ->where('users.role','=','Administrator')
        ->get();
        $investigator = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->join('cases','logs.logs_caseid','=','cases.caseid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                ,DB::raw("cases.caseid AS caseID")
                )
        ->orderBy('logs.created_at','DESC')
        ->where('users.role','=','Investigator')
        ->get();
        $encoder = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                )
        ->orderBy('logs.created_at','DESC')
        ->where('users.role','=','Encoder')
        ->get();
        return view ('admin.userLogs',compact('showData','investigator','encoder'));
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
