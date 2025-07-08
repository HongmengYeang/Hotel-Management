<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_rooms = Room::count();
        $total_alliable_rooms = Room::where('is_available', 1)->count();
        $total_booking_rooms = Booking::count();
        $customer = Customer::count();

        $sumToday = Payment::whereDate('payment_date', Carbon::today())
            ->sum('amount');

        $sumMonth = Payment::whereYear('payment_date', Carbon::now()->year)
            ->whereMonth('payment_date', Carbon::now()->month)
            ->sum('amount');

        // Get the last 5 booked customers
        $lastBookedCustomers = Booking::with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'name' => $booking->customer->name,
                    "email" => $booking->customer->email,
                    'booking_date' => $booking->created_at->format('Y-m-d'),
                    'payment' => Payment::where('booking_id', $booking->id)->sum('amount'),
                ];
            });

        return view('dashboard', compact('total_rooms', 'total_alliable_rooms', 'total_booking_rooms', 'customer', 'sumToday', 'sumMonth','lastBookedCustomers'));
    }
}
