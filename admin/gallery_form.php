<?php
require_once __DIR__ . '/../includes/db.php';
$id = (int)($_GET['id'] ?? 0);
$g = ['title'=>'','caption'=>'','emoji'=>'✨','image_file'=>''];
if ($id) {
    $st = $pdo->prepare("SELECT * FROM gallery WHERE id=?"); $st->execute([$id]);
    $g = $st->fetch() ?: die('Photo not found.');
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $g = array_merge($g, [
        'title' => trim($_POST['title'] ?? ''), 'caption' => trim($_POST['caption'] ?? ''),
        'emoji' => trim($_POST['emoji'] ?? '') ?: '✨', 'image_file' => basename(trim($_POST['image_file'] ?? '')),
    ]);
    if ($g['title']==='' || $g['caption']==='') {
        $error = 'Fill in a title and a caption.';
    } else {
        $img = $g['image_file'] ?: null;
        if ($id) {   // UPDATE
            $pdo->prepare("UPDATE gallery SET title=?,caption=?,emoji=?,image_file=? WHERE id=?")->execute([$g['title'],$g['caption'],$g['emoji'],$img,$id]);
            $msg = 'Photo updated.';
        } else {     // CREATE
            $pdo->prepare("INSERT INTO gallery (title,caption,emoji,image_file) VALUES (?,?,?,?)")->execute([$g['title'],$g['caption'],$g['emoji'],$img]);
            $msg = 'Photo added.';
        }
        header('Location: gallery.php?msg=' . urlencode($msg)); exit;
    }
}
$heading = $id ? 'Edit photo' : 'Add photo';
require '_top.php';
?>
<form class="form" method="post">
  <label>Title<input name="title" value="<?= e($g['title']) ?>" required></label>
  <label>Caption<input name="caption" value="<?= e($g['caption']) ?>" required></label>
  <label>Emoji (shown when there is no image)<input name="emoji" maxlength="8" value="<?= e($g['emoji']) ?>"></label>
  <label>Image file name (optional, copy the file into assets/img first, for example latte.jpg)<input name="image_file" value="<?= e($g['image_file']) ?>"></label>
  <p class="error"><?= e($error) ?></p>
  <div style="display:flex;gap:.6rem"><button class="btn dark" type="submit">Save photo</button><a class="btn" href="gallery.php">Cancel</a></div>
</form>
<?php require '_bottom.php'; ?>
