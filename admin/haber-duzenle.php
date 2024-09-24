<?php
$urunId = clean($_GET["uid"]);
$urunSQL = $conn->prepare("SELECT * FROM haberler WHERE haberId='$urunId'");
$urunSQL->execute();
if ($urunSQL->rowCount() > 0) {
    $urun = $urunSQL->fetch();
    $hata = "";
    if (isset($_POST["haberSil"])) {
        $sql = "DELETE FROM `haberler` WHERE `haberler`.`haberId` = $urun[haberId]";
        $conn->exec($sql);
        unlink("../img/" . $urun["haberId"]);
        if ($conn) {
            header("location: haberler");
        }
    } 
?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="haberler">Haberler</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Haber Düzenle</a>
            </li>
        </ol>
    </nav>
    <?php
    if (isset($_POST["guncelle"])) {
        $adlandir = $urun["haberImg"];
        $fotograf = $_FILES["fotograf"]["name"];
        if ($fotograf != "") {
            $adlandir = date("dmyHis");
            $adlandir = $adlandir . ".png";
            move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
            unlink("../img/" . $urun["haberImg"]);
        }
        $baslik = clean($_POST["urunBaslik"]);
        $icerik = $_POST["urunAciklama"];
        $sql = "UPDATE `haberler` SET
        `haberBaslik` = '$baslik',
        `haberImg` = '$adlandir',
        `haberText` = '$icerik'
        WHERE `haberler`.`haberId` = '$urun[haberId]'";
        $conn->exec($sql);
        header("refresh: 0");
    }
    ?>
    <div class="text-danger">
        <?= $hata; ?>
    </div>
    <form method="post" enctype="multipart/form-data" class="card col-sm-8 m-auto px-0">
        <div class="card-header">
            Haber Düzenle
        </div>
        <div class="card-body">
            <div>
                <label for="" class="m-0">Başlık</label>
                <input name="urunBaslik" type="text" class="form-control" value="<?= $urun["haberBaslik"]; ?>">
            </div>
            <div class="mt-3">
                <p class="text-center">
                    <img class="col-sm-6 col-9" src="../img/<?= $urun["haberImg"]; ?>">
                </p>
                <label for="" class="m-0">Fotoğraf</label>
                <input name="fotograf" type="file" class="form-control">
            </div>
            <div class="mt-3">
                <label for="" class="m-0">İçerik:</label>
                <textarea name="urunAciklama"><?= $urun["haberText"] ?></textarea>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="row justify-content-between">
                <button class="btn btn-success col-4" type="submit" name="guncelle">
                    GÜNCELLE
                </button>
                <button type="button" class="btn btn-danger col-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Haberi Sil
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kategoriyi silmek istediğine emin misin?</h5>
                            </div>
                            <div class="modal-body text-danger fw-bold">
                                Haberi silmek istediğinize emin misiniz?
                                <br>
                                İŞLEM GERİ ALINAMAZ!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success col-sm-3" data-bs-dismiss="modal">İPTAL</button>
                                <form method="post">
                                    <button name="haberSil" class="btn btn-danger col-sm-3">SİL</button>
                                </form>
                            </div>
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