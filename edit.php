<?php


// 送信されたidをgetで受け取る
$id = $_GET['id'];

// 関数ファイル読み込み
include("functions.php");

// DB接続&id名でテーブルから検索
$pdo = connect_to_db();
$sql = 'SELECT * FROM contact_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}
// var_dump($record);
// exit();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせフォーム</title>
</head>

<body>
  <form action="contact_update.php" method="POST">
    <fieldset>
      <legend>お問い合わせフォーム</legend>
      <a href="contact_read.php">一覧画面</a>
      <div>
        name: <input type="text" name="name" value="<?= $record["name"] ?>">
      </div>
      <div>
        message: <input type="texy" name="message" value="<?= $record["message"] ?>">
      </div>

      <!-- // idを見えないように送る
      // input type="hidden"を使用する！
      // form内に以下を追加 -->
      <input type="hidden" name="id" value="<?= $record['id'] ?>">

      <div>
        <button>送信</button>
      </div>

    </fieldset>
  </form>

</body>

</html>