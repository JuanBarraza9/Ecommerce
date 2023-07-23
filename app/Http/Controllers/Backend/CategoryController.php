<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $category = Category::latest()->get();

        return view('backend.category.category-all', [
            'categories' => $category
        ]);

    } // End Method

    public function addCategory()
    {
        return view('backend.category.category-add');
    } // End Method

    public function storeCategory(Request $request)
    {
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification); 
    } // End Method

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category-edit',compact('category'));
    } // End Method 

    public function updateCategory(Request $request)
    {
        $cat_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Category::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Category Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification); 

        } else {

             Category::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)), 
        ]);

       $notification = array(
            'message' => 'Category Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification); 

        } // end else
    } // End Method

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img ); 

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    } // End Method

}
