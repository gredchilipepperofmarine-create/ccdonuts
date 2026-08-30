<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = 'クレジットカード登録完了';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">クレジットカード登録完了</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<?php

  $is_success = false;

  if(isset($_SESSION['customer']) && isset($_POST['card_number'])){
    $customer_id = $_SESSION['customer']['id'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $card_month = $_POST['card_month'];
    $card_year = $_POST['card_year'];
    $security_code = $_POST['security_code'];

    $sql = $pdo->prepare('INSERT INTO cards (customer_id, card_name, card_number, card_month, card_year, security_code) VALUES (?, ?, ?, ?, ?, ?)');
    $is_success = $sql->execute([
      $customer_id,
      $card_name,
      $card_number,
      $card_month,
      $card_year,
      $security_code
    ]);
  }
?>

<!-- テキストエリア -->
<div class="container my-5 text-center">
  <?php if ($is_success): ?>
    <h2 class="m-4">クレジットカードを登録しました</h2>
    <div class="px-5 py-5 my-4" style="border: 2px solid #F7D1CD;">
      <p>カード情報の登録が正常に完了しました。</p>
    </div>
    <div>
      <a href="cart.php" class="btn btn-primary rounded-0" style="border: none; background-color: #7F5539;">カート画面へ戻る</a>
    </div>
  <?php else: ?>
    <h2 class="m-4">登録に失敗しました</h2>
    <div class="px-5 py-5 my-4" style="border: 2px solid #F7D1CD;">
      <p>カード情報の登録処理中にエラーが発生したか、ログインしていません。</p>
    </div>
    <div>
      <a href="card-input.php" class="btn btn-secondary rounded-0">もう一度試す</a>
    </div>
  <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>