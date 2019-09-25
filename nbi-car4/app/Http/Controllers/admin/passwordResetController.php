<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use \App\Logs;

class passwordResetController extends Controller
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
        ->select('users.*')
        ->where('userStatus','=','Active')
        ->where('userid','!=',Auth::user()->userid)
        ->orWhere('userStatus','=','Inactive')
        ->orWhere('userStatus','=','Reassigned')
        ->get();
        return view ('admin.manageAccount',compact('showData'));
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

    public function update(Request $request)
    {
        if($request==true){
            $user = User::findOrFail($request->useridOne);
            $password = $request['password'];
            $user->update([
                'password'=>Hash::make($password)
            ]);
            $userID = $request['useridOne'];
            $formDescription = $request['description'];
            $insertDescription = $formDescription. ' '.$userID;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' => $insertDescription,
            ]);
            return redirect('/manageAccounts')->with('alert-success', 'User details successfully updated!');
        }else {
            return redirect('/manageAccounts')->with('alert-danger', 'ERROR!');
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
