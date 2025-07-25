<?php
// Selalu mulai session di awal
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Ambil aksi dan id produk dari URL
$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

switch ($action) {
    case 'tambah':
        // Jika produk sudah ada di keranjang, tambah jumlahnya. Jika belum, tambahkan.
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id]++;
        } else {
            $_SESSION['keranjang'][$id] = 1;
        }
        break;

    case 'kurang':
        // Jika produk ada dan jumlahnya lebih dari 1, kurangi.
        if (isset($_SESSION['keranjang'][$id]) && $_SESSION['keranjang'][$id] > 1) {
            $_SESSION['keranjang'][$id]--;
        }
        // Jika jumlahnya 1, jangan lakukan apa-apa (tidak dihapus)
        break;

    case 'hapus':
        // Hapus item dari keranjang
        unset($_SESSION['keranjang'][$id]);
        break;

    case 'kosongkan':
        // Hapus semua item dari keranjang
        $_SESSION['keranjang'] = [];
        break;
}

// Arahkan pengguna kembali ke halaman sebelumnya atau halaman keranjang
// 'HTTP_REFERER' adalah URL halaman tempat pengguna datang.
$previous_page = $_SERVER['HTTP_REFERER'] ?? 'product.php';
header("Location: " . $previous_page);
exit();
?>
