@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Edit Cake</h1>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Edit Cake</h2>
                        <form action="{{ route('cake.update', $cake->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Cake Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $cake->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="flavor">Flavor</label>
                                <input type="text" name="flavor" id="flavor" class="form-control" value="{{ $cake->flavor }}" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_people">Number of People</label>
                                <input type="number" name="number_of_people" id="number_of_people" class="form-control" value="{{ $cake->number_of_people }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $cake->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $cake->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Cake Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <img src="{{ asset('images/' . $cake->image) }}" alt="{{ $cake->name }}" width="100" class="img-fluid mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update Cake</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
