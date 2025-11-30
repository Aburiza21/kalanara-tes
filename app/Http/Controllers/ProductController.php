<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->search);
        //
        // dd('Hello');
        if($request->search != ''){
            $products = Product::where('title', 'like', '%'.$request->search.'%')->orWhere('description', 'like', '%'.$request->search.'%')->orWhere('price', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->paginate(10);

            // $product_summary = Product::where('title', 'like', '%'.$request->search.'%')->orWhere('description', 'like', '%'.$request->search.'%')->orWhere('price', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')->get();
        }else{
            $products = Product::orderBy('id', 'desc')->paginate(10);

            // $product_summary = Product::orderBy('id', 'desc')->get();
        }


        // dd($products);
        // Alert::alert('Title', 'Message', 'Type');
        return view('pages.products.index')->with(compact('products'));
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
        //
        // dd($request->all());

        // Validation


        try {
            Product::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            Alert::success('Success Title', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Success Title', 'Success Message');
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

        try {
            Product::where('id', $id)->update([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            Alert::success('Success Title', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Success Title', 'Success Message');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::where('id', $id)->delete();
            Alert::success('Success Title', 'Success Message');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Success Title', 'Success Message');
            return redirect()->back();
        }
    }
}
