<?php
/*
    kadai02_1.php
    Date:2024/10/07
    Author:IE1A 金島拓矢
*/

$fruits = ['りんご','バナナ','苺','ぶどう','キウイ'];
echo '配列fruitsの3番目の値は「',$fruits[2],'」です。';
$fruits[5] = "パイナップル";
echo '<pre>';
print_r($fruits);
echo '</pre>';
echo'配列1番目を上書き';
$fruits[0] = "スイカ";
echo '<pre>';
print_r($fruits);
echo '</pre>';

?>