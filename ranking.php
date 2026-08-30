<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/db.php';
?>
<?php
// sql文をpdoに渡してprepareして$sqlに代入
  $ranking_sql = $pdo->prepare('
    SELECT
    products.id,
    products.name,
    products.price,
    COALESCE(SUM(order_details.count * order_details.price), 0) AS total_sales
    FROM products LEFT JOIN order_details ON order_details.product_id = products.id
    GROUP BY products.id ORDER BY total_sales DESC, products.id ASC LIMIT 6;
  ');
  // $sqlを実行
  $ranking_sql->execute();
?>

<!-- テキストエリア -->
<div class="container text-center">
  <div class="row p-5">
    <div class="col">
      <h2>人気ランキング</h2>
    </div>
  </div>
  <div class="row text-start">
    <?php foreach($ranking_sql as $index => $product): ?>
        <div class="col-6 col-md-4 d-flex justify-content-center">
          <div class="rankDetail py-5">
            <div class="text-center">
              <?php if($index+1 < 4): ?>
                <img src="images/rank<?= $index+1 ?>.png">
              <?php else: ?>
                <p class="m-0 pt-4">
                  <?= $index+1 ?>
                </p>
              <?php endif; ?>
            </div>
            <div class="px-1">
              <a href="detail.php?id=<?= $product['id'] ?>">
                <img class="w-100 object-fit-cover py-4" src="images/items/<?= $product['id'] ?>.png">
                <p><?= $product['name'] ?></p>
              </a>
              </div>
            <p class="text-danger">税込 ￥<?= number_format($product['price']) ?></p>
            <div class="text-center">
              <form action="includes/cart-insert.php" method="post">
              <input type="hidden" name="id" value="<?= $product['id'] ?>">
              <input type="hidden" name="count" value="1">
              <input class="text-center px-4 px-md-5 py-2" type="submit" value="カートに入れる" style="background-color:#7F5539; color: #fff;">
              </form>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>

