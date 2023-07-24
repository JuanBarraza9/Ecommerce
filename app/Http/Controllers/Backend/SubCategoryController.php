<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function allSubcategory()
    {
        $subcategories = SubCategory::latest()->get();

        return view('backend.subcategory.subcategory-all', [
            'subcategories' => $subcategories
        ]);

    } // End Method

    public function addSubcategory()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        
        return view('backend.subcategory.subcategory-add', compact('categories'));
    } // End Method

    public function storeSubcategory(Request $request)
    {
        
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

       $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification); 

    } // End Method

    public function editSubcategory($id)
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory-edit',compact('categories','subcategory'));
    } // End Method 

    public function updateSubcategory(Request $request)
    {
        $subcat_id = $request->id;

         SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)), 
        ]);

       $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification); 
    } // End Method

    public function deleteSubcategory($id)
    {

        SubCategory::findOrFail($id)->delete();

         $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    } // End Method

    public function getSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);

    }// End Method 
}
