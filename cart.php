<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = 'カート';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">カート</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->


<?php
// もし画面から商品ID($_POST['id'])が送られてきたら
  if(isset($_POST['id'])){
    // productsテーブルから、その商IDのデータを1件探す準備をする
    $sql=$pdo->prepare('select * from products where id=?');
    // 実行する
    $sql->execute([$_POST['id']]);
  }
$message = 'カートに商品が入っていません';
// ログインしてるなら（$_SESSIONに顧客情報があるなら）
if(isset($_SESSION['customer'])){
  // pdoでデータベースに接続し、cartsとproductsをjoinした情報からこのユーザーのカート情報(cart)を探す指示(sql)を作って準備する
  $cart = $pdo->prepare('select * from carts join products on carts.product_id = products.id where carts.customer_id=?');
  // それを、セッションに入っているidを使って実行する
  $cart->execute([$_SESSION['customer']['id']]);
  // 実行した結果、帰ってきた「カートに入っている全商品のデータ」を、$db_productsに配列として代入する
  $db_products = $cart->fetchAll();
  // $db_productsの中から「count(個数)」の列だけを取り出して(array_culmun)、それらを全部足して(array_sum)、合計個数を$totalCountに代入
  $totalCount = array_sum(array_column($db_products, 'count'));

  $totalPrice = 0;
  $db_items = $db_products;
} else {
  $totalCount = isset($_SESSION['product']) ? array_sum(array_column($_SESSION['product'], 'count')):0;
  $db_items = $_SESSION['product'] ?? [];
}
  foreach($db_items as $product){
    $totalPrice += $product['price'] * $product['count'];
  }


?>

<!-- テキストエリア -->
<?php if(!empty($db_items)): ?>
  <div class="container text-center">
    <div style="border: 2px solid #FFD233" class="py-4 my-4">
      <?php if(isset($_POST['id'])): ?>
      <p>カートに商品が追加されました</p>
      <?php endif; ?>
      <p>現在商品<?= $totalCount ?>点</p>
      <p>ご注文小計<?= number_format($totalPrice) ?></p>
      <a href="purchase-confirm.php">
      <input class="text-center px-4 px-md-5 py-2" type="submit" value="購入確認へ進む" style="background-color:#BF0000; color: #fff;">
      </a>
    </div>
    <div class="text-end">
      <ul>
        <li><a href="index.php">TOPページへ戻る</a></li>
        <li><a href="products.php">商品一覧へ戻る</a></li>
      <ul>
    </div>
  </div>

  <!-- テキストエリア -->
  <?php foreach($db_items as $id => $product): ?>
    <div class="container text-center">
      <div class="row p-1 p-md-5">
          <div class="col-12 col-md-6">
            <img class="w-100 object-fit-cover" src="images/items/<?= $product['id'] ?>.png">
          </div>
          <div class="col-12 col-md-6 text-md-start" >
            <div style="font-size: clamp(16px, 5vw, 24px);">
              <a href="detail.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
            </div>
            <div class="cartText">
              <div class="d-md-flex py-3" style="font-size: clamp(16px, 5vw, 24px);">
                <p class="text-danger text-md-start w-100">税込み ￥<?= number_format($product['price']*$product['count']) ?></p>
                <div class="text-md-end w-100" style="color: #000;">
                  <form action="includes/delete-output.php" method="post">
                    数量
                    <input class="px-1 align-baseline" type="number" name="count" style="border: 1px solid #7F5539; max-width: 80px;" value="<?= $product['count']?>">
                    個
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input class="text-center px-2 px-md-5 my-3" type="submit" value="再計算" style="color: #000; background-color:#ccc;">
                  </form>
                </div>
              </div>
              <form action="includes/delete-output.php" method="post">
                <div class="text-md-end py-3 pt-5">
                  <input type="hidden" name="count" value="0">
                  <input type="hidden" name="id" value="<?= $product['id'] ?>">
                  <input class="text-center" type="submit" value="削除する" style="color: #000; border-bottom: 1px solid;">
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- テキストエリア -->
  <div class="container text-center">
    <div style="border: 2px solid #FFD233" class="py-4 my-4">
      <p>現在商品<?= $totalCount ?>点</p>
      <p>ご注文小計<?= number_format($totalPrice) ?></p>
      <a href="purchase-confirm.php">
        <input class="text-center px-4 px-md-5 py-2" type="submit" value="購入確認へ進む" style="background-color:#BF0000; color: #fff;">
      </a>
    </div>
  </div>
<?php else: ?>
  <div class="text-center p-4 p-md-5 m-5" style="border: 2px solid #FFD233">
    <?= $message ?>
  </div>
<?php endif; ?>
<div class="text-center py-3">
  <a href="products.php" class="text-center px-4 px-md-5 py-2" style="background-color:#7F5539; color: #fff;">買い物を続ける</a>
</div>
<?php require 'includes/footer.php'; ?>






