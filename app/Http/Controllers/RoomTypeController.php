<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $room_types = RoomType::all();
        return view("page.roomType.index", compact('room_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("page.roomType.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name'        => 'required|string|max:255',
            'price_per_night'  => 'required|numeric|min:0',
            'description'      => 'nullable|string',
        ]);

        $data = [
            "type_name" => $request->input("type_name"),
            "price_per_night" => $request->input("price_per_night"),
            "description" => $request->input("description")
        ];
        RoomType::create($data);

        return redirect()->route("room_type.index")->with('success', "create room type success");
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
        $room_type = RoomType::find($id);

        return view("page.roomType.edit", compact('room_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'type_name'        => 'required|string|max:255',
            'price_per_night'  => 'required|numeric|min:0',
            'description'      => 'nullable|string',
        ]);

        $room_type = RoomType::findOrFail($id); // safer than find()

        $room_type->update([
            'type_name'        => $request->input('type_name'),
            'price_per_night'  => $request->input('price_per_night'),
            'description'      => $request->input('description'),
        ]);

        return redirect()->route('room_type.index')->with('success', 'Room type updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room_type = RoomType::findOrFail($id);

        if ($room_type->rooms()->count() > 0) {
            return redirect()->route('room_type.index')->with('error', 'Cannot delete: This room type is in use.');
        }

        $room_type->delete();

        return redirect()->route('room_type.index')->with('success', 'Room type deleted successfully.');
    }
}
