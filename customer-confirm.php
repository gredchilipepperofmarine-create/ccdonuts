<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
require_once 'includes/db.php';
?>
<?php
  $page_title = '会員登録確認';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
  <li class="breadcrumb-item"><a href="login-input.php">ログイン</a></li>
  <li class="breadcrumb-item active" aria-current="page">会員登録</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- phpエリア -->
<?php
 $name = $_POST['name'] ?? "";
 $furigana = $_POST['furigana'] ?? "";
 $postcode_a = $_POST['postcode_a'] ?? "";
 $postcode_b = $_POST['postcode_b'] ?? "";
 $address = $_POST['address'] ?? "";
 $mail = $_POST['mail'] ?? "";
 $mail_confirm = $_POST['mail_confirm'] ?? "";
 $password = $_POST['password'] ?? "";
 $password_confirm = $_POST['password_confirm'] ?? "";
?>

<!-- テキストエリア -->
<?php if($mail !== $mail_confirm || $password !== $password_confirm): ?>
  <div class="text-center">
    <h2 class="m-4">登録できません</h2>
    <div class="p-5" style="border: 2px solid #F7D1CD;">
      <p>
      メールアドレスかパスワードが一致しません
      <br>再度入力してください
      </p>
    </div>
  </div>
<?php else: ?>
  <div class="text-center">
    <h2 class="m-4">入力確認</h2>
  </div>
  <div class="container my-5 text-start text-md-center">
    <form action="customer-output.php" method="post">
      <input type="hidden" name="name" value="<?= h($name) ?>">
      <input type="hidden" name="furigana" value="<?= h($furigana) ?>">
      <input type="hidden" name="postcode_a" value="<?= h($postcode_a) ?>">
      <input type="hidden" name="postcode_b" value="<?= h($postcode_b) ?>">
      <input type="hidden" name="address" value="<?= h($address) ?>">
      <input type="hidden" name="mail" value="<?= h($mail) ?>">
      <input type="hidden" name="password" value="<?= h($password) ?>">

      <div class="mb-3 confirmBox">
        <p class="form-p">お名前</p>
        <p class="confirmP"><?= h($name) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">お名前(フリガナ)</p>
        <p class="confirmP"><?= h($furigana) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">郵便番号</p>
        <div class="d-flex justify-content-md-center">
          <p class="confirmP"><?= h($postcode_a) ?></p>
          <p>-</p>
          <p class="confirmP"><?= h($postcode_b) ?></p>
        </div>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">住所</p>
        <p class="confirmP"><?= h($address) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">メールアドレス</p>
        <p class="confirmP"><?= h($mail) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">メールアドレス確認用</p>
        <p class="confirmP"><?= h($mail) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">パスワード</p>
        <p class="confirmP"><?= h(str_repeat('☆', mb_strlen($password))) ?></p>
      </div>
      <div class="mb-3 confirmBox">
        <p class="form-p">パスワード確認用</p>
        <p class="confirmP"><?= h(str_repeat('☆', mb_strlen($password))) ?></p>
      </div>
      <div class="mb-4 text-center">
        <button type="submit" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #7F5539;">登録する</button>
      </div>
    </form>
    <div class="mb-4 text-center">
      <a href="customer-input.php">
        <p class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #FFD233;">前のページに戻る</p>
      </a>
    </div>
  </div>
  <?php endif; ?>
<?php require 'includes/footer.php'; ?>
