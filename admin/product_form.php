<?php
require_once __DIR__ . '/../includes/db.php';
$id = (int)($_GET['id'] ?? 0);
$p = ['name'=>'','category'=>'Coffee','description'=>'','price'=>'','emoji'=>'☕','is_featured'=>0,'is_bestseller'=>0,'is_seasonal'=>0];
if ($id) {
    $st = $pdo->prepare("SELECT * FROM products WHERE id=?"); $st->execute([$id]);
    $p = $st->fetch() ?: die('Product not found.');
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p = array_merge($p, [
        'name' => trim($_POST['name'] ?? ''), 'category' => $_POST['category'] ?? '',
        'description' => trim($_POST['description'] ?? ''), 'price' => $_POST['price'] ?? '',
        'emoji' => trim($_POST['emoji'] ?? '') ?: '☕',
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
        'is_bestseller' => isset($_POST['is_bestseller']) ? 1 : 0,
        'is_seasonal' => isset($_POST['is_seasonal']) ? 1 : 0,
    ]);
    if ($p['name']==='' || $p['description']==='' || !in_array($p['category'], CATEGORIES, true) || !is_numeric($p['price']) || $p['price'] < 0) {
        $error = 'Fill in the name, description, a category and a price of 0 or more.';
    } else {
        $f = [$p['name'],$p['category'],$p['description'],$p['price'],$p['emoji'],$p['is_featured'],$p['is_bestseller'],$p['is_seasonal']];
        if ($id) {   // UPDATE
            $pdo->prepare("UPDATE products SET name=?,category=?,description=?,price=?,emoji=?,is_featured=?,is_bestseller=?,is_seasonal=? WHERE id=?")->execute([...$f, $id]);
            $msg = 'Product updated.';
        } else {     // CREATE
            $pdo->prepare("INSERT INTO products (name,category,description,price,emoji,is_featured,is_bestseller,is_seasonal) VALUES (?,?,?,?,?,?,?,?)")->execute($f);
            $msg = 'Product added.';
        }
        header('Location: products.php?msg=' . urlencode($msg)); exit;
    }
}
$heading = $id ? 'Edit product' : 'Add product';
require '_top.php';
?>
<form class="form" method="post">
  <label>Name<input name="name" value="<?= e($p['name']) ?>" required></label>
  <label>Category<select name="category"><?php foreach (CATEGORIES as $c): ?><option <?= $p['category']===$c?'selected':'' ?>><?= e($c) ?></option><?php endforeach; ?></select></label>
  <label>Description<textarea name="description" rows="3" required><?= e($p['description']) ?></textarea></label>
  <label>Price (<?= CURRENCY ?>)<input name="price" type="number" step="0.01" min="0" value="<?= e($p['price']) ?>" required></label>
  <label>Emoji<input name="emoji" maxlength="8" value="<?= e($p['emoji']) ?>"></label>
  <label class="check"><input type="checkbox" name="is_featured" <?= $p['is_featured']?'checked':'' ?>> Show in featured on Home</label>
  <label class="check"><input type="checkbox" name="is_bestseller" <?= $p['is_bestseller']?'checked':'' ?>> Show in best sellers</label>
  <label class="check"><input type="checkbox" name="is_seasonal" <?= $p['is_seasonal']?'checked':'' ?>> Fall seasonal special</label>
  <p class="error"><?= e($error) ?></p>
  <div class="row" style="display:flex;gap:.6rem"><button class="btn dark" type="submit">Save product</button><a class="btn" href="products.php">Cancel</a></div>
</form>
<?php require '_bottom.php'; ?>
