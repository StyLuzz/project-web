<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS (Opsional) -->
    <style>
        .hero-section {
            background: url('https://images.unsplash.com/photo-1555529669-e69e7aa0ba9e?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 8rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        .product-card-img {
            height: 250px;
            object-fit: cover;
        }
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .quantity-input {
            width: 70px;
        }
    </style>
</head>
<body>

    @include('navbar')
    @yield('content')
    <x-footer></x-footer>

    <!-- Bootstrap JS Bundle (termasuk Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
