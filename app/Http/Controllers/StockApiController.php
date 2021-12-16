<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StockApiController extends Controller
{    
   
    public function index()
    {
        $stocks = Stock::with('Product')->get();
        $stocks = Stock::with('Transaction')->orderBy('date_of_transaction','asc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data stock',
            'data'    => $stocks
        ], 200);

    }
    
   
    public function show($id)
    {
        $stocks = Stock::with('Product')->findOrFail($id);
        $stocks = Stock::with('Transaction')->findOrFail($id);
        $products = Product::all();
        $transactions = Transaction::all();
        return response()->json([
            'success' => true,
            'message' => 'Detail data stock',
            'data'    => $products,
            'data'    => $stocks,
            'data'    => $transactions
        ], 200);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'stocks'   => 'required',
            'number_of_sellers' => 'required',
            'name' => 'required',
            'type' => 'required',
            'date_of_transaction' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $stocks = Stock::create([
            'stocks'     => $request->stocks,
            'number_of_sellers'   => $request->number_of_sellers,
            'name'   => $request->name,
            'type'   => $request->type,
            'date_of_transaction'   => $request->date_of_transaction,
        ]);

        if($stocks) {

            return response()->json([
                'success' => true,
                'message' => 'Data stocks berhasil disimpan',
                'data'    => $stocks
            ], 201);

        } 

        return response()->json([
            'success' => false,
            'message' => 'Data stocks gagal disimpan',
        ], 409);

    }
    
    public function update(Request $request, Stock $stock)
    {
        $validator = Validator::make($request->all(), [
            'stocks'   => 'required',
            'number_of_sellers' => 'required',
            'name' => 'required',
            'type' => 'required',
            'date_of_transaction' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $stocks = Stock::findOrFail($stock->id);

        if($stocks) {

            $stocks->update([
                'stocks'     => $request->stocks,
                'number_of_sellers'   => $request->number_of_sellers,
                'name'   => $request->name,
                'type'   => $request->type,
                'date_of_transaction'   => $request->date_of_transaction,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data stock berhasil diupdate!',
                'data'    => $stocks
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data stock tidak ditemukan',
        ], 404);

    }
    
    public function destroy($id)
    {
        $stocks = Stock::findOrfail($id);

        if($stocks) {

            $stocks->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data stock berhasil dihapus!',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data stock tidak ditemukan!',
        ], 404);
    }
}