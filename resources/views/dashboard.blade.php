@extends('layouts.app')

@section('body')
    <main class="bg-white rounded-2xl p-6 shadow-md  font-sans overflow-auto max-h-[83vh]">
        <h1 class="text-2xl font-semibold mb-2">Welcome to the Dashboard</h1>

        {{-- Primary Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ([['label' => 'Total Rooms', 'value' => $total_rooms, 'color' => 'blue', 'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16'], ['label' => 'Available Rooms', 'value' => $total_alliable_rooms, 'color' => 'green', 'icon' => 'M9 12l2 2 4-4m-7 9h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z'], ['label' => 'Total Bookings', 'value' => $total_booking_rooms, 'color' => 'purple', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'], ['label' => 'Customers', 'value' => $customer, 'color' => 'yellow', 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13 0a4 4 0 00-3-3.13 4 4 0 00-6 0 4 4 0 00-3 3.13m6-6a4 4 0 100-8 4 4 0 000 8z']] as $card)
                <div class="bg-gray-100 hover:bg-blue-100 transition rounded-xl p-5 shadow text-center">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-{{ $card['color'] }}-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700 mb-1">{{ $card['label'] }}</h2>
                    <p class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Income Stats (50% width each) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            @foreach ([['label' => 'Income Today', 'value' => '$ ' . number_format($sumToday, 2), 'color' => 'emerald', 'icon' => 'M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3zm0 8c1.657 0 3-1.343 3-3H9c0 1.657 1.343 3 3 3zM12 3v2m0 14v2m9-9h2M3 12H1'], ['label' => 'Income This Month', 'value' => '$ ' . number_format($sumMonth, 2), 'color' => 'indigo', 'icon' => 'M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3zm0 8c1.657 0 3-1.343 3-3H9c0 1.657 1.343 3 3 3zM12 3v2m0 14v2m9-9h2M3 12H1']] as $card)
                <div class="bg-gray-100 hover:bg-blue-100 transition rounded-xl p-5 shadow text-center">
                    <div class="flex justify-center mb-2">
                        <svg class="w-8 h-8 text-{{ $card['color'] }}-600" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-medium text-gray-700 mb-1">{{ $card['label'] }}</h2>
                    <p class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Last 5 Customers --}}
        <div class="mt-5">
            <h2 class="text-xl font-semibold mb-4">Last 5 Booked Customers</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-xl shadow-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm uppercase text-left">
                            <th class="py-3 px-5">Name</th>
                            <th class="py-3 px-5">Email</th>
                            <th class="py-3 px-5">Check-in Date</th>
                            <th class="py-3 px-5 text-right">Payment</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($lastBookedCustomers as $cus)
                            <tr class="border-t">
                                <td class="py-3 px-5">{{ $cus['name'] }}</td>
                                <td class="py-3 px-5">{{ $cus['email'] }}</td>
                                <td class="py-3 px-5 min-w-[100px]">
                                    {{ \Carbon\Carbon::parse($cus['booking_date'])->format('d/m/Y') }}
                                </td>

                                <td class="py-3 px-5 text-right text-green-600 font-bold">$
                                    {{ number_format($cus['payment'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
