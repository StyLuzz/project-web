<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include '../koneksi.php'; // Include koneksi database
    
    $sql = "DELETE FROM products WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        $id = trim($_GET['id']);
        
        if ($stmt->execute()) {
            header("location: dashboard.php");
            exit();
        } else {
            echo "Error: Gagal menghapus data.";
        }
        $stmt->close();
    }
    $conn->close();
} else {
    // Redirect jika tidak ada ID
    header("location: dashboard.php");
    exit();
}
?>
