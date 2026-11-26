<?php
require_once __DIR__ . '/db.php';
$root  = $root  ?? '';
$page  = $page  ?? '';
$title = $title ?? 'Daydream';
$links = ['index'=>'Home','menu'=>'Menu','gallery'=>'Gallery','about'=>'About Us','contact'=>'Contact Us'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> | Daydream Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,700;1,9..144,500&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="<?= $root ?>assets/img/logo.png">
<link rel="stylesheet" href="<?= $root ?>assets/css/style.css">
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<header class="site-header">
  <div class="container nav">
    <a class="logo" href="<?= $root ?>index.php"><img src="<?= $root ?>assets/img/logo.png" alt="Daydream café, home" width="72" height="72"></a>
    <button class="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="nav">Menu</button>
    <nav id="nav">
      <?php foreach ($links as $k => $label): ?>
        <a href="<?= $root . $k ?>.php" class="<?= $page === $k ? 'active' : '' ?>"><?= $label ?></a>
      <?php endforeach; ?>
      <a href="<?= $root ?>admin/index.php" class="<?= $page === 'admin' ? 'active' : '' ?>">Manage</a>
    </nav>
  </div>
</header>
<main id="main">
