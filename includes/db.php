<?php
// Database connection (XAMPP defaults: user root, empty password)
$DB_HOST = '127.0.0.1';
$DB_PORT = 3308;   // the port shown in phpMyAdmin (Server: 127.0.0.1:3308). Default XAMPP is 3306.
$DB_NAME = 'daydream';
$DB_USER = 'root';
$DB_PASS = '';
const CURRENCY = 'SAR';
const CATEGORIES = ['Coffee','Matcha','Tea','Cold Drinks','Desserts'];

try {
    $pdo = new PDO("mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $ex) {
    die('Could not connect to the database. Start MySQL in XAMPP and import sql/daydream.sql in phpMyAdmin.');
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function price($p) { return CURRENCY . ' ' . rtrim(rtrim(number_format((float)$p, 2), '0'), '.'); }

function product_card(array $p): string {
    return '<article class="card" data-cat="' . e($p['category']) . '">'
        . '<div class="card-art">' . e($p['emoji']) . '</div>'
        . '<div class="card-body"><p class="tag">' . e($p['category']) . '</p>'
        . '<h3>' . e($p['name']) . '</h3><p>' . e($p['description']) . '</p>'
        . '<p class="price">' . price($p['price']) . '</p></div></article>';
}
