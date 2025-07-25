<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Proses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body text-center">
                <?php
                // Cek apakah request yang masuk adalah POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    // Ambil data dari form dan amankan dengan htmlspecialchars
                    $nama_produk = htmlspecialchars($_POST['nama_produk']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $deskripsi = htmlspecialchars($_POST['deskripsi']);

                    // Validasi: cek apakah ada field yang kosong setelah di-trim
                    if (!empty(trim($nama_produk)) && !empty($harga) && !empty(trim($deskripsi))) {
                        
                        // Jika validasi sukses
                        echo "<h3 class='text-success'>Sukses!</h3>";
                        echo "<p>Data produk telah diterima dan siap disimpan ke database.</p>";
                        echo "<hr>";
                        echo "<strong>Nama:</strong> " . $nama_produk . "<br>";
                        echo "<strong>Harga:</strong> Rp " . number_format($harga, 0, ',', '.') . "<br>";
                        echo "<strong>Deskripsi:</strong> " . $deskripsi;

                    } else {
                        // Jika validasi gagal
                        echo "<h3 class='text-danger'>Gagal!</h3>";
                        echo "<p>Semua field wajib diisi. Silakan kembali dan lengkapi form.</p>";
                    }

                } else {
                    // Jika halaman diakses langsung tanpa mengirim form
                    echo "<h3 class='text-warning'>Akses Tidak Sah</h3>";
                    echo "<p>Silakan isi form terlebih dahulu.</p>";
                }
                ?>
                <hr>
                <a href="form_html.html" class="btn btn-primary">Kembali ke Form</a>
            </div>
        </div>
    </div>
</body>
</html>