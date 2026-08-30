<?php
 if(session_status() === PHP_SESSION_NONE){
  session_start();
  if(!isset($_SESSION['customer'])) {
    $_SESSION['login_message'] = 'お気に入り機能はログインの後ご利用いただけます';
    header('Location: login-input.php');
    exit;
  }
 }
?>

<?php
  $page_title = 'お気に入り一覧';
  require 'includes/header.php';
  ?>
<!-- パンくずリスト -->
<?php require 'includes/breadCrumb.php'; ?>
    <li class="breadcrumb-item">お気に入りリスト</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>

<?php
$message = 'お気に入り登録がありません';

// ログイン中のユーザーIDを取得
$customer_id = $_SESSION['customer']['id'] ?? null;

// 「お気に入りから削除する」ボタンが押されたときの処理
if (isset($_POST['id']) && $customer_id) {
    $delete_sql = $pdo->prepare('delete from favorites where customer_id = ? and product_id = ?');
    $delete_sql->execute([$customer_id, $_POST['id']]);
}

// DBから「このユーザーがお気に入り登録した商品一覧」をまとめて取得する
$favorites = [];
if ($customer_id) {
    // favorites テーブルと products テーブルを結合（JOIN）して商品情報を取得
    $sql = $pdo->prepare('
        select products.* from favorites 
        join products on favorites.product_id = products.id 
        where favorites.customer_id = ?
    ');
    $sql->execute([$customer_id]);
    $favorites = $sql->fetchAll(); // 全件まとめて取得
}
?>

<!-- テキストエリア -->
<?php if(!empty($favorites)): ?>
  <?php foreach($favorites as $product): ?>
    <div class="container text-center py-3">
        <div style="border: 1px solid #E6CCB2;">
          <div class="row p-1 p-md-5">
            <div class="col-12 col-md-6 p-3">
              <img class="w-50" src="images/items/<?= $product['id'] ?>.png">
            </div>
            <div class="col-12 col-md-6 p-5 text-start">
              <a href="detail.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
              <p>税込み ￥<?= number_format($product['price']) ?></p>
              <form action="favorite.php" method="post">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                <input class="text-center" type="submit" value="お気に入りから削除する" style="color: #000; border-bottom: 1px solid;">
              </form>
            </div>
          </div>
        </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <div class="py-5 m-5 text-center" style="border: 1px solid #E6CCB2;">
    <?= $message ?>
  </div>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>