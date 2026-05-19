<?php
//変数 test のデータを「sample06」というクッキー名で保存
//$test = "あいうえお";
//setcookie("sample06", $test, time() + (60 * 1));
//echo "クッキーを保存しました";

//セッション変数の配列に「old」というキーで値を格納
session_start();
$_SESSION["old"] = "かきくけこ";
echo "セッションを開始しました";
?>