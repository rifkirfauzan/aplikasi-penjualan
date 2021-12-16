<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TransactionApiController extends Controller
{    
   
    public function index()
    {
        
        $transactions = Transaction::get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data Transaction',
            'data'    => $transactions
        ], 200);

    }
    
   
    public function show($id)
    {
        $transactions = Transaction::findOrfail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail data Transaction',
            'data'    => $transactions
        ], 200);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_of_transaction'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transactions = Transaction::create([
            'date_of_transaction'     => $request->date_of_transaction
        ]);

        if($transactions) {

            return response()->json([
                'success' => true,
                'message' => 'Data Transaction berhasil disimpan',
                'data'    => $transactions
            ], 201);

        } 

        return response()->json([
            'success' => false,
            'message' => 'Data Transaction gagal disimpan',
        ], 409);

    }
    
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'date_of_transaction'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transactions = Transaction::findOrFail($transaction->id);

        if($transactions) {

            $transactions->update([
                'date_of_transaction'     => $request->date_of_transaction
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Transaction berhasil diupdate!',
                'data'    => $transactions
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data Transaction tidak ditemukan',
        ], 404);

    }
    
    public function destroy($id)
    {
        $transactions = Transaction::findOrfail($id);

        if($transactions) {

            $transactions->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Transaction berhasil dihapus!',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Data Transaction tidak ditemukan!',
        ], 404);
    }
}