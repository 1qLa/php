<?php
/*
    kadai05_2.php
    Date:2024/10/28
    Author:IE1A 金島拓矢
*/
require_once __DIR__ . "/def.php";
require_once __DIR__ . "/utils.php";

// TODO：課題の仕様を確認
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: kadai05_1.html"); //kadai05_1.html へ画面遷移
  exit; // 処理を終了させる
}

$result = [
  "status" => true, //状態を表す
  "message" => null, //エラーメッセージ格納用
  "result" => null, //結果格納用
  ];

if (!isset($_FILES["upfile"])) {
  $result["status"] = false; // エラーのとき false とする
  $result["message"] = "ファイルのアップロードに失敗しました"; // 画面表示用
}

$upFile = $_FILES["upfile"];

$ext = explode(".", $upFile["name"]);

if($upFile["error"]){
  $result["status"] = false;

  switch($upFile["error"]){
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      $result["message"] = "ファイルサイズが大きすぎます";
      break;
    case UPLOAD_ERR_PARTIAL:
      $result["message"] = "通信環境が良くなってからもう⼀度お試しください";
      break;  
    case UPLOAD_ERR_NO_FILE:
      $result["message"] = "ファイルがありません";
      break;
    default:
      $result["message"] = "システムの復旧後に再度アップロードしてください";
      break;  
  }
}

if (!preg_match('/image/', $upFile["type"])) {
  $result["status"] = false;
  $result["message"] = "画像ファイル以外はアップロードできません";
} else{
    //拡張子つきの画像ファイル名を「.」前後で分割。ファイル名と拡張子に分ける
    $reFileName = date("YmdHis");// date 関数で日時を取得
    $ext = explode(".", $upFile["name"]); //ファイル名分割
    $ext = $ext[count($ext) - 1]; // 連想配列の末尾＝拡張子のみ取得
    //↓移動先のディレクトリ参照（「_DIR_」は自分自身のディレクトリを示す）
    $moveFilePath = __DIR__ . "/asset/storage/{$reFileName}.{$ext}";
    if (move_uploaded_file($upFile["tmp_name"], $moveFilePath)) {
      $result["message"] = "ファイルのアップロードに成功しました";
      //↓HTML の src プロパティに設定するパス用なので、フォルダパスではなく、URL で指定
      $result["result"] =
      "http://localhost/PHP1/asset/storage/{$reFileName}.{$ext}";
    } else {
        $result["status"] = false;
        $result["message"] = "ファイルのアップロードに失敗しました";
      }
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>php1 - kadai05_2</title>
  <!-- TODO:bootstrapCSS読み込み -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="w-100">

    <!-- ▼▼ヘッダー▼▼--------------------------------- -->
    <header class="bg-info">
      <div class="text-light ms-3 pt-4 pb-3">
        <h1 class="h6">サーバーサイドスクリプト演習１</h1>
        <h2 class="pt-3">画像のアップロード結果</h2>
      </div><!--/.container-->
    </header>
    <!-- ▲▲ヘッダー▲▲--------------------------------- -->

    <!-- ▼▼メイン▼▼----------------------------------- -->
    <main>

      <div class="form-control">

        <h3 class="border-bottom border-3 border-info mb-4 mt-2 pb-2">アップロード結果</h3>

        <div id="frame" class="p-5 border-info rounded" style="border:1px dashed;">

          <!-- ファイル結果表示箇所 -->
          <div class="text-center">
            <!-- TODO:ファイル結果表示 -->
            <!-- TODO:画像は正しく画像ファイルがアップロードされた場合のみ -->
            <figure class="d-inline-block me-1 mt-1 mb-5">
              <img src="<?= $result["result"] ?>">
            </figure>
            <!-- TODO:エラーがあった場合はメッセージのみ -->
            <p class="text-danger"><?= $result["message"] ?></p>
          </div>
        </div>

        <!-- TODO:戻るボタン押下で入力画面に戻る -->
        <div class="p-5 d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-secondary btn-lg" href="kadai05_1.php">戻る</a>
        </div>

      </div>
    </main>

  </div><!--/.w100-->

</body>

</html>