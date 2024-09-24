<?php
include_once "../baglan.php";
include_once "../control.php";
$bugun = date('d.m.Y - H:i');
if (isset($_POST["sifre"])) {
    $kullaniciAdi = clean($_POST["kullaniciAdi"]);
    $sifre = md5(clean($_POST["sifre"]));
    $userSql = $conn->prepare("SELECT * FROM user WHERE userAdi='$kullaniciAdi' AND userSifre ='$sifre'");
    $userSql->execute();
    if ($userSql->rowCount() > 0) {
        $user = $userSql->fetch();
        $cookie_time = time() + (60 * 60 * 24); # 1 gün
        $cookie = setcookie("username", $kullaniciAdi, $cookie_time, "/");
        $_SESSION["username"] = $user["userAdi"];

        $kullaniciIp = $_SERVER["REMOTE_ADDR"];
        $engelenmisIp = array("::1", "127.0.0.1");
        if (in_array($kullaniciIp, $engelenmisIp)) {
            $kullaniciIp = "Engellenmiş IP adresi!";
        } else {
            $kullaniciIp = $_SERVER["REMOTE_ADDR"];
        }
        $hostnameUser = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        $sql = "INSERT INTO `girislog` (`girisLogTarih`, `girisLogIp`, `girisLogCihaz`, `girisLogKullaniciAdi`, `girisLogUsername`) 
        VALUES ('$bugun', '$kullaniciIp', '$_SERVER[HTTP_USER_AGENT]', '$hostnameUser', '$user[userId]');";
        $conn->exec($sql);
        echo true;
    } else {
        echo "Kullanıcı bulunamadı!";
    }
}
if (isset($_POST["adSoyad"])) {
    $adSoyad = clean($_POST["adSoyad"]);
    $telefon = clean($_POST["telefon"]);
    $email = clean($_POST["email"]);
    $konu = clean($_POST["konu"]);
    $hata = clean($_POST["hata"]);

    $sql = "INSERT INTO `sikayet` (`sikayetAdSoyad`, `sikayetTelefon`, `sikayetEmail`, `sikayetKonu`, `sikayetMesaj`) 
    VALUES ('$adSoyad', '$telefon', '$email', '$konu', '$hata');";
    $conn->exec($sql);
    echo true;
}
if (isset($_POST["profilIsim"])) {
    $isim = clean($_POST["profilIsim"]);
    $email = clean($_POST["email"]);
    $sifre = clean($_POST["profilSifre"]);

    if ($sifre == "") {
        $sql = "UPDATE `user` SET 
        `userAdi` = '$isim',
        `userEmail` = '$email'
        WHERE `user`.`userId` = '$user[userId]'";
    } else {
        $sifre = md5($sifre);
        $sql = "UPDATE `user` SET 
        `userSifre` = '$sifre'
        WHERE `user`.`userId` = '$user[userId]'";
    }
    $conn->exec($sql);
    $cookie_time = time() + (60 * 60 * 24); # 1 gün
    $cookie = setcookie("username", $isim, $cookie_time, "/");
    echo true;
}
if (isset($_POST["acilirMesajKapat"])) {
    $cookie_time = time() + (60 * 60 * 12); # 12 saat
    $cookie = setcookie("acilirMesaj", "Çerez 12 saat sonra silinecek.", $cookie_time, "/");
    echo true;
}
if (isset($_POST["x"])) {
    $instagram = clean($_POST["instagram"]);
    $x = clean($_POST["x"]);
    $facebook = clean($_POST["facebook"]);
    $sql = "UPDATE `site` SET 
    `siteInstagram` = '$instagram',
    `siteX` = '$x',
    `siteFacebook` = '$facebook'
    WHERE `site`.`siteId` = '1'";
    $conn->exec($sql);
    echo true;
}
if (isset($_POST["firmaUnvani"])) {
    $firmaUnvani = clean($_POST["firmaUnvani"]);
    $firmaTelefon = clean($_POST["firmaTelefon"]);
    $firmaSaat = clean($_POST["firmaSaat"]);
    $firmaAdres = clean($_POST["firmaAdres"]);
    $firmaEmail = clean($_POST["firmaEmail"]);
    $sql = "UPDATE `site` SET 
    `siteAdi` = '$firmaUnvani',
    `siteTelefon` = '$firmaTelefon',
    `siteSaat` = '$firmaSaat',
    `siteKonum` = '$firmaAdres',
    `siteMail` = '$firmaEmail'
    WHERE `site`.`siteId` = '1'";
    $conn->exec($sql);
    echo true;
}
if (isset($_POST["UrunDurum"])) {
    $urunId = clean($_POST["urunId"]);
    $durum = clean($_POST["UrunDurum"]);
    if ($durum == true) {
        $sutun = "urunLike";
    } else {
        $sutun = "urunDislike";
    }
    $sql = "UPDATE `urunler` SET `$sutun` = `$sutun` + 1 WHERE `urunler`.`urunId` = :urunId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':urunId', $urunId, PDO::PARAM_INT);
    $stmt->execute();

    $cookie_time = time() + (60 * 60 * 24 * 1095); # 3 yıl
    $cookie = setcookie("UrunLike" . $urunId, $urunId, $cookie_time, "/");
    echo true;
}
if (isset($_POST["UrunDurumGuncel"])) {
    $urunId = clean($_POST["urunId"]);
    $urunSQL = $conn->prepare("SELECT * FROM urunler WHERE urunId='$urunId'");
    $urunSQL->execute();
    $urunSorgu = $urunSQL->fetch();
    if ($urunSorgu["urunState"] == false) {
        $state = true;
        echo "Aktif";
    } else {
        $state = false;
        echo "Pasif";
    }
    $sql = "UPDATE `urunler` SET `urunState` = '$state' WHERE `urunler`.`urunId` = :urunId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':urunId', $urunId, PDO::PARAM_INT);
    $stmt->execute();
}
if (isset($_POST["AnaUrunDurumGuncel"])) {
    $urunId = clean($_POST["urunId"]);
    $urunSQL = $conn->prepare("SELECT * FROM anaurunler WHERE anaUrunId='$urunId'");
    $urunSQL->execute();
    $urunSorgu = $urunSQL->fetch();
    if ($urunSorgu["anaUrunState"] == false) {
        $state = true;
        echo "Aktif";
    } else {
        $state = false;
        echo "Pasif";
    }
    $sql = "UPDATE `anaurunler` SET `anaUrunState` = '$state' WHERE `anaurunler`.`anaUrunId` = :urunId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':urunId', $urunId, PDO::PARAM_INT);
    $stmt->execute();
}
if (isset($_POST["haberUrunDurumGuncel"])) {
    $urunId = clean($_POST["urunId"]);
    $urunSQL = $conn->prepare("SELECT * FROM haberler WHERE haberId='$urunId'");
    $urunSQL->execute();
    $urunSorgu = $urunSQL->fetch();
    if ($urunSorgu["haberState"] == false) {
        $state = true;
        echo "Aktif";
    } else {
        $state = false;
        echo "Pasif";
    }
    $sql = "UPDATE `haberler` SET `haberState` = '$state' WHERE `haberler`.`haberId` = :urunId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':urunId', $urunId, PDO::PARAM_INT);
    $stmt->execute();
}