<?php
 if(session_status() === PHP_SESSION_NONE){
  session_start();
 }
?>
<?php
  $page_title = 'よくあるご質問';
  require 'includes/header.php';
  ?>
<?php require 'includes/breadCrumb.php'; ?>
<!-- パンくずリスト -->
    <li class="breadcrumb-item">よくあるご質問</li> 
</li>
  </ol>
</nav>
<?php require 'includes/welcomeGuest.php'; ?>
<!-- ようこそゲスト様 -->

<style>
  /* Q用：文節区切りで自然に折り返す */
  .faq-container span.text-segment {
    display: inline-block;
  }

  /* A用：スマホでも右端がきれいに揃う「両端揃え」 */
  .faq-container .faq-answer {
    text-align: justify;
    text-justify: inter-ideograph; /* 日本語テキストの余白調整を最適化 */
  }
</style>

<!-- テキストエリア -->
<div class="container mt-5 p-3 text-center faq-container">
  <h2 class="text-center m-4">よくあるご質問（FAQ）</h2>
  <div style="border: 2px solid #F7D1CD;" class="p-4 text-start">
        
    <div class="faq-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <p class="fw-bold mb-2" style="color: #555;">
        <span style="color: #FF8877; font-weight: bold; me-1;">Q.</span>
        <span class="text-segment">ドーナツの賞味期限はどのくらい？</span>
      </p>
      <p class="mb-0 text-muted fs-6 faq-answer" style="padding-left: 1.2rem;">
        <span style="color: #FF8877; font-weight: bold;">A.</span> 到着後、冷凍保存で約2週間美味しくお召し上がりいただけます。解凍後は当日中にお召し上がりください。
      </p>
    </div>

    <div class="faq-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <p class="fw-bold mb-2" style="color: #555;">
        <span style="color: #FF8877; font-weight: bold; me-1;">Q.</span>
        <span class="text-segment">美味しい解凍方法や食べ方は？</span>
      </p>
      <p class="mb-0 text-muted fs-6 faq-answer" style="padding-left: 1.2rem;">
        <span style="color: #FF8877; font-weight: bold;">A.</span> 冷蔵庫で約2〜3時間自然解凍するのがおすすめです。トースターで30秒ほど温め直すと、出来立てのようなサクふわ食感をお楽しみいただけます。
      </p>
    </div>

    <div class="faq-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <p class="fw-bold mb-2" style="color: #555;">
        <span style="color: #FF8877; font-weight: bold; me-1;">Q.</span>
        <span class="text-segment">ラッピングや熨斗はできますか？</span>
        <span class="text-segment"></span>
      </p>
      <p class="mb-0 text-muted fs-6 faq-answer" style="padding-left: 1.2rem;">
        <span style="color: #FF8877; font-weight: bold;">A.</span> はい、可能です。オリジナルのギフトボックスやオリジナルメッセージカードを無料でご用意しております。ご注文画面の「ギフト設定」よりお選びください。
      </p>
    </div>

    <div class="faq-item mb-4 pb-3" style="border-bottom: 1px dashed #F7D1CD;">
      <p class="fw-bold mb-2" style="color: #555;">
        <span style="color: #FF8877; font-weight: bold; me-1;">Q.</span>
        <span class="text-segment">卵・乳製品不使用の商品はありますか？</span>
        <span class="text-segment"></span>
      </p>
      <p class="mb-0 text-muted fs-6 faq-answer" style="padding-left: 1.2rem;">
        <span style="color: #FF8877; font-weight: bold;">A.</span> 一部、小麦・卵・乳製品不使用のプラントベース（ヴィーガン対応）ドーナツをご用意しております。各商品ページのアレルギー詳細をご確認ください。
      </p>
    </div>

    <div class="faq-item mb-2">
      <p class="fw-bold mb-2" style="color: #555;">
        <span style="color: #FF8877; font-weight: bold; me-1;">Q.</span>
        <span class="text-segment">配送日時の指定は可能ですか？</span>
      </p>
      <p class="mb-0 text-muted fs-6 faq-answer" style="padding-left: 1.2rem;">
        <span style="color: #FF8877; font-weight: bold;">A.</span> ご注文日より4日後以降の日時をご指定いただけます。フレッシュなおいしさをお届けするため、クール便（冷凍）にて配送いたします。
      </p>
    </div>

  </div>
</div>
<?php require 'includes/footer.php'; ?>
