<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include any necessary CSS and JavaScript files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            color: #333;
        }

        .navbar {
            background-color: #ff69b4;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: bold;
        }

        .card-text.display-3 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #ff69b4;
        }

        .table thead th {
            font-weight: bold;
            color: #fff;
            font-size: 1rem;
        }

        .table tbody tr:hover {
            background-color: #ffe4e1;
        }

        .btn {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            margin-right: 0.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .small {
            font-size: 0.8rem;
        }

        .table-responsive {
            max-height: 350px;
            overflow-y: auto;
        }

        .btn-primary.btn-sm {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
        }

        .form-control {
            border: 1px solid #ff69b4;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-dark">
        <a class="navbar-brand text-center" href="#">Lola</a>
    </nav>

    <!-- Main content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Include any necessary JavaScript files -->
    <!-- For example, you can include Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>

</html>
