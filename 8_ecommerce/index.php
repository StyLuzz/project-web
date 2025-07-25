<?php
// Koneksi database
include '../koneksi.php';

// Ambil produk berdasarkan kategori
$categories_filter = isset($_GET['kategori']) ? $conn->real_escape_string($_GET['kategori']) : '';

if (!empty($categories_filter)) {
    // Jika ada filter kategori, tambahkan ke query
    $sql = "SELECT * FROM products WHERE kategori = '$categories_filter'";
    $result = $conn->query($sql);
} else {
    // Jika tidak ada filter, ambil semua produk
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
}

$categories_sql = "SELECT DISTINCT kategori FROM products";
$categories_result = $conn->query($categories_sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS untuk memastikan kartu memiliki tinggi yang sama */
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover; /* Agar gambar tidak gepeng */
        }
        .card {
            height: 100%;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .card-title {
            flex-grow: 1; /* Mendorong harga dan tombol ke bawah */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">E-Commerce Store</h1>
        <!-- Filter Form Centered -->
        <form method="GET" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-8">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php if ($categories_result->num_rows > 0): ?>
                            <?php while ($category = $categories_result->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($category['kategori']) ?>"
                                    <?= ($categories_filter == $category['kategori']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['kategori']) ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-4">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
        <!-- Produk Centered -->
        <div class="row justify-content-center">
            <?php if ($result->num_rows > 0):?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 col-sm-10 mb-4 d-flex align-items-stretch">
                        <div class="card shadow-sm w-100">
                            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                                <p class="card-text text-success">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                <a href="#" class="btn btn-primary mt-auto">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">Tidak ada produk yang tersedia.</div>
                </div>
            <?php endif; ?>           
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Toko Online. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
