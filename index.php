<?php
$page = 'index'; $title = 'Home';
require 'includes/header.php';
$featured = $pdo->query("SELECT * FROM products WHERE is_featured=1 AND is_seasonal=0 ORDER BY id LIMIT 4")->fetchAll();
$best = $pdo->query("SELECT * FROM products WHERE is_bestseller=1 ORDER BY price DESC")->fetchAll();
$catIcons = ['Coffee'=>'☕','Matcha'=>'🍵','Tea'=>'🫖','Cold Drinks'=>'🧋','Desserts'=>'🍰'];
?>
<section class="hero">
  <span class="cloud c1"></span><span class="cloud c2"></span><span class="cloud c3"></span>
  <div class="container">
    <h1>Every cup is a little <em>getaway.</em></h1>
    <p>Daydream is a café for slow mornings, quiet afternoons and long conversations. Pull up a seat and let your mind wander.</p>
    <a class="btn" href="menu.php">Order Now</a>
  </div>
</section>

<section class="section">
  <div class="container welcome">
    <div>
      <h2>Welcome to Daydream</h2>
      <p>We turn ordinary coffee moments into extraordinary ones. Our drinks are mixed with care, our desserts are baked fresh each morning, and our space is made for staying a little longer.</p>
      <p style="margin:1rem 0 1.6rem">Open Sunday to Thursday, 8:00 AM to 11:00 PM.</p>
      <a class="btn dark" href="about.php">Read our story</a>
    </div>
    <div class="welcome-art" aria-hidden="true">☁️</div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <h2>Featured drinks and desserts</h2>
    <p class="lead">The ones our regulars point newcomers to.</p>
    <div class="grid"><?php foreach ($featured as $p) echo product_card($p); ?></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Browse by category</h2>
    <p class="lead">Pick a corner of the menu.</p>
    <div class="cats">
      <?php foreach (CATEGORIES as $c): ?>
        <a class="cat" href="menu.php?cat=<?= urlencode($c) ?>"><span><?= $catIcons[$c] ?></span><strong><?= e($c) ?></strong></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <h2>Best sellers</h2>
    <p class="lead">Most loved by our guests, with prices.</p>
    <ul class="rank">
      <?php foreach ($best as $p): ?>
        <li><span><?= e($p['emoji']) ?></span>
          <div><strong><?= e($p['name']) ?></strong><small><?= e($p['description']) ?></small></div>
          <span class="dots"></span><strong><?= price($p['price']) ?></strong></li>
      <?php endforeach; ?>
    </ul>
    <p style="margin-top:2rem"><a class="btn dark" href="menu.php">See the full menu</a></p>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
