<div class="card col-sm-8 m-auto">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Site Bakım Modu</h5>
            </div>
            <?php
            if (isset($_POST["bakimKaydet"])) {
                $bakimTarih = clean($_POST["bakimTarih"]);
                $bakimTarih = $bakimTarih . ":00";
                $bakimBaslik = clean($_POST["bakimBaslik"]);
                $bakimAciklama = clean($_POST["bakimAciklama"]);

                $siteBakimDurum = $_POST["siteBakimDurum"];
                if (isset($siteBakimDurum)) {
                    $siteBakimDurum = true;
                } else {
                    $siteBakimDurum = false;
                }
                $sql = "UPDATE `site` SET
                `siteBakimTarih` = '$bakimTarih',
                `siteBakimBaslik` = '$bakimBaslik',
                `siteBakimAciklama` = '$bakimAciklama',
                `siteBakim` = '$siteBakimDurum'
                WHERE `site`.`siteId` = '1'";
                $conn->exec($sql);
                header("refresh: 0");
            }
            ?>
            <form class="card-body" method="post">
                <div class="mb-2">
                    <?php
                    $d = date("d") + 10;
                    $siteAcilis = date("Y-m-") . $d . "T" . date("10:00");
                    ?>
                    <label class="m-0">Site Açılış Tarihi</label>
                    <input class="form-control" type="datetime-local" name="bakimTarih" value="<?= $siteAcilis; ?>">
                </div>
                <?php
                if ($site["siteBakim"] == true) { ?>
                    <div class="mb-2 text-success fw-bold">
                        <label class="m-0">Mevcut Site Açılış Tarihi</label>
                        <input disabled class="form-control" type="datetime-local" name="bakimTarih"
                            value="<?= $site["siteBakimTarih"]; ?>">
                    </div>
                <?php }
                ?>
                <div class="mb-2">
                    <label class="m-0">Başlık</label>
                    <input class="form-control" name="bakimBaslik" value="<?php if ($site["siteBakimBaslik"] != "") {
                        echo $site["siteBakimBaslik"];
                    } else {
                        echo "SİTEMİZ BAKIMDADIR";
                    } ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Açıklama</label>
                    <textarea class="form-control" name="bakimAciklama" rows="5"><?php if ($site["siteBakimAciklama"] != "") {
                        echo $site["siteBakimAciklama"];
                    } else {
                        echo "Şu anda bakımdayız.Kısa süre sonra geri döneceğiz. Daha sonra yeniden deneyiniz.";
                    } ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="siteBakimDurum">Durum:</label>
                    <input name="siteBakimDurum" style="width: 25px; height: 50px; vertical-align: middle;"
                        type="checkbox" name="siteBakimDurum" <?php if ($site["siteBakim"]) {
                            echo "checked";
                        } ?>>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary col-sm-3" name="bakimKaydet">
                        Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>