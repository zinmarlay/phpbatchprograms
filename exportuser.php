<?php
//データベース接続
$username = "root";
$password = "mysql123";
$hostname = "localhost";
$db = "php_db";
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8",$username,$password);

//DBデータ取得
$sql = "SELECT * FROM users ORDER BY id";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//SQL結果を実行する
$outputData = [];
$dataCount = 0;
while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
    //出力データの作成
    $outputData[$dataCount]["name"] = $row["name"];
    $outputData[$dataCount]["id"] = $row["id"];
    $outputData[$dataCount]["name_kana"] = $row["name_kana"];
    $outputData[$dataCount]["birthday"] = $row["birthday"];
    $outputData[$dataCount]["gender"] = $row["gender"];
    $outputData[$dataCount]["organization"] = $row["organization"];
    $outputData[$dataCount]["post"] = $row["post"];
    $outputData[$dataCount]["start_date"] = $row["start_date"];
    $outputData[$dataCount]["tel"] = $row["tel"];
    $outputData[$dataCount]["mail_address"] = $row["mail_address"];
    $outputData[$dataCount]["created"] = $row["created"];
    $outputData[$dataCount]["updated"] = $row["updated"];
    $dataCount++;
    // var_dump($row);
}
//debug
//var_dump($outputData);

//出力ファイルオープン
$fpOut = fopen(__DIR__. "/export_user.csv", "w");
$header = [
    "社員番号",
    "社員名",
    "社員名カナ",
    "生年月日",
    "性別",
    "所属部署",
    "役職",
    "入社生年日",
    "電話番号",
    "メールアドレス",
    "作成日時",
    "更新日時"
];
fputcsv($fpOut,$header);

//出力データ数分を繰り返し
foreach ($outputData as $data){
    //出力データ書込
    fputcsv($fpOut,$data);
}

//出力ファイルクローズ
fclose($fpOut);
?>