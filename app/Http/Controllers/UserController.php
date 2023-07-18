<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDashboard() {

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('dashboard', [
            'userData' => $userData
        ]);
    } // End method

    public function userProfileStore(Request $request) {

        $id = Auth::user()->id;
        $updateData = User::find($id);

        $updateData->name = $request->name;
        $updateData->username = $request->username;
        $updateData->email = $request->email;
        $updateData->phone = $request->phone;
        $updateData->address = $request->address;
        

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images'. $updateData->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);

            $updateData['photo'] = $filename;
        }

        $updateData->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End method

    public function userUpdatePassword(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match the old password
        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update the new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Succesfully',
            'alert-type' => 'success'
        );


        return back()->with($notification);
        
    } // end method

    public function userLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }


}
