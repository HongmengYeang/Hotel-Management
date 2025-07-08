@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Add Room
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('room.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="room_number">Room Number</label>
                        <input type="text" id="room_number" name="room_number" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" id="capacity" name="capacity" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="floor">Floor</label>
                        <input type="text" id="floor" name="floor">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <select id="room_type" name="room_type" required>
                            <option value="" disabled selected>-- Please select room type --</option>
                            @foreach ($room_types as $item)
                                <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label for="is_available">Status</label>
                        <select id="is_available" name="is_available" required>
                            <option value="available" selected>Available</option>
                            <option value="block">Block</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
@endsection
