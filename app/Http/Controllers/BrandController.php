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
      $last_img = $upload_location.$img_name; // img/brand/3242342.jpg

      $brand_img->move($upload_location, $img_name);
      
      Brand::create([
        'brand_name' => $request->brand_name,
        'brand_img' => $last_img,
      ]);

      return redirect()->back()->with('success', 'Brand Inserted succesfully!' );
      
    }

    public function editBrand($id)
    {
      $brand = Brand::find($id);

      return view('admin.brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
      $validated_data = $request->validate([
        'brand_name' => 'required|min:4',
      ],
    [
      'brand_name.required' => 'Add Brand name',
    ]);

      $old_img = $request->old_img;

      $brand_img = $request->file('brand_img');

      if($brand_img) {

        $img_name_gen = hexdec(uniqid());
        $img_extension = strtolower($brand_img->getClientOriginalExtension());
  
        $img_name = $img_name_gen . '.'. $img_extension;
  
        $upload_location = 'img/brand/';
        $last_img = $upload_location.$img_name; // img/brand/3242342.jpg
  
        $brand_img->move($upload_location, $img_name);
  
        unlink($old_img);
  
        Brand::findOrFail($id)->update([
          'brand_name' => $request->brand_name,
          'brand_img' => $last_img,
        ]);
  
        return redirect()->route('brands')->with('success', 'Brand Updated succesfully!' );

      } else {
        Brand::findOrFail($id)->update([
          'brand_name' => $request->brand_name,
        ]);
        return redirect()->route('brands')->with('success', 'Brand Updated succesfully!' );
      }
    
    }

    public function deleteBrand($id)
    {
      $image = Brand::find($id);
      $old_img = $image->brand_img;

      unlink($old_img);

      Brand::findOrFail($id)->delete();

      return redirect()->route('brands')->with('success', 'Brand Deleted succesfully!' );
    }


}
