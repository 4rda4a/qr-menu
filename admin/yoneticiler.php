<?php
if (isset($_POST["kaydet"])) {
    $kullaniciAdi = clean($_POST["kullaniciAdi"]);
    $email = clean($_POST["email"]);
    $sifre = clean(md5($_POST["sifre"]));
    $sql = "INSERT INTO `user` (`userAdi`, `userSifre`,  `userEmail`) 
        VALUES ('$kullaniciAdi', '$sifre',  '$email');";
    $conn->exec($sql);
    if ($conn) {
        header("refresh: 0");
    }
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Yönetici Ekle
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Yönetici Ekle</h5>
            </div>
            <div method="post" class="modal-body">
                <div>
                    <label class="m-0">Kullanıcı Adı:</label>
                    <input class="form-control" type="text" name="kullaniciAdi">
                </div>
                <div class="mt-3">
                    <label class="m-0">Email:</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="mt-3">
                    <label class="m-0">Şifre:</label>
                    <input class="form-control" type="password" name="sifre">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
    </div>
</div>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Kullanıcı Adı</th>
            <th>Email</th>
            <th>Son Giriş</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $users = $conn->prepare("SELECT *
        FROM user WHERE userAdi != '$_COOKIE[username]';
        ");
        $users->execute();
        $users = $users->fetchAll();
        foreach ($users as $key => $value) {
            if (isset($_POST["kaldir"])) {
                $sql = "DELETE FROM `user` WHERE `user`.`userId` = $value[userId]";
                $conn->exec($sql);
                $sql = "INSERT INTO `ylog` (`ylogIslem`, `ylogUser`,  `ylogAciklama`) 
                    VALUES ('Yönetici Silme', '$_COOKIE[username]',  '$_COOKIE[username] kullanıcı adına sahip yönetici, $value[userAdi] adlı kullancıyı yöneticilikten kaldırmıştır.');";
                $conn->exec($sql);
                if ($conn) {
                    header("refresh: 0");
                }
            }
        ?>
            <tr>
                <td><?= $value["userAdi"]; ?></td>
                <td>
                    <a href="mailto: <?= $value["userEmail"]; ?>">
                        <?= $value["userEmail"]; ?>
                    </a>
                </td>
                <td>
                    <?php
                    $girislog = $conn->prepare("SELECT * FROM girislog WHERE girisLogUsername = $value[userId] ORDER BY girisLogId DESC;");
                    $girislog->execute();
                    if ($girislog->rowCount() > 0) {
                        $girislog = $girislog->fetch();
                        echo $girislog["girisLogTarih"];
                    } else {
                        echo "Daha önce giriş yapmadı!";
                    }
                    ?>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#yoneticiDuzenle">
                        Kaldır
                    </button>

                    <div class="modal fade" id="yoneticiDuzenle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Yöneticiyi Kaldır</h5>
                                </div>
                                <div class="modal-body text-danger">
                                    Eğer yöneticiyi kaldırırsanız bu işlemi geri alamazsınız. <br><br> Olası bir durumda yazılım şirketi ile iletişime geçilip bu işlemi kimin gerçekleştirdiği tespit edilebilir.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                    <form method="post">
                                        <button type="submit" name="kaldir" class="btn btn-primary">Kaldır</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script>
    new DataTable('#example');
</script>