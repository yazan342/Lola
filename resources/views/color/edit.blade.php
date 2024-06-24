@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Edit Color</h1>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('color.update', $color->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="hex">Color Hex</label>
                                <input type="text" name="hex" id="hex" class="form-control" value="{{ $color->hex }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Color Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $color->price }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Color</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
