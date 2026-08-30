<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'db.php';
?>

<?php
// postで送信されたidがあるなら
if(isset($_POST['id'])){
  // それを$idに代入して
  $id=$_POST['id'];
  $count = $_POST['count'] ?? "";
  if(empty($count) || (int)$count < 1 ){
    $count = 1;
  }
  $add_count = (int)$count;

  // $pdoからidを引っ張て来て$sqlに代入して(prepareの中身に()がsql文)
  $sql=$pdo->prepare('select * from products where id=?');
  // $idで$sqlを実行する
  $sql->execute([$id]);
  $product = $sql->fetch();

  if($product) {
    if(isset($_SESSION['customer'])){
      $customer_id = $_SESSION['customer']['id'];

      $check_sql = $pdo->prepare('select * from carts where customer_id =? AND product_id =?');
      $check_sql->execute([$customer_id, $id]);
      $check_item = $check_sql->fetch();

      if($check_item) {
        $new_count = $check_item['count'] + $add_count;
        $update_sql = $pdo->prepare('UPDATE carts SET count = ? where customer_id = ? AND product_id = ?');
        $update_sql->execute([$new_count, $customer_id, $id]);
      } else {
        $new_count = $add_count;
        $insert_sql = $pdo->prepare('INSERT INTO carts (customer_id, product_id, count) VALUES (?, ?, ?)');
        $insert_sql->execute([$customer_id, $id, $new_count]);
      }
      $_SESSION['product'][$id] = [
      //   // セッションに保存したproductの配列を、idをキーとして保存(セット)
      //   // $producs['name']の配列のキーとして(=>)nameを代入せよ
      //   // ただの＝は「代入せよ」だが、=>は「=>の左側をキーとして右側のデータを代入せよ」
        'id' => $id,
        'name' => $product['name'],
        'price' => $product['price'],
        'count' => $new_count
      ];
    } else {
      if(!isset($_SESSION['product'])){
        $_SESSION['product'] = [];
      }
      $currentCount = isset($_SESSION['product'][$id])?$_SESSION['product'][$id]['count'] : 0;
      $_SESSION['product'][$id] = [
        // セッションに保存したproductの配列を、idをキーとして保存(セット)
        // $producs['name']の配列のキーとして(=>)nameを代入せよ
        // ただの＝は「代入せよ」だが、=>は「=>の左側をキーとして右側のデータを代入せよ」
        'id' => $id,
        'name' => $product['name'],
        'price' => $product['price'],
        'count' => $currentCount + (int)$count
      ];
    }
  }
}
header('Location: ../cart.php');
exit;
?>


