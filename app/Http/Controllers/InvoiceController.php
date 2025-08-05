<?php

namespace App\Http\Controllers;

use App\Contracts\CacheServiceInterface;
use App\Models\Invoice;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(private CacheServiceInterface $cache){}
    
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
        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'invoice_date' => $request->invoice_date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        auth()->user()->notify(new InvoicePaid($request->invoice_number));
        return response()->json(['message' => 'Invoice created successfully'], 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show($invoice)
    {
        $invoice = $this->cache->remember("invoice_{$invoice}", function () use ($invoice) {
            return Invoice::findOrFail($invoice);
        }, 60);

        return response()->json(['message'=> $invoice],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
