<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = new Brand();
        return view('admin.brand.create')->with('brand', $brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'description' => 'required|max:1000|min:10',
        ]);
          
        if ($validator->fails()) {
            return redirect('admin/brand/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The product
        $image = $request->file('image');
        $upload = 'uploads/brand-img/';
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename);
    
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $filename;
        $brand->description = $request->description;
	    $brand->status = $request->status==true ? '0' : '1';
        $brand->save();
        Session::flash('brand_create','New data is created.');
        return redirect('admin/brand/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        if (empty($id)) {
            return redirect('admin/brand');
        }
        $brand = Brand::find($id);
        return view('admin.brand.edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'description' => 'required|max:1000|min:10',
        ]);
    
        if ($validator->fails()) {
            return redirect('admin/brand/'.$id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }
    
        $brand = Brand::find($id);
    
        // Handle Image Upload
        if($request->file('image')) {
            // Delete old image if exists
            if($brand->image) {
                $oldImagePath = public_path('uploads/brand-img/'.$brand->image);
                if(File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
    
            // Upload new image
            $image = $request->file('image');
            $uploadPath = 'uploads/brand-img/';
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move($uploadPath, $filename);
    
            // Update brand with new image
            $brand->image = $filename;
        }
    
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->status = $request->status == true ? '1' : '0';
        $brand->save();
    
        Session::flash('brand_update', 'Data is updated');
        return redirect('admin/brand/'.$brand->id.'/edit');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
    	$image_path = 'brand-img/'.$brand->image;
    	File::delete($image_path);
    	$brand->delete();
    	Session::flash('brand_delete','Data is deleted.');
    	return redirect('admin/brand');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $brands = Brand::where('name', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->orWhere('id', 'like', "%$query%")
        ->get();

        return view('admin.brand.index', compact('brands'));
    }
}
