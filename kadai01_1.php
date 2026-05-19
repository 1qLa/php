<?php
/*
    kadai01_1.php
    Date:2024/09/30
    Author:IE1A 金島拓矢
*/
    $total; //合計額の格納用の変数
    $price = 1200; //価格を格納した変数
    $tax = '1.1';   //消費税を格納した変数
                    //※ただし、シングルコーテーションで囲んでいるので文字列

    $total = $price * $tax;   //価格×消費税を変数$totalに格納
    echo gettype($tax),'<br>';
    echo $total;    //画面出力 echo
?>