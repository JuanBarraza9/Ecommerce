<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    
    public function allBrand()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.brands-all', [
            'brands' => $brands
        ]);

    }
    // end method

    public function addBrand()
    {


        return view('backend.brand.brand-add', [
            
        ]);

    }
    // end method

    public function storeBrand(Request $request)
    {
        // name gen with you name
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url
        ]);

        $notification = array(
            'message' => 'Brand Inserted Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }
    // end method

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);

        return view('backend.brand.brand-edit', [
            'brand' => $brand,
            'id' => $id
        ]);

    }
    // end method

    public function updateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;
        
        if($request->file('brand_image')){
            // name gen with you name
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;

            if(file_exists($old_img))
            {
                unlink($old_img);

            }
    
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url
            ]);
    
            $notification = array(
                'message' => 'Brand Updated with image Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.brand')->with($notification);
        } 
        else 
        {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);
    
            $notification = array(
                'message' => 'Brand updated without image Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.brand')->with($notification);
        } // end else

    }
    // end method

    public function deleteBrand($id){
        
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img );

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand deleted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);

    }
    // end method

}
