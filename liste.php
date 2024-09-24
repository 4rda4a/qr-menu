<?php
if ($k[0] == "urunler") {

?>
    <hr>
    <div class="card">
        <div class="card-body">
            <h5>Kategoriler</h5>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <?php
                $anaUrunler = $conn->prepare("SELECT * FROM anaUrunler WHERE anaUrunState = 1");
                $anaUrunler->execute();
                $anaUrunler = $anaUrunler->fetchAll();
                foreach ($anaUrunler as $key => $value) { ?>
                    <div class="col">
                        <a href="urunler/<?= $value["anaUrunLink"]; ?>" class="card">
                            <img class="card-img-urun" style="background-image: url(img/<?= $value["anaUrunImg"]; ?>);"
                                class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title m-0"><?= $value["anaUrunIsim"]; ?></h6>
                            </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h5>Ürünler</h5>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <?php
                $anaUrunler = $conn->prepare("SELECT * FROM urunler INNER JOIN anaurunler on urunler.anaUrunId = anaurunler.anaUrunId WHERE urunState = 1 AND anaUrunState = 1");
                $anaUrunler->execute();
                $anaUrunler = $anaUrunler->fetchAll();
                foreach ($anaUrunler as $key => $value) { ?>
                    <div class="col">
                        <a href="urunler/<?= $value["urunLink"]; ?>" class="card">
                            <img class="card-img-urun" style="background-image: url(img/<?= $value["urunImg"]; ?>);"
                                class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title m-0"><?= $value["urunBaslik"]; ?></h6>
                            </div>
                            <div class="card-footer">
                                <h5 class="m-0 text-success fw-bold">
                                    <?= $value["urunFiyat"]; ?> ₺
                                </h5>
                            </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
<?php
} else {
    header("location: urunler");
}
?>