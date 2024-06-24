@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Orders</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title mb-4">All Orders</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>${{ $order->total_price }}</td>
                                    <td>
                                        <form action="{{ route('order.delete', $order->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm ml-2">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
