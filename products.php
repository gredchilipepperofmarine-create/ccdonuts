<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = '商品一覧';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item"><a href="products.php">商品一覧</a></li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<?php
// sql文をpdoに渡してprepareして$sqlに代入
  $sql=$pdo->prepare('select * from products');
  // $sqlを実行
  $sql->execute();
?>

<!-- テキストエリア -->
<div class="container text-center">
  <h2 class="pt-5">商品一覧</h2>
  <p class="py-5">メインメニュー</p>
    <div class="row">
      <!-- 全てのproductsに対して処理を繰り返す -->
    <?php foreach($sql as $product): ?>
      <div class="col-6 col-md-4 d-flex justify-content-center">
        <div class="rankDetail text-start py-5">
          <a href="detail.php?id=<?= $product['id'] ?>">
            <img class="w-100 object-fit-cover" src="images/items/<?= $product['id'] ?>.png">
            <p><?= $product['name'] ?></p>
          </a>
          <p class="text-danger">税込み ￥<?= number_format($product['price']) ?></p>
          <form action="includes/cart-insert.php" method="post">
            <div class="text-center">
              <input type="hidden" name="id" value="<?= $product['id']?>">
              <input type="hidden" name="count" value="1">
              <input class="text-center px-4 px-md-5 py-2" type="submit" value="カートに入れる" style="background-color:#7F5539; color: #fff;">
            </div>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require 'includes/footer.php'; ?>
