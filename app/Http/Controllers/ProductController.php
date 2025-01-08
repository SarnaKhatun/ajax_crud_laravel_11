<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->paginate(5);
        return view('products', compact('products'));
    }

    public function addProduct(Request $request)
    {
        //dd($request);
        $request->validate(
            [
           'name'=>'required|unique:products,name',
           'price' =>'required',
                'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed

            ],
            [
                'name.required' => 'Name is Required',
                'name.unique' => 'Product Already Exists',
                'price.required'=>'Price is Required',
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public');
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $filePath;
        $product->save();

        //dd($product);
        return response()->json([
           'status'=>'success',
        ]);
    }


    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|unique:products,name,'.$request->up_id,
                'price' =>'required',
                'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed

            ],
            [
                'name.required' => 'Name is Required',
                'name.unique' => 'Product Already Exists',
                'price.required'=>'Price is Required',
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public');
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $product = Product::where('id', $request->up_id)->first();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $filePath;
        $product->save();

        //dd($product);
        return response()->json([
            'status'=>'success',
        ]);
    }

    public function deleteProduct()
    {

    }
}
