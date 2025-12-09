<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "taizlost";

$mysqli = mysqli_connect($host, $user, $pass, $db);

if (!$mysqli) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>
