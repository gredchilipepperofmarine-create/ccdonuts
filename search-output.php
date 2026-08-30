<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
require_once 'includes/db.php';
?>
<?php
  $page_title = '検索結果';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
  <li class="breadcrumb-item">検索結果</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- phpエリア -->
<?php
$word = $_GET['search'] ?? "";
$products = [];
if(!empty($word)){
  $word_hiragana = mb_convert_kana($word, 'c', 'UTF-8');
  $word_katakana = mb_convert_kana($word, 'C', 'UTF-8');
  $search_sql = $pdo->prepare('SELECT * FROM products WHERE name LIKE ? OR name LIKE ?');
  $search_sql->execute(['%'.$word_hiragana.'%', '%'.$word_katakana.'%' ]);
  $products = $search_sql->fetchAll();
}

?>

<!-- テキストエリア -->
<?php if(!empty($word)): ?>
  <div class="text-center">
    <h2 class="m-4"><small>検索ワード:</small><?= h($word)?></h2>
  </div>
  <?php if($products): ?>
    <?php foreach($products as $product): ?>
      <div class="container text-center py-3">
        <div style="border: 1px solid #E6CCB2;">
          <div class="row p-1 p-md-5">
            <div class="col-12 col-md-6 p-3">
              <img class="w-50" src="images/items/<?= h($product['id']) ?>.png">
            </div>
            <div class="col-12 col-md-6 p-5 text-start">
              <a href="detail.php?id=<?= h($product['id']) ?>"><?= h($product['name']) ?></a>
              <p>税込み ￥<?= number_format($product['price']) ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="text-center">
      <p class="m-4">該当の商品はありません</p>
    </div>
  <?php endif; ?>
<?php else: ?>
  <div class="text-center">
    <h2 class="m-4">検索ワードを入力してください</h2>
  </div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>




