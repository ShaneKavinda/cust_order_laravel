<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest() -> paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Search for a given product in the database
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('q');

        // Perform the search query to retrieve matching products
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->get();

        // Format the data as JSON and return it
        return response()->json($products);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'expiry_date' => 'nullable',
        ]);

        // Generate a unique code
        $code = Str::uuid()->toString();

        // Create the product with generated code
        Product::create([
            'name' => $request->name,
            'code' => $code,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product Created Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'expiry_date' => 'nullable'
        ]);
    
        // Ensure the original code remains unchanged
        $data = $request->except('code');
    
        $product->update($data);
    
        return redirect()->route('products.index')
            ->with('success', 'Product Updated Successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
