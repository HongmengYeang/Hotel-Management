<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingService;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bookings = Booking::with("bookingDetail")
            ->join("customer", "customer.id", "booking.customer_id")
            ->join("room", "room.id", "booking.room_id")
            ->select("booking.*", "room.room_number", "customer.name")
            ->orderBy("booking.created_at", "desc")
            ->get();
        
        return view("page.booking.index", compact("bookings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        $services = Service::all();
        $customers = Customer::all();
        return view("page.booking.create", compact('customers', 'rooms', "services"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $services = $request->input("services", []);
        $quantities = $request->input("quantities", []);
        $payment_amount = $request->input("payment", 0);

        
        $data = [
            "customer_id" => $request->input("customer_id"),
            "room_id" => $request->input("room_id"),
        ];
        $booking = Booking::create($data);
        
        if (!$booking) {
            return redirect()->back()->withErrors(['error' => 'Failed to create booking']);
        }
        $bookingDetailData = [
            "booking_id" => $booking->id,
            "booking_date" => $request->input("booking_date"),
            'check_in_date' => $request->input("check_in_date"),
            "check_out_date" => $request->input("check_out_date"),
            "price" => $request->input("price"),
            "description" => $request->input("description", "")
        ];
        $bookingDetail = BookingDetail::create($bookingDetailData);
        if (!$bookingDetail) {
            return redirect()->back()->withErrors(['error' => 'Failed to create booking detail']);
        }

        // ✅ Store booking services
        foreach ($services as $service_id) {
            $service = Service::find($service_id);
            $qty = $quantities[$service_id] ?? 1;

            if ($service) {
                BookingService::create([
                    "booking_id" => $booking->id,
                    "service_id" => $service->id,
                    "quantity" => $qty,
                    "total_price" => $qty * $service->price
                ]);
            }
        }

        // ✅ Store payment
        if ($payment_amount > 0) {
            Payment::create([
                "booking_id" => $booking->id,
                "amount" => $payment_amount,
                "payment_date" => Carbon::now(),
                "payment_method" => 1 // You can change this to dynamic later
            ]);
        }

        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with("customer", "services", "bookingDetail", "payments")
            ->join("room", "room.id", "booking.room_id")
            ->where("booking.id", $id)
            ->select("booking.*", "room.room_number")
            ->first();

        // dd($booking);

        return view("page.booking.show", compact("booking"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::with("customer", "services", "payments")->where("id", $id)->first();
        // dd($booking);
        $rooms = Room::all();
        $services = Service::all();
        $customers = Customer::all();
        return view("page.booking.edit", compact("booking", 'rooms', 'services', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $services = $request->input("services", []);
        $quantities = $request->input("quantities", []);
        $payment_amount = $request->input("payment", 0);

        // ✅ Find booking
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->withErrors(['error' => 'Booking not found']);
        }

        // ✅ Update booking
        $booking->update([
            "customer_id" => $request->input("customer_id"),
            "room_id" => $request->input("room_id"),
        ]);

        // ✅ Update or create booking detail
        $bookingDetailData = [
            "booking_id" => $booking->id,
            "booking_date" => $request->input("booking_date"),
            'check_in_date' => $request->input("check_in_date"),
            "check_out_date" => $request->input("check_out_date"),
            "price" => $request->input("price"),
            "description" => $request->input("description", "")
        ];

        $bookingDetail = BookingDetail::where('booking_id', $booking->id)->first();
        if ($bookingDetail) {
            $bookingDetail->update($bookingDetailData);
        } else {
            BookingDetail::create($bookingDetailData);
        }

        // ✅ Delete old booking services and re-insert
        BookingService::where('booking_id', $booking->id)->delete();

        foreach ($services as $service_id) {
            $service = Service::find($service_id);
            $qty = $quantities[$service_id] ?? 1;

            if ($service) {
                BookingService::create([
                    "booking_id" => $booking->id,
                    "service_id" => $service->id,
                    "quantity" => $qty,
                    "total_price" => $qty * $service->price
                ]);
            }
        }

        // ✅ Delete old payment and insert new one (optional)
        Payment::where("booking_id", $booking->id)->delete();
        if ($payment_amount > 0) {
            Payment::create([
                "booking_id" => $booking->id,
                "amount" => $payment_amount,
                "payment_date" => Carbon::now(),
                "payment_method" => 1 // Still hardcoded
            ]);
        }

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->withErrors(['error' => 'Booking not found']);
        }

        // ✅ Delete related payments
        $booking->payments()->delete();

        // ✅ Delete related booking services
        BookingService::where('booking_id', $booking->id)->delete();

        // ✅ Delete booking detail
        BookingDetail::where('booking_id', $booking->id)->delete();

        // ✅ Delete the booking itself
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
}
