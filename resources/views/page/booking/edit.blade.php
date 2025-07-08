@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Edit Booking
        </div>
        <div class="text-xl">
            <span class="me-4">
                Total :
            </span>
            <span id="total_payment">
                $ 0.00
            </span>
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">
            <form class="borrow-form" method="POST" action="{{ route('booking.update', $booking->id) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="customer_id">Customer</label>
                        <select id="customer_id" name="customer_id" required>
                            <option value="" disabled>-- Please select customer --</option>
                            @foreach ($customers as $index => $customer)
                                <option value="{{ $customer->id }}"
                                    {{ $booking->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="room_id">Room Number</label>
                        <select id="room_id" name="room_id" required>
                            <option value="" disabled>-- Please select room number --</option>
                            @foreach ($rooms as $index => $room)
                                <option value="{{ $room->id }}" data-price="{{ $room->roomType->price_per_night }}"
                                    {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="check_in_date">Check-in Date</label>
                        <input type="datetime-local" id="check_in_date" name="check_in_date"
                            value="{{ date('Y-m-d\TH:i', strtotime($booking->check_in_date)) }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="check_out_date">Check-out Date</label>
                        <input type="datetime-local" id="check_out_date" name="check_out_date"
                            value="{{ date('Y-m-d\TH:i', strtotime($booking->check_out_date)) }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="booking_date">Booking Date</label>
                        <input type="datetime-local" id="booking_date" name="booking_date"
                            value="{{ date('Y-m-d\TH:i', strtotime($booking->booking_date)) }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" value="{{ $booking->price }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="service">Add Service</label>
                        <div class="flex items-center gap-2 ">
                            <select id="service" name="service">
                                <option value="" disabled selected>-- Please select service --</option>
                                @foreach ($services as $index => $service)
                                    <option value="{{ $service->id }}" data-service='@json($service)'>
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>

                            <button style="margin:0px !important;" type="button" id="add_service">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="w-full">
                        <label for="service">Service</label>
                        <div class="main-table">
                            <div class="table-container" style="height: auto">
                                <table class="custom-table" id="table_service">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking->services as $index => $bookingService)
                                            <tr data-id="{{ $bookingService->service_id }}"
                                                data-price="{{ $bookingService->total_price }}">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $bookingService->service->service_name }}</td>
                                                <td class="service-price">
                                                    ${{ number_format($bookingService->total_price, 2) }}</td>
                                                <td>
                                                    <div class="flex items-center gap-2">
                                                        <button type="button" class="decrease"
                                                            style="padding: 5px;margin-top:0px"
                                                            data-id="{{ $bookingService->service_id }}">➖</button>
                                                        <span class="qty">{{ $bookingService->quantity }}</span>
                                                        <button type="button" class="increase"
                                                            data-id="{{ $bookingService->service_id }}"
                                                            style="padding: 5px;margin-top:0px">➕</button>
                                                    </div>
                                                    <input type="hidden" name="services[]"
                                                        value="{{ $bookingService->service_id }}">
                                                    <input type="hidden"
                                                        name="quantities[{{ $bookingService->service_id }}]"
                                                        value="{{ $bookingService->quantity }}" class="qty-input">
                                                </td>
                                                <td>{{ $bookingService->service->description }}</td>
                                                <td><button type="button" class="remove-btn"
                                                        data-id="{{ $bookingService->service_id }}"
                                                        style="margin-top: 0px;padding: 10px 20px;">✖</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="payment">Payment</label>
                        <input type="number" id="payment" name="payment"
                            value="{{ $booking->payments->first()->amount ?? 0 }}" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3">{{ $booking->bookingDetail->description }}</textarea>
                    </div>
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script>
        const roomSelect = document.getElementById('room_id');
        const priceInput = document.getElementById('price');
        const totalDisplay = document.getElementById('total_payment');
        const payment = document.getElementById("payment");
        // 🏨 Set room price when room is selected
        roomSelect.addEventListener('change', function() {
            const selectedOption = roomSelect.options[roomSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price') || 0);
            priceInput.value = price ? price : '';

            updateTotal();
        });

        // 🛎️ Add services and calculate total
        const addedServiceIds = [];
        const btnAddService = document.getElementById('add_service');
        const serviceSelect = document.getElementById('service');
        const serviceTableBody = document.querySelector('#table_service tbody');

        btnAddService.addEventListener('click', function() {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            if (!selectedOption || !selectedOption.value) {
                alert('Please select a service');
                return;
            }

            const serviceId = selectedOption.value;
            const serviceData = JSON.parse(selectedOption.getAttribute('data-service'));
            const existingRow = document.querySelector(`#table_service tbody tr[data-id="${serviceId}"]`);

            if (existingRow) {
                // Increase quantity
                const qtyCell = existingRow.querySelector('.qty');
                const qtyInput = existingRow.querySelector('.qty-input');
                let qty = parseInt(qtyCell.textContent);
                qty += 1;
                qtyCell.textContent = qty;
                qtyInput.value = qty;

                const priceCell = existingRow.querySelector('.service-price');
                const newTotal = qty * parseFloat(serviceData.price);
                priceCell.textContent = `$${newTotal.toFixed(2)}`;
                existingRow.setAttribute('data-price', newTotal);
            } else {
                // Create new row
                const row = document.createElement('tr');
                row.setAttribute('data-id', serviceId);
                row.setAttribute('data-price', serviceData.price);
                row.innerHTML = `
                        <td></td>
                        <td>${serviceData.service_name}</td>
                        <td class="service-price">$${parseFloat(serviceData.price).toFixed(2)}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <button type="button" class="decrease" data-id="${serviceId}" style="margin-top: 0px;padding: 5px;">➖</button>
                                <span class="qty">1</span>
                                <button type="button" class="increase" data-id="${serviceId}" style="margin-top: 0px;padding: 5px;">➕</button>
                                
                            </div>
                            <input type="hidden" name="services[]" value="${serviceId}">
                            <input type="hidden" name="quantities[${serviceId}]" value="1" class="qty-input">
                        </td>
                        <td>${serviceData.description}</td>
                        <td><button type="button" class="remove-btn" data-id="${serviceId}" style="margin-top: 0px;padding: 10px 20px;">✖</button></td>
                    `;
                serviceTableBody.appendChild(row);
            }

            updateServiceIndexes();
            updateTotal();
        });


        // 🗑️ Remove service and update total
        serviceTableBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const row = e.target.closest('tr');
                const serviceId = e.target.getAttribute('data-id');
                row.remove();

                const index = addedServiceIds.indexOf(serviceId);
                if (index !== -1) addedServiceIds.splice(index, 1);

                updateServiceIndexes();
                updateTotal();
            }
        });

        // 🔢 Update table index numbers
        function updateServiceIndexes() {
            const rows = document.querySelectorAll('#table_service tbody tr');
            rows.forEach((row, index) => {
                row.children[0].textContent = index + 1;
            });
        }

        // 💵 Calculate total (room + services)
        function updateTotal() {
            let total = 0;

            const roomOption = roomSelect.options[roomSelect.selectedIndex];
            const baseRoomPrice = parseFloat(roomOption?.getAttribute('data-price') || 0);

            const checkInVal = document.getElementById('check_in_date').value;
            const checkOutVal = document.getElementById('check_out_date').value;

            let roomTotal = 0;

            if (checkInVal && checkOutVal) {
                const checkIn = new Date(checkInVal);
                const checkOut = new Date(checkOutVal);

                const diffTime = checkOut - checkIn;
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Convert ms to days

                if (diffDays < 1) diffDays = 1; // Minimum 1 day

                roomTotal = baseRoomPrice * diffDays;
            } else {
                roomTotal = baseRoomPrice;
            }

            total += roomTotal;
            priceInput.value = roomTotal.toFixed(2); // Fill input box

            // Add all service prices
            const serviceRows = document.querySelectorAll('#table_service tbody tr');
            serviceRows.forEach(row => {
                const price = parseFloat(row.getAttribute('data-price') || 0);
                total += price;
            });

            priceInput.value = total.toFixed(2);
            payment.value = priceInput.value;
            totalDisplay.textContent = `$ ${total.toFixed(2)}`;
        }

        document.getElementById('check_in_date').addEventListener('change', updateTotal);
        document.getElementById('check_out_date').addEventListener('change', updateTotal);
        serviceTableBody.addEventListener('click', function(e) {
            const btn = e.target;
            const row = btn.closest('tr');
            if (!row) return;

            const serviceId = row.getAttribute('data-id');
            const pricePerUnit = parseFloat(row.getAttribute('data-price')) / parseInt(row.querySelector('.qty')
                .textContent);

            const qtySpan = row.querySelector('.qty');
            const qtyInput = row.querySelector('.qty-input');
            const priceCell = row.querySelector('.service-price');

            let qty = parseInt(qtySpan.textContent);

            // ➖ Minus button
            if (btn.classList.contains('decrease')) {
                if (qty <= 1) {
                    row.remove();
                } else {
                    qty -= 1;
                    qtySpan.textContent = qty;
                    qtyInput.value = qty;
                    const newTotal = pricePerUnit * qty;
                    priceCell.textContent = `$${newTotal.toFixed(2)}`;
                    row.setAttribute('data-price', newTotal);
                }
            }

            // ➕ Plus button
            if (btn.classList.contains('increase')) {
                qty += 1;
                qtySpan.textContent = qty;
                qtyInput.value = qty;
                const newTotal = pricePerUnit * qty;
                priceCell.textContent = `$${newTotal.toFixed(2)}`;
                row.setAttribute('data-price', newTotal);
            }

            // ✖ Remove button
            if (btn.classList.contains('remove-btn')) {
                row.remove();
            }

            updateServiceIndexes();
            updateTotal();
        });
        updateTotal();
    </script>
@endsection
