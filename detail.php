<?php
// セッションをスタートして使えるようにする※まだ始まってない場合のみ
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/db.php';
?>
<?php
  $page_title = '商品詳細';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item"><a href="products.php">商品一覧</a></li>
    <li class="breadcrumb-item">商品詳細</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<?php
// "detail.php?id="などで送られてきたid=?(数字)を使って、
// db上のproductsテーブルから該当のidをもつ商品の全情報を取得する準備(prepare)をしている
  $sql=$pdo->prepare('select * from products where id=?');
  // 送られてきたid($_REQUEST['id'])を使って$sqlを実行(execute)する
  $sql->execute([$_REQUEST['id']]);

  // セッションの中からidという項目を取り出して$customer_idという変数に代入
  // つまりここではすでにセッションが存在している。ログイン時などでセッションを作る処理が入っているはず
  $customer_id = $_SESSION['customer']['id'] ?? null;
  // formで送られてきたidを$product_idという変数に代入
  $product_id = $_REQUEST['id'];

  // 以降初めてdbから取得した情報が使える


  // お気に入りボタンが押されたときの「追加/削除」処理

  // もしもフォームからidがPOST送信されてきたら
  if(isset($_POST['id']) && $customer_id){

    // セッションではなく、直接dbと接続してfavoriteを調べる準備をしている
    // prepare以降はdbから引っ張ってくるための記述。
    $check = $pdo->prepare('select * from favorites where customer_id=? and product_id=?');
    // where以降のcustomer_idとproduct_idに合致しているか調べる
    $check->execute([$customer_id, $product_id]);
    // ↑つまりexecute([$SESSION['customer']['id'], $_POST['id']])と書くこともできる
    
    // fetchは実行される(->)とデータがあればture、なければfalseを返す
    // つまりこの記述で、$check(custome_idとproduct_idに合致しているものがあるか)の真偽がわかる
    if($check->fetch()){
      // 合致するデータが存在している(お気に入り登録済)ならばそれを削除(delete)する準備
      $delete_sql = $pdo->prepare('delete from favorites where customer_id =? and product_id =?');
      // そしてそれを実行する
      $delete_sql->execute([$customer_id, $product_id]);
      // これらは、お気に入りボタンが押された状態(登録済)でもう一度押すとお気に入り解除(削除)のための機能

      // もしまだdbに合致するデータが存在しない(お気に入り登録されてな)なら、
    } else {
      // favoriteテーブルにcustomer_idとproduct_idを挿入(insert)する準備
      $insert_sql = $pdo->prepare('insert into favorites (customer_id, product_id)values (?, ?)');
      // そして実行
      $insert_sql->execute([$customer_id, $product_id]);
    }
  }
  $is_favorite = false;
  if($customer_id){
    $favorite_check = $pdo->prepare('select * from favorites where customer_id =? and product_id=?');
    $favorite_check->execute([$customer_id, $product_id]);

    $is_favorite = $favorite_check->fetch();
  }
?>

<!-- テキストエリア -->
<div class="container text-center">
  <div class="row p-1 p-md-5">
    <!-- 先ほどのif判定を終えてここまでたどり着いたら -->
     <!-- $sql(分岐によって違いあり)を$productと定義してforeachで取り出して回す(ループ表示) -->
    <?php foreach($sql as $product): ?>
      <div class="col-12 col-md-6">
        <div class="detailPic" style="max-height: 540px">
          <img class="w-100 h-100 object-fit-cover" src="images/items/<?= $product['id'] ?>.png">
        </div>
      </div>
      <div class="col-12 col-md-6 text-start">
        <div style="max-width: 460px; font-size: clamp(16px, 5vw, 24px);">
          <p class="detailName"><?= $product['name'] ?></p>
          <p class="detailText py-4" style="text-align: justify;"><?= $product['introduction'] ?>
          <p class="text-danger py-3">税込み ￥<?= number_format($product['price']) ?></p>
        </div>
        <div class="d-flex">
          <form action="includes/cart-insert.php" method="post">
            <div>
              <input type="hidden" name="id" value="<?= $product['id']?>">
              <input class="text-center p-2 align-baseline" type="number" name="count" value="1" style="border: 1px solid; max-width: 80px">個
              <input class="text-center px-4 px-md-5 py-2" type="submit" value="カートに入れる" style="background-color:#7F5539; color: #fff;">
            </div>
          </form>
          <form action="detail.php?id=<?= $product['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <input type="hidden" name="name" value="<?= $product['name'] ?>">
            <input type="hidden" name="price" value="<?= $product['price'] ?>">
            <?php if($is_favorite): ?>
              <input type="image" class="p-1 w-75" src="images/selectedFavorite.png" alt="favoriteBtn">
            <?php else: ?>
              <input type="image" class="p-1 w-75" src="images/favorite.png" alt="favoriteBtn">
            <?php endif; ?>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require 'includes/footer.php'; ?>