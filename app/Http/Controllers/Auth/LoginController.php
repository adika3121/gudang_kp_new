<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Gate;

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

    protected function authenticated($request, $user){

        // return ($user);
        if(Gate::allows('isAdmin')){
            return redirect ('/lainnya');
            // abort(404,"Sorry, You can do this actions");
        }else if(Gate::allows('isMarketing')){
            return redirect ('/dashboard');
        }else if(Gate::allows('isGudang')){
            return redirect ('/transaksi');
        }else if(Gate::allows('isPengiriman')){
            return redirect ('/stock-keluar');
        }
        
    }
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
