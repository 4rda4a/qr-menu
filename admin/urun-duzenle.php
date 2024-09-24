<?php
$urunId = clean($_GET["uid"]);
$urunSQL = $conn->prepare("SELECT * FROM urunler INNER JOIN anaurunler ON urunler.anaUrunId = anaurunler.anaUrunId WHERE urunId='$urunId'");
$urunSQL->execute();
if ($urunSQL->rowCount() > 0) {
    $urun = $urunSQL->fetch();
?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
                <a href="urun-kategorileri">Ürünlerimiz</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#"><?= $urun["urunBaslik"]; ?></a>
            </li>
        </ol>
    </nav>
    <?php
    if (isset($_POST["guncelle"])) {
        $adlandir = $urun["urunImg"];
        $fotograf = $_FILES["fotograf"]["name"];
        if ($fotograf != "") {
            $adlandir = date("dmyHis");
            $adlandir = $adlandir . ".png";
            move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
            unlink("../img/" . $urun["urunImg"]);
        }
        $baslik = clean($_POST["urunBaslik"]);
        $link = SEOLink($baslik);
        $kategori = clean($_POST["anaUrunId"]);
        $fiyat = clean($_POST["urunFiyat"]);
        $icerik = $_POST["urunAciklama"];
        $sql = "UPDATE `urunler` SET
        `urunBaslik` = '$baslik',
        `anaUrunId` = '$kategori',
        `urunFiyat` = '$fiyat',
        `urunLink` = '$link',
        `urunAciklama` = '$icerik',
        `urunImg` = '$adlandir'
        WHERE `urunler`.`urunId` = '$urun[urunId]'";
        $conn->exec($sql);
        header("refresh: 0");
    }
    ?>
    <form method="post" enctype="multipart/form-data" class="card col-sm-8 m-auto px-0">
        <div class="card-header">
            Ürün Düzenle :: <?= $urun["urunBaslik"]; ?>
        </div>
        <div class="card-body">
            <div>
                <label for="" class="m-0">Başlık</label>
                <input name="urunBaslik" type="text" class="form-control" value="<?= $urun["urunBaslik"]; ?>">
            </div>
            <div class="mt-3">
                <label for="" class="m-0">Kategori</label>
                <select name="anaUrunId" id="" class="form-control">
                    <option value="<?= $urun["anaUrunId"]; ?>" selected><?= $urun["anaUrunIsim"] ?></option>
                    <?php
                    $anaUrunler = $conn->prepare("SELECT *
                FROM anaurunler WHERE anaUrunId != $urun[anaUrunId]
                ");
                    $anaUrunler->execute();
                    $anaUrunler = $anaUrunler->fetchAll();
                    foreach ($anaUrunler as $key => $value) { ?>
                        <option value="<?= $value["anaUrunId"]; ?>"><?= $value["anaUrunIsim"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-3">
                <label for="" class="m-0">Fiyat</label>
                <input name="urunFiyat" type="number" class="form-control" value="<?= $urun["urunFiyat"]; ?>">
            </div>
            <div class="mt-3">
                <p class="text-center">
                    <img class="col-sm-4 col-9" src="../img/<?= $urun["urunImg"]; ?>">
                </p>
                <label for="" class="m-0">Fotoğraf</label>
                <input name="fotograf" type="file" class="form-control">
            </div>
            <div class="mt-3">
                <div class="form-check form-switch">
                    <span class="mr-4">Durum: </span>
                    <input onclick="urunDurumGuncelle(<?= $urun['urunId']; ?>)"
                        style="width: 20px; height: 20px;vertical-align: middle;" class="form-check-input"
                        type="checkbox" role="switch" id="durumUrun_<?= $urun["urunId"]; ?>"
                        <?php
                        if ($urun["urunState"] == true) {
                            echo "checked";
                        }
                        ?>>
                    <label for="durumUrun_<?= $urun["urunId"]; ?>">
                        (<span id="urunDurumText_<?= $urun["urunId"]; ?>">
                            <?php
                            if ($urun["urunState"] == true) {
                                echo "Aktif";
                            } else {
                                echo "Pasif";
                            }
                            ?>
                        </span>)
                    </label>
                </div>
            </div>
            <div class="mt-3">
                <label for="" class="m-0">İçerik:</label>
                <textarea name="urunAciklama"><?= $urun["urunAciklama"] ?></textarea>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="row justify-content-between">
                <button class="btn btn-success col-4" type="submit" name="guncelle">
                    GÜNCELLE
                </button>
                <button type="button" class="btn btn-danger col-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ürünü Sil
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ürünü silmek istediğine emin misin?</h5>
                            </div>
                            <div class="modal-body text-danger fw-bold">
                                Ürünü silmek istediğinize emin misiniz?
                                <br>
                                İŞLEM GERİ ALINAMAZ!
                            </div>
                            <div method="post" class="modal-footer">
                                <button type="button" class="btn btn-success col-sm-3" data-bs-dismiss="modal">İPTAL</button>
                                <form method="post">
                                    <button name="urunSil" class="btn btn-danger col-sm-3">SİL</button>
                                </form>
                            </div>
                            <?php
                            if (isset($_POST["urunSil"])) {
                                $sql = "DELETE FROM `urunler` WHERE `urunler`.`urunId` = $urun[urunId]";
                                $conn->exec($sql);
                                unlink("../img/" . $urun["urunImg"]);
                                if ($conn) {
                                    header("location: urunlerimiz");
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.tiny.cloud/1/vm9qrp7e80a0gvajnymcl115d87be6xnxokohxtyovowsr5v/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'tr',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <style>
        .tox-statusbar__branding {
            display: none !important;
        }
    </style>
<?php
} else {
    include "../errorPage.php";
}
?>