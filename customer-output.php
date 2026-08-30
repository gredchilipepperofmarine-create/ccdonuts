<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
require_once 'includes/db.php';
?>
<?php
  $page_title = '会員登録';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
  <li class="breadcrumb-item"><a href="login-input.php">ログイン</a></li>
  <li class="breadcrumb-item active" aria-current="page">会員登録</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- phpエリア -->
<?php
// エラー判定用のフラグ(メッセージ切替用)
$is_updated = false;
$is_inserted = false;

if(isset($_SESSION['customer'])) {
  // customerの中のpassword等を呼び出す
  $id=$_SESSION['customer']['id'];
  // 同じパスワードとメールアドレスでログイン中の人がいないか検索する(select~)
  $sql=$pdo->prepare('select * from customers where id!=? and password=?');
  $sql->execute([$id, $_POST['password']]);
} else {
  // ログイン中の人で該当がいないなら、同じパスワードを使っている人がいるか探す
  $sql=$pdo->prepare('select * from customers where password=?');
  $sql->execute([$_POST['password']]);
}
// fetchで検索結果を取得して、空(empty)なら
if(empty($sql->fetchAll())) {
  if(isset($_SESSION['customer'])) {
    $sql=$pdo->prepare('
    update customers set name=?,
    furigana=?,
    postcode_a=?,
    postcode_b=?,
    address=?,
    mail=?,
    password=?
    where id=?');
    $sql->execute([
      $_POST['name'],
      $_POST['furigana'],
      $_POST['postcode_a'],
      $_POST['postcode_b'],
      $_POST['address'],
      $_POST['mail'],
      $_POST['password'],
      $id]);
      $_SESSION['customer']=[
        'id'=>$id,
        'name'=>$_POST['name'],
        'furigana'=>$_POST['furigana'],
        'postcode_a'=>$_POST['postcode_a'],
        'postcode_b'=>$_POST['postcode_b'],
        'address'=>$_POST['address'],
        'mail'=>$_POST['mail'],
        'password'=>$_POST['password']
      ];
      $is_updated = true;
  } else {
    // 新規登録処理(insert)
    $sql=$pdo->prepare('insert into customers values(null,?,?,?,?,?,?,?)');
    $sql->execute([
      $_POST['name'],
      $_POST['furigana'],
      $_POST['postcode_a'],
      $_POST['postcode_b'],
      $_POST['address'],
      $_POST['mail'],
      $_POST['password'],
      ]);
      $is_inserted = true;
  }
} 
?>

<!-- テキスト分岐エリア -->
<div class="container my-5 text-start text-md-center">
  <?php if($is_updated): ?>
    <h2 class="m-4">会員情報を更新しました。</h2>
      <div class="px-5 py-5" style="border: 2px solid #F7D1CD;">
      <p>
      会員情報の更新が完了しました。
      </p>
    </div>
      <div class="text-end">
      <a href="#">購入確認ページへ進む</a>
    </div>
    </div>
  <?php elseif($is_inserted): ?>
    <h2 class="m-4">会員登録完了</h2>
      <div class="px-5 py-5" style="border: 2px solid #F7D1CD;">
      <p>
      会員登録が完了しました。
      <br>ログインページへお進みください。
      </p>
    </div>
      <div class="text-end">
        <ul>
          <li><a href="login-input.php">ログインページへ進む</a></li>
          <li><a href="card-input.php">クレジットカード登録へ進む</a></li>
          <li><a href="#">購入確認ページへ進む</a></li>
        </ul>
    </div>
  <?php else: ?>
    <h2 class="m-4">登録できません</h2>
      <div class="px-5 py-5" style="border: 2px solid #F7D1CD;">
      <p>
      このメールアドレスは既に登録されています。
      <br>情報をご確認ください。
      </p>
    </div>
      <div class="text-end">
      <a href="login-input.php">ログインページへ進む</a>
    </div>
    </div>
  <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>
