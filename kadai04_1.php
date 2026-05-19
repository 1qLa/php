<?php
/*
    kadai04_1.php
    Date:2024/10/14
    Author:IE1A 金島拓矢
*/
// TODO：kadai03_resource.phpファイル読み込み
require_once __DIR__ ."/kadai03_resource.php";

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php1 - kadai04_1</title>
    <!-- TODO:bootstrapCSS読み込み -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- ▼▼コンテンツ全体▼▼---------------------------------- -->
    <div class="w-100">

        <!-- ▼▼ヘッダー▼▼--------------------------------- -->
        <header class="bg-info">
            <div class="text-light ms-5 pt-5 pb-3">
                <h1 class="h6">サーバーサイドスクリプト演習１</h1>
                <h2 class="pt-3">ファイルアップロード</h2>
            </div><!--/.container-->
        </header>
        <!-- ▲▲ヘッダー▲▲--------------------------------- -->

        <!-- ▼▼メイン▼▼----------------------------------- -->
        <main>
            <div class="form-control">

                <!-- TODO:設定必要（３回目の課題の応用） -->
                <form action="kadai04_2.php" method="POST" novalidate>
                    <div class="p-5 row">
                        <div class="col-md-5">
                            <div class="row">

                                <!-- 学科表示 -->
                                <div class="col">
                                    <label class="form-label" for="department">学科</label>
                                    <select name="department" id="department" class="form-select form-select-lg mb-3 border-info">
                                        <!-- TODO: -->
                                        <!-- <option value="1">⾼度情報処理研究(4年制)</option> -->
                                        <!-- <option value="2">マルチメディア研究(3年制)</option> -->
                                        <!-- <option value="3">マルチメディア(2年制)</option> -->
                                        <?php foreach ($departments as $key => $value) { ?>
                                            <option value="<?php echo ($value["d_id"]);?>">
                                                <?php echo ($value["d_name"])."(".($value["d_years"])."年制)";?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- コース表示 -->
                                <div class="col">
                                    <label class="form-label" for="course">コース</label>
                                    <select name="course" id="course" class="form-select form-select-lg mb-3 border-info">
                                        <!-- TODO: -->
                                        <!-- <option value="1">IT 開発エキスパート</option> -->
                                        <!-- <option value="2">IT 開発研究</option> -->
                                        <!-- <option value="2">Web デザイン</option> -->
                                        <!-- <option value="3">システムエンジニア</option> -->
                                        <?php foreach ($courses as $key => $value) { ?>
                                            <option value="<?php echo ($value["c_id"]);?>">
                                                <?php echo ($value["c_name"]);?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <label class="form-label" for="name">名前<em class="text-danger">※必須</em></label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg border-info" placeholder="ECC 太郎" required>
                            </div>

                            <div class="col">
                                <label class="form-label" for="kana">フリガナ<em class="text-danger">※必須</em></label>
                                <input type="text" name="kana" id="kana" class="form-control form-control-lg border-info" placeholder="イーシーシー タロウ" required>
                            </div>
                        </div>


                        <div class="col mh-100">
                            <label class="form-label" for="note">備考</label>
                            <textarea name="note" id="note" class="form-control form-control-lg border-info" rows="7"></textarea>
                        </div>

                    </div>

                    <div class="p-5 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-danger btn-lg">入力内容の確認</button>
                    </div>
                </form>

            </div><!--/.container-->
        </main>
        <!-- ▲▲メイン▲▲------------------------------------ -->

    </div>
    <!-- ▲▲コンテンツ全体▲▲---------------------------------- -->
</body>

</html>