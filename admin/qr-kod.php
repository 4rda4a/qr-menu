<?php
$siteUrl = $site["siteLink"];
$site = str_replace("http://", "", $siteUrl);
$site = str_replace("https://", "", $site);
$site = str_replace(".", "", $site);
$site = str_replace("/", "", $site);
$site = str_replace("_", "", $site);
if (file_exists("../img/$site.png")) { ?>
    <div class="card">
        <div class="card-header">QR Kod</div>
        <div class="card-body text-center">
            <img src="../img/<?= $site ?>.png" alt="qr-code">
            <div class="mt-3">
                <a href="../img/<?= $site ?>.png" download class="btn btn-primary col-sm-3">
                    <i class="fas fa-fw fa-download"></i> İndir
                </a>
            </div>
        </div>
    </div>
<?php } else {
    include "barcodeQr.php";
    $qrcode = new BarcodeQR();
    $qrcode->url("$siteUrl");
    $qrcode->draw(250, "../img/$site.png");
    header("refresh:0");
} ?>