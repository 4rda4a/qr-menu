<?php
session_destroy();

$deleteTime = time() - 360;
setcookie("username", "", $deleteTime, "/");

header("location: ./");
?>