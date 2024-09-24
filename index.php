<!doctype html>
<html lang="en" style="height:100%;">
<?php
include "control.php";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="2vkyccGnBudlhdUpI4vqNqXEvA6b-aSQszgdL-7QSpA" />
    <title>
        <?= $site["siteAdi"]; ?>
    </title>
    <!-- FAVICON -->
    <link rel="icon" href="<?= $site["siteLink"] . "/img/" . $site["siteLogo"]; ?>">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= $site["siteLink"]; ?>assets/style.css?<?php echo date("d-m-Y"); ?>123">
    <style>
        .text-logo-color1 {
            color:
                <?= $site["renk1"]; ?> !important;
        }

        body {
            background-color:
                <?= $site["renk2"]; ?> !important;
        }
    </style>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- ICONS -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.4.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
</head>

<body id="body">
    <?php
    if ($site["siteBakim"] == true) {
        $timestamp = strtotime($site["siteBakimTarih"]);
        if (time() < $timestamp) {
            include "bakimModu.php";
        } else {
            $sql = "UPDATE `site` SET
            `siteBakim` = '0'
            WHERE `site`.`siteId` = '1'";
            $conn->exec($sql);
            header("refresh: 0");
        }
    } else {
        if ($site["acilirMesajDurum"] && empty($_COOKIE["acilirMesaj"])) { ?>
            <div class="modal fade show" id="acilirMesajModal" tabindex="-1" aria-labelledby="acilirMesajModalAria"
                aria-modal="true" role="dialog" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="acilirMesajModalAria">Açılır Mesaj</h1>
                            <button type="button" onclick="acilirMesajKapat()" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header text-center">
                                    <img class="w-100" src="img/<?= $site["acilirMesajGorsel"]; ?>">
                                </div>
                                <div class="card-body">
                                    <?= $site["acilirMesajMetin"]; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="acilirMesajKapat()" class="btn btn-primary"
                                data-bs-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show" id="acilirMesajBg"></div>
            <script>
                b = document.getElementById("body");
                b.classList.add("modal-open");
                b.style.overflow = "hidden";
                b.style.paddingRight = "17px";
            </script>
        <?php } ?>
        <div class="col-md-10 col-12 m-auto container pb-3">
            <div class="container"></div>
            <?php
            include "navbar.php";
            if (isset($_GET["seo"])) {
                $k = explode("/", rtrim($_GET["seo"], "/"));
                $dosya_kategori = $k[0];
                if (isset($k[2])) {
                    include "errorPage.php";
                } else {
                    if (isset($k[0])) {
                        include "breadcrumb.php";
                    }
                    if (file_exists($dosya_kategori . ".php")) {
                        include $dosya_kategori . ".php";
                    } else {
                        $icerik = $conn->prepare("SELECT * FROM kategoriler WHERE link='$dosya_kategori'");
                        $icerik->execute();
                        $icerikgetir = $icerik->fetch(PDO::FETCH_ASSOC);
                        if ($icerikgetir) {
                            $baslik_kategori = $icerikgetir['kategori'];
                            if (isset($k[1])) {
                                include "detay.php";
                            } else {
                                include "liste.php";
                            }
                        } else {
                            include "liste.php";
                        }
                    }
                }
            } else {
                include "anasayfa.php";
            }
    }
    ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
    <!-- JQUERY -->
    <script src="<?= $site["siteLink"]; ?>assets/script.js?<?php echo date("d-m-Y"); ?>552"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>