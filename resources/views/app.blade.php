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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).on('change', '.update-qty', function () {
            let $input = $(this); // The input field that triggered the change
            let cartId = $input.data('id');
            let itemId = $input.data('item-id');
            let newQty = $input.val();
            let token = "{{ csrf_token() }}"; // CSRF token
    
            $.ajax({
                url: "{{ route('keranjang.update') }}", // Route for updating
                type: "PATCH",
                data: {
                    _token: token,
                    id: cartId,
                    item_id: itemId,
                    qty: newQty
                },
                success: function (response) {
                    if (response.success) {
                        // Update the subtotal in the corresponding row
                        let price = parseFloat($input.closest('tr').find('td[data-price]').data('price')); // Get the item price
                        let newSubtotal = price * newQty;
    
                        // Format and display the new subtotal
                        $input.closest('tr').find('.subtotal').text('Rp ' + newSubtotal.toLocaleString('id-ID', {minimumFractionDigits: 0}));
                    } else {
                        alert('Failed to update quantity!');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 400) {
                        location.reload(); // Trigger reload to display the session message
                    } else {
                        alert('Something went wrong!');
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const searchBar = document.getElementById('search-bar');
            const itemsContainer = document.getElementById('items-container');
    
            function fetchItems(query = '') {
                fetch(`{{ route('transaksi.index') }}?query=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    itemsContainer.innerHTML = ''; // Clear previous items
    
                    data.items.forEach(item => {
                        const stockBadge = item.stock >= 100
                            ? `<span class="badge rounded-pill text-bg-success">Stok : ${item.stock}</span>`
                            : item.stock >= 50
                            ? `<span class="badge rounded-pill text-bg-warning">Stok : ${item.stock}</span>`
                            : item.stock >= 1
                            ? `<span class="badge rounded-pill text-bg-danger">Stok : ${item.stock}</span>`
                            : `<span class="badge rounded-pill text-bg-danger">Stok : Habis</span>`;
    
                        itemsContainer.innerHTML += `
                            <div class="col">
                                <div class="card h-100 border-1 border-dark shadow-lg">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                                        <img src="/images/items/${item.image}" class="card-img-top rounded" alt="Gambar Barang" style="object-fit: cover; width: 100px; height: 100px;">
                                    </div>
                                    <div class="card-body p-2">
                                        <h6 class="fw-semibold mb-1 text-center">${item.nameItem}</h6>
                                        <p class="text-muted small mb-2 text-center">
                                            <span class="badge text-bg-secondary">${item.category.nameCategory}</span> | 
                                            <span class="badge text-bg-dark">${item.brand && item.brand.nameBrand ? item.brand.nameBrand : 'No Brand'}</span>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-primary fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</span>
                                            ${stockBadge}
                                        </div>
                                    </div>
                                    <div class="card-footer p-2 bg-transparent border-0">
                                        <form action="{{ route('keranjang.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="${item.id}">
                                            <button type="submit" ${item.stock === 0 ? 'disabled' : ''} class="btn btn-outline-primary w-100 btn-sm">
                                                <i class="bi bi-cart-plus me-1"></i>Keranjang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                })
                .catch(error => console.error('Error fetching items:', error));
            }
    
            // Fetch all items on initial load
            fetchItems();
    
            // Fetch items on search input
            searchBar.addEventListener('input', function () {
                fetchItems(this.value);
            });
        });
    </script>
</body>

</html>