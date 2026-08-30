<?php session_start(); ?>
<?php
  $page_title = '会員登録';
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
// 一気に空の文字列を代入しておく
$name=$furigana=$address=$mail=$mail_confirm=$password=$password_confirm=$postcode_a=$postcode_b='';
// もし顧客情報(customer)があるなら
if(isset($_SESSION['customer'])) {
  // customerの中のnameを読み出す
  $name = $_SESSION['customer']['name'];
  $furigana = $_SESSION['customer']['furigana'];
  $postcode_a = $_SESSION['customer']['postcode_a'];
  $postcode_b = $_SESSION['customer']['postcode_b'];
  $address = $_SESSION['customer']['address'];
  $mail = $_SESSION['customer']['mail'];
  $mail_confirm = $_SESSION['customer']['mail_confirm'];
  $password = $_SESSION['customer']['password'];
  $password_confirm = $_SESSION['customer']['password_confirm'];
}
?>
<!-- HTMLエリア -->
 <div class="text-center">
  <h2 class="m-4">会員登録</h2>
</div>

<div class="container my-5 text-start text-md-center">
  <form action="customer-confirm.php" method="post">
    <div class="mb-3">
      <label class="form-label">お名前<span class="text-danger ms-1">(必須)</span></label>
      <input type="text" class="form-control rounded-0" name="name" value="<?= h($name) ?>" placeholder="上部 エンジ" required>
    </div>
    <div class="mb-3">
      <label class="form-label">お名前(フリガナ)<span class="text-danger ms-1">(必須)</span></label>
      <input type="text" class="form-control rounded-0" name="furigana" value="<?= h($furigana) ?>" placeholder="ウエブ エンジ" required>
    </div>
    <div class="mb-3">
      <label class="form-label">郵便番号<span class="text-danger ms-1">(必須)</span></label>
      <div class="d-flex">
        <input type="tel" class="form-control rounded-0" name="postcode_a" value="<?= h($postcode_a) ?>" placeholder="123" required>
        <input type="tel" class="form-control rounded-0 ms-1" name="postcode_b" value="<?= h($postcode_b) ?>" placeholder="4567" required>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">住所<span class="text-danger ms-1">(必須)</span></label>
      <input type="text" class="form-control rounded-0" name="address" value="<?= h($address) ?>" placeholder="千葉県〇〇市中区1-1" required>
    </div>
    <div class="mb-3">
      <label class="form-label">メールアドレス<span class="text-danger ms-1">(必須)</span></label>
      <input type="email" class="form-control rounded-0" name="mail" value="<?= h($mail) ?>" placeholder="example@email.com" required>
    </div>
    <div class="mb-3">
      <label class="form-label">メールアドレス確認用<span class="text-danger ms-1">(必須)</span></label>
      <input type="email" class="form-control rounded-0" name="mail_confirm" value="<?= h($mail_confirm) ?>" placeholder="example@email.com" required>
    </div>
    <div class="mb-3">
      <label class="form-label">パスワード<span class="text-danger ms-1">(必須)</span></label>
      <input type="password" class="form-control rounded-0" name="password" value="<?= h($password) ?>" placeholder="123456789abcd" required>
    </div>
    <div class="mb-3">
      <label class="form-label">パスワード確認用<span class="text-danger ms-1">(必須)</span></label>
      <input type="password" class="form-control rounded-0" name="password_confirm" value="<?= h($password_confirm) ?>" placeholder="123456789abcd" required>
    </div>
    <div class="mb-4 text-center">
      <button type="submit" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #7F5539;">入力確認する</button>
    </div>
  </form>
</div>
<?php require 'includes/footer.php'; ?>
