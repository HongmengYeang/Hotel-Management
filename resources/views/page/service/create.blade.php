@extends('layouts.app')
@section('body')
    <div class="header-form">
        <div class="title">
            Add service
        </div>
    </div>

    <div class="body-form">
        <div class="form-container">

            <form class="borrow-form" method="POST" action="{{ route('service.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="service_name">Service Name</label>
                        <input type="text" id="service_name" name="service_name" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
@endsection
