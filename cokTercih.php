<div>
    <hr>
    <h5>En Çok Tercih Edilenler?</h5>
    <div class="row row-cols-2 row-cols-md-5 g-4">
        <?php
        $urunler = $conn->prepare("SELECT * FROM urunler WHERE urunState = 1 ORDER BY urunLike DESC LIMIT 20");
        $urunler->execute();
        $urunler = $urunler->fetchAll();
        foreach ($urunler as $key => $value) { ?>
            <div class="col">
                <a href="urunler/<?= $value["urunLink"]; ?>" class="card">
                    <img class="card-img-urun" style="background-image: url(img/<?= $value["urunImg"]; ?>);"
                        class="card-img-top">
                    <div class="card-body">
                        <h6 class="card-title"><?= $value["urunBaslik"]; ?></h6>
                        <h5 class="card-title m-0 text-success fw-bold"><?= $value["urunFiyat"]; ?> ₺</h5>
                    </div>
                </a>
            </div>
        <?php }
        ?>
    </div>
</div>