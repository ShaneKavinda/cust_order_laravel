<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\FreeIssue;
use Illuminate\Http\Request;

class FreeIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the purchase_product and free_product relationships
        $freeIssues = FreeIssue::with('purchaseProduct', 'freeProduct')->get();
        return view('free_issues.index', compact('freeIssues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new free issue
        $products = Product::all();
        return view('free_issues.create', ['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'purchase_product' => 'required',
            'free_quantity' => 'required',
            'purchase_quantity' => 'required',
            'lower_limit' => 'required',
            'upper_limit' => 'required'
        ]);

        // Assign the same value to free_product as purchase_product
        $request->merge(['free_product' => $request->input('purchase_product')]);

        // Create the FreeIssue
        FreeIssue::create($request->all());

        return redirect()->route('free_issues.index')
                        ->with('success','FreeIssue created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(FreeIssue $freeIssue)
    {
        // Return the view for showing the details of a free issue
        return view('free_issues.show', compact('freeIssue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FreeIssue $freeIssue)
    {
        $products = Product::all(); // Fetch all products from the database

        return view('free_issues.edit', compact('freeIssue', 'products'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FreeIssue $freeIssue)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'purchase_product' => 'required',
            'free_quantity' => 'required',
            'purchase_quantity' => 'required',
            'lower_limit' => 'required',
            'upper_limit' => 'required'
        ]);

        // Assign the same value to free_product as purchase_product
        $request->merge(['free_product' => $request->input('purchase_product')]);

        // Update the free issue
        $freeIssue->update($request->all());

        // Redirect to the index page with success message
        return redirect()->route('free_issues.index')
            ->with('success', 'Free Issue updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FreeIssue $freeIssue)
    {
        // Delete the free issue
        $freeIssue->delete();

        // Redirect to the index page with success message
        return redirect()->route('free_issues.index')
            ->with('success', 'Free Issue deleted successfully');
    }

    public function getFreeIssueByProduct($productId)
    {
        $freeIssue = FreeIssue::where('purchaseProduct', $productId)->first();
        return response()->json($freeIssue);
    }
    

}
