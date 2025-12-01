<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'min:3'
        ]);

        if ($validator->fails()) {
            // dd($validator->errors()->messages());
            Alert::warning('Gagal', 'Input Tidak Valid');
        }

        // dd($request->search);
        //
        // dd('Hello');
        if($request->search != ''){
            $transactions = Transaction::where('invoice', 'like', '%'.$request->search.'%')->orWhere('total', 'like', '%'.$request->search.'%')->orWhere('pay', 'like', '%'.$request->search.'%')->orWhere('return', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->paginate(10);

            // $product_summary = Product::where('title', 'like', '%'.$request->search.'%')->orWhere('description', 'like', '%'.$request->search.'%')->orWhere('price', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->get();
        }else{
            $transactions = Transaction::orderBy('id', 'desc')->paginate(10);

            // $product_summary = Product::orderBy('id', 'desc')->get();
        }

        $products = Product::all();

        // dd(date(time()));
        $transaction = Transaction::latest()->first();
        // dd($transaction);
        try {
            if($transaction->return < 0){
            $transaction = Transaction::create(
                [
                    'user_id' => Auth::user()->id,
                    'invoice' => date(time()).Transaction::count(),
                    'total' => 0,
                    'pay' => 0,
                    'return' => 0
                ]
            );
        }
        } catch (\Throwable $th) {
            //throw $th;
            $transaction = Transaction::create(
                [
                    'user_id' => Auth::user()->id,
                    'invoice' => date(time()).Transaction::count(),
                    'total' => 0,
                    'pay' => 0,
                    'return' => 0
                ]
            );

        }
        // dd($invoice);

        // dd($transaction);
        // Alert::alert('Title', 'Message', 'Type');
        return view('pages.transactions.index')->with(compact('transactions', 'transaction', 'products'));
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
        try {
            $transaction = Transaction::create(
                [
                    'user_id' => Auth::user()->id,
                    'invoice' => date(time()).Transaction::count(),
                    'total' => 0,
                    'pay' => 0,
                    'return' => 0
                ]
            );
            Alert::success('Success', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Error Message');
            return redirect()->back();
        }
        // dd($invoice);

        // dd($transaction);
        // Alert::alert('Title', 'Message', 'Type');
        return redirect()->back()->with(compact('transaction'));
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
        // dd($request->all());

        try {
            $transaction = Transaction::where('id', $id)->first();
            $transaction->update([
                'pay' => $request->pay,
                'return' => ($transaction->total - $request->pay),
            ]);
            Alert::success('Success', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Error Message');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Transaction::where('id', $id)->delete();
            Alert::success('Success', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Error Message');
            return redirect()->back();
        }
    }
}
