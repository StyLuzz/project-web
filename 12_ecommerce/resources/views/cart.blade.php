@extends('layout')
@section('content')
@section('title', 'Cart - TokoOnline')
    <!-- 2. SHOPPING CART SECTION -->
    <main class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4"><i class="bi bi-cart-check"></i> Keranjang Belanja Anda</h1>
                
                <!-- Tabel Keranjang Belanja -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col" class="text-end">Harga</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="text-end">Subtotal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item Keranjang 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://placehold.co/600x400/5e81ac/ffffff?text=Laptop" alt="Produk Laptop" class="img-fluid rounded product-image me-3">
                                        <div>
                                            <h6 class="mb-0">Laptop Ultrabook Generasi 12</h6>
                                            <small class="text-muted">Kategori: Elektronik</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">Rp 12.500.000</td>
                                <td class="text-center">
                                    <input type="number" class="form-control quantity-input mx-auto" value="1" min="1">
                                </td>
                                <td class="text-end fw-bold">Rp 12.500.000</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>

                            <!-- Item Keranjang 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://placehold.co/600x400/a3be8c/ffffff?text=Sepatu" alt="Produk Sepatu" class="img-fluid rounded product-image me-3">
                                        <div>
                                            <h6 class="mb-0">Sepatu Lari Pro-Series</h6>
                                            <small class="text-muted">Kategori: Fashion</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">Rp 799.000</td>
                                <td class="text-center">
                                    <input type="number" class="form-control quantity-input mx-auto" value="2" min="1">
                                </td>
                                <td class="text-end fw-bold">Rp 1.598.000</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Ringkasan Belanja -->
                <div class="row mt-4 justify-content-end">
                    <div class="col-md-5">
                        <h4>Ringkasan Belanja</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Subtotal
                                <span>Rp 14.098.000</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pengiriman
                                <span>Rp 25.000</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Total
                                <span>Rp 14.123.000</span>
                            </li>
                        </ul>
                        <div class="d-grid gap-2 mt-3">
                            <a href="#" class="btn btn-primary btn-lg">Lanjutkan ke Pembayaran</a>
                            <a href="home.php" class="btn btn-outline-secondary">Lanjutkan Belanja</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
