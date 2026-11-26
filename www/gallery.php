<?php
$page = 'gallery'; $title = 'Gallery';
require 'includes/header.php';
$shots = $pdo->query("SELECT * FROM gallery ORDER BY id")->fetchAll();
?>
<section class="banner"><div class="container"><h1>Gallery</h1><p>A look at the little moments that happen at Daydream.</p></div></section>
<section class="section">
  <div class="container">
    <?php if (!$shots): ?>
      <p>No photos yet. Add the first one in <a href="admin/gallery.php">Manage gallery</a>.</p>
    <?php else: ?>
    <div class="gallery">
      <?php foreach ($shots as $s): ?>
        <figure class="shot">
          <?php if ($s['image_file'] && is_file(__DIR__ . '/assets/img/' . basename($s['image_file']))): ?>
            <img src="assets/img/<?= e(basename($s['image_file'])) ?>" alt="<?= e($s['title']) ?>">
          <?php else: ?><span aria-hidden="true"><?= e($s['emoji']) ?></span><?php endif; ?>
          <figcaption><strong><?= e($s['title']) ?></strong><?= e($s['caption']) ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
