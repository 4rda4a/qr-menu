<?php
$urunId = clean($_GET["uid"]);
$urunSQL = $conn->prepare("SELECT * FROM anaurunler WHERE anaUrunId='$urunId'");
$urunSQL->execute();
if ($urunSQL->rowCount() > 0) {
    $urun = $urunSQL->fetch();
    $hata = "";
    if (isset($_POST["anaUrunSil"])) {
        $urunSQL2 = $conn->prepare("SELECT * FROM urunler WHERE anaUrunId='$urunId'");
        $urunSQL2->execute();
        if ($urunSQL2->rowCount() == 0) {
            $sql = "DELETE FROM `anaurunler` WHERE `anaurunler`.`anaUrunId` = $urun[anaUrunId]";
            $conn->exec($sql);
            unlink("../img/" . $urun["anaUrunImg"]);
            if ($conn) {
                header("location: urun-kategorileri");
            }
        } else {
            $hata = "Bu kategoriye ait ürünler var. Lütfen baştan onları siliniz yada kategoriyi pasif hale getiriniz.";
        }
    }
?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="urun-kategorileri">Ürün Kategorileri</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#"><?= $urun["anaUrunIsim"]; ?></a>
            </li>
        </ol>
    </nav>
    <?php
    if (isset($_POST["guncelle"])) {
        $adlandir = $urun["anaUrunImg"];
        $fotograf = $_FILES["fotograf"]["name"];
        if ($fotograf != "") {
            $adlandir = date("dmyHis");
            $adlandir = $adlandir . ".png";
            move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
            unlink("../img/" . $urun["urunImg"]);
        }
        $baslik = clean($_POST["urunBaslik"]);
        $link = SEOLink($baslik);
        $sql = "UPDATE `anaurunler` SET
        `anaUrunIsim` = '$baslik',
        `anaUrunLink` = '$link',
        `anaUrunImg` = '$adlandir'
        WHERE `anaurunler`.`anaUrunId` = '$urun[anaUrunId]'";
        $conn->exec($sql);
        header("refresh: 0");
    }
    ?>
    <div class="text-danger">
        <?= $hata; ?>
    </div>
    <form method="post" enctype="multipart/form-data" class="card col-sm-8 m-auto px-0">
        <div class="card-header">
            Ürün Kategorisi Düzenle :: <?= $urun["anaUrunIsim"]; ?>
        </div>
        <div class="card-body">
            <div>
                <label for="" class="m-0">Başlık</label>
                <input name="urunBaslik" type="text" class="form-control" value="<?= $urun["anaUrunIsim"]; ?>">
            </div>
            <div class="mt-3">
                <p class="text-center">
                    <img class="col-sm-4 col-9" src="../img/<?= $urun["anaUrunImg"]; ?>">
                </p>
                <label for="" class="m-0">Fotoğraf</label>
                <input name="fotograf" type="file" class="form-control">
            </div>
            <div class="mt-3">
                <div class="form-check form-switch">
                    <span class="mr-4">Durum: </span>
                    <input onclick="anaUrunDurumGuncelle(<?= $urun['anaUrunId']; ?>)"
                        style="width: 20px; height: 20px;vertical-align: middle;" class="form-check-input"
                        type="checkbox" role="switch" id="durumUrun_<?= $urun["anaUrunId"]; ?>"
                        <?php
                        if ($urun["anaUrunState"] == true) {
                            echo "checked";
                        }
                        ?>>
                    <label for="durumUrun_<?= $urun["anaUrunId"]; ?>">
                        (<span id="urunDurumText_<?= $urun["anaUrunId"]; ?>">
                            <?php
                            if ($urun["anaUrunState"] == true) {
                                echo "Aktif";
                            } else {
                                echo "Pasif";
                            }
                            ?>
                        </span>)
                    </label>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="row justify-content-between">
                <button class="btn btn-success col-4" type="submit" name="guncelle">
                    GÜNCELLE
                </button>
                <button type="button" class="btn btn-danger col-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Kategoriyi Sil
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kategoriyi silmek istediğine emin misin?</h5>
                            </div>
                            <div class="modal-body text-danger fw-bold">
                                Kategoriyi silmek istediğinize emin misiniz?
                                <br>
                                İŞLEM GERİ ALINAMAZ!
                                <br>
                                <b>
                                    Not: Eğer bu kategoriye sahip ürün varsa kategoriyi silemezsiniz!
                                </b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success col-sm-3" data-bs-dismiss="modal">İPTAL</button>
                                <form method="post">
                                    <button name="anaUrunSil" class="btn btn-danger col-sm-3">SİL</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<?php
} else {
    include "../errorPage.php";
}
?>