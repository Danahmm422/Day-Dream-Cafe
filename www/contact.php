<?php
$page = 'contact'; $title = 'Contact Us';
require 'includes/header.php';
$sent = false; $error = '';
$v = ['name'=>'','email'=>'','subject'=>'','message'=>''];

// CREATE: save the visitor's message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($v as $k => $_) $v[$k] = trim($_POST[$k] ?? '');
    if ($v['name']==='' || $v['subject']==='' || !filter_var($v['email'], FILTER_VALIDATE_EMAIL) || strlen($v['message']) < 10) {
        $error = 'Enter your name, a valid email, a subject and a message of at least 10 characters.';
    } else {
        $st = $pdo->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
        $st->execute([$v['name'],$v['email'],$v['subject'],$v['message']]);
        $sent = true; $v = array_map(fn($x)=>'', $v);
    }
}
?>
<section class="banner"><div class="container"><h1>Contact Us</h1><p>Questions, bookings or just a hello. We read every message.</p></div></section>
<section class="section">
  <div class="container contact">
    <div>
      <h2>Send a message</h2>
      <?php if ($sent): ?><p class="notice">Thank you. Your message was sent and we will reply by email.</p><?php endif; ?>
      <form id="contact-form" class="form" method="post" action="contact.php" novalidate>
        <label>Name<input name="name" value="<?= e($v['name']) ?>" required></label>
        <label>Email<input type="email" name="email" value="<?= e($v['email']) ?>" required></label>
        <label>Subject<input name="subject" value="<?= e($v['subject']) ?>" required></label>
        <label>Message<textarea name="message" rows="5" required><?= e($v['message']) ?></textarea></label>
        <p id="form-error" class="error" role="alert"><?= e($error) ?></p>
        <button class="btn dark" type="submit">Send message</button>
      </form>
    </div>
    <div>
      <h2>Find us</h2>
      <p>Email: <a href="mailto:daydream@gmail.com">daydream@gmail.com</a></p>
      <h3 style="margin-top:1.5rem">Opening hours</h3>
      <p>Sunday to Thursday<br>8:00 AM to 11:00 PM</p>
    </div>
  </div>
</section>
<?php require 'includes/footer.php'; ?>
