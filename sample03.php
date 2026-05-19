<?php
    $result = $_GET["keyword"];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル03</title>
</head>
<body>
    <?php
        echo $result, "<br>";
    ?>
    <?= $result ?>
</body>
</html>