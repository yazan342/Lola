@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Edit Topping</h1>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('topping.update', $topping->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Topping Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $topping->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Topping Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Topping Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $topping->price }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Topping</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
