<?php
/*
    kadai02_2.php
    Date:2024/10/07
    Author:IE1A 金島拓矢
*/

$fruits = ['りんご','バナナ','苺','ぶどう','キウイ'];
$vegetable = ['キャベツ','人参','ピーマン','茄子','かぼちゃ'];

echo '<pre>';
var_dump($fruits);
var_dump($vegetable);
echo '</pre>';

$food = [$fruits,$vegetable];
echo '<pre>';
var_dump($food);
echo '</pre>';

echo '$food2行3列目は、',$food[1][2],'です。';
?>