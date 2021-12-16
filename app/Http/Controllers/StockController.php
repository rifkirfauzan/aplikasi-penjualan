<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Stock;
use Exception;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $stock = Stock::with('Product')->get();
        $stock = Stock::with('Transaction')->orderBy('date_of_transaction','asc')->get();
        return view('stock.index',[
            'stocks'=>$stock,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        $transaction = Transaction::all();
        return view('stock.create',[
            'products'=>$product,
            'transactions'=>$transaction
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
        $stock = new Stock;
        $stock->stocks = $request->input('stocks');
        $stock->number_of_sellers = $request->input('number_of_sellers');
        $stock->name = $request->input('name');
        $stock->type = $request->input('type');
        $stock->date_of_transaction = $request->input('date_of_transaction');
        try{
            $stock->save();
            return redirect('/stock');
        }catch(Exception $e){
            return response()->json([
                'message' => 'Internal error',
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
        $stock = Stock::with('Product')->findOrFail($id);
        $stock = Stock::with('Transaction')->findOrFail($id);
        $product = Product::all();
        $transaction = Transaction::all();
        return view('stock.edit',[
            'stock' => $stock,
            'products' => $product,
            'transactions' => $transaction,
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
        $stock = Stock::with('Product')->findOrFail($id);
        $stock = Stock::with('Transaction')->findOrFail($id);
        $stock->stocks = $request->input('stocks');
        $stock->number_of_sellers = $request->input('number_of_sellers');
        $stock->name = $request->input('name');
        $stock->type = $request->input('type');
        $stock->date_of_transaction = $request->input('date_of_transaction');

        try{
            $stock->save();
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
            ]);
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
        $stock = Stock::with('Product')->findOrFail($id);
        $stock->delete();

        try{
            $stock->delete();
            return redirect('/guest');
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
