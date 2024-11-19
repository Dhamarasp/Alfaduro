<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alfaduro</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .product-image {
            width: 65px;
            height: 65px;
            object-fit: cover;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="p-5 flex-grow-1">
        <div class="container">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>