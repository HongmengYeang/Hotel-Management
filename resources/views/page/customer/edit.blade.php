@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Update customer
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('customer.update', $customer->id) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required value="{{ $customer->name }}">
                    </div>


                    <div class="form-group full-width">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled {{ $customer->gender == null ? 'selected' : '' }}>-- Please select gender --</option>
                            <option value="1" {{ $customer->gender == 1 ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ $customer->gender == 2 ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>


                    <div class="form-group full-width">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required value="{{ $customer->email }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" required value="{{ $customer->phone }}">
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
@endsection
