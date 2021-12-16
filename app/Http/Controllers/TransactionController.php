<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Exception;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::get();
        return view('transaction.index',[
            'transactions'=>$transaction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction = Transaction::all();
        return view('transaction.create',[
            'transaction' => $transaction
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->date_of_transaction = $request->input('date_of_transaction');
        try{
            $transaction->save();
            return redirect('/transaction');
        }catch(exception $e){
            return response()->json([
                'message' => 'Internal Server Error',
                'code' => '500',
                'error' => true,
                'errors' => $e,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('transaction.edit',[
            'transaction'=>$transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->date_of_transaction = $request->input('date_of_transaction');

        try{
            $transaction->save();
            // return redirect('/subcompany');
            return response()->json([
                'message' => 'OK',
                'code' => '200',
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Internal error',
                'code' => '500',
                'error' => true,
                'errors' => $e,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        try{
            $transaction->delete();
            return redirect('/transaction');
            dd(package);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Internal error',
                'code' => '500',
                'error' => true,
                'errors' => $e,
            ]);
        }
    }
}
