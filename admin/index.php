<!DOCTYPE html>
<html lang="en">
<?php
include "../control.php";
if (isset($login)) {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>
            <?= $site["siteAdi"]; ?> | Yönetim
        </title>
        </title>
        <!-- FAVICON -->
        <link rel="icon" href="<?= $site["siteLink"] . "/img/" . $site["siteLogo"]; ?>">
        <!-- CSS -->
        <!-- <link rel="stylesheet" href="<?= $site["siteLink"]; ?>assets/style.css"> -->
        <!-- BOOTSTRAP -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
        <!-- ICONS -->
        <!-- <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'> -->
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
        <link rel='stylesheet'
            href='https://cdn-uicons.flaticon.com/2.4.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href="css/sb-admin-2.min.css?03-06-2024" rel="stylesheet">
    </head>

    <body id="page-top">
        <div id="wrapper">
            <?php
            include "leftNavbar.php";
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <?php
                    include "topNavbar.php";
                    ?>
                    <div class="container-fluid">
                        <?php
                        if (isset($_GET["admin"])) {
                            $k = explode("/", rtrim($_GET["admin"], "/"));
                            $dosya_kategori = $k[0];
                            if (file_exists($dosya_kategori . ".php")) {
                                include $dosya_kategori . ".php";
                            }
                        } else {
                        ?>
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Yönetim Paneli</h1>
                            </div>
                            <h4>Kısayollar</h4>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="profil" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Profilim</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user["userAdi"]; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="urunlerimiz" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Ürünlerimiz</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">İncele</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-folder fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="mesajlar" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Mesajlar</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Göz At</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-inbox fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-secondary shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="qr-kod" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                        QR Kod</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Oluştur</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-qrcode fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="yoneticiler" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Yöneticiler</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">İncele</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger  shadow h-100 py-2">
                                        <div class="card-body">
                                            <a href="../cikis" class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger     text-uppercase mb-1">
                                                        Çıkış Yap</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Hızlı Çıkış</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <?php
                include "footer.php";
                ?>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="js/sb-admin-2.min.js"></script>

        <script src="vendor/chart.js/Chart.min.js"></script>

        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

    </body>

    <script src="<?= $site["siteLink"]; ?>assets/script.js?<?php echo date("d-m-Y"); ?>693"></script>

</html>
<?php
} else {
    include "../errorPage.php";
}
?>