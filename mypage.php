<?php
// 1. セッションが未開始なら開始する
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. ログインしていない場合はログイン画面へリダイレクト（独立して判定）
if (!isset($_SESSION['customer'])) {
    $_SESSION['login_message'] = 'マイページはログインの後ご利用いただけます';
    header('Location: login-input.php');
    exit;
}
?>
<?php
  $page_title = 'マイページ';
  require 'includes/header.php';
?>

<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">マイページ</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- テキストエリア -->
<div class="container mt-5 p-3 text-center">
  <h2 class="text-center m-4"><span style="color: #BF0000; font-weight: bold;"><?= $_SESSION['customer']['name'] ?></span>様のマイページ</h2>
  <div style="border: 2px solid #F7D1CD;" class="p-4">
    <div class="mb-4 text-center">
      <a href="cart.php" class="btn btn-primary w-75 rounded-0" style="border: none; background-color: #FF8877;">カート</a>
    </div>
    <div class="mb-4 text-center">
      <a href="favorite.php" class="btn btn-primary w-75 rounded-0" style="border: none; background-color: #FF8877;">お気に入り一覧</a>
    </div>
    <div class="mb-4 text-center">
      <a href="card-input.php" class="btn btn-primary w-75 rounded-0" style="border: none; background-color: #FF8877;">クレジットカード登録</a>
    </div>
    <div class="mb-4 text-center">
      <a href="logout-output.php" class="btn btn-primary w-75 rounded-0" style="border: none; background-color: #FF8877;">ログアウト</a>
    </div>
  </div>
</div>


<?php require 'includes/footer.php'; ?>
