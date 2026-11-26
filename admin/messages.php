<?php
require_once __DIR__ . '/../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {         // DELETE
        $pdo->prepare("DELETE FROM messages WHERE id=?")->execute([(int)$_POST['delete_id']]);
        $msg = 'Message deleted.';
    } elseif (isset($_POST['toggle_id'])) {   // UPDATE status
        $pdo->prepare("UPDATE messages SET status = IF(status='new','replied','new') WHERE id=?")->execute([(int)$_POST['toggle_id']]);
        $msg = 'Status updated.';
    }
    header('Location: messages.php?msg=' . urlencode($msg ?? '')); exit;
}
$heading = 'Messages';
require '_top.php'; flash();
$rows = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC, id DESC")->fetchAll();   // READ
?>
<div class="table-wrap"><table>
<tr><th>From</th><th>Subject</th><th>Message</th><th>Status</th><th>Actions</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
  <td><?= e($r['name']) ?><br><a href="mailto:<?= e($r['email']) ?>"><?= e($r['email']) ?></a><br><small><?= e($r['created_at']) ?></small></td>
  <td><?= e($r['subject']) ?></td>
  <td><?= nl2br(e($r['message'])) ?></td>
  <td><span class="badge <?= $r['status'] ?>"><?= e($r['status']) ?></span></td>
  <td><div class="row">
    <form method="post"><input type="hidden" name="toggle_id" value="<?= $r['id'] ?>"><button class="btn small" type="submit"><?= $r['status']==='new' ? 'Mark replied' : 'Mark new' ?></button></form>
    <form method="post" data-confirm="Delete this message?"><input type="hidden" name="delete_id" value="<?= $r['id'] ?>"><button class="btn small danger" type="submit">Delete</button></form>
  </div></td>
</tr>
<?php endforeach; ?>
</table></div>
<?php require '_bottom.php'; ?>
