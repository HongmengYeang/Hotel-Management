<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view("page.customer.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("page.customer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'email'  => 'required|email|unique:customer,email',
            'phone'  => 'required|string|max:20',
        ]);

        // Save customer
        Customer::create($validatedData);

        // Redirect with success message
        return redirect()->route("customer.index")->with('success', 'Customer added successfully.');
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
        $customer = Customer::find($id);
        return view("page.customer.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $validatedData = $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required|in:1,2',
            'email'  => 'required|email|unique:customer,email,' . $id,
            'phone'  => 'required|string|max:20',
        ]);

        // Find customer and update
        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        // Redirect with success message
        return redirect()->route("customer.index")->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        // $customer->bookings()->delete();

        $customer->delete();

        return redirect()->route("customer.index")->with('success', 'Customer deleted successfully.');
    }
   
}
