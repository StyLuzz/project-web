cd C:\xampp\mysql\bin
mysql -u root -p
CREATE DATABASE toko;
USE toko;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    harga INT NOT NULL,
    stok INT NOT NULL
    );
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255)
    );
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
    );
INSERT INTO products VALUES (1,'Laptop A', 'Personal Computer Portable', 5000000, 10);
INSERT INTO products VALUES (2,'Laptop B', 'Personal Computer Portable', 4000000, 5);
INSERT INTO products (id, nama_produk, deskripsi, harga, stok) VALUES ('Buku MySQL', 'Buku Belajar MySQL', 500000, 50);
SELECT * FROM products;
SELECT nama_produk, harga FROM products;
UPDATE products
    SET nama_produk = 'Buku MySQL 01'
    WHERE id = 3;
UPDATE products
    SET stok = 9
    WHERE id = 1;
DELETE FROM products WHERE id = 2;
INSERT INTO Users (id, nama, email, password)
VALUES
(1,'Budi', 'budi@email.com', 'aaa'),
(2,'Agus', 'agus@email.com', 'bbb'),
(3,'Bagas', 'bagas@email.com', 'ccc');
