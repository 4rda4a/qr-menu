<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="urun-kategorileri">Ürün Kategorileri</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Yeni Ürün Kategorisi Ekle</a>
        </li>
    </ol>
</nav>
<?php
$hata = "";
if (isset($_POST["guncelle"])) {
    $fotograf = $_FILES["fotograf"]["name"];
    $baslik = clean($_POST["urunBaslik"]);
    if (isset($_POST["durum"])) {
        $durum = true;
    } else {
        $durum = false;
    }
    $link = SEOLink($baslik);
    if ($fotograf != "" && $baslik != "") {
        $adlandir = date("dmyHis");
        $adlandir = $adlandir . ".png";
        move_uploaded_file($_FILES["fotograf"]["tmp_name"], "../img/" . $adlandir);
        $sql = "INSERT INTO `anaurunler` (`anaUrunIsim`, `anaUrunImg`, `anaUrunLink`, `anaUrunState`) 
        VALUES ('$baslik', '$adlandir', '$link', '$durum');";
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
        Ürün Kategorisi Ekle
    </div>
    <div class="card-body">
        <div>
            <label for="" class="m-0">Başlık</label>
            <input name="urunBaslik" type="text" class="form-control">
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
    </div>
    <div class="card-footer text-center">
        <div class="row justify-content-between">
            <button class="btn btn-success col-4" type="submit" name="guncelle">
                Kaydet
            </button>
        </div>
    </div>
</form>