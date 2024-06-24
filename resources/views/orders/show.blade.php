@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Order Details</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title mb-4">Order ID: {{ $order->id }}</h2>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="order-info bg-light p-4 rounded shadow-sm mb-4">
                            <h3 class="section-title mb-3">Order Information</h3>
                            <ul class="list-unstyled mb-0">
                                <li><strong>User:</strong> {{ $order->user->full_name }}</li>
                                <li><strong>Total Price:</strong> ${{ $order->total_price }}</li>
                                <li><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="order-items bg-light p-4 rounded shadow-sm">
                            <h3 class="section-title mb-3">Ordered Cakes</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cake Name</th>
                                            <th>Cake Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderCakes as $item)
                                            <tr>
                                                <td>{{ $item->cake->name }}</td>
                                                <td><img src="{{ asset('images/' . $item->cake->image) }}" alt="{{ $item->cake->name }}" width="50" height="50" class="img-fluid rounded"></td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h3 class="section-title mt-4 mb-3">Custom Cakes</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Flavor</th>
                                            <th>Shape</th>
                                            <th>Color</th>
                                            <th>Topping</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Text</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderCustomCakes as $item)
                                            <tr>
                                                <td>{{ $item->customCake->flavor->name }}</td>
                                                <td>{{ $item->customCake->shape->name }}</td>
                                                <td>{{ $item->customCake->color->hex }}</td>
                                                <td>{{ $item->customCake->topping->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>${{ $item->image }}</td>
                                                <td>${{ $item->text }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border: none;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #ff69b4;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .section-title {
            color: #333;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.2rem;
        }

        .order-info, .order-items {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .list-unstyled {
            padding-left: 0;
        }

        .list-unstyled li {
            list-style-type: none;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #ff69b4;
            color: #fff;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
@endsection
