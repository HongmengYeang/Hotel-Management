@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Add Room Type
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('room_type.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="type_name">Type Name</label>
                        <input type="text" id="type_name" name="type_name" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_night">Price Per Night</label>
                        <input type="number" id="price_per_night" name="price_per_night" required>
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
