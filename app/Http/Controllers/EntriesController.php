<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Pagination\DatePaginator;
use Illuminate\Pagination\Paginator;
use InvalidArgumentException;

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
    public function index(Request $request)
    {
        try {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('date'))->startOfDay();
        } catch (InvalidArgumentException $e) {
            $date = Carbon::today();
        }

        if($date->copy()->greaterThan(Carbon::today())) {
            return redirect(route('entries.index', ['date' => Carbon::today()->format('Y-m-d')]));
        }

        $links = [
            'previous' => route('entries.index', ['date' => $date->copy()->subDay()->format('Y-m-d')]),
            'next' => route('entries.index', ['date' => $date->copy()->addDay()->format('Y-m-d')]),
            'next-disabled' => $date->copy()->greaterThanOrEqualTo(Carbon::today()),
            'today' => route('entries.index', ['date' => Carbon::today()->format('Y-m-d')]),
            'page' => $date->format('l, F d, Y'),
        ];

        $entries = request()
            ->user()
            ->entries()
            ->whereDate('consumed_at', $date->format('Y-m-d'))
            ->with('product', 'user')
            ->orderBy('consumed_at', 'desc')
            ->get();

        return view('entries.index', compact('entries', 'links'));
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
