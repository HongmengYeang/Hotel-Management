@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Room Type
        </div>
        <div class="add-button">
            <a href="{{ route('room_type.create') }}">
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
                            <th>Type Name</th>
                            <th>Price Per Night</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($room_types as $index => $room_type)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{$room_type->type_name}}</td>
                                <td>{{ $room_type->price_per_night ?? '-' }} $</td>
                                <td>
                                    {{ $room_type->description }}
                                </td>
                                <td>
                                    <div class='action'>
                                        <a href="{{ route('room_type.edit', $room_type->id) }}" class="edit-btn">Edit</a>

                                        <form action="{{ route('room_type.destroy', $room_type->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
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
