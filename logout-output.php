<?php
  if(session_status() === PHP_SESSION_NONE){
    session_start();
  }

  if(isset($_SESSION['customer'])) {
    unset($_SESSION['customer']);
    unset($_SESSION['product']);
    $message =" ログアウトしました。";
  } else {
    $message = "すでにログアウトしています。";
  }
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


<!-- テキストエリア -->
<div class="container text-center">
  <div style="border: 2px solid #FFD233" class="py-4 my-4">
    <?= $message ?>
  </div>
</div>
<div class="text-center py-3">
  <a href="index.php" class="text-center px-4 px-md-5 py-2" style="background-color:#7F5539; color: #fff;">TOPページへ戻る</a>
</div>
<?php require 'includes/footer.php'; ?>
