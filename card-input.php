<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = 'クレジット登録';
  // 検索に引っ掛からないようにする処理。処理詳細はheaderの中
  $noindex = true;
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">クレジット登録</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->


<!-- テキストエリア -->
<div class="container mt-5 text-start text-md-center">
  <div class="text-center">
    <h2 class="m-4">クレジットカード登録</h2>
  </div>
  <div class="text-center" style="font-weight: bold; border: 2px solid; background-color: #ff0000; color: #fff;">
    <div class="py-1 my-3" >
      <p class="text-warning">注意</p>
      <p>実際のクレジット情報を<br>入力しないでください</p>
      <p>ここは疑似サイトです</p>
    </div>
  </div>
  <?php if(isset($_SESSION['customer'])): ?>
    <div class="my-5 text-start text-md-center">
      <form action="card-output.php" method="post">
        <div class="mb-3">
          <label class="form-label">カード名義<span class="text-danger ms-1">(必須)</span></label>
          <input type="text" class="form-control rounded-0" name="card_name" placeholder="UEBU ENJI" required>
        </div>
        <div class="mb-3">
          <label class="form-label">カード番号<span class="text-danger ms-1">(必須)</span></label>
          <input type="text" class="form-control rounded-0" name="card_number" placeholder="0123456789123456" maxlength="8" pattern="\d{6,8}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">有効期限(月/年)<span class="text-danger ms-1">(必須)</span></label>
          <div class="d-flex justify-content-md-center">
            <select class="form-select rounded-0 me-2" name="card_month" style="max-width: 120px" required>
              <option value="">月</option>
              <?php for($m=1; $m<=12; $m++): ?>
                <option value="<?= sprintf('%02d', $m) ?>"><?= sprintf('%02d', $m) ?></option>
              <?php endfor; ?>
            </select>
            <span class="align-self-center me-2">/</span>
            <select class="form-select rounded-0" name="card_year" style="max-width: 120px;" required>
              <option value="">年</option>
              <?php for($y=24; $y<=35; $y++): ?>
                <option value="<?= $y ?>"><?= $y ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
        <!-- セキュリティコード -->
        <div class="mb-3">
          <label class="form-label">セキュリティコード<span class="text-danger ms-1">(必須)</span></label>
          <input type="password" class="form-control rounded-0" name="security_code" placeholder="123" maxlength="4" pattern="\d{3,4}" required>
        </div>
        <div class="mb-4 text-center">
          <button type="submit" class="btn btn-primary w-50 rounded-0" style="border: none; background-color: #7F5539;">登録する</button>
        </div>
      </form>
    </div>
  <?php else: ?>
    <div>
      <div class="px-5 py-5" style="border: 2px solid #F7D1CD;">
        <?= 'クレジットカードを登録するにはログインが必要です' ?>
      </div>
      <div class="text-end">
        <ul>
          <li><a href="login-input.php">ログインページへ進む</a></li>
        </ul>
      </div>
    </div>
  <?php endif; ?>
</div>
    
<?php require 'includes/footer.php'; ?>






