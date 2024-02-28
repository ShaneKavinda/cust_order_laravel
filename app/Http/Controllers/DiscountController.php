<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::with('product')->get();
        return view('discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all products for the dropdown
        $products = Product::all();
        return view('discounts.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product' => 'required|exists:products,id',
            'discount' => 'required|min:0',
            'lower_limit' => 'required|integer|min:0',
            'upper_limit' => 'required|integer|min:0'
        ]);

        $discount = new Discount();
        $discount ->product_id = $validatedData['product'];
        $discount ->discount = $validatedData['discount'];
        $discount ->lower_limit = $validatedData['lower_limit'];
        $discount ->upper_limit = $validatedData['upper_limit'];
        $discount -> save();

        return redirect()->route('discounts.index')->with('success', 'discount added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $products = Product::all();

        return view('discounts.edit', compact('discount', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'product' => 'required|exists:products,id',
            'discount' => 'required|min:0',
            'lower_limit' => 'required|integer|min:0',
            'upper_limit' => 'required|integer|min:0'
        ]);

        $discount->update($request->all());

        return redirect()->route('discounts.index')->with('success', 'discount upated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'discount deleted successfully');
    }

    public function discountByProduct($productId, $quantity)
    {
        $discount = Discount::where('product_id', $productId)
                        ->where('lower_limit', '<=', $quantity)
                        ->where('upper_limit', '>=', $quantity)
                        ->first();

        return response()->json($discount);
    }
    
}
