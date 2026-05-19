<?php
/*
    kadai10_2.php
    Date:2024/12/02
    Author:IE1A 金島拓矢
*/

require_once __DIR__ . "/def.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
  header("Location: kadai10_1.php");
  exit;
}
//POST送信されたデータを変数に格納
$pname = filter_input(INPUT_POST, "pname");
$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
$category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);

// TODO:各入力値チェック用配列-------------------
$result = [
  "status"  => true,   // エラーがあった場合はfalse
  "message" => null,   // エラーメッセージ
  "result"  => null,   // 更新結果(成功した場合はtrue)
];

//商品名の空白文字を置き換え
$pname = str_replace(array(" ", "　"), "", $pname);

//商品名が空かどうかのチェック
if(!$pname){
  $result["status"] = false;
  $result["message"] = $result["message"] . "商品名が入力されていません。<br>";
}

//価格が空かどうかのチェック
if(!$price){
  $result["status"] = false;
  $result["message"] = $result["message"] . "価格が入力されていません。<br>";
}

//エラーがなかったとき（条件つける）
//入力値にエラーがなければDB登録
if($result["status"]){
  
  //カテゴリのコードからカテゴリ名に置き換え
  $category = ($category == 1) ? "ピザ" : "ドリンク";

  //DB登録処理ここから開始
  $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
  try {
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_AUTOCOMMIT, false);

    // トランザクション開始
    $db->beginTransaction();

    $sql = "insert into oldproduct(pname, category, price) values(:pname, :category, :price)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);

    //executeの結果は$result配列に格納
    $result["result"] = $stmt->execute();

    // トランザクション確定
    $db->commit();

    //登録完了の場合、完了メッセージを格納。
    if($result["result"]){
      $result["message"] = "商品の登録が完了しました。";
    }
  }catch(PDOException $poe) {
    $db->rollBack();
    // TODO:debug 用メッセージ（本番ではセキュリティ上表示しないこと！！）
    echo "DB 接続エラー".$poe->getMessage();
  }finally{
    //DB切断
    $stmt = null;
    $db = null;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>php1 - kadai10_2</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="w-100">

    <!-- ▼▼ヘッダー▼▼--------------------------------- -->
    <header class="bg-info">
      <div class="text-light ms-3 pt-4 pb-3">
        <h1 class="h6">サーバーサイドスクリプト演習１</h1>
        <h2 class="pt-3">データベース登録結果</h2>
      </div><!--/.container-->
    </header>
    <!-- ▲▲ヘッダー▲▲--------------------------------- -->

    <!-- ▼▼メイン▼▼----------------------------------- -->
    <main>

      <div class="form-control">

        <h3 class="border-bottom border-3 border-info mb-4 mt-2 pb-2">データベース登録結果</h3>

        <div id="frame" class="p-5 border-info rounded" style="border:1px dashed;">

          <!-- 処理結果表示 -->
          <div class="text-center">


            <p class="text-danger"><?= $result["message"] ?></p>
          </div>
        </div>

        <div class="p-5 d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-secondary btn-lg" href="kadai10_1.php">戻る</a>
        </div>

      </div>
    </main>

  </div><!--/.w100-->

</body>

</html>