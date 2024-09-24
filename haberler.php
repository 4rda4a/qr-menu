<?php
$haberlerSql = $conn->prepare("SELECT * FROM haberler WHERE haberState = 1 ORDER BY haberId DESC LIMIT 5 ");
$haberlerSql->execute();
if ($haberlerSql->rowCount() > 0) { ?>
    <hr>
    <h5>Haberler / Duyurular</h5>
    <div class="alert alert-light text-center" role="alert">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">,
                <?php
                $haberlerSql = $haberlerSql->fetchAll();
                $i = 1;
                foreach ($haberlerSql as $key => $value) { ?>
                    <div class="carousel-item" id="haber-carousel-item-<?= $i; ?>" data-bs-interval="5000">
                        <img class="d-block w-100 haber-carousel-img"
                            style="background-image: url(img/<?= $value["haberImg"]; ?>);">
                        <div class="carousel-caption d-md-block">
                            <button type="button" class="btn btn-primary col-sm-3 col-8" data-bs-toggle="modal"
                                data-bs-target="#haber_id_<?= $value["haberId"]; ?>">
                                İncele
                            </button>
                            <div class="modal fade text-dark" id="haber_id_<?= $value["haberId"]; ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"><?= $value["haberBaslik"]; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?= $value["haberText"]; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary col-12"
                                                data-bs-dismiss="modal">Kapat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Önceki</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sonraki</span>
            </button>
        </div>
    </div>
<?php } ?>
<script>
    document.getElementById("haber-carousel-item-1").classList.add("active");
</script>