<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;
use File;
use DirectoryIterator;

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
        $avatar = "default_profile.jpg";
        $userID = Auth::user()->Pk_UserId;
        $dir_path = public_path() . "/image/account/" . $userID . "/profile_img/";
        if (file_exists($dir_path)){
            $dir = new DirectoryIterator($dir_path);
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                    $avatar = "/image/account/" . Auth::user()->Pk_UserId . "/profile_img/" . $fileinfo;
                    break;
                }
            }
        }else{
            $avatar = "/image/dummy/default_profile.jpg";
        }

        return view('pages.account.profile')->with('profileIMG', $avatar);
    }

    public function profile_submit_update(Request $request){
        $validator = Validator::make($request->all(), [
            'UserFname' => ["required"],
            'UserLname' => ["required"],
            'UserBirthDate' => ["required"],
            'UserCountry' => ["required"],
            'UserImage' => ["image", "mimes:jpeg,png,jpg"]
        ])->setAttributeNames([
            'UserFname' => 'Firstname',
            'UserLname' => 'Lastname',
            'UserBirthDate' => 'Birth Date',
            'UserCountry' => 'Country',
            'UserImage' => 'Profile Image'
        ]);
        if($validator->fails()) {
            return back()->witherrors($validator)->withInput();
        }else{
            $userID = Auth::user()->Pk_UserId;

            $userInfo = User::find(Auth::user()->Pk_UserId);
            $userInfo->UserFname = $request->UserFname;
            $userInfo->UserLname = $request->UserLname;
            $userInfo->UserBirthDate = $request->UserBirthDate;
            $userInfo->UserCountry = $request->UserCountry;
            $userInfo->save();

            if($request->hasFile('UserImage')){
                // DELETE/CLEAR ACCOUNT PROFILE DIRECTORY - TO PREVENT DUPLICATE IMAGE
                File::deleteDirectory(public_path("image/account/" . $userID . '/profile_img'));

                // SAVE PROFILE IMAGE
                $UserImg = $request->file('UserImage');
                $UserImg_name = time() . '.' . $UserImg->getClientOriginalExtension();
                $UserImg->move(public_path("image/account/" . $userID . '/profile_img/'), $UserImg_name);
            }

            \Session::flash('sucessUpdate', true);
            return redirect()->route('accnt_profile');
        }
    }
}
