<?php

namespace App\Http\Controllers;
use App\Models\Product1;
use Illuminate\Http\Request;

class API_Product1_Controller extends Controller
{
   public function getproduct1(){
    $products1=Product1::all();
    return response()->json($products1);
   }

   public function addproduct1(Request $request){
    $product1 = new Product1();														
    $product1->name = $request->input('name');							
    $product1->image = $request->input('image');
    $product1->description = $request->input('description');							
    $product1->price = intval($request->input('price'));													
    $product1->save();														
    return $product1;
   }
   public function uploadImage(Request $request)							
    {							
    // process image							
    if ($request->hasFile('uploadImage')) {							
    $file = $request->file('uploadImage');							
    $fileName = $file->getClientOriginalName();							
                                
    $file->move('source/image/product_one', $fileName);							
                                
    return response()->json(["message" => "ok"]);							
    } else return response()->json(["message" => "false"]);							
    }
}



