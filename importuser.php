<?php

//データベース接続
$username = "root";
$password = "mysql123";
$hostname = "localhost";
$db = "php_db";
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8",$username,$password);


//社員情報CSVオープン
$fp = fopen(__DIR__. "/import_users.csv", "r");

//トランザクション開始
$pdo->beginTransaction();

//ファイルを１行ずつ読み込む
while ($data = fgetcsv($fp)){
    //var_dump($data);

    //社員番号をキーに実行
    $sql = "SELECT COUNT(*) As count FROM users WHERE id = :id";
    $param = [":id" => $data[0]];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($param);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    //debug
    // var_dump($data[0]);
    // var_dump($result);
    
    //SQLの結果
    if($result["count"] === 0){
         //社員情報変更SQL
        //  var_dump(($data[0]));
        //  var_dump('register');
        $sql  = "INSERT INTO users (";
        $sql .= " id, ";
        $sql .= " name, ";
        $sql .= " name_kana, ";
        $sql .= " birthday, ";
        $sql .= " gender, ";
        $sql .= " organization, ";
        $sql .= " post, ";
        $sql .= " start_date, ";
        $sql .= " tel, ";
        $sql .= " mail_address, ";
        $sql .= " created, ";
        $sql .= " updated ";
        $sql .= ") VALUES (";
        $sql .= " :id, ";
        $sql .= " :name, ";
        $sql .= " :name_kana, ";
        $sql .= " :birthday, ";
        $sql .= " :gender, ";
        $sql .= " :organization, ";
        $sql .= " :post, ";
        $sql .= " :start_date, ";
        $sql .= " :tel, ";
        $sql .= " :mail_address, ";
        $sql .= " NOW(), ";
        $sql .= " NOW(), ";
        $sql .= ")";
        
    }else{
        //社員情報登録SQL
        // var_dump(($data[0]));
        // var_dump('update');

        $sql  = "UPDATE users ";
        $sql .= " SET name = :name, ";
        $sql .= " name_kana = :name_kana, ";
        $sql .= " birthday = :birthday, ";
        $sql .= " gender = :gender, ";
        $sql .= " organization = :organization, ";
        $sql .= " post = :post, ";
        $sql .= " start_date = :start_date, ";
        $sql .= " tel = :tel, ";
        $sql .= " mail_address = :mail_address, ";
        $sql .= " updated = NOW() ";
        $sql .= " WHERE id = :id ";
    }
    $param = array(
        "id" => $data[0],
        "name" => $data[1],
        "name_kana" => $data[2],
        "birthday" => $data[3],
        "gender" => $data[4],
        "organization" => $data[5],
        "post" => $data[6],
        "start_date" => $data[7],
        "tel" => $data[8],
        "mail_address" => $data[9],
    );
    $stmt = $pdo->prepare($sql);
    $stmt->execute($param);  
    
}
//コミット
$pdo->commit();

//社員情報CSVクローズ
fclose($fp);
?>