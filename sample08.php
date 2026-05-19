<?php
$dsn = "mysql:host=localhost;dbname=studb;charset=utf8mb4";

try{
    $db = new PDO($dsn, "dbuser", "ecc");
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //TODO:追記(エラー詳細を拾う)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM oldproduct";
    $key = 'ピザ';
    //$sql = "SELECT * FROM oldproduct where category = 'ドリンク'";
    $sql = "SELECT * FROM oldproduct where category = :ca";
    $stmt = $db->prepare($sql);
    $stmt -> bindParam(":ca", $key, PDO::PARAM_STR);
    $stmt->execute();

    $result = [];
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[] = $rows;
    }

    echo "<pre>";
    print_r($result);
    echo "</pre>";

    $stmt = null;
    $db = null;
}catch(PDOException $poe){
    exit("DBエラー" . $poe->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル08</title>
</head>
<body>
    <?php foreach($result as $v): ?>
        <p><?= $v["product_no"] ?></p>
        <p><?= $v["pname"] ?></p>
        <p><?= $v["category"] ?></p>
        <p><?= $v["price"] ?></p>
        <p><?= $v["image_path"] ?></p>
    <?php endforeach; ?>
</body>
</html>