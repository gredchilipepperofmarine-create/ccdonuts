<?php
 if(session_status() === PHP_SESSION_NONE){
  session_start();
 }
?>
<?php
  $page_title = 'お問い合わせ';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">お問い合わせ</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- テキストエリア -->
<div class="container mt-5 p-3 text-center">
  <h2 class="text-center m-4">お問い合わせ</h2>
  <p class="text-center text-muted fs-6 mb-4">
    ご質問やご要望がございましたら<br class="d-block d-md-none">お気軽にお問い合わせください。
  </p>
  <div style="border: 2px solid #F7D1CD;" class="p-4 text-start">
    
    <form action="#" method="post" class="mx-auto" style="max-width: 600px;">
      
      <div class="mb-3">
        <label for="name" class="form-label fw-bold" style="color: #555;">お名前 <span class="badge" style="background-color: #FF8877;">必須</span></label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($_SESSION['customer']['name'] ?? '') ?>" placeholder="例）山田 太郎" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label fw-bold" style="color: #555;">メールアドレス <span class="badge" style="background-color: #FF8877;">必須</span></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="例）example@example.com" required>
      </div>

      <div class="mb-3">
        <label for="category" class="form-label fw-bold" style="color: #555;">お問い合わせ種別</label>
        <select class="form-select" id="category" name="category">
          <option selected>選択してください</option>
          <option value="product">商品について</option>
          <option value="delivery">配送・お届けについて</option>
          <option value="order">ご注文について</option>
          <option value="other">その他</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="message" class="form-label fw-bold" style="color: #555;">お問い合わせ内容 <span class="badge" style="background-color: #FF8877;">必須</span></label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="お問い合わせ内容をご記入ください" required></textarea>
      </div>

      <div class="text-center">
        <button type="button" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #FF8877;">送信する</button>
        <p class="text-danger">※疑似サイトのため送信されません</p>
      </div>

    </form>

  </div>
</div>
<?php require 'includes/footer.php'; ?>
