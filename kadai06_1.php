<?php
/*
    kadai06_1.php
    Date:2024/11/04
    Author:IE1A 金島拓矢
*/
require_once __DIR__ . "/def.php";
require_once __DIR__ . "/utils.php";
require_once __DIR__ . "/kadai06_resource.php";

//クッキーに保存されている商品 ID を受け取る
//※kadai06_2.php で商品 ID を「,」カンマで区切って格納する処理をする
$browsed = [];
if (isset($_COOKIE["PHP1_kadai06"])) {
  $browsed = explode(",", $_COOKIE["PHP1_kadai06"]);
}

//商品 ID を元に「商品名」「商品価格」「商品画像」は、kadai06_resource.php ファイル内の$productsから取得する。
$productMap = [];
foreach ($products as $product) {
    $productMap[$product["id"]] = $product;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- TODO:Bootstrap読み込み -->
  <!-- link -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <title>php1 - kadai06_1</title>
</head>

<body>
  <!-- ▼▼ヘッダー▼▼--------------------------------- -->
  <header class="bg-info">
    <div class="text-light ms-5 pt-5 pb-3">
      <h1 class="h6">サーバーサイドスクリプト演習１</h1>
      <h2 class="pt-3">クッキー</h2>
    </div><!--/.text-light ms-5 pt-5 pb-3-->
  </header>
  <!-- ▲▲ヘッダー▲▲--------------------------------- -->

  <!-- ▼▼メイン▼▼----------------------------------- -->
  <main>
    <div class="container-field">
      <h2 class="p-5 d-grid gap-2 d-md-flex">取り扱いクッキー</h2>
      <div class="row" style="border-top: 2px solid hotpink;">
        <?php foreach($products as $product) : ?>
          <!-- TODO:kadai06_resourceファイルの情報を読み込み -->
          <div class="col-sm-3 p-3">
            <div class="card h-100 shadow-sm" style="max-width:25rem;">
              <a class="link-secondary" style="text-decoration:none;" href="kadai06_2.php?product_id=<?= $product["id"] ?>">

                <img class="img-fluid img-thumbnail h-50" style="width:100%;" src="<?= asset("images/{$product["thumbnail"]["small"]}") ?>">

                <div class="card-body">
                  <p class="card-text"><?= $product["name"] ?></p>
                  <p class="card-text" style="color:hotpink;">¥<?= $product["price"] ?></p>
                </div>
              </a>
            </div>
          </div>
        <?php endforeach ?>
      </div>

      <div class="row">
        <h2 class="p-5 d-grid gap-2 d-md-flex" style="border-bottom: 2px solid hotpink;">閲覧したクッキー</h2>
        <div class="col m-3" style="display: flex; overflow:auto;">
          <?php foreach ($browsed as $browsedId) : ?>
            <?php if (isset($productMap[$browsedId])) : // 商品が存在するか確認 ?>
              <?php $product = $productMap[$browsedId]; // 商品情報を取得 ?>
              <div class="card m-3" style="max-width:10rem; min-width:10rem;">
                <a class="link-secondary" style="text-decoration:none;" href="kadai06_2.php?product_id=<?= $product["id"] ?>">
                  <img class="img-fluid img-thumbnail h-50" style="width:100%;" src="<?= asset("images/{$product["thumbnail"]["small"]}") ?>">
                  <div class="card-body">
                    <p class="card-text"><?= $product["name"] ?></p>
                    <p class="card-text" style="color:hotpink;">¥<?= $product["price"] ?></p>
                  </div>
                </a>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>

      </div>

    </div>
  </main>
  <!-- ▲▲メイン▲▲----------------------------------- -->

</body>

</html>