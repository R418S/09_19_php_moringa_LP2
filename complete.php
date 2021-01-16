<?php
session_start();

$name = $_SESSION['name'];
$mail = $_SESSION['mail'];
$toiawase = $_SESSION['toiawase'];

$mailHeader = "From: from@from.com";
$mailSubject = "お問い合わせありがとうございます";
$mailBody = $name . "様 お問い合わせありがとうございます";
$mailBody .= "¥n";
$mailBody .= "ご返信まで～～～～";

mail($mail, $mailSubject, $mailBody, $mailHeader);

require("index.html");

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <title>Insert title here</title>
</head>

<body>
    <?php echo $name; ?>さん、お問い合わせありがとうございます。
</body>

</html>