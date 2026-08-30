<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/db.php';
if(!function_exists('h')){
  // XSS対策用のエスケープ処理を行う短縮関数
  // @param string|null $str 変換したい文字列
  // @return string エスケープ後の文字列
  function h($str){
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <?php if(isset($noindex) && $noindex === true): ?>
      <meta name="robots" content="noindex">
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="common/reset.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="styles/style.css" rel="stylesheet">
    <title>C.C.Donuts<?php echo isset($page_title) ? '｜' . $page_title : ''; ?></title>
  <body>
    <header>
      <div class="headerLogoArea">
        <div class="container text-center py-3">
          <div class="row py-2 align-items-center">
            <div class="col-4 text-start">
              <!-- ボタン部分 -->
              <button type="button" class="btn p-0 border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <img class="icon" src="images/drawer.png" alt="drawerIcon">
              </button>
              <!-- 上から降りてくるメニュー -->
              <!-- ロゴエリア -->
              <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: rgba(127, 85, 57, .75); height: 418px;">
                <div class="offcanvas-header position-relative justify-content-end py-5">
                  <a href="index.php">
                    <img class="iconLogo position-absolute start-50 translate-middle-x" src="images/logo.png" alt="logo">
                  </a>
                  <button type="button" class="btn-close btn-close-white" style="width: 54px; height: 54px; background-size: contain; padding: 0 95px 0 0;" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- 本体 -->
                <div class="offcanvas-body text-white d-flex flex-column align-items-center">
                  <ul class="navbar-nav pe-0 mx-auto w-100" style="max-width: 560px;">
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link active fs-6 fs-md-4" aria-current="page" href="index.php">TOP</a>
                    </li>
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link fs-6 fs-md-4" href="mypage.php">マイページ</a>
                    </li>
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link fs-6 fs-md-4" href="products.php">商品一覧</a>
                    </li>
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link fs-6 fs-md-4" href="question.php">よくある質問</a>
                    </li>
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link fs-6 fs-md-4" href="contact.php">問い合わせ</a>
                    </li>
                    <li class="nav-item border-bottom border-white w-100 text-start text-md-center">
                      <a class="nav-link fs-6 fs-md-4" href="policy.php">当サイトのポリシー</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- ロゴ画像 -->
            <div class="col-4">
              <a href="index.php">
                <img class="iconLogo" src="images/logo.png" alt="logo">
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- 検索ボックス -->
      <form action="search-output.php" method="get">
        <div class="headerSearchArea py-3 px-3 d-flex justify-content-center justify-content-md-end">
          <div class="input-group rounded-0" style="border: 1px solid #7F5539; width: 355px;">
            <button type="submit">
              <span class="rounded-0 d-flex align-items-center justify-content-center" 
                    style="background-color: #d9d9d9; border-right: 3px solid #7F5539; width: 40px; height: 40px;">
                <img src="images/searchIcon.png" alt="検索">
              </span>
            </button>
              <input type="text" name="search" class="form-control border-0 rounded-0 shadow-none" placeholder="検索ワードを入力" style="height: 40px;">
          </div>
        </div>
      </form>
    </header>