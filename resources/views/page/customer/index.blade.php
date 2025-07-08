@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Customer
        </div>
        <div class="add-button">
            <a href="{{ route('customer.create') }}">
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
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>
                                    @if ($customer->gender == 1)
                                        Male
                                    @elseif ($customer->gender == 2)
                                        Female
                                    @else
                                        Unknown
                                    @endif
                                </td>

                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    <div class='action'>
                                        <a href="{{ route('customer.edit', $customer->id) }}" class="edit-btn">Edit</a>

                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"
                                                onclick="return confirm('Are you sure?')">Delete</button>
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
