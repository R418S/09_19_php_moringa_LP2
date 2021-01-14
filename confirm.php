<?php

$name = $_POST['name'];
$mail = $_POST['mail'];
$toiawase = $_POST['toiawase'];

// $write_data = "{$name} {$mail} {$toiawase}\n"; // スペース区切りで最後に改行
// $file = fopen('data/form.csv', 'a');
// flock($file, LOCK_EX); // ファイルをロック
// fwrite($file, $write_data); // データに書き込み,
// flock($file, LOCK_UN); // ロック解除
// fclose($file); // ファイルを閉じる
// header("Location:index.html"); // 入力画面に移動
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>Insert title here</title>
</head>

<body>
    お名前：<?php echo $name; ?>
    </br>
    メールアドレス：<?php echo $mail; ?>
    </br>
    お問い合わせ内容
    </br>
    <?php echo $toiawase; ?>
    </br>
    </br>
    <form action='complete.php' method='post'>
        <input type='hidden' name='name' value='$name'>
        <input type='hidden' name='mail' value='$mail'>
        <input type='hidden' name='toiawase' value='$toiawase'>
        <input type='button' onclick='history.back()' value='戻る'>
        <input type='submit' value='確認'>
    </form>
</body>

</html>