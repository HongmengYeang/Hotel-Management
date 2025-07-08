@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Service
        </div>
        <div class="add-button">
            <a href="{{ route('service.create') }}">
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
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($services as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{$service->service_name}}</td>
                                <td>{{ $service->price}} $</td>
                                <td>
                                    {{ $service->description }}
                                </td>
                                <td>
                                    <div class='action'>
                                        <a href="{{ route('service.edit', $service->id) }}" class="edit-btn">Edit</a>

                                        <form action="{{ route('service.destroy', $service->id) }}" method="POST"
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
