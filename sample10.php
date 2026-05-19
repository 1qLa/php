<?php
require_once __DIR__ . "/def.php";
require_once __DIR__ . "/utils.php";

$pname = "水";
$category = "ドリンク";
$price = 100;

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
try {
$db = new PDO($dsn, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
// トランザクション開始
$db->beginTransaction();
//$sql = "INSERT INTO PRODUCTS(PRODUCT_ID, PRODUCT_NAME) VALUES(:product_id, :product_name)";
$sql = "insert into oldproduct(pname, category, price) values(:pname, :category, :price)";
$stmt = $db->prepare($sql);
//$stmt->bindParam(':product_id', $prduct_id, PDO::PARAM_INT);
//$stmt->bindParam(':product_name', $product_name,PDO::PARAM_STR);
$stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':price', $price, PDO::PARAM_INT);

$stmt->execute();
// トランザクション確定
$db->commit();

$sql = "SELECT * FROM oldproduct";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = [];
while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
$result[] = $rows;
}

}catch(PDOException $poe) {
$db->rollBack();
 // TODO:debug 用メッセージ（本番ではセキュリティ上表示しないこと！！）
echo "DB 接続エラー".$poe->getMessage();
}finally{
$stmt = null;
$db = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル10</title>
</head>
<body>
    <?php foreach($result as $v) : ?>
        <p><?= $v["product_no"] ?></p>
        <p><?= $v["pname"] ?></p>
        <p><?= $v["category"] ?></p>
        <p><?= $v["price"] ?></p>
        <p><?= $v["image_path"] ?></p>
    <?php endforeach; ?>
</body>
</html>