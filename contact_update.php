<?php
// 送信確認
// var_dump($_POST);
// exit();

// 受け取ったデータを変数に入れる
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db(); // 関数実行

// idを指定して更新するSQLを作成（UPDATE文）
$sql = "UPDATE contact_table SET name=:name, email=:email, subject=:subject, message=:message, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:users_read.php");
    exit();
}
