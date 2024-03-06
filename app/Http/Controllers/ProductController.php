<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request) {
        $validator = Validator::make($request->all(), [
           'product_name' => 'required',
           'product_description' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description
        ]);

        return response()->json(['message' => 'Продукт успешно создан', 'product' => $product], 201);
    }

    public static function deleteProduct(Product $product) {
        $product->delete();

        return response()->json(['message' => 'Продукт успешно удалён'], 201);
    }

    public function showProducts(){
        return Product::all();
    }

    public function updateProduct(Request $request, Product $product) {
        $product->update([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description
        ]);

        return response()->json(['message' => 'Продукт успешно изменён', 'product' => $product], 201);
    }
}
