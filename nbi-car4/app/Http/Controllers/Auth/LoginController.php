<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\History;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'username';
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'userStatus' => 'Active'];
    }

    public function authenticated()
    {
        $current = new Carbon();
        $current = Carbon::now();
        $history= new History;
        $history->login = $current;
        $history->userid = Auth::user()->userid;
        $history->save();


    }
    public function logout(Request $request){
        $current = new Carbon();
        $current = Carbon::now();
        $history = History::where('userid', '=', Auth::user()->userid)->orderBy('historyid', 'desc')->first();
        //$history = History::find(Auth::user()->userid)->orderBy('historyid', 'desc')->first();
        //return $history;
        $history->logout = $current;
        $history->save();
        Auth::logout();
        return redirect('/login');
    }



}
