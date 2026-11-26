<?php
$page = 'menu'; $title = 'Menu';
require 'includes/header.php';
$seasonal = $pdo->query("SELECT * FROM products WHERE is_seasonal=1 ORDER BY id")->fetchAll();
$all = $pdo->query("SELECT * FROM products WHERE is_seasonal=0 ORDER BY FIELD(category,'Coffee','Matcha','Tea','Cold Drinks','Desserts'), name")->fetchAll();
?>
<section class="banner"><div class="container"><h1>Menu</h1><p>Made to order, one cup at a time.</p></div></section>

<section class="section alt">
  <div class="container">
    <h2>Seasonal specials: fall drinks</h2>
    <p class="lead">Warm spices and toasted nuts, here until the leaves are gone.</p>
    <div class="grid"><?php foreach ($seasonal as $p) echo product_card($p); ?></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Everything on the menu</h2>
    <div class="filters" role="group" aria-label="Filter by category">
      <button type="button" data-filter="All" class="active">All</button>
      <?php foreach (CATEGORIES as $c): ?><button type="button" data-filter="<?= e($c) ?>"><?= e($c) ?></button><?php endforeach; ?>
    </div>
    <div class="grid" id="menu-grid"><?php foreach ($all as $p) echo product_card($p); ?></div>
  </div>
</section>

<section class="section" style="padding-top:0">
  <div class="container">
    <div class="hours">
      <h2>Opening hours</h2>
      <div><p>Sunday to Thursday</p><p class="time">8:00 AM to 11:00 PM</p></div>
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
