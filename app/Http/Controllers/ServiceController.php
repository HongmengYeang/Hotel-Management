<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view("page.service.index", compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
        ]);

        // Save the new service
        Service::create([
            'service_name'        => $validated['service_name'],
            'price'       => $validated['price'],
            'description' => $validated['description'] ?? null,
        ]);

        // Redirect back with success message
        return redirect()->route("service.index")->with('success', 'Service added successfully.');
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
        $service = Service::find($id);
        return view("page.service.edit", compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
        ]);

        // Find and update the service
        $service = Service::findOrFail($id);
        $service->update([
            'service_name' => $validated['service_name'],
            'price'       => $validated['price'],
            'description' => $validated['description'] ?? null,
        ]);

        // Redirect back with success message
        return redirect()->route('service.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        // $service->bookingServices()->delete();

        $service->delete();

        return redirect()->route("service.index")->with('success', 'Service deleted successfully.');
    }
}
