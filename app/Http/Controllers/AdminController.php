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
        return view('admin.methods.admin_login');   
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

        return view('admin.methods.admin_profile_view', compact('adminData'));
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

        return view('admin.methods.admin_change_password');
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

    public function inactiveVendor()
    {

        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')
        ->latest()->get();

        return view('backend.vendor.inactive-vendor', compact('inActiveVendor'));
        

    } // end method

    public function activeVendor()
    {

        $activeVendor = User::where('status', 'active')->where('role', 'vendor')
        ->latest()->get();

        return view('backend.vendor.active-vendor', compact('activeVendor'));
        

    } // end method

    public function inactiveVendorDetails($id)
    {

        $inActiveVendorDetails = User::findOrFail($id);

        return view('backend.vendor.inactive-vendor-details', compact('inActiveVendorDetails'));
        

    } // end method

    public function activeVendorApprove(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendor')->with($notification);

    }// End Mehtod 


    public function activeVendorDetails($id)
    {

        $activeVendorDetails = User::findOrFail($id);

        return view('backend.vendor.active-vendor-details', compact('activeVendorDetails'));
        

    } // end method

    public function inactiveVendorApprove(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor InActive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);

    }// End Mehtod 

}
