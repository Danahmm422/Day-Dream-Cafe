<?php
$root = '../'; $page = 'admin';
require __DIR__ . '/../includes/header.php';
function flash() { if (!empty($_GET['msg'])) echo '<p class="notice">' . e($_GET['msg']) . '</p>'; }
?>
<section class="banner"><div class="container"><h1><?= e($heading ?? 'Manage') ?></h1>
<p>Add, edit and delete what appears on the website.</p></div></section>
<section class="section"><div class="container">
<div class="admin-bar">
  <a class="btn small" href="index.php">Dashboard</a>
  <a class="btn small" href="products.php">Products</a>
  <a class="btn small" href="gallery.php">Gallery</a>
  <a class="btn small" href="messages.php">Messages</a>
</div>
