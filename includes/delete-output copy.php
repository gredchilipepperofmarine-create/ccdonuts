<?php
if(session_status() === PHP_SESSION_NONE) {
  session_start();
}

  require_once 'db.php';

if(isset($_POST['id'], $_POST['count'])){
  $count = (int)$_POST['count'];
  $id = $_POST['id'];
  if(isset($_SESSION['customer'])){
    if($count > 0) {
      // ログイン済の場合に再計算の記述
      $update_sql = $pdo->prepare('UPDATE carts SET count = ? where customer_id = ? AND product_id = ?');
      $update_sql->execute([$count, $_SESSION['customer']['id'], $id]);
    } else {
      $delete_sql = $pdo->prepare('DELETE FROM carts where customer_id = ? AND product_id = ?');
      $delete_sql->execute([$_SESSION['customer']['id'], $id]);
    }
  } else {
    // 未ログインの場合はセッションから持ってきて処理
    if($count > 0) {
      // 再計算の場合
      $_SESSION['product'][$id]['count'] = $count;
    } else {
      // 削除ボタンの場合
      unset($_SESSION['product'][$id]);
    }
  }
  header('Location: ../cart.php');
  exit;
}
?>