<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Ad Soyad</th>
            <th>Telefon</th>
            <th>Email</th>
            <th>Konu</th>
            <th>Mesaj</th>
            <th>Durum</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $mesajlar = $conn->prepare("SELECT *
        FROM sikayet INNER JOIN sikayetkonu ON sikayet.sikayetKonu = sikayetkonu.sikayetKonuId WHERE sikayetDurum = 1;
        ");
        $mesajlar->execute();
        $mesajlar = $mesajlar->fetchAll();
        foreach ($mesajlar as $key => $value) {
            if (isset($_POST["mesajArsiv"])) {
                echo $value["sikayetId"];
                $sql = "UPDATE `sikayet` SET
                `sikayetDurum` = '0'
                WHERE `sikayet`.`sikayetId` = '$value[sikayetId]'";
                $conn->exec($sql);
                header("refresh: 0");
            }
            ?>
            <tr>
                <td><?= $value["sikayetAdSoyad"]; ?></td>
                <td><a href="tel:0<?= $value["sikayetTelefon"]; ?>"><?= $value["sikayetTelefon"]; ?></a></td>
                <td><a href="mailto:<?= $value["sikayetEmail"]; ?>"><?= $value["sikayetEmail"]; ?></a></td>
                <td><?= $value["sikayetBaslik"]; ?></td>
                <td><?= $value["sikayetMesaj"]; ?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Arşivle
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Arşivlemek istediğinize emin misiniz?</h5>
                                </div>
                                <div class="modal-body text-danger">
                                    Arşivlediğiniz mesajlar yalnızca yazılım firması tarafından en erken 14 iş günü geri alınabilir bunu onaylıyor musunuz?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                                    <form method="post">
                                        <button name="mesajArsiv" type="submit" class="btn btn-primary">Arşivle</button>
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