@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Room
        </div>
        <div class="add-button">
            <a href="{{ route('room.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>Add</span>
            </a>
        </div>
    </div>

    <div class="body-form">
        <div class="main-table">
            <div class="table-container">
                <table class="custom-table" id="borrowTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Number</th>
                            <th>floor</th>
                            <th>Room Type</th>
                            <th>capacity</th>
                            <th>Room price</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($rooms as $index => $room)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->floor }}</td>
                                <td>{{ $room->roomType->type_name ?? '-' }}</td>
                                <td>{{ $room->capacity }}</td>
                                <td>{{ $room->roomType->price_per_night ?? '-' }} $</td>
                                <td>{{ $room->is_available == 1 ? 'Available' : 'Block' }}</td>
                                <td>
                                    {{ $room->description }}
                                </td>
                                <td>
                                    <div class='action'>
                                        <a href="{{ route('room.edit', $room->id) }}" class="edit-btn">Edit</a>

                                        <form action="{{ route('room.destroy', $room->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
