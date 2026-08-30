<?php
if(session_status() === PHP_SESSION_NONE){
  session_start();
}
?>
<?php require 'includes/header.php'; ?>
<!-- ようこそゲスト様 -->
<?php require 'includes/welcomeGuest.php'; ?>

<section>
  <img class="w-100" src="images/hero.png" alt="topImg">
</section>
<div class="container text-center">
  <div class="row py-5 gx-5">
    <div class="col-6">
      <img class="img-fluid" src="images/summerCytrus.png" alt="newItem">
    </div>
    <div class="col-6">
      <img class="img-fluid" src="images/donutLife.png" alt="column">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="products.php">
        <img class="img-fluid mb-4" src="images/item.png" alt="regular">
      </a>
    </div>
  </div>
</div>  
<section class="shopInfo">
  <img class="w-100 object-fit-cover" src="images/shopInfo.png" alt="shopInfo">
</section>
<?php require 'ranking.php'; ?>
<?php require 'includes/footer.php'; ?>
