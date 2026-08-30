<?php
  session_start();
  require_once 'includes/db.php';
  unset($_SESSION['customer']);
  if(isset($_POST['mail'], $_POST['password'])){
    $sql=$pdo->prepare('select * from customers where mail=? and password=?');
    $sql->execute([$_POST['mail'], $_POST['password']]);
    $customer = $sql->fetch();
    if($customer){
      $_SESSION['customer'] = $customer;

      $cart_sql = $pdo->prepare('
        SELECT carts.product_id, carts.count, products.name, products.price
        FROM carts
        JOIN products ON carts.product_id = products.id
        WHERE carts.customer_id = ?
      ');
      $cart_sql->execute([$customer['id']]);
      $_SESSION['product'] = [];
      foreach ($cart_sql as $row) {
        $id = $row['product_id'];
        $_SESSION['product'][$id]=[
          'count'=> $row['count'],
          'name'=> $row['name'],
          'price'=> $row['price']
        ];
      }
    }
  }
?>
<?php
  $page_title = 'ログイン';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
  <li class="breadcrumb-item"><a href="login-input.php">ログイン</a></li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- テキスト分岐エリア -->
<div class="container my-5 text-center">
  <?php if (isset($_SESSION['customer'])): ?>
      <h2 class="m-4">ログイン完了</h2>
      <div class="px-5 py-5" style="border: 2px solid #F7D1CD;">
        <p>
        ログインが完了しました。
        <br>引き続きお楽しみください。
        </p>
      </div>
      <div class="d-flex flex-column align-items-end">
        <a href="#">購入確認ページへ進む</a>
        <a href="index.php">TOPページへ戻る</a>
      </div>
      
    <?php else: ?>
      <h2 class="m-4">ログインできません</h2>
      <div class="p-5" style="border: 2px solid #F7D1CD;">
        <p>
        メールアドレスかパスワードが間違っています。
        <br>情報をご確認ください。
        </p>
      </div>
      <div class="text-end">
        <a href="index.php">TOPページへ戻る</a>
      </div>
    <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>