<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    
    public function vendorDashboard()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_dashboard', compact('vendorData'));
    } // End Method

    public function vendorLogin()
    {
        return view('vendor.methods.vendor_login');   
    }
    
    public function vendorDestroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    } // end method

    public function vendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.methods.vendor-profile', compact('vendorData'));
    } // end method

    public function vendorProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $updateData = User::find($id);

        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->phone = $request->phone;
        $updateData->address = $request->address;
        $updateData->vendor_join = $request->vendor_join;
        $updateData->vendor_short_info = $request->vendor_short_info;
        

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images'. $updateData->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'),$filename);

            $updateData['photo'] = $filename;
        }

        $updateData->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function vendorChangePassword()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.methods.change-password', compact('vendorData'));
    } // end method

    public function vendorUpdatePassword(Request $request)
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
