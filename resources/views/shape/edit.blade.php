@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Edit Shape</h1>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('shape.update', $shape->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Shape Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $shape->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Shape Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Shape Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $shape->price }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Shape</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
