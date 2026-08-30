<?php
  $page_title = 'ログイン';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
  <li class="breadcrumb-item"><a href="login-input.php">ログイン</a></li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<div class="container mt-5 p-3 text-center">
  <h2 class="m-4">ログイン</h2>
  <?php if(isset($_SESSION['login_message'])): ?>
    <p class="text-danger text-center font-weight-bold py-2">
      <?= $_SESSION['login_message'] ?>
      </p>
      <?php 
      // 一度表示したらメッセージを消す（画面を再読み込みした時や普通のログイン時には消えるようにする）
      unset($_SESSION['login_message']); 
      ?>
  <?php endif; ?>
<form action="login-output.php" method="post">
    <div style="border: 2px solid #F7D1CD;" class="p-4">
      <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <input type="email" class="form-control rounded-0" name="mail" placeholder="example@email.com" required>
      </div>
      <div class="mb-3">
        <label class="form-label">パスワード</label>
        <input type="password" class="form-control rounded-0" name="password" placeholder="123456789abcd" required>
      </div>
      <div class="mb-4 text-center">
        <button type="submit" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #7F5539;">ログインする</button>
      </div>
    </div>
  </form>
  <div class="mb-4 text-end">
    <a href="customer-input.php" class="rounded-0" style="border: none; color: #7F5539;">会員登録はこちら</a>
  </div>
</div>

<?php require 'includes/footer.php'; ?>