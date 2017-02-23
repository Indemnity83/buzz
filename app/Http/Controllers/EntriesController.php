<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Product;
use Illuminate\Http\Request;

class EntriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = request()->user()->diary();

        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('entries.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer',
            'product_id' => 'required|exists:products,id',
            'consumed_at' => 'required|date',
        ]);

        $request->user()->log($request->all());

        return redirect(route('entries.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        $products = Product::all();

        return view('entries.edit', compact('entry', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $this->validate($request, [
            'quantity' => 'required|integer',
            'product_id' => 'required|exists:products,id',
            'consumed_at' => 'required|date',
        ]);

        $entry->update($request->all());

        return redirect(route('entries.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();

        return redirect(route('entries.index'));
    }
}
