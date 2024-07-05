<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index')->with('categories',$categories);
    }

    public function create()
    {
        // $brands = Brand::pluck('name', 'id'); // Assuming you have a 'categories' table with 'name' and 'id'
        // return view('admin.category.create', compact('brands'));
        $brands = array();
    	foreach (Brand::all() as $brand) {
    		$brands[$brand->id] = $brand->name;
    	}
    	return view('admin.category.create')->with('brands', $brands);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/category/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'uploads/cate-img/';
            $image->move($path, $filename);
        }

        // Create brand
        $category = new Category();
        $category->brand_id = $request->brand_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $filename; // Assuming you store filename in 'image' field
        $category->status = $request->status==true ? '0' : '1';
        $category->save();

        Session::flash('category_create', 'category created successfully');
        return redirect('admin/category/create');
    }








    public function search(Request $request)
    {
        $query = $request->input('search');
        $catgories = Category::where('name', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->orWhere('id', 'like', "%$query%")
        ->get();

        return view('admin.category.index', compact('categories'));
    }
}
