<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // $products = Product::latest()

         // Get search query and sorting parameters
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'name'); // Default sort by 'name'
        $sort_order = $request->input('sort_order', 'asc'); // Default order 'asc'

        // Modify the query for searching and sorting
        $products = Product::when($search, function ($query, $search) {
            return $query->where('product_id', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
        })
        ->orderBy($sort_by, $sort_order) // Apply sorting
        
        ->paginate(3);
        return view('pages.index',compact('products', 'search', 'sort_by', 'sort_order'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "product_id"=>"required|unique:products,product_id",
                "name"=>"required",
                "description"=>"nullable",
                "price"=>"required",
                "stock"=>"nullable",
                "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // Handle image upload
                if ($request->hasFile('image')) {
                    $imageName = time().'.'.$request->image->getClientOriginalExtension();
                    $request->image->move(public_path('images'), $imageName);
                    $imagePath = 'images/' . $imageName;
                } else {
                    $imagePath = null;
                }

        

            // $imagePath = null;
            //     if($request->hasFile('image')){
            //         $image = $request->file('image');
            //         $imageName = time().'.'.$image->getClientOriginalExtension();
            //         $imagePath = $image->storeAs('images', 'public');
            //     };

            Product::create([
                "product_id"=>$request->input('product_id'),
                "name"=>$request->input('name'),
                "description"=>$request->input('description'),
                "price"=>$request->input('price'),
                "stock"=>$request->input('stock'),
                "image" => $imagePath,  // Save image path
            ]);

            Toastr::success('Product Created Successfully');
                return redirect()->route('products.index');
            }catch(Exception $e){
                Toastr::error('somthing went wrong');
                return redirect()->back();
            
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Product::where('id',$id)->first();
        return view('pages.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                "product_id"=>"required|unique:products,product_id,".$id,
                "name"=>"required",
                "description"=>"nullable",
                "price"=>"required",
                "stock"=>"nullable",
                "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // Handle image upload
            // $product = Product::findOrFail($id);
            // $product->name = $request->name;
            // $product->description = $request->description;
            // $product->price = $request->price;
            // $product->stock = $request->stock;
            // $product->product_id = $request->product_id;

            // if ($request->hasFile('image')) {
            //     $image = $request->file('image');
            //     //File::delete('images/' . $product->image);
            //     $image_name = 'images/'.time() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('images/'), $image_name);
            //     $product->image = $image_name;
            // }

            // $product->save();




                if ($request->hasFile('image')) {
                    // File::delete('images/'.)
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('images'), $imageName);
                    $imagePath = 'images/'.$imageName;
                }
                //  else {
                //     $imagePath = $product->image;  // Keep the old image if no new image is uploaded
                // }

                //image insert 
                // if ($request->image) { 
                //     //delete that image
                //     if (File::exists('images/' . $product->image)) {
                //         File::delete('images/' . $product->image);
                //     }

                //     $image = $request->file('image');
                //     $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
                //     $location = public_path('assets/images/' . $img);
                //     Image::make($image)->save($location);
                //     $slider->image = $img;

                // }



            Product::where('id',$id)->update([
                "product_id"=>$request->input('product_id'),
                "name"=>$request->input('name'),
                "description"=>$request->input('description'),
                "price"=>$request->input('price'),
                "stock"=>$request->input('stock'),
                
                "image" => $imagePath,
            ]);
            Toastr::success('Product updated Successfully');
            return redirect()->route('products.index');
        }catch(Exception $e){
            Toastr::error('somthing went wrong');
            return redirect()->back();
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        Toastr::success('Product Deleted Successfully');
        return redirect()->back();
    }
}
