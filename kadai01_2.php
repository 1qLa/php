<?php
/*
    kadai01_2.php
    Date:2024/09/30
    Author:IE1A 金島拓矢
*/
$word = 'ECC太郎';

echo 'こんにちは。  {$word} さん';
echo '<br>';    //比較の分かり易さのため、改行は分けて記述
echo "こんにちは。  {$word} さん";
echo '<br>';

$quote1 = 'シングルコーテーション\tで囲んだ文字列'; //\tはタブ
$quote2 = 'ダブルコーテーション\tで囲んだ文字列';

echo $quote1;
echo '<br>';
echo $quote2;
?>