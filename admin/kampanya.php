<?php
$urunSQL = $conn->prepare("SELECT * FROM kampanya");
$urunSQL->execute();
$urun = $urunSQL->fetch();
?>
<?php
if (isset($_POST["guncelle"])) {
    $adlandir = $urun["kampanyaImg"];
    $fotograf = $_FILES["fotograf"]["name"];
    if ($fotograf != "") {
        $adlandir = date("dmyHis");
        $adlandir = $adlandir . ".png";
        move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
        unlink("../img/" . $urun["kampanyaImg"]);
    }
    $durum = $_POST["kampanyaDurum"];
    if (isset($durum)) {
        $durum = true;
    } else {
        $durum = false;
    }
    $icerik = $_POST["urunAciklama"];
    $sql = "UPDATE `kampanya` SET
        `kampanyaText` = '$icerik',
        `kampanyaImg` = '$adlandir',
        `kampanyaState` = '$durum'
        WHERE `kampanya`.`kampanyaId` = '1'";
    $conn->exec($sql);
    header("refresh: 0");
}
?>
<form method="post" enctype="multipart/form-data" class="card col-sm-8 m-auto px-0">
    <div class="card-header">
        Kampanya Düzenle
    </div>
    <div class="card-body">
        <div class="mt-3">
            <p class="text-center">
                <img class="col-sm-6 col-9" src="../img/<?= $urun["kampanyaImg"]; ?>">
            </p>
            <label for="" class="m-0">Fotoğraf</label>
            <input name="fotograf" type="file" class="form-control">
        </div>
        <div class="mt-3">
            <div class="form-check form-switch">
                Durum:
                <input name="kampanyaDurum" style="width: 25px; height: 50px; vertical-align: middle;"
                    type="checkbox"
                    <?php if ($urun["kampanyaState"]) {
                        echo "checked";
                    } ?>>
            </div>
        </div>
        <div class="mt-3">
            <label for="" class="m-0">İçerik:</label>
            <textarea name="urunAciklama"><?= $urun["kampanyaText"] ?></textarea>
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="row justify-content-between">
            <button class="btn btn-success col-4" type="submit" name="guncelle">
                Kaydet
            </button>
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