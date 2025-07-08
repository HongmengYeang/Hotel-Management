<div class="main-menu">
    <div class="menu {{ Route::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </div>
    <div class="menu {{ Route::is('room.*') ? 'active' : '' }}">
        <a href="{{ route('room.index') }}">Room</a>
    </div>
    <div class="menu {{ Route::is('room_type.*') ? 'active' : '' }}">
        <a href="{{ route('room_type.index') }}">Room Type</a>
    </div>
    <div class="menu {{ Route::is('customer.*') ? 'active' : '' }}">
        <a href="{{ route('customer.index') }}">Customer</a>
    </div>
    <div class="menu {{ Route::is('service.*') ? 'active' : '' }}">
        <a href="{{ route('service.index') }}">Service</a>
    </div>
    <div class="menu {{ Route::is('booking.*') ? 'active' : '' }}">
        <a href="{{ route('booking.index') }}">Booking</a>
    </div>
</div>
