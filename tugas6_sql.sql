cd C:\xampp\mysql\bin
mysql -u root -p
CREATE DATABASE toko;
USE toko;
CREATE TABLE products (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     nama_produk VARCHAR(255) NOT NULL,
    ->     deskripsi TEXT,
    ->     harga INT NOT NULL,
    ->     stok INT NOT NULL
    -> );
CREATE TABLE users (
    -> id INT AUTO_INCREMENT PRIMARY KEY,
    -> nama VARCHAR(255) NOT NULL,
    -> email VARCHAR(255) NOT NULL,
    -> password VARCHAR(255)
    -> );
CREATE TABLE orders (
    -> order_id INT AUTO_INCREMENT PRIMARY KEY,
    -> user_id INT,
    -> product_id INT,
    -> quantity INT NOT NULL,
    -> total INT NOT NULL,
    -> FOREIGN KEY (user_id) REFERENCES users(id),
    -> FOREIGN KEY (product_id) REFERENCES products(id)
    -> );
INSERT INTO produk VALUES (1,'Laptop A', 'Personal Computer Portable', 5000000, 10);
INSERT INTO produk VALUES (2,'Laptop B', 'Personal Computer Portable', 4000000, 5);
INSERT INTO produk (nama_produk, deskripsi, harga, stok) VALUES ('Buku MySQL', 'Buku Belajar MySQL', 500000, 50);
SELECT * FROM produk;
SELECT nama_produk, harga FROM produk;
UPDATE produk
    -> SET nama_produk = 'Buku MySQL 01'
    -> WHERE id = 3;
UPDATE produk
    -> SET stok = 9
    -> WHERE id = 1;
DELETE FROM produk WHERE id = 2;