<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::latest()->paginate(4);
        $trashCats = Category::onlyTrashed()->latest()->paginate(2);
        return view('admin.category.index', compact('categories', 'trashCats'));
    }

    public function addCategory(Request $request)
    {
      $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255'
      ],[
        'category_name.required' => 'Kategorija obavezna',
        
      ]);

      Category::create([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
      ]);
    
      return redirect()->route('categories')->with('success', 'Category inserted!');

    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        Category::find($id)->update([
          'category_name' => $request->category_name,
          'user_id' => Auth::user()->id
        ]);
          
        return redirect()->route('categories')->with('success', 'Category updated');
    }

    public function softDeleteCategory($id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories')->with('success', 'Category deleted');
    }

    public function restoreCategory($id)
    {
        Category::withTrashed()->find($id)->restore();

        return redirect()->route('categories')->with('success', 'Category restored');
    }

    public function deleteCategory($id)
    {
      Category::onlyTrashed()->find($id)->forceDelete();
      return redirect()->route('categories')->with('success', 'Category permantently deleted!');
    }
}
