<?php
$heading = 'Manage Daydream';
require '_top.php';
$n = fn($t) => $pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
?>
<div class="admin-tiles">
  <a class="tile" href="products.php"><strong><?= $n('products') ?></strong>Products on the menu</a>
  <a class="tile" href="gallery.php"><strong><?= $n('gallery') ?></strong>Gallery photos</a>
  <a class="tile" href="messages.php"><strong><?= $n('messages') ?></strong>Customer messages</a>
</div>
<?php require '_bottom.php'; ?>
