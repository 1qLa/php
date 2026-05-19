<?php
    // POST 形式でなければ
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: sample05.html"); //sample05.html へ画面遷移
        exit; // 処理を終了させる
    }

    // 定義されていない、または null である場合
    if (!isset($_FILES["upfile"])) {
        $result["status"] = false; // エラーのとき false とする
        $result["message"] = "ファイルのアップロードに失敗しました"; // 画面表示用
    }
    
    // 値チェックなどを行うので、変数に格納して使用が一般的
    $upFile = $_FILES["upfile"];
    print_r($upFile);

    //確認用に画面に連想配列の値を表示
    echo "<pre>";
    print_r($reFileName.".".$ext); //日付のファイル名と拡張子を文字列連結して表示
    echo "</pre>";

    //拡張子つきの画像ファイル名を「.」前後で分割。ファイル名と拡張子に分ける
    $reFileName = date("YmdHis");// date 関数で日時を取得
    $ext = explode(".", $upFile["name"]); //ファイル名分割
    $ext = $ext[count($ext) - 1]; // 連想配列の末尾＝拡張子のみ取得

    //拡張子つきの画像ファイル名を「.」前後で分割。ファイル名と拡張子に分ける
    $ext = explode(".", $upFile["name"]);

    //確認用に画面に連想配列の値を表示
    echo "<pre>";
    print_r($ext);
    echo "</pre>";

    //↓結果格納用の連想配列
    $result = [
        "status" => true, //結果フラグ用
        "message" => null, //結果メッセージ用
        "result" => null, //結果のファイルパス用
    ];

    //文字列 image を含まないとき＝画像ではないとき、エラーとして連想配列に値を格納
    //※文字列のパターンは「’/image/’」（ / スラッシュで囲む）
    //※条件の前の「!」は否定（ＮＯＴ） 初回の復習
    if (!preg_match('/image/', $upFile["type"])) {
        $result["status"] = false;
        $result["message"] = "画像ファイル以外はアップロードできません";
    } else{
        //↓移動先のディレクトリ参照（「_DIR_」は自分自身のディレクトリを示す）
        $moveFilePath = __DIR__ . "/asset/storage/{$upFile["name"]}";
        if (move_uploaded_file($upFile["tmp_name"], $moveFilePath)) {
            $result["message"] = "ファイルのアップロードに成功しました";
            //↓HTML の src プロパティに設定するパス用なので、フォルダパスではなく、URL で指定
            $result["result"] =
            "http://localhost/PHP1/asset/storage/{$upFile["name"]}";
        } else {
            $result["status"] = false;
            $result["message"] = "ファイルのアップロードに失敗しました";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- ファイル結果表示箇所 -->
    <div class="text-center">
        <?php if ($result["status"]) : ?>
        <figure class="d-inline-block me-1 mt-1 mb-5">
            <img class="img-fluid" src="<?= $result["result"] ?>">
        </figure>
        <?php else : ?>
            <p class="text-danger"><?= $result["message"] ?></p>
        <?php endif ?>
    </div>
</body>
</html>