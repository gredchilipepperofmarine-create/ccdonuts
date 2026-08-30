<?php
if(session_status() === PHP_SESSION_NONE)
  session_start();
?>
<?php
  $page_title = 'ログアウト';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item"><a href="logout-input.php">ログアウト</a></li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->


<div class="container mt-5 p-3 text-center">
  <h2 class="m-4">ログアウト</h2>
  <div style="border: 2px solid #F7D1CD;" class="p-4">
    <p>ログアウトしますか？</p>
    <div class="mb-4 text-center">
      <a href="logout-output.php" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #7F5539;">ログアウトする</a>
    </div>
  </div>
  <div class="mb-4 text-end">
    <ul>
      <li><a href="cart-insert.php" class="rounded-0" style="border: none; color: #7F5539;">カートを見る</a><li>
      <li><a href="products.php" class="rounded-0" style="border: none; color: #7F5539;">商品一覧を見る</a><li>
      <li><a href="card-input.php" class="rounded-0" style="border: none; color: #7F5539;">クレジットカード登録へ進む</a><li>
    </ul>
  </div>
</div>


<?php require 'includes/footer.php'; ?>
