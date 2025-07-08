@extends('layouts.app')

@section('body')
    <div class="header-form">
        <div class="title">
            Booking Information
        </div>

    </div>

    <div class="body-form">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="font-semibold">Customer:</p>
                    <p>{{ $booking->customer->name }}</p>
                </div>

                <div>
                    <p class="font-semibold">Room Number:</p>
                    <p>{{ $booking->room_number }}</p>
                </div>

                <div>
                    <p class="font-semibold">Booking Date:</p>
                    <p>{{ \Carbon\Carbon::parse($booking->bookingDetail->booking_date)->format('d-M-Y H:i') }}</p>
                </div>

                <div>
                    <p class="font-semibold">Check-In:</p>
                    <p>{{ \Carbon\Carbon::parse($booking->bookingDetail->check_in_date)->format('d-M-Y H:i') }}</p>
                </div>

                <div>
                    <p class="font-semibold">Check-Out:</p>
                    <p>{{ \Carbon\Carbon::parse($booking->bookingDetail->check_out_date)->format('d-M-Y H:i') }}</p>
                </div>

                <div>
                    <p class="font-semibold">Room Price:</p>
                    <p>$ {{ number_format($booking->bookingDetail->price, 2) }}</p>
                </div>
                <div>
                    <p class="font-semibold">Description:</p>
                    <p>{{$booking->bookingDetail->description}}</p>
                </div>
            </div>

            <hr class="my-4">

            <h3 class="text-xl font-semibold mb-2">Services</h3>
            @if ($booking->services->count())
                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Service</th>
                            <th class="px-4 py-2 border">Quantity</th>
                            <th class="px-4 py-2 border">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($booking->services as $index => $service)
                            <tr>
                                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $service->service->service_name ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $service->quantity }}</td>
                                <td class="px-4 py-2 border">$ {{ number_format($service->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No services added to this booking.</p>
            @endif

            <hr class="my-4">

            <h3 class="text-xl font-semibold mb-2">Payments</h3>
            @if ($booking->payments->count())
                <ul class="list-disc list-inside">
                    @foreach ($booking->payments as $payment)
                        <li>
                            $ {{ number_format($payment->amount, 2) }} -
                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-M-Y H:i') }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No payments recorded.</p>
            @endif
        </div>

    </div>
@endsection
