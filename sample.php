<?php
/*
    sample.php
    Date:2024/10/07
    Author:IE1A 金島拓矢
*/

$furuits = ['りんご','バナナ','いちご','ぶどう','キウイ'];
$furuits[0] = "もも";
$furuits[8] = "スイカ";
//print_r($furuits);
//echo '<pre>';
//print_r($furuits);
//var_dump($furuits);
//echo '</pre>';

//エラーになる↓
//echo $furuits,$furuits[7];

$subject = array(
    array('英語','数学','理科'),
    array('English','Math','Science')
);
print_r($subject);

$name = ['ECC太郎','ECC次郎','ECC三郎']; //配列１
$class = ['1A','2B','3A']; //配列２
$list = [$name, $class]; //多次元配列(配列 1 と 2 を使⽤)

$list = [
    'name' => 'ECC太郎',
    'class' => '1A'
];

foreach($list as $key => $value){
    echo $key,"-",$value,"<br>";
}

$id = 12345678; //ID
$name = "ECC太郎"; //名前
$homeClass = "IE1A"; //クラス
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
</head>
<body>
    <!-- 第 1 段階 -->
    <h2>php echo での表示</h2>
    <?php echo "<p>ID:{$id}</p><p>名前：{$name}</p><p>クラス：
{$homeClass}</p>"; ?>



<!-- 第 2 段階 -->
<h2>タグに PHP 変数埋め込み</h2>
<p>ID:<?= $id ?></p>
<p>名前:<?= $name ?></p>
<p>クラス:<?= $homeClass ?></p>
</body>
</html>
