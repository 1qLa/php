<?php
//「sample06」という名前のクッキーの値を、変数 cookieData に格納
//$cookieData = $_COOKIE["sample06"];
//echo $cookieData;

//セッション変数「old」に値があれば、ローカル変数$oldData に値を格納
session_start();
if (isset($_SESSION["old"])) {
$oldData = $_SESSION["old"];
}
echo session_id()."<br>";
echo $oldData;
?>