<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminsLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function login(Request $request)
    {
      //validate the form data
     $this->validate($request,[
         'email'=> 'required|email',
          'password'=> 'required|min:6'
     ]);
      
     //attempt to login the user
     if (Auth::guard('admin')->attempt([
         'email'=> $request->email,
         'password' => $request->password
         ])) 
         {
             //if successfully loged in
        return redirect()->intended(route('admin.dashboard'));
     }
     
     //if unsuccessfully return back with formdata
      return redirect()->back()->withInput($request->only('email'))->with('alert','Incorrect email or password');
     
    }
}
