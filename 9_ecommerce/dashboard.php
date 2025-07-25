<?php
include '../koneksi.php';

// Ambil data produk dari database, urutkan ID ASCENDING
$sql = "SELECT id, nama_produk, gambar, kategori, harga, stok FROM products ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manajemen Produk</h1>
            <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Produk Baru</a>
        </div>

        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>
                                    <div style='width:90px; height:90px; display:flex; align-items:center; justify-content:center;'>
                                        <img src='" . htmlspecialchars($row['gambar']) . "' alt='" . htmlspecialchars($row['nama_produk']) . "' 
                                        style='width:80px; height:80px; object-fit:cover; border:1px solid #ccc; border-radius:8px; background:#fff;'/>
                                    </div>
                                  </td>";
                            echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                            echo "<td>Rp " . number_format($row['harga']) . "</td>";
                            echo "<td>" . $row['stok'] . "</td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm me-2'><i class='bi bi-pencil-square'></i> Edit</a>";
                            echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'><i class='bi bi-trash'></i> Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        $result->free();
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada produk ditemukan.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>ERROR: Tidak bisa mengeksekusi query. " . $conn->error . "</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
