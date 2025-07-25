<?php
// Selalu mulai session di awal file
session_start();
include '../koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="produk.php">Toko Incukaruhun</a>
            <a href="keranjang.php" class="btn btn-primary">
                <i class="bi bi-cart"></i> Keranjang
                <?php
                // Tampilkan jumlah item di keranjang
                $jumlah_item = isset($_SESSION['keranjang']) ? array_sum($_SESSION['keranjang']) : 0;
                if ($jumlah_item > 0) {
                    echo "<span class='badge bg-danger ms-1'>$jumlah_item</span>";
                }
                ?>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Produk Tersedia</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            $sql = "SELECT id, nama_produk, harga, gambar FROM products WHERE stok > 0 ORDER BY id DESC";
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                                <p class="card-text fw-bold text-primary">Rp <?php echo number_format($row['harga']); ?></p>
                                <!-- Tombol ini akan mengarahkan ke aksi_keranjang.php -->
                                <a href="aksi_keranjang.php?action=tambah&id=<?php echo $row['id']; ?>" class="btn btn-success mt-auto">
                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
                $result->free();
            }
            ?>
        </div>
    </div>
</body>
</html>
