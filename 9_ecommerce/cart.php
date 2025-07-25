<?php
session_start();
include '../koneksi.php';

// Proses tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $jumlah = intval($_POST['jumlah']);

    // Ambil stok produk dari database
    $sql = "SELECT stok FROM products WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($stok);
        if ($stmt->fetch()) {
            if ($jumlah > 0 && $jumlah <= $stok) {
                // Tambahkan ke keranjang (update jika sudah ada)
                if (!isset($_SESSION['keranjang'][$product_id])) {
                    $_SESSION['keranjang'][$product_id] = 0;
                }
                // Pastikan tidak melebihi stok
                $new_jumlah = $_SESSION['keranjang'][$product_id] + $jumlah;
                $_SESSION['keranjang'][$product_id] = ($new_jumlah > $stok) ? $stok : $new_jumlah;
                // Redirect agar tidak resubmit form
                header("Location: cart.php");
                exit();
            } else {
                $_SESSION['cart_error'] = "Jumlah melebihi stok tersedia!";
                header("Location: index.php");
                exit();
            }
        }
        $stmt->close();
    }
}

// Ambil semua ID produk dari keranjang
$product_ids = array_keys($_SESSION['keranjang'] ?? []);
$products = [];
$total_harga = 0;

// Ambil detail produk dari database jika keranjang tidak kosong
if (!empty($product_ids)) {
    // Buat placeholder '?' sebanyak jumlah item di keranjang
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    
    // Siapkan query dengan klausa IN
    $sql = "SELECT id, nama_produk, harga, gambar FROM products WHERE id IN ($placeholders)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter. 'i' diulang sebanyak jumlah item.
        $stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
        
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products[$row['id']] = $row;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="cart.php">Toko Incukaruhun</a>
            <a href="cart.php" class="btn btn-primary">
                <i class="bi bi-cart"></i> Keranjang
                <?php
                $jumlah_item = isset($_SESSION['keranjang']) ? array_sum($_SESSION['keranjang']) : 0;
                if ($jumlah_item > 0) {
                    echo "<span class='badge bg-danger ms-1'>$jumlah_item</span>";
                }
                ?>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1><i class="bi bi-cart-check-fill"></i> Keranjang Belanja Anda</h1>
        
        <?php if (empty($_SESSION['keranjang'])): ?>
            <div class="alert alert-info mt-4">Keranjang Anda masih kosong. <a href="index.php">Mulai belanja sekarang!</a></div>
        <?php else: ?>
            <table class="table table-bordered table-hover mt-4 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['keranjang'] as $id => $jumlah): 
                        if (isset($products[$id])) {
                            $product = $products[$id];
                            $subtotal = $product['harga'] * $jumlah;
                            $total_harga += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo htmlspecialchars($product['gambar']); ?>" width="80" height="80" style="object-fit:cover; border:1px solid #ccc; border-radius:8px;" class="me-3">
                                    <?php echo htmlspecialchars($product['nama_produk']); ?>
                                </div>
                            </td>
                            <td>Rp <?php echo number_format($product['harga']); ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="action.php?action=kurang&id=<?php echo $id; ?>" class="btn btn-sm btn-secondary">-</a>
                                    <span class="mx-2"><?php echo $jumlah; ?></span>
                                    <a href="action.php?action=tambah&id=<?php echo $id; ?>" class="btn btn-sm btn-secondary">+</a>
                                </div>
                            </td>
                            <td>Rp <?php echo number_format($subtotal); ?></td>
                            <td>
                                <a href="action.php?action=hapus&id=<?php echo $id; ?>" class="btn btn-danger btn-sm" title="Hapus Item">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Harga</th>
                        <th colspan="2">Rp <?php echo number_format($total_harga); ?></th>
                    </tr>
                </tfoot>
            </table>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-outline-primary fw-semibold">Lanjutkan Belanja</a>
                <a href="#" class="btn btn-success fw-semibold">Lanjutkan ke Pembayaran</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
