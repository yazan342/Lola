<!-- resources/views/user/profile.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">User Profile</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $user->full_name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phone Number:</strong> {{ $user->phone_number }}</p>
                        <p><strong>image:</strong> <img src="{{ asset('images/' . $user->image) }}" alt="{{ $user->full_name }}" width="50" height="50" class="img-fluid">
                        </p>
                    </div>
                </div>
                <!-- Add more profile information as needed -->
            </div>
        </div>
    </div>
@endsection
