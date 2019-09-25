<?php

namespace App\Http\Controllers\admin;
use DB; //DATABASE CONNECTION TAG
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class terminatedCasesController extends Controller
{
    
    public function __construct(){
        $this->middleware('preventBackHistory'); $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showData = DB::table('cases as c')
            ->join('caseagent as ca','ca.caseid','=','c.caseid')
            ->join('casenature as cn', 'cn.caseid','=','c.caseid')
            ->join('nature as na','na.natureid','=','cn.natureid')
            ->join('case_status as s','s.statusid','=','c.statusid')
            ->join('case_suspects as cs','cs.caseid','=','c.caseid')
            ->join('case_victims as cv','cv.caseid','=','c.caseid')
            ->join('users as usr','usr.userid','=','ca.userid')
            ->join('agent as agt','agt.userid','=','usr.userid')
            ->select('c.caseid','c.docketNumber','c.dateTerminated','c.ccn','c.acmo'
                ,DB::raw('upper(s.status) as stat')
                ,DB::raw('DATE_FORMAT(c.dateTerminated, "%m/%d/%Y ") as terminated_date')
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(na.nature) SEPARATOR ', ')) as case_nature")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(agt.position, ' ',usr.lastName) SEPARATOR '\n')) as agentoncase")
                ,DB::raw("CONCAT(c.docketNumber, '\n', c.ccn, '\n', c.acmo) as carcase")

                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (suspect_name) SEPARATOR ', ')) as subject"))
            ->whereNotNull('c.dateTerminated')
            ->where('s.status','!=','Under Investigation')
            ->where('c.caseAvailability','=','Available')
            ->groupBy('c.caseid')
            ->orderBy('c.dateTerminated','ASC')
            ->get();

            $start_date = null;
            $end_date = null;
            return view('admin.terminatedCases',compact('showData','start_date','end_date'));
            
    }

    public function date_filter(Request $request) {

        $validator = Validator::make($request->all(), [
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        if ($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else {
        $f_date = $request->input('from_date'); 
        $t_date = $request->input('to_date'); 

        $showData = DB::table('cases as c')
            ->join('caseagent as ca','ca.caseid','=','c.caseid')
            ->join('casenature as cn', 'cn.caseid','=','c.caseid')
            ->join('nature as na','na.natureid','=','cn.natureid')
            ->join('case_status as s','s.statusid','=','c.statusid')
            ->join('case_suspects as cs','cs.caseid','=','c.caseid')
            ->join('case_victims as cv','cv.caseid','=','c.caseid')
            ->join('users as usr','usr.userid','=','ca.userid')
            ->join('agent as agt','agt.userid','=','usr.userid')
            ->select('c.caseid','c.docketNumber','c.dateTerminated'
                ,DB::raw('upper(s.status) as stat')
                ,DB::raw('DATE_FORMAT(c.dateTerminated, "%m/%d/%Y ") as terminated_date')
                ,DB::raw("CONCAT(c.docketNumber, '\n', c.ccn, '\n', c.acmo) as carcase")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(na.nature) SEPARATOR ', ')) as case_nature")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(agt.position, ' ',usr.lastName) SEPARATOR '\n')) as agentoncase")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (suspect_name) SEPARATOR ', ')) as subject"))
            ->whereNotNull('c.dateTerminated')
            ->where('s.status','!=','Under Investigation')
            ->whereBetween('c.dateTerminated', array($f_date, $t_date))
            ->where('c.caseAvailability','=','Available')
            ->groupBy('c.docketNumber')
            ->orderBy('c.dateTerminated','ASC')
            ->get();  
        
        $start_date =  date('F d, Y', strtotime($f_date));
        $end_date =  date('F d, Y', strtotime($t_date));

        return view('admin.terminatedCases',compact('showData','start_date','end_date'));
        }
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
