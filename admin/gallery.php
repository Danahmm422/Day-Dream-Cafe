<?php
require_once __DIR__ . '/../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $pdo->prepare("DELETE FROM gallery WHERE id=?")->execute([(int)$_POST['delete_id']]);
    header('Location: gallery.php?msg=' . urlencode('Photo deleted.')); exit;
}
$heading = 'Gallery';
require '_top.php'; flash();
$rows = $pdo->query("SELECT * FROM gallery ORDER BY id DESC")->fetchAll();
?>
<p style="margin-bottom:1rem"><a class="btn dark" href="gallery_form.php">Add photo</a></p>
<div class="table-wrap"><table>
<tr><th>ID</th><th>Title</th><th>Caption</th><th>Image file</th><th>Actions</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= e($r['emoji']) ?> <?= e($r['title']) ?></td>
  <td><?= e($r['caption']) ?></td>
  <td><?= e($r['image_file'] ?: 'Emoji tile') ?></td>
  <td><div class="row">
    <a class="btn small" href="gallery_form.php?id=<?= $r['id'] ?>">Edit</a>
    <form method="post" data-confirm="Delete <?= e($r['title']) ?>?"><input type="hidden" name="delete_id" value="<?= $r['id'] ?>"><button class="btn small danger" type="submit">Delete</button></form>
  </div></td>
</tr>
<?php endforeach; ?>
</table></div>
<?php require '_bottom.php'; ?>
