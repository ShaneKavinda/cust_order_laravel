<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all orders with their related customer information
        $orders = Order::with('customer')->get();

        // Pass the orders data to the view
        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        // Fetch all customers to populate the dropdown
        $customers = Customer::all();
        
        // Fetch all products to display in the order form
        $products = Product::all();
        $productPrices = Product::pluck('price', 'id')->toArray();
        return view('orders.create', compact('customers', 'products', 'productPrices'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'net_amount' => 'required|numeric|min:0',
        ]);

        // Create the order
        $order = new Order();
        $order->customer_id = $validatedData['customer'];
        $order->net_amount = $validatedData['net_amount'];
        $order->order_date = now()->toDateString(); // Set order_date to current date
        $order->order_time = now()->toTimeString(); // Set order_time to current time
        $order->save();

        // Create order products
        foreach ($validatedData['products'] as $productData) {
            $product = Product::find($productData['product_id']);
            $order->products()->attach($productData['product_id'], [
                'amount' => $product->price * $productData['quantity'],
                'free' => $productData['free'] ?? 0, // Assuming 'free' field is nullable
                'quantity' => $productData['quantity'] + $productData['free'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }



    public function show(Order $order)
    {
        // Load the associated order products with the order
        $order->load('products');

        return view('orders.show', ['order' => $order]);
    }
}
