<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GrahamCampbell\ResultType\Success;

class AdminController extends Controller
{
    
    public function adminDashboard()
    {

        return view('admin.admin_dashboard');
    } // End Method

    public function adminLogin()
    {
        return view('admin.admin_login');   
    }

    public function adminDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // end method

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    } // end method

    public function adminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $updateData = User::find($id);

        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->phone = $request->phone;
        $updateData->address = $request->address;
        

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images'. $updateData->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);

            $updateData['photo'] = $filename;
        }

        $updateData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function adminChangePassword()
    {

        return view('admin.admin_change_password');
    } // end method

    public function adminUpdatePassword(Request $request)
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

        return back()->with("status", "Password Changed Succesfully");
        
    } // end method

}
