<?php

namespace App\Http\Controllers\Backend;

use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class AttributesController extends Controller
{
    // SIZES
    public function allAttributesSizes()
    {
        $sizes = Size::latest()->get();

        return view('backend.attributes.all-sizes', [
            'sizes' => $sizes
        ]);
    } // end method

    public function addAttributeSize()
    {
        
        return view('backend.attributes.add-size');
    } // end method

    public function storeSize(Request $request)
    {

        Size::insert([
            'name' => $request->name
         ]);

        $notification = array(
            'message' => 'Size Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.sizes')->with($notification); 
    } // end method

    public function deleteSize($id)
    {
        Size::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Size Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method


    // COLORS
    public function allAttributesColors()
    {
        $colors = Color::latest()->get();

        return view('backend.attributes.all-colors', [
            'colors' => $colors
        ]);
    } // end method

    public function addAttributeColor()
    {

        return view('backend.attributes.add-color');
    } // end method

    public function storeColor(Request $request)
    {

        Color::insert([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Color Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.colors')->with($notification); 
    } // end method

    public function deleteColor($id)
    {
        Color::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Color Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method
}
