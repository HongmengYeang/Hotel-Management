@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Update Room
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('room.update', $room->id) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="room_number">Room Number</label>
                        <input type="text" id="room_number" value="{{ $room->room_number }}" name="room_number" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" id="capacity" name="capacity" required value="{{ $room->capacity }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="floor">Floor</label>
                        <input type="text" id="floor" name="floor" value="{{ $room->floor }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <select id="room_type" name="room_type" required>
                            <option value="" disabled>-- Please select room type --</option>
                            @foreach ($room_types as $item)
                                <option value="{{ $item->id }}"
                                    {{ $room->room_type_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->type_name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="available" {{ $room->is_available == 1 ? 'selected' : '' }}>Available</option>
                            <option value="block" {{ $room->is_available == 0 ? 'selected' : '' }}>Block</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3">{{ $room->description }}</textarea>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
@endsection
