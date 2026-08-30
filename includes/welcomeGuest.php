<div class="d-flex align-items-center justify-content-between text-start ps-3 mx-0 px-0" style="border-bottom: 1px solid #7F5539;">
  <!-- あいさつメッセージ -->
  <?php if(isset($_SESSION['customer'])): ?>
    <p class="mb-0">ようこそ<span style="color: #BF0000; font-weight: bold;"><?= $_SESSION['customer']['name'] ?></span>様</p>
  <?php else: ?>
    <p class="mb-0">ようこそゲスト様</p>
  <?php endif; ?>

  <!-- ボタン・アイコンエリア -->
  <div class="d-flex align-items-center">
    <?php if(isset($_SESSION['customer'])): ?>
      <!-- ログアウト画像 -->
      <a class="m-1" href="logout-input.php">
        <img class="icon loginImg" src="images/logout.png" alt="logoutBtn">
      </a>
    <?php else: ?>
      <!-- ログイン画像 -->
      <a class="m-1" href="login-input.php">
        <img class="icon loginImg" src="images/login.png" alt="loginBtn">
      </a>
    <?php endif; ?>

    <!-- カート画像 -->
    <a class="m-1" href="cart.php">
      <img class="icon curtImg" src="images/cart.png" alt="cart">
    </a>

    <!-- マイページ画像 -->
    <a class="m-1" href="mypage.php">
      <img class="icon loginImg" src="images/mypage.png" alt="mypageBtn">
    </a>
    
    <!-- お気に入り画像 -->
    <a class="m-1" href="favorite.php">
      <img class="icon loginImg" src="images/favoriteIcon.png" alt="favoriteBtn">
    </a>
  </div>

</div>
<!-- 以下にページ本体を記述 -->