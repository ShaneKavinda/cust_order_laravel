<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::latest() -> paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create() {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'contact' => 'required|max:10'
        ]);

        // Generate a unique code
        $code = Str::uuid()->toString();

        // Create the customer with generated code
        Customer::create([
            'name' => $request->name,
            'code' => $code,
            'address' => $request->address,
            'contact' => $request->contact,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer Created Successfully');
    }

    public function show(Customer $customer){
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer){
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'contact' => 'required|max:10'
        ]);
    
        // Ensure the original code remains unchanged
        $data = $request->except('code');
    
        $customer->update($data);
    
        return redirect()->route('customers.index')
            ->with('success', 'Customer Updated Successfully');
    }
    

    public function destroy(Customer $customer){
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer Deleted Successfully');
    }
}
