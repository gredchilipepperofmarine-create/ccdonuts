<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = 'ご購入確認';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item"><a href="cart.php">カート</a></li>
    <li class="breadcrumb-item">ご購入確認</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<?php

  // 1. ログインチェック
  if (!isset($_SESSION['customer'])) {
    echo '<div class="container my-5 text-center"><p>ご購入手続きにはログインが必要です。</p><a href="login-input.php" class="btn btn-primary">ログイン画面へ</a></div>';
    require 'includes/footer.php';
    exit;
  }

  // DBのカートチェックのための準備
  $customer_id = $_SESSION['customer']['id'];
  $cart_sql = $pdo -> prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.id WHERE carts.customer_id = ?');
  $cart_sql -> execute([$customer_id]);
  $db_products = $cart_sql->fetchAll();

  // DB内のカートチェックでif分岐
  if (empty($db_products)) {
    echo '<div class="container my-5 text-center"><p>カートに商品が入っていません。</p><a href="index.php" class="btn btn-primary">商品一覧へ</a></div>';
    require 'includes/footer.php';
    exit;
  }

// ORDER BY id DESC 大きい順に並べる
$card_sql = $pdo->prepare('SELECT * FROM cards WHERE customer_id = ? ORDER BY id DESC');
$card_sql->execute([$customer_id]);
$cards = $card_sql->fetchAll();

?>

<!-- テキストエリア -->
<div class="container my-5" style="max-width: 800px;">
  <h2 class="text-center mb-4">ご購入内容の確認</h2>
  <!-- 購入商品一覧 -->
  <div class="card mb-4 rounded-0">
    <div class="card-header bg-light">注文商品</div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th>商品名</th>
            <th>価格</th>
            <th>個数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php $total = 0; ?>
          <?php foreach($db_products as $id => $product): ?>
            <?php
              $subtotal = $product['price'] * $product['count'];
              $total += $subtotal;
            ?>
            <tr>
              <td><?= h($product['name']) ?></td>
              <td>&yen;<?= number_format($product['price']) ?></td>
              <td><?= h($product['count']) ?></td>
              <td>&yen;<?= number_format($subtotal) ?></td>
            </tr>    
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="text-end fw-bold fs-5">
        合計金額: &yen;<?= number_format($total) ?>
      </div>
    </div>
  </div>

  <!-- 決済用フォーム -->
  <form action="purchase-output.php" method="post">
    <!-- クレジットカード情報 -->
    <div class="card mb-4 rounded-0">
      <div class="card-header bg-light">お支払い方法（クレジットカード選択）</div>
      <div class="card-body">
        <?php if(!empty($cards)): ?>
          <p>ご使用になるクレジットカードを選択してください:</p>
          <?php foreach($cards as $index => $card): ?>
            <div class="form-check mb-2">
              <input type="radio" class="form-check-input" name="card_id" id="card_<?= $card['id'] ?>" value="<?= $card['id'] ?>" <?= $index === 0 ? 'checked' : '' ?> required>
              <label class="form-check-label" for="card_<?= $card['id'] ?>">
                カード番号: **** **** **** <?= substr($card['card_number'], -4) ?> (名義: <?= h($card['card_name']) ?>)
              </label>
            </div>
          <?php endforeach; ?>
          <div class="mt-3">
            <a href="card-input.php" class="btn btn-sm btn-outline-secondary">新しいカードを登録する</a>
          </div>
        <?php else: ?>
          <p class="text-danger">登録されているクレジットカードがありません。</p>
          <a href="card-input.php" class="btn btn-primary rounded-0" style="border: none; background-color: #7F5539;">クレジットカードを登録する</a>
        <?php endif; ?>
      </div>
    </div>

    <!-- 注文確定ボタン -->
    <?php if (!empty($cards)): ?>
      <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg rounded-0 w-50" style="border: none; background-color: #7F5539;">注文を確定する（決済）</button>
      </div>
    <?php endif; ?>
  </form>
</div>

<?php require 'includes/footer.php'; ?>

