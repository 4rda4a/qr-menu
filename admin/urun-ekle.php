<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="urunlerimiz">Ürünlerimiz</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Ürün Ekle</a>
        </li>
    </ol>
</nav>
<?php
$hata = "";
if (isset($_POST["guncelle"])) {
    $fotograf = $_FILES["fotograf"]["name"];
    $baslik = clean($_POST["urunBaslik"]);
    $kategori = clean($_POST["anaUrunId"]);
    $fiyat = clean($_POST["urunFiyat"]);
    if (isset($_POST["durum"])) {
        $durum = true;
    } else {
        $durum = false;
    }
    $link = SEOLink($baslik);
    if ($fotograf != "" && $baslik != "" && $kategori != "" && $fiyat != "") {
        $adlandir = date("dmyHis");
        $adlandir = $adlandir . ".png";
        move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
        $icerik = $_POST["urunAciklama"];
        $sql = "INSERT INTO `urunler` (`urunBaslik`, `urunState`,  `anaUrunId`, `urunFiyat`, `urunLink`, `urunAciklama`, `urunImg`) 
        VALUES ('$baslik', '$durum',  '$kategori', '$fiyat', '$link', '$icerik', '$adlandir');";
        $conn->exec($sql);
        if ($conn) {
            header("refresh: 0");
        }
    } else {
        $hata = "Lütfen eksik alan bırakmayınız!";
    }
}
?>
<div class="text-danger fw-bold">
    <?= $hata; ?>
</div>
<form method="post" enctype="multipart/form-data" class="card col-sm-8 m-auto px-0">
    <div class="card-header">
        Ürün Ekle
    </div>
    <div class="card-body">
        <div>
            <label for="" class="m-0">Başlık</label>
            <input name="urunBaslik" type="text" class="form-control">
        </div>
        <div class="mt-3">
            <label for="" class="m-0">Kategori</label>
            <select name="anaUrunId" id="" class="form-control">
                <?php
                $anaUrunler = $conn->prepare("SELECT *
                FROM anaurunler WHERE anaUrunState = 1
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
            <input name="urunFiyat" type="number" class="form-control" value="">
        </div>
        <div class="mt-3">
            <label for="" class="m-0">Fotoğraf</label>
            <input name="fotograf" type="file" class="form-control">
        </div>
        <div class="mt-3">
            <div class="form-check form-switch">
                <span class="mr-4">Durum: </span>
                <input name="durum" style="width: 20px; height: 20px;vertical-align: middle;" class="form-check-input"
                    type="checkbox" role="switch" checked>
            </div>
        </div>
        <div class="mt-3">
            <label for="" class="m-0">İçerik:</label>
            <textarea name="urunAciklama"></textarea>
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