@extends('layout')
@section('content')
@section('title', 'Home - TokoOnline')

<!-- 2. HERO SECTION -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Koleksi Terbaru Musim Ini</h1>
            <p class="lead col-md-8 mx-auto">Temukan gaya terbaik Anda dengan produk-produk pilihan kami. Kualitas terjamin, harga bersahabat.</p>
            <a href="#" class="btn btn-primary btn-lg mt-3">Belanja Sekarang</a>
        </div>
    </header>

    <!-- 3. FEATURED PRODUCTS SECTION -->
    <main class="container mt-5">
        <section id="featured-products">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Produk Unggulan</h2>
                <p class="text-muted">Produk paling populer dan banyak dicari oleh pelanggan kami.</p>
            </div>

            <!-- Baris untuk menampung kartu produk -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                
                <!-- Kartu Produk 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="https://placehold.co/600x400/5e81ac/ffffff?text=Laptop" class="card-img-top product-card-img" alt="Gambar produk laptop">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Laptop Ultrabook Generasi 12</h5>
                            <p class="card-text text-muted">Performa tinggi untuk produktivitas tanpa batas.</p>
                            <h6 class="fw-bold text-primary mt-auto">Rp 12.500.000</h6>
                            <a href="#" class="btn btn-outline-primary mt-2"><i class="bi bi-cart-plus"></i> Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu Produk 2 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="https://placehold.co/600x400/a3be8c/ffffff?text=Sepatu" class="card-img-top product-card-img" alt="Gambar produk sepatu">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Sepatu Lari Pro-Series</h5>
                            <p class="card-text text-muted">Ringan dan nyaman untuk menemani setiap langkahmu.</p>
                            <h6 class="fw-bold text-primary mt-auto">Rp 799.000</h6>
                            <a href="#" class="btn btn-outline-primary mt-2"><i class="bi bi-cart-plus"></i> Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu Produk 3 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="https://placehold.co/600x400/b48ead/ffffff?text=Kamera" class="card-img-top product-card-img" alt="Gambar produk kamera">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Kamera Mirrorless 4K</h5>
                            <p class="card-text text-muted">Abadikan momen berharga dengan kualitas sinematik.</p>
                            <h6 class="fw-bold text-primary mt-auto">Rp 9.800.000</h6>
                            <a href="#" class="btn btn-outline-primary mt-2"><i class="bi bi-cart-plus"></i> Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu Produk 4 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="https://placehold.co/600x400/ebcb8b/3b4252?text=Jam+Tangan" class="card-img-top product-card-img" alt="Gambar produk jam tangan">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Jam Tangan Klasik Otomatis</h5>
                            <p class="card-text text-muted">Desain elegan yang tak lekang oleh waktu.</p>
                            <h6 class="fw-bold text-primary mt-auto">Rp 2.150.000</h6>
                            <a href="#" class="btn btn-outline-primary mt-2"><i class="bi bi-cart-plus"></i> Tambah ke Keranjang</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection