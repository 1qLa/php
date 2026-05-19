<?php
require './lib/vendor/autoload.php';
$zipcode = filter_input(INPUT_GET, 'zipcode');
$address = "";//住所格納用変数
$message = "";//エラーメッセージ格納用変数

if(!is_null($zipcode)){
    $cli = new GuzzleHttp\Client([
        'base_uri' => 'https://zipcloud.ibsnet.co.jp', //外部 API
    ]);
    $res = $cli->request('get', '/api/search', [
        'query' => [
            'zipcode' => $zipcode // 検索したい郵便番号を指定
        ],
        'verify' => false //開発用環境なので、証明書の検証をオフにする（本来はオンで使用する）
    ]);
    $response = json_decode($res->getBody(), true); //JSON データを連想配列に変換

    if(!is_null($response['results'])){
        $address = $response['results'][0]['address1'].$response['results'][0]['address2'].$response['results'][0]['address3'];
    }
    if(!is_null($response['message'])){
        $message = $response['message'];
    }else if(!$address){
        $message = "該当する住所がありません";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kadai12_1 JSONデータ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- ▼▼ヘッダー▼▼--------------------------------- -->
    <header class="bg-info">
        <div class="text-light ms-5 pt-5 pb-3">
            <h1 class="h6">サーバーサイドスクリプト演習１</h1>
            <h2 class="pt-3">外部APIからJSONデータを取得する</h2>
        </div><!--/.text-light ms-5 pt-5 pb-3-->
    </header>
    <!-- ▲▲ヘッダー▲▲--------------------------------- -->

    <!-- ▼▼メイン▼▼----------------------------------- -->
    <main>
        <div class="form-control">

            <div class="p-5 row">
                <div class="col-md-5">
                    <form action="kadai12_1.php" method="GET" class="">

                        <!-- 検索 -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">郵便番号</span>
                            <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?= $zipcode ?>">

                        </div>
                        <div class="input-group mb-3">
                            <!-- 住所 -->
                            <div class="col">
                                <p class="text-danger">
                                    住所：
                                    <?php 
                                        echo $address;
                                        echo $message; 
                                    ?>
                                </p>
                            </div><!-- .col -->
                        </div>

                        <div class="row">
                            <div class="pt-5 px-0 d-grid gap-2 d-md-flex justify-content-md-end">
                                <input class="btn btn-primary btn-lg" type="submit" value="検索">
                            </div><!-- .p-5 d-grid gap-2 d-md-flex justify-content-md-end -->
                        </div><!-- .row -->

                    </form>

                </div><!-- .col-md-5 -->

            </div><!-- .p-5 row -->
        </div><!--/.form-control-->
    </main>
    <!-- ▲▲メイン▲▲------------------------------------ -->

</body>

</html>