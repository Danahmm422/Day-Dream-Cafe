<?php
require_once __DIR__ . '/../includes/db.php';
// DELETE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $pdo->prepare("DELETE FROM products WHERE id=?")->execute([(int)$_POST['delete_id']]);
    header('Location: products.php?msg=' . urlencode('Product deleted.')); exit;
}
$heading = 'Products';
require '_top.php'; flash();
// READ
$rows = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
?>
<p style="margin-bottom:1rem"><a class="btn dark" href="product_form.php">Add product</a></p>
<div class="table-wrap"><table>
<tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Tags</th><th>Actions</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= e($r['emoji']) ?> <?= e($r['name']) ?></td>
  <td><?= e($r['category']) ?></td>
  <td><?= price($r['price']) ?></td>
  <td><?= $r['is_featured'] ? '<span class="badge">Featured</span> ' : '' ?><?= $r['is_bestseller'] ? '<span class="badge">Best seller</span> ' : '' ?><?= $r['is_seasonal'] ? '<span class="badge">Seasonal</span>' : '' ?></td>
  <td><div class="row">
    <a class="btn small" href="product_form.php?id=<?= $r['id'] ?>">Edit</a>
    <form method="post" data-confirm="Delete <?= e($r['name']) ?>?"><input type="hidden" name="delete_id" value="<?= $r['id'] ?>"><button class="btn small danger" type="submit">Delete</button></form>
  </div></td>
</tr>
<?php endforeach; ?>
</table></div>
<?php require '_bottom.php'; ?>
