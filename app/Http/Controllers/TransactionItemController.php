<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $product = Product::find($request->product);
            // dd($product);
            $transaction = Transaction::where('invoice', $request->invoice)->first();
            $transaction->update(
                [
                    'total' => $transaction->total + $product->price * $request->quantity,
                ]
            );

            // dd($transaction);

            $transaction_item = TransactionItem::create(
                [
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                ]
            );

            // dd($transaction);
            Alert::success('Success', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Error Message');
            return redirect()->back();
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
    public function destroy(string $id)
    {
        //
    }
}
