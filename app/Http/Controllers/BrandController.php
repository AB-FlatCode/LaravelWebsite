<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrands()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
      $validated_data = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_img' => 'required|mimes:jpg.jpeg,png',
      ],
    [
      'brand_name.required' => 'Add Brand name',
      'brand_img.min' => 'Brand longer than 4 characters',
    ]);

      $brand_img = $request->file('brand_img');
      $img_name_gen = hexdec(uniqid());
      $img_extension = strtolower($brand_img->getClientOriginalExtension());

      $img_name = $img_name_gen . '.'. $img_extension;

      $upload_location = 'img/brand/';
      $last_img = $upload_location.$img_name; // 3242342.jpg

      $brand_img->move($upload_location, $img_name);
      
      Brand::create([
        'brand_name' => $request->brand_name,
        'brand_img' => $last_img,
      ]);

      return redirect()->back()->with('success', 'Brand Inserted succesfully!' );
      
    }


}
