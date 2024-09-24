<!DOCTYPE html>
<html lang="en">
<?php
include "control.php";
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>404</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div class="container-fluid mt-5">
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-3">Sayfa Bulunamadı</p>
            <p class="text-gray-500 mb-0">Lütfen gitmek istediğiniz sayfanın adresini kontrol ediniz ya da giriş
                yapınız...</p>
            <a href="<?= $site["siteLink"]; ?>">&larr; Anasayfa</a>
        </div>
    </div>
</body>

</html>