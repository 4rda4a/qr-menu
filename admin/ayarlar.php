<?php
if (isset($_POST["logoKaydet"])) {
    $logoPhoto = $_FILES["logoPhoto"]["name"];
    if ($logoPhoto != "") {
        $adlandir = date("dmyHis");
        $adlandir = $adlandir . ".png";
        move_uploaded_file($_FILES["logoPhoto"]["tmp_name"], "../img/" . $adlandir);
        $sql = "UPDATE `site` SET
            `siteLogo` = '$adlandir'
            WHERE `site`.`siteId` = '1'";
        $conn->exec($sql);
        unlink("../img/" . $site["siteLogo"]);
    }
    header("refresh: 0");
}
if (isset($_POST["renk1Btn"])) {
    $renk = $_POST["renkInput1"];
    $sql = "UPDATE `site` SET
        `renk1` = '$renk'
        WHERE `site`.`siteId` = '1'";
    $conn->exec($sql);
    header("refresh: 0");
}
if (isset($_POST["renk2Btn"])) {
    $renk = $_POST["renkInput2"];
    $sql = "UPDATE `site` SET
        `renk2` = '$renk'
        WHERE `site`.`siteId` = '1'";
    $conn->exec($sql);
    header("refresh: 0");
}
?>
<div class="card col-sm-8 m-auto">
    <div class="card-body">
        <form class="card" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <h6 class="m-0">Logo</h6>
            </div>
            <div class="card-body text-center">
                <input class="form-control" type="file" name="logoPhoto">
                <div class="mt-3">
                    <img class="col-sm-4 col-8 m-auto rounded" src="<?= $site["siteLink"] . "img/" . $site["siteLogo"]; ?>">
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="logoKaydet">Güncelle</button>
            </div>
        </form>
        <form class="row row-cols-sm-2 row-cols-1 mt-3" method="post">
            <div class="col mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Renk 1 (Genel Renk)</h6>
                    </div>
                    <div class="card-body text-center">
                        <input class="form-control" type="color" value="<?= $site["renk1"] ?>" name="renkInput1">
                        <button type="submit" class="btn mt-2 btn-primary" name="renk1Btn">Güncelle</button>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Renk 2</h6>
                    </div>
                    <div class="card-body text-center">
                        <input class="form-control" type="color" value="<?= $site["renk2"] ?>" name="renkInput2">
                        <button type="submit" class="btn mt-2 btn-primary" name="renk2Btn">Güncelle</button>
                    </div>
                </div>
            </div>
        </form>
    </div>