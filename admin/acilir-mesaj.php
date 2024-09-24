<?php
if (isset($_POST["acilirKaydetBtn"])) {
    $acilirGorsel = $_FILES["acilirGorsel"]["name"];
    if ($acilirGorsel != "") {
        $adlandir = date("dmyHis");
        $adlandir = $adlandir . ".png";
        move_uploaded_file($_FILES["acilirGorsel"]["tmp_name"], "../img/" . $adlandir);
        unlink("../img/" . $site["acilirMesajGorsel"]);
    } else {
        $adlandir = $site["acilirMesajGorsel"];
    }
    $acilirMesajMetin = clean($_POST["acilirMetin"]);
    $acilirMesajDurum = $_POST["acilirMesajDurum"];
    if (isset($acilirMesajDurum)) {
        $acilirMesajDurum = true;
    } else {
        $acilirMesajDurum = false;
    }
    $sql = "UPDATE `site` SET
            `acilirMesajGorsel` = '$adlandir',
            `acilirMesajMetin` = '$acilirMesajMetin',
            `acilirMesajDurum` = '$acilirMesajDurum'
            WHERE `site`.`siteId` = '1'";
    $conn->exec($sql);
    header("refresh: 0");
}
?>
<div class="card m-auto col-sm-8">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Açılır Mesaj</h5>
            </div>
            <form class="card-body" method="post" enctype="multipart/form-data">
                <div class="">
                    <div class="mb-3 text-center">
                        <img class="col-sm-3 col-6"
                            src="<?= $site["siteLink"] . "img/" . $site["acilirMesajGorsel"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="m-0">Görsel: </label>
                        <input class="form-control" type="file" name="acilirGorsel">
                    </div>
                    <div class="mb-3">
                        <label class="m-0">Metin: </label>
                        <textarea class="form-control" rows="5"
                            name="acilirMetin"><?= $site["acilirMesajMetin"] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="acilirMesajDurum">Durum:</label>
                        <input name="acilirMesajDurum" style="width: 25px; height: 50px; vertical-align: middle;"
                            type="checkbox" id="acilirMesajDurum" <?php if ($site["acilirMesajDurum"]) {
                                echo "checked";
                            } ?>>
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary col-sm-3" name="acilirKaydetBtn">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>