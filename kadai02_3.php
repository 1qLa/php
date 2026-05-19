<?php
/*
    kadai02_3.php
    Date:2024/10/07
    Author:IE1A 金島拓矢
*/

//$fruits = [220,110,490,550,160];

$fruits = [
    'apple' => 220,
    'banana' => 110,
    'strawberry' => 490,
    'grape' => 550,
    'kiwi' => 160
];

$vegetable = [
    'cabbage' => 130,
    'carrot' => 80,
    'greenPepper' => 120,
    'eggplant' => 160,
    'pumpkin' => 240
];

echo '<pre>';
var_dump($fruits);
echo '</pre>';

echo'foodの内容を表示';

echo '<pre>';
$food = [
    'fruits' => $fruits,
    'vegetable' => $vegetable
];
echo '</pre>';

echo '<pre>';
var_dump($food);
echo '</pre>';

echo '配列$fruitsの中身をforeachで順番に表示<br>';
foreach($fruits as $key => $value){
    echo $key,":",$value,"円","<br>";
}
echo '<br>';

echo '配列$foodの中身をforeachで種別ごとに、順番に表示<br>';
foreach($food as $key => $value){
    echo "■種別：",$key,"<br>";
    
    foreach($value as $key => $sum){
        echo "商品名：",$key,"　／　価格：",$sum,"円","<br>";
    }
    echo '------------------------------------<br>';
}
?>