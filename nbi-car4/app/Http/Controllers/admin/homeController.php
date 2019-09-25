<?php

namespace App\Http\Controllers\admin;
use DB;
use Carbon\Carbon;
use App\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
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
        $pendingCase = DB::table('cases')
        ->join('case_status','cases.statusid','=','case_status.statusid')
        ->join('caseagent', 'cases.caseid','=','caseagent.caseid')
        ->join('users','caseagent.userid','=','users.userid')
        ->join('case_suspects', 'case_suspects.caseid','=','cases.caseid')
        ->select('cases.complainantname', 'caseagent.dateassigned', 'case_status.status'
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(case_suspects.suspect_name) SEPARATOR ' and ') as suspectName")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (users.firstName,' ',users.lastName) SEPARATOR ' and ') as full_name")
        )
        ->groupBy(DB::raw('caseagent.caseid'))
        ->whereNull('cases.dateTerminated')
        ->orWhere('case_status.status','=','Under Investigation')
        ->orderBy('dateAssigned','DESC')
        ->limit(10)
        ->get();

        $activeUsers = DB::table('users')
        ->where('userStatus','=','Active')
        ->count();

        /**Get the current date */
        $current = Carbon::now();
        $formatted = $current->format('Y-m-d');

        /** If you comment onlineusers and list of online users the notifications/badges on home
         * will be removed and trigger an error.
         *
         */
        //$onlineUsers = DB::select('select COUNT(historyid) AS onlineUsers FROM history WHERE logout IS NULL AND DATE_FORMAT((login),"%Y-%m-%d") = ?',[$formatted]);
        //$listOfOnlineUsers = DB::select('select username FROM users INNER JOIN history ON history.userid=users.userid WHERE logout IS NULL AND DATE_FORMAT((login),"%Y-%m-%d") = ?', [$formatted]);


        /**
         * Notifications for uploading of reports
         */

        //$countUpload = DB::select('select COUNT(created_at) AS countUpload FROM logs WHERE DATE_FORMAT((created_at),"%Y-%m-%d") = ? AND description LIKE "%uploaded%"', [$formatted]);
        //$reportDescription = DB::select('select CONCAT(users.firstname," - ",logs.description) AS reportDescription FROM logs INNER JOIN users ON users.userid=logs.userid WHERE DATE_FORMAT((logs.created_at),"%Y-%m-%d") = ? AND logs.description LIKE "%Agent%"', [$formatted]);

        //$reportDescription = DB::select('select cases.caseid AS caseID,logs.logs_caseid, logs.description AS reportDescription FROM logs INNER JOIN users ON users.userid=logs.userid INNER JOIN cases ON cases.caseid=logs.logs_caseid WHERE DATE_FORMAT((logs.created_at),"%Y-%m-%d") = ? AND logs.description LIKE "%uploaded%"', [$formatted]);

        $totalRecords = DB::table('cases')
        ->where('caseAvailability','=','Available')
        ->count();

        $caseRecords = DB::table('cases')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->select(DB::raw("COUNT(cases.caseid) AS caseRecords"))
        ->whereNotNull('cases.dateTerminated')
        ->orWhere('case_status.status','!=','Under Investigation')
        ->get();

        $chart = DB::table('nature')
        ->join('casenature','casenature.natureid','=','nature.natureid')
        ->join('cases','cases.caseid','=','casenature.caseid')
        ->join('case_status','cases.statusid','=','case_status.statusid')
        ->select('nature.nature',
        DB::raw("count(casenature.caseid) AS totalNumber"))
        ->groupBy(DB::raw('nature.natureid'))
        ->where('case_status.status','!=', 'Under Investigation')
        ->get();

        $showData = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                ,DB::raw("DATE(logs.created_at) as dateCreated")
                ,DB::raw("TIME(logs.created_at) as timeCreated")
                )
        ->orderBy('logs.created_at','DESC')
        ->limit(10)
        ->get();
        return view('admin.home',compact('showData','pendingCase','totalRecords','caseRecords','chart','activeUsers'));
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
    public function show(Request $request)
    {
         /**Get the current date */
         $current = Carbon::now();
         $formatted = $current->format('Y-m-d');

         /** If you comment onlineusers and list of online users the notifications/badges on home
          * will be removed and trigger an error.
          *
          */
         //$onlineUsers = DB::select('select COUNT(historyid) AS onlineUsers FROM history WHERE logout IS NULL AND DATE_FORMAT((login),"%Y-%m-%d") = ?',[$formatted]);
         //$listOfOnlineUsers = DB::select('select username FROM users INNER JOIN history ON history.userid=users.userid WHERE logout IS NULL AND DATE_FORMAT((login),"%Y-%m-%d") = ?', [$formatted]);


         /**
          * Notifications for uploading of reports
          */

         //$countUpload = DB::select('select COUNT(created_at) AS countUpload FROM logs WHERE DATE_FORMAT((created_at),"%Y-%m-%d") = ? AND description LIKE "%uploaded%"', [$formatted]);
        //$reportDescription = DB::select('select CONCAT(users.firstname," - ",logs.description) AS reportDescription FROM logs INNER JOIN users ON users.userid=logs.userid WHERE DATE_FORMAT((logs.created_at),"%Y-%m-%d") = ? AND logs.description LIKE "%Agent%"', [$formatted]);

        //$reportDescription = DB::select('select cases.caseid AS caseID, logs.description AS reportDescription FROM logs INNER JOIN users ON users.userid=logs.userid INNER JOIN cases ON cases.caseid=logs.logs_caseid WHERE DATE_FORMAT((logs.created_at),"%Y-%m-%d") = ? AND logs.description LIKE "%uploaded%"', [$formatted]);

        $pendingCase = DB::table('cases')
        ->join('case_status','cases.statusid','=','case_status.statusid')
        ->join('caseagent', 'cases.caseid','=','caseagent.caseid')
        ->join('users','caseagent.userid','=','users.userid')
        ->join('case_suspects', 'case_suspects.caseid','=','cases.caseid')
        ->select('cases.complainantname', 'caseagent.dateassigned', 'case_status.status'
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(case_suspects.suspect_name) SEPARATOR ' and ') as suspectName")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (users.firstName,' ',users.lastName) SEPARATOR ' and ') as full_name")
        )
        ->groupBy(DB::raw('caseagent.caseid'))
        ->whereNull('cases.dateTerminated')
        ->orWhere('case_status.status','=','Under Investigation')
        ->orderBy('dateAssigned','DESC')
        ->limit(10)
        ->get();

        $activeUsers = DB::table('users')
        ->where('userStatus','=','Active')
        ->count();

        $totalRecords = DB::table('cases')
        ->where('caseAvailability','=','Available')
        ->count();

        $caseRecords = DB::table('cases')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->select(DB::raw("COUNT(cases.caseid) AS caseRecords"))
        ->whereNotNull('cases.dateTerminated')
        ->orWhere('case_status.status','!=','Under Investigation')
        ->get();

        $yearPicker = $request['yearPicker'];
        /*
        $chart = DB::table('nature')
        ->join('casenature','casenature.natureid','=','nature.natureid')
        ->join('caseagent', 'casenature.caseid','=','caseagent.caseid')
        ->select('nature.nature',
        DB::raw("count(casenature.caseid) AS totalNumber"))
        ->groupBy(DB::raw('nature.natureid'))
        ->whereYear('caseagent.dateassigned','=',$yearPicker)
        ->get();
        */
        $chart =DB::select('select nature.nature, COUNT(casenature.caseid) AS totalNumber,YEAR(caseagent.dateassigned) AS sample FROM nature INNER JOIN casenature ON nature.natureid=casenature.natureid INNER JOIN cases ON cases.caseid=casenature.caseid INNER JOIN case_status ON case_status.statusid=cases.statusid INNER JOIN caseagent ON caseagent.caseid=casenature.caseid WHERE DATE_FORMAT((caseagent.dateassigned),"%Y-%m") = ? and case_status.status != "Under Investigation" GROUP BY nature.natureid',[$yearPicker]);

        $showYear = DB::select('Select DATE_FORMAT((caseagent.dateassigned),"%Y-%m") AS showYear FROM caseagent WHERE DATE_FORMAT((caseagent.dateassigned),"%Y-%m") = ? GROUP BY YEAR(caseagent.dateassigned)',[$yearPicker]);

        $showData = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                ,DB::raw("DATE(logs.created_at) as dateCreated")
                ,DB::raw("TIME(logs.created_at) as timeCreated")
                )
        ->orderBy('logs.created_at','DESC')
        ->limit(10)
        ->get();
        $request->flash();
        return view('admin.showStatistics',compact('showData','pendingCase','onlineUsers','listOfOnlineUsers','countUpload','reportDescription','activeUsers','totalRecords','caseRecords','chart','showYear'));

    }
/*
    public function totalRecords (Request $request){

        $pendingCase = DB::table('cases')
        ->join('case_status','cases.statusid','=','case_status.statusid')
        ->join('caseagent', 'cases.caseid','=','caseagent.caseid')
        ->join('users','caseagent.userid','=','users.userid')
        ->join('case_suspects', 'case_suspects.caseid','=','cases.caseid')
        ->select('cases.complainantname', 'caseagent.dateassigned', 'case_status.status'
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(case_suspects.suspect_name) SEPARATOR ' and ') as suspectName")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (users.firstName,' ',users.lastName) SEPARATOR ' and ') as full_name")
        )
        ->groupBy(DB::raw('caseagent.caseid'))
        ->whereNull('cases.dateTerminated')
        ->orWhere('case_status.status','=','Under Investigation')
        ->orderBy('dateAssigned','DESC')
        ->limit(10)
        ->get();

        $activeUsers = DB::table('users')
        ->where('userStatus','=','Active')
        ->count();

        $yearPicker = $request['totalRecords'];

        $totalRecords = DB::select('select COUNT(cases.caseid) AS sample FROM cases INNER JOIN caseagent ON cases.caseid=caseagent.caseid WHERE DATE_FORMAT((caseagent.dateassigned),"%Y-%m") = ? AND cases.caseAvailability="Available"',[$yearPicker]);

        $showYear = DB::select('select DATE_FORMAT((caseagent.dateassigned),"%Y-%m") AS showYear FROM cases INNER JOIN caseagent ON cases.caseid=caseagent.caseid WHERE DATE_FORMAT((caseagent.dateassigned),"%Y-%m") = ? AND cases.caseAvailability="Available" GROUP BY DATE_FORMAT((caseagent.dateassigned),"%Y-%m")',[$yearPicker]);


        $caseRecords = DB::table('cases')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->select(DB::raw("COUNT(cases.caseid) AS caseRecords"))
        ->whereNotNull('cases.dateTerminated')
        ->orWhere('case_status.status','!=','Under Investigation')
        ->get();

        $chart = DB::table('nature')
        ->join('casenature','casenature.natureid','=','nature.natureid')
        ->join('cases','cases.caseid','=','casenature.caseid')
        ->join('case_status','cases.statusid','=','case_status.statusid')
        ->select('nature.nature',
        DB::raw("count(casenature.caseid) AS totalNumber"))
        ->groupBy(DB::raw('nature.natureid'))
        ->where('case_status.status','!=', 'Under Investigation')
        ->get();

        $showData = DB::table('users')
        ->join('logs','users.userid','=','logs.userid')
        ->select('users.*','logs.*'
                ,DB::raw("CONCAT(users.firstName,' ',users.lastName) AS name")
                ,DB::raw("DATE(logs.created_at) as dateCreated")
                ,DB::raw("TIME(logs.created_at) as timeCreated")
                )
        ->orderBy('logs.created_at','DESC')
        ->limit(10)
        ->get();
        $request->flash();
        return view('admin.showStatistics',compact('showData','pendingCase','activeUsers','totalRecords','caseRecords','chart','showYear'));

    }
*/
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
