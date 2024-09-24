<hr>
<div>
    <?php
    $urun = $conn->prepare("SELECT *
    FROM urunler
    INNER JOIN anaUrunler ON urunler.anaUrunId = anaUrunler.anaUrunId
    WHERE anaUrunler.anaUrunLink = '$k[1]' AND anaUrunState = 1
    ORDER BY urunBaslik ASC
    ");
    $urun->execute();
    if ($urun->rowCount() > 0) {
        $urun = $urun->fetchAll();
    ?>
        <h5><?= strtoupper(str_replace("-", " ", $k[1])); ?></h5>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            <?php
            // ÜRÜN KATEGORİ SAYFASI
            foreach ($urun as $key => $value) { ?>
                <div class="col">
                    <a href="../urunler/<?= $value["urunLink"]; ?>" class="card">
                        <img class="card-img-urun" style="background-image: url(../img/<?= $value["urunImg"]; ?>);"
                            class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title"><?= $value["urunBaslik"]; ?></h6>
                            <h5 class="card-title m-0"><?= $value["urunFiyat"]; ?> ₺</h5>
                        </div>
                    </a>
                </div>
            <?php }
            ?>
        </div>
        <?php
    } else {
        $urun = $conn->prepare("SELECT *
        FROM urunler INNER JOIN anaurunler ON urunler.anaUrunId = anaurunler.anaUrunId 
        WHERE urunState = 1 AND anaUrunState = 1 AND urunLink = '$k[1]'
    ");
        $urun->execute();
        if ($urun->rowCount() > 0) {
            $urun = $urun->fetch();
            // ÜRÜN SAYFASI
        ?>
            <div class="card col-sm-7 m-auto">
                <div class="card-header">
                    <div class="text-center mb-2">
                        <img src="../img/<?= $urun["urunImg"]; ?>" class="col-sm-8 m-auto card-img">
                    </div>
                    <h5 class="fw-bold">
                        <?= $urun["urunBaslik"]; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <?= $urun["urunAciklama"]; ?>
                    <div class="text-center mt-3" id="urunLikeOrDislike">
                        <?php
                        $c_adi = "UrunLike" . $urun["urunId"];
                        if (isset($_COOKIE[$c_adi])) {
                            echo "Değerlendirmeniz kaydedilmiştir!";
                        } else { ?>
                            <div class="row row-cols-2">
                                <input type="hidden" value="<?= $urun["urunId"]; ?>" id="urunId">
                                <div class="col text-start">
                                    <i class="fi fi-rr-social-network text-success cursor-pointer fs-3" onclick="urunLike(1)"></i>
                                </div>
                                <div class="col text-end">
                                    <i class="fi fi-rr-hand text-danger cursor-pointer fs-3" onclick="urunLike(0)"></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer fs-4 fw-bold text-success">
                    <?= $urun["urunFiyat"]; ?> ₺
                </div>
            </div>
    <?php } else {
            include "./errorPage.php";
        }
    }
    ?>
</div>