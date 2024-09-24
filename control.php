<?php
include_once "baglan.php";

$urladres = $_SERVER['REQUEST_URI'];
$site_sql = $conn->prepare("SELECT * FROM site");
$site_sql->execute();
$site = $site_sql->fetch();

if (isset($_COOKIE["username"])) {
    $login = true;
    $user = $conn->prepare("SELECT * FROM user WHERE userAdi = '$_COOKIE[username]'");
    $user->execute();
    $user = $user->fetch();
}
$time = time();
$bugun = date('d.m.Y - H:i');
?>