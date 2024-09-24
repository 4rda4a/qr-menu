<div>
    <hr>
    <h5>Ne Yemek İstersiniz?</h5>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        <?php
        $anaUrunler = $conn->prepare("SELECT * FROM anaUrunler WHERE anaUrunState = 1");
        $anaUrunler->execute();
        $anaUrunler = $anaUrunler->fetchAll();
        foreach ($anaUrunler as $key => $value) { ?>
            <div class="col">
                <a href="urunler/<?= $value["anaUrunLink"]; ?>" class="card">
                    <img class="card-img-urun" style="background-image: url(img/<?= $value["anaUrunImg"]; ?>);" class="card-img-top">
                    <div class="card-body">
                        <h6 class="card-title m-0"><?= $value["anaUrunIsim"]; ?></h6>
                    </div>
                </a>
            </div>
        <?php }
        ?>
    </div>
</div>