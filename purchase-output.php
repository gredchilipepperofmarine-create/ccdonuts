<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = 'ご購入完了';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">ご購入完了</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<?php

$is_success = false;

  // 1. ログインチェック ＆ カートチェック
  if (isset($_SESSION['customer']) && !empty($_SESSION['product']) && isset($_POST['card_id'])){
    $customer_id = $_SESSION['customer']['id'];
    $card_id = $_POST['card_id'];

    // 合計金額の計算
    $total = 0;
    foreach($_SESSION['product'] as $product){
      $total += $product['price'] * $product['count'];
    }

    try {
      // トランザクション開始(途中で処理が失敗したときに全取り消し)
      $pdo->beginTransaction();

      // ordersテーブルに注文概要を保存
      $order_sql = $pdo->prepare('INSERT INTO orders (customer_id, total_price, card_id) VALUES(?, ?, ?)');
      $order_sql->execute([$customer_id, $total, $card_id]);

      // 直前で作成された注文のauto_incrementIDを取得
      $order_id = $pdo->lastInsertId();

      // order_detailsテーブルに商品ごとの明細を保存
      $detail_sql = $pdo->prepare('INSERT INTO order_details (order_id, product_id, count, price) VALUES(?, ?, ?, ?)');
      foreach($_SESSION['product'] as $product_id => $product){
        $detail_sql->execute([
          $order_id,
          $product_id,
          $product['count'],
          $product['price']
        ]);

        // DBのカート情報も削除する（ログイン時）
        $cart_delete_sql = $pdo->prepare('DELETE FROM carts WHERE customer_id = ?');
        $cart_delete_sql->execute([$customer_id]);
        
      }
      // 処理がすべて成功したらDBに確定反映
      $pdo->commit();


      // カートを空にする
      unset($_SESSION['product']);
      $is_success = true;
    } catch (Exception $e) {
      //エラーが発生した場合はDBの変更を取り消す
      $pdo->rollBack();
      $is_success = false;
    }
  }
?>

<!-- テキストエリア -->
<div class="container my-5 text-center">
  <?php if ($is_success): ?>
    <h2 class="m-4">ご購入が完了しました</h2>
    <div class="px-5 py-5 my-4" style="border: 2px solid #F7D1CD;">
      <p>ご注文ありがとうございました。<br>疑似決済処理が正常に完了し、注文情報を保存しました。</p>
    </div>
    <div>
      <a href="index.php" class="btn btn-primary rounded-0" style="border: none; background-color: #7F5539;">トップページへ戻る</a>
    </div>
  <?php else: ?>
    <h2 class="m-4">ご購入手続きに失敗しました</h2>
    <div class="px-5 py-5 my-4" style="border: 2px solid #F7D1CD;">
      <p>決済処理中にエラーが発生したか、セッションが切れた可能性があります。</p>
    </div>
    <div>
      <a href="cart.php" class="btn btn-secondary rounded-0">カートへ戻る</a>
    </div>
  <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>