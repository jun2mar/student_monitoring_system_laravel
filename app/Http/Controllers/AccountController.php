<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('pages.account.dashboard');
    }

    public function profile(){
        return view('pages.account.profile');
    }

    public function profile_submit_update(Request $request){
        $validator = Validator::make($request->all(), [
            'UserFname' => ["required"],
            'UserLname' => ["required"],
            'UserBirthDate' => ["required"],
            'UserCountry' => ["required"],
        ])->setAttributeNames([
            'UserFname' => 'Firstname',
            'UserLname' => 'Lastname',
            'UserBirthDate' => 'Birth Date',
            'UserCountry' => 'Country',
        ]);
        if($validator->fails()) {
            return back()->witherrors($validator)->withInput();
        }else{
            $userInfo = User::find(Auth::user()->Pk_UserId);
            $userInfo->UserFname = $request->UserFname;
            $userInfo->UserLname = $request->UserLname;
            $userInfo->UserBirthDate = $request->UserBirthDate;
            $userInfo->UserCountry = $request->UserCountry;
            $userInfo->save();
            \Session::flash('sucessUpdate', true);
            return redirect()->route('accnt_profile');
        }
    }
}
