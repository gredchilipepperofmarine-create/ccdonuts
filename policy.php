<?php
 if(session_status() === PHP_SESSION_NONE){
  session_start();
 }
?>
<?php
  $page_title = 'ポリシー';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">ポリシー</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<!-- テキストエリア -->
<style>
  /* ポリシーの本文のみ、両端揃えを適用 */
  .policy-container .policy-text {
    text-align: justify;
    text-justify: inter-ideograph; /* 日本語の文字間調整を最適化 */
  }
</style>

<!-- テキストエリア -->
<div class="container mt-5 p-3 text-center policy-container">
  <h2 class="text-center m-4">当サイトのポリシー</h2>
  <div style="border: 2px solid #F7D1CD;" class="p-4 text-start">
    
    <div class="policy-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <h4 style="color: #FF8877; font-size: 1.1rem; font-weight: bold;" class="mb-2">1. 品質・安全へのこだわり</h4>
      <p class="mb-0 text-muted fs-6 policy-text" style="padding-left: 0.5rem;">
        当店のドーナツは、厳選した素材を使用し、ひとつひとつ丁寧に手作りしております。安心してお召し上がりいただけるよう、保存料や不要な添加物は極力使用せず、徹底した衛生管理のもとでお届けいたします。
      </p>
    </div>

    <div class="policy-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <h4 style="color: #FF8877; font-size: 1.1rem; font-weight: bold;" class="mb-2">2. 個人情報の保護</h4>
      <p class="mb-0 text-muted fs-6 policy-text" style="padding-left: 0.5rem;">
        お客様からお預かりしたお名前、ご住所、メールアドレスなどの個人情報は、商品の発送やお客様へのご連絡以外の目的で使用することはございません。法令に基づき、安全に厳重管理いたします。
      </p>
    </div>

    <div class="policy-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <h4 style="color: #FF8877; font-size: 1.1rem; font-weight: bold;" class="mb-2">3. 返品・交換・キャンセルについて</h4>
      <p class="mb-0 text-muted fs-6 policy-text" style="padding-left: 0.5rem;">
        食品という商品の性質上、お客様のご都合による返品・交換・出荷後のキャンセルはお受けできかねます。万が一、届いた商品に不備や破損がございましたら、商品到着後2日以内にご連絡をお願いいたします。
      </p>
    </div>

    <div class="policy-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <h4 style="color: #FF8877; font-size: 1.1rem; font-weight: bold;" class="mb-2">4. クレジットカード決済の安全性</h4>
      <p class="mb-0 text-muted fs-6 policy-text" style="padding-left: 0.5rem;">
        当サイトではSSL（暗号化通信）を導入しております。お客様の入力されたクレジットカード情報等の重要データは暗号化されて送信されますので、安心してご利用いただけます。
      </p>
    </div>

    <div class="policy-item mb-2">
      <h4 style="color: #FF8877; font-size: 1.1rem; font-weight: bold;" class="mb-2">5. 環境への取り組み</h4>
      <p class="mb-0 text-muted fs-6 policy-text" style="padding-left: 0.5rem;">
        おいしさだけでなく地球環境にもやさしくあるため、配送時の包装資材には再生紙やバイオマス素材を積極的に使用しています。簡易包装へのご理解とご協力をお願い申し上げます。
      </p>
    </div>

  </div>
</div>
<?php require 'includes/footer.php'; ?>
