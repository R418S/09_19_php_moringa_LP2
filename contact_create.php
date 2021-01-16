<?php

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_POST['name']) || $_POST['name'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['subject']) || $_POST['subject'] == '' ||
    !isset($_POST['message']) || $_POST['message'] == ''
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    // echo json_encode(["error_msg" => "no input"]);
    // exit();
}

// 受け取ったデータを変数に入れる
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


include('functions.php'); // 関数を記述したファイルの読み込み
$pdo = connect_to_db(); // 関数実行

$sql = 'INSERT INTO contact_table(id, name, email, subject, message) VALUES(NULL, :name, :email, :subject, :message )';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($_POST);
// exit();
// var_dump($_POST);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:main.php");
    exit();
}
