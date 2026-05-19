<?php
require './lib/vendor/autoload.php';

$zipcode = '5670014'; //検索したい郵便番号
$cli = new GuzzleHttp\Client([
 'base_uri' => 'https://zipcloud.ibsnet.co.jp', //外部 API
]);
$res = $cli->request('get', '/api/search', [
 'query' => [
 'zipcode' => $zipcode // 検索したい郵便番号を指定
 ],
 'verify' => false //開発用環境なので、証明書の検証をオフにする（本来はオンで使用する）
]);
$response = json_decode($res->getBody(), true); //JSON データを連想配列に変換

echo "<pre>";
print_r($response);
echo "</pre>";

if(!is_null($response['results'])){
    echo $response['results'][0]['address1'].$response['results'][0]['address2'].$response['results'][0]['address3'];
}
if(!is_null($response['message'])){
    echo $response['message'];
}
?>