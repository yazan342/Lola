@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Dashboard</h1>

        <!-- Statistics Section -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Users</h2>
                        <p class="card-text text-center display-3">{{ $users->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Orders</h2>
                        <p class="card-text text-center display-3">{{ $orders->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Cakes</h2>
                        <p class="card-text text-center display-3">{{ $cakes->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div class="row mt-4" id="usersSection">
            <div class="col-md-12">
                <button class="btn btn-info mb-2" onclick="toggleSection('usersTable')">Users</button>
                <div class="card" id="usersTable">
                    <div class="card-body">
                        <h2 class="card-title">All Users</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mt-3">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                <a href="{{ route('user.profile', $user->id) }}" class="btn btn-primary btn-sm ml-2">View Profile</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($users) > 5)
                                <p class="text-muted small mt-2">Scroll to view more</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cakes Section -->
        <div class="row mt-4" id="cakesSection">
            <div class="col-md-12">
                <button class="btn btn-info mb-2" onclick="toggleSection('cakesTable')">Cakes</button>
                <div class="card" id="cakesTable">
                    <div class="card-body">
                        <h2 class="card-title">All Cakes</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mt-3">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Flavor</th>
                                        <th>Number of People</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cakes as $cake)
                                        <tr>
                                            <td><img src="{{ asset('images/' . $cake->image) }}" alt="{{ $cake->name }}" width="50" height="50" class="img-fluid rounded"></td>
                                            <td>{{ $cake->name }}</td>
                                            <td>{{ $cake->flavor }}</td>
                                            <td>{{ $cake->number_of_people }}</td>
                                            <td>${{ $cake->price }}</td>
                                            <td>
                                                <form action="{{ route('cake.delete', $cake->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                <a href="{{ route('cake.edit', $cake->id) }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($cakes) > 5)
                                <p class="text-muted small mt-2">Scroll to view more</p>
                            @endif
                        </div>
                        <button id="showCreateFormBtn" class="btn btn-success mt-4">Create New Cake</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createCakeModal" tabindex="-1" role="dialog" aria-labelledby="createCakeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCakeModalLabel">Create a New Cake</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cake.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Cake Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="flavor">Flavor</label>
                                <input type="text" name="flavor" id="flavor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_people">Number of People</label>
                                <input type="number" name="number_of_people" id="number_of_people" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Cake Image</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Create Cake</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="row mt-4" id="ordersSection">
            <div class="col-md-12">
                <button class="btn btn-info mb-2" onclick="toggleSection('ordersTable')">Orders</button>
                <div class="card" id="ordersTable">
                    <div class="card-body">
                        <h2 class="card-title">All Orders</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mt-3">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>User</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->full_name }}</td>
                                            <td>${{ $order->total_price }}</td>
                                            <td>
                                                <a href="{{ route('order.view', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                                <form action="{{ route('order.delete', $order->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($orders) > 5)
                                <p class="text-muted small mt-2">Scroll to view more</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Flavors Section -->
     <div class="row mt-4" id="flavorsSection">
        <div class="col-md-12">
            <button class="btn btn-info mb-2" onclick="toggleSection('flavorsTable')">Flavors</button>
            <div class="card" id="flavorsTable">
                <div class="card-body">
                    <h2 class="card-title">All Flavors</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($flavors as $flavor)
                                    <tr>
                                        <td>{{ $flavor->name }}</td>
                                        <td><img src="{{ asset('images/' . $flavor->image) }}" alt="{{ $flavor->name }}" width="50" height="50" class="img-fluid rounded"></td>
                                        <td>${{ $flavor->price }}</td>
                                        <td>
                                            <form action="{{ route('flavor.delete', $flavor->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="{{ route('flavor.edit', $flavor->id) }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($flavors) > 5)
                            <p class="text-muted small mt-2">Scroll to view more</p>
                        @endif
                    </div>
                    <button id="showCreateFlavorFormBtn" class="btn btn-success mt-4">Create New Flavor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Flavor Modal -->
    <div class="modal fade" id="createFlavorModal" tabindex="-1" role="dialog" aria-labelledby="createFlavorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFlavorModalLabel">Create a New Flavor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('flavor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="flavor_name">Flavor Name</label>
                            <input type="text" name="name" id="flavor_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="flavor_image">Flavor Image</label>
                            <input type="file" name="image" id="flavor_image" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="flavor_price">Flavor Price</label>
                            <input type="text" name="price" id="flavor_price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Create Flavor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Shapes Section -->
    <div class="row mt-4" id="shapesSection">
        <div class="col-md-12">
            <button class="btn btn-info mb-2" onclick="toggleSection('shapesTable')">Shapes</button>
            <div class="card" id="shapesTable">
                <div class="card-body">
                    <h2 class="card-title">All Shapes</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shapes as $shape)
                                    <tr>
                                        <td>{{ $shape->name }}</td>
                                        <td><img src="{{ asset('images/' . $shape->image) }}" alt="{{ $shape->name }}" width="50" height="50" class="img-fluid rounded"></td>
                                        <td>${{ $shape->price }}</td>
                                        <td>
                                            <form action="{{ route('shape.delete', $shape->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="{{ route('shape.edit', $shape->id) }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($shapes) > 5)
                            <p class="text-muted small mt-2">Scroll to view more</p>
                        @endif
                    </div>
                    <button id="showCreateShapeFormBtn" class="btn btn-success mt-4">Create New Shape</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createShapeModal" tabindex="-1" role="dialog" aria-labelledby="createShapeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createShapeModalLabel">Create a New Shape</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('shape.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="shape_name">Shape Name</label>
                            <input type="text" name="name" id="shape_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="shape_image">Shape Image</label>
                            <input type="file" name="image" id="shape_image" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="shape_price">Shape Price</label>
                            <input type="text" name="price" id="shape_price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Create Shape</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Toppings Section -->
     <div class="row mt-4" id="toppingsSection">
        <div class="col-md-12">
            <button class="btn btn-info mb-2" onclick="toggleSection('toppingsTable')">Toppings</button>
            <div class="card" id="toppingsTable">
                <div class="card-body">
                    <h2 class="card-title">All Toppings</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($toppings as $topping)
                                    <tr>
                                        <td>{{ $topping->name }}</td>
                                        <td><img src="{{ asset('images/' . $topping->image) }}" alt="{{ $topping->name }}" width="50" height="50" class="img-fluid rounded"></td>
                                        <td>${{ $topping->price }}</td>
                                        <td>
                                            <form action="{{ route('topping.delete', $topping->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="{{ route('topping.edit', $topping->id) }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($toppings) > 5)
                            <p class="text-muted small mt-2">Scroll to view more</p>
                        @endif
                    </div>
                    <button id="showCreateToppingFormBtn" class="btn btn-success mt-4">Create New Topping</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createToppingModal" tabindex="-1" role="dialog" aria-labelledby="createToppingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createToppingModalLabel">Create a New Topping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('topping.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="topping_name">Topping Name</label>
                            <input type="text" name="name" id="topping_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="topping_image">Topping Image</label>
                            <input type="file" name="image" id="topping_image" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="topping_price">Topping Price</label>
                            <input type="text" name="price" id="topping_price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Create Topping</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



     <!-- Color Section -->
     <div class="row mt-4" id="colorsSection">
        <div class="col-md-12">
            <button class="btn btn-info mb-2" onclick="toggleSection('colorsTable')">Colors</button>
            <div class="card" id="colorsTable">
                <div class="card-body">
                    <h2 class="card-title">All Colors</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Hex</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->hex }}</td>
                                        <td>${{ $color->price }}</td>
                                        <td>
                                            <form action="{{ route('color.delete', $color->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="{{ route('color.edit', $color->id) }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($colors) > 5)
                            <p class="text-muted small mt-2">Scroll to view more</p>
                        @endif
                    </div>
                    <button id="showCreateColorFormBtn" class="btn btn-success mt-4">Create New Color</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createColorModal" tabindex="-1" role="dialog" aria-labelledby="createColorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createColorModalLabel">Create a New Color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('color.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="color_hex">Color Hex</label>
                            <input type="text" name="hex" id="color_hex" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="color_price">Color Price</label>
                            <input type="text" name="price" id="color_price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Create Color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




</div>



@endsection

@section('scripts')
    <!-- Include jQuery and Bootstrap JS for toggle functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSection(sectionId) {
            $('#' + sectionId).toggle();
        }

        document.getElementById('showCreateFormBtn').addEventListener('click', function() {
            $('#createCakeModal').modal('show');
        });

        document.getElementById('showCreateFlavorFormBtn').addEventListener('click', function() {
            $('#createFlavorModal').modal('show');
        });

        document.getElementById('showCreateShapeFormBtn').addEventListener('click', function() {
            $('#createShapeModal').modal('show');
        });

        document.getElementById('showCreateToppingFormBtn').addEventListener('click', function() {
            $('#createToppingModal').modal('show');
        });


        document.getElementById('showCreateColorFormBtn').addEventListener('click', function() {
            $('#createColorModal').modal('show');
        });
    </script>
@endsection
