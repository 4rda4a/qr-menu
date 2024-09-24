<table class="table table-bordered text-center">
    <thead>
        <tr rowspan="4">SON 50 GİRİŞ LOGU</tr>
        <tr>
            <th class="col-sm-3">Tarih</th>
            <th class="col-sm-3">IP Adresi</th>
            <th class="col-sm-3">Cihaz</th>
            <th class="col-sm-3">Cihaz Kullanıcı Adı</th>
            <th class="col-sm-3">Yönetici Adı</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $log = $conn->prepare("SELECT * FROM girislog INNER JOIN user ON girislog.girisLogUsername = user.userId ORDER BY girisLogId DESC LIMIT 50");
        $log->execute();
        $log = $log->fetchAll();
        foreach ($log as $key => $value) { ?>
            <tr>
                <td><?= $value["girisLogTarih"]; ?></td>
                <td><?= $value["girisLogIp"]; ?></td>
                <td><?= $value["girisLogCihaz"]; ?></td>
                <td><?= $value["girisLogKullaniciAdi"]; ?></td>
                <td><?= $value["userAdi"]; ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>