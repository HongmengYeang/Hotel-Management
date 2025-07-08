<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('roomType')->get();

        return view("page.room.index", compact('rooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $room_types = RoomType::all();

        return view("page.room.create", compact("room_types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            "room_number"   => $request->input("room_number"),
            "capacity"      => $request->input("capacity"),
            "floor"         => $request->input("floor"),
            "is_available"  => $request->input("is_available") == "available" ? 1 : 0,
            "description"   => $request->input("description"),
            "room_type_id"  => $request->input("room_type")
        ];

        Room::create($data);

        return redirect()->route('room.index')->with('success', 'Room created successfully.');
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
        $room_types = RoomType::all();

        $room = Room::find($id);

        return view("page.room.edit", compact('room', 'room_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'room_number'   => 'required|string|max:255',
            'capacity'      => 'required|integer|min:1',
            'floor'         => 'required|integer|min:0',
            'status'  => 'required|in:available,block',
            'description'   => 'nullable|string',
            'room_type'     => 'required|exists:room_type,id'
        ]);


        $data = [
            "room_number"   => $request->input("room_number"),
            "capacity"      => $request->input("capacity"),
            "floor"         => $request->input("floor"),
            "is_available"  => $request->input("status") == "available" ? 1 : 0,
            "description"   => $request->input("description"),
            "room_type_id"  => $request->input("room_type")
        ];


        $room = Room::findOrFail($id);
        $room->update($data);

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }
}
