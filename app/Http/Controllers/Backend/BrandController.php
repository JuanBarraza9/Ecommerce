<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

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

}
