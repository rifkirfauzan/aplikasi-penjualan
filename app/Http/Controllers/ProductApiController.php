<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductApiController extends Controller
{    
   
    public function index()
    {
        
        $products = Product::get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data product',
            'data'    => $products
        ], 200);

    }
    
   
    public function show($id)
    {
        $products = Product::findOrfail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail data product',
            'data'    => $products
        ], 200);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'type' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $products = Product::create([
            'name'     => $request->name,
            'type'   => $request->type
        ]);

        if($products) {

            return response()->json([
                'success' => true,
                'message' => 'Data product berhasil disimpan',
                'data'    => $products
            ], 201);

        } 

        return response()->json([
            'success' => false,
            'message' => 'Data product gagal disimpan',
        ], 409);

    }
    
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $products = Product::findOrFail($product->id);

        if($products) {

            $products->update([
                'name'     => $request->name,
                'type'   => $request->type
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data product berhasil diupdate!',
                'data'    => $products
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data product tidak ditemukan',
        ], 404);

    }
    
    public function destroy($id)
    {
        $products = Product::findOrfail($id);

        if($products) {

            $products->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data product berhasil dihapus!',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data product tidak ditemukan!',
        ], 404);
    }
}