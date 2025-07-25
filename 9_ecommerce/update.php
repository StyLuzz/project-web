<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../koneksi.php';
    $id = $_POST['id'] ?? null;

    // Proses gambar
    $gambar = '';
    if (!empty($_POST['gambar_url'])) {
        $gambar = $_POST['gambar_url'];
    } elseif (isset($_FILES['gambar_file']) && $_FILES['gambar_file']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $target_file = $target_dir . basename($_FILES["gambar_file"]["name"]);
        if (move_uploaded_file($_FILES["gambar_file"]["tmp_name"], $target_file)) {
            $gambar = $target_file;
        }
    } else {
        // Jika tidak ada perubahan gambar, gunakan gambar lama
        $gambar = $_POST['gambar_lama'] ?? '';
    }

    $sql = "UPDATE products SET nama_produk=?, deskripsi=?, gambar=?, kategori=?, harga=?, stok=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssdii", $nama, $deskripsi, $gambar, $kategori, $harga, $stok, $id);

        $nama = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        if ($stmt->execute()) {
            header("location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
} else {
    include '../koneksi.php'; // Tambahkan ini agar $conn tersedia

    // Ambil id dari GET atau POST
    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    if (!$id) {
        echo "ID produk tidak ditemukan.";
        exit;
    }

    // Ambil data produk untuk ditampilkan di form
    $sql = "SELECT * FROM products WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $product = $result->fetch_assoc();
            } else {
                echo "Produk tidak ditemukan.";
                exit;
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function toggleGambarInput() {
        var tipe = document.querySelector('input[name="gambar_type"]:checked').value;
        document.getElementById('gambar_url_group').style.display = tipe === 'url' ? 'block' : 'none';
        document.getElementById('gambar_file_group').style.display = tipe === 'file' ? 'block' : 'none';
    }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk: <?php echo htmlspecialchars($product['nama_produk']); ?></h2>
        <form action="update.php" method="post" class="mt-4" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($product['gambar']); ?>">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="<?php echo htmlspecialchars($product['nama_produk']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?php echo htmlspecialchars($product['deskripsi']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Produk</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gambar_type" id="gambar_type_url" value="url"
                        <?php if (filter_var($product['gambar'], FILTER_VALIDATE_URL)) echo 'checked'; ?> onclick="toggleGambarInput()">
                    <label class="form-check-label" for="gambar_type_url">URL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gambar_type" id="gambar_type_file" value="file"
                        <?php if (!filter_var($product['gambar'], FILTER_VALIDATE_URL)) echo 'checked'; ?> onclick="toggleGambarInput()">
                    <label class="form-check-label" for="gambar_type_file">Choose File</label>
                </div>
                <div id="gambar_url_group" class="mt-2">
                    <input type="text" name="gambar_url" class="form-control" placeholder="Masukkan URL gambar"
                        value="<?php echo filter_var($product['gambar'], FILTER_VALIDATE_URL) ? htmlspecialchars($product['gambar']) : ''; ?>">
                </div>
                <div id="gambar_file_group" class="mt-2" style="display:none;">
                    <input type="file" name="gambar_file" class="form-control">
                    <?php if (!filter_var($product['gambar'], FILTER_VALIDATE_URL) && !empty($product['gambar'])): ?>
                        <div class="mt-2">
                            <img src="<?php echo htmlspecialchars($product['gambar']); ?>" alt="Gambar Produk" style="max-width:100px;max-height:100px;border:1px solid #ccc;">
                            <div class="small text-muted">Gambar saat ini</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?php echo htmlspecialchars($product['kategori']); ?>">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" step="0.01" value="<?php echo $product['harga']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?php echo $product['stok']; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script>
        // Inisialisasi tampilan input gambar saat halaman dimuat
        toggleGambarInput();
    </script>
</body>
</html>
