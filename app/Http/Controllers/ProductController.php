<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.addNewProduct');
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    // Validate input
    $validData = Validator::make(
        $request->all(),
        [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg|max:2048'  // Add max size if necessary
        ]
    );

    // Check if validation fails
    if ($validData->fails()) {
        return response()->json([
            'msg' => "Please enter valid data",
            'errors' => $validData->errors()  // You can return the error messages
        ]);
    } else {
        // Handle file upload
        if ($request->hasFile('image')) {
            $fileName=$request->file('image')->getClientOriginalName();

            // Store the file and get the path
             $filePath = $request->file('image')->storeAs('/images/products',$fileName , 'public');
             
        } else {
            return response()->json([
                'msg' => "Image is required",
                
            ]);
        }

        // Create the product
        $insertedData = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->quantity,
            'description' => $request->description,
            'image' => $fileName,  // Store the file path
        ]);

        if ($insertedData) {
            return response()->json([
                'msg' => "Product created successfully",
                'name'=>$fileName,
            ]);
        } else {
            return response()->json([
                'msg' => "Couldn't store the product",
            ]);
        }
    }
}

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lastTime=Product::find($id);
        if(!$lastTime){
            return response()->json([
                'msg' => "Product not found",
            ]);
        }else{
            
            
                $imagePath=public_path().'/storage/images/products/'.$lastTime->image;
                
                if(file_exists($imagePath)){
                   unlink($imagePath);
                }
            
        
        $dataToDelete=Product::where('id',$id)->delete();
        if($dataToDelete){
            return response()->json([
                'msg' => "Product deleted successfully",
                'id'=>$id,
                'file'=>$imagePath,
            ]);
        }else{
            return response()->json([
                'msg' => "Product couldn't deleted ",
                'id'=>$id,
            ]);
        }
    }
    }
}