@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Booking
        </div>
        <div class="add-button">
            <a href="{{ route('booking.create') }}">
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
                            <th>Customer Name</th>
                            <th>Room Number</th>
                            <th>Price</th>
                            <th>Check-In Date</th>
                            <th>Check-Out Date</th>
                            <th>Booking Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->room_number }}</td>
                                <td>$ {{ $booking->bookingDetail?->price ?? 0 }} </td>
                                <td>{{ $booking->bookingDetail?->check_in_date ?? '' }}</td>
                                <td>{{ $booking->bookingDetail?->check_out_date ?? '' }}</td>
                                <td>{{ $booking->bookingDetail?->booking_date ?? '' }}</td>
                                <td>
                                    <div class='action'>
                                        <a href="{{ route('booking.show', $booking->id) }}"
                                            class="text-sm bg-blue-500 hover:bg-blue-600 text-white  py-1 px-3 rounded-[0.4rem] me-2">
                                            Show
                                        </a>

                                        <a href="{{ route('booking.edit', $booking->id) }}" class="edit-btn">Edit</a>
                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST"
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
