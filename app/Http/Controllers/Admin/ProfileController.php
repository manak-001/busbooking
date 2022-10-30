<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function index()
    {

        return view('admin.profile.changepassword');
    }
    public function updatepassword(Request $request)
    {
        // dd(auth()->user()->password);

        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'confirmed'],
        ]);
       
        // $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|confirmed',
        // ]);
        if (\Hash::check(($request->get('old_password')), auth()->user()->password)) {
            User::whereId(auth()->user()->id)->update([
                'password' => \Hash::make($request->new_password)
            ]);
            return Redirect::back()->with( "message", "Password  Update successfully");
        }

        return Redirect::back()->with("message","Old Password Doesn't match!");
    }
}
