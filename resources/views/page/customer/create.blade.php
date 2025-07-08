@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Add Customer
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('customer.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>


                    <div class="form-group full-width">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="" disabled selected>-- Please select gender --</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>


                    <div class="form-group full-width">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                </div>


                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
@endsection
