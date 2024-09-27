<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
      
    }

    public function create()
    {
        
        return view('admin.addNewProduct');
    }

     public function store(Request $request)
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
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg,webp'  // Add max size if necessary
        ]
    );


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
            return redirect()->route('dash')->with('message',"inserted successfully");
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
    public function edit( $id)
    {
        $myItem=Product::find($id);
        return view('admin.editProduct',compact('myItem'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validData=Validator::make(
            $request->all(),
            [
                'name'=>'required|string',
                
                'category' => 'required',
                'price' => 'required|numeric',
               
                'description' => 'required',
               

            ]
            );
            if($validData->fails()){
                // return redirect('/product/'.$id.'/edit')->with('errors',$validData->errors());
                echo $validData->errors();
                
            }else{
                if($request->hasFile('image')){
                    $fileName=$request->file('image')->getClientOriginalName();
                   $photoTOStore=$request->file('image')->storeAs('images/products',$fileName,'public');
                    
                    $photoToDelete=Product::where('id',$id)->first('image');
                    $imagePath=public_path().'/storage/images/products/'.$photoToDelete->image;

                }
                if(empty($request->image)){
                    $products=Product::where('id',$id)->update([
                        'name'=>$request->name,
                        'category'=>$request->category,
                        'price'=>$request->price,
                        
                        'description'=>$request->description,


                    ]);
                }else{

                    $products=Product::where('id',$id)->update([
                        'name'=>$request->name,
                        'category'=>$request->category,
                        'price'=>$request->price,
                        
                        'description'=>$request->description,
                        'image'=>$fileName,


                    ]);
                    if($products){
                        if(file_exists($imagePath)){
                            unlink($imagePath);
                        }
                        echo "updated successfully";
                    }

                
                }
                
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lastTime=Product::find($id);
        echo $lastTime->name;

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
