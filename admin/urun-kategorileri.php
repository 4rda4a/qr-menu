<a href="kategori-ekle" class="btn btn-primary">Ürün Kategorisi Ekle</a>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Başlık</th>
            <th>Durum (Aktif)</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $anaUrunler = $conn->prepare("SELECT *
        FROM anaurunler
        ");
        $anaUrunler->execute();
        $anaUrunler = $anaUrunler->fetchAll();
        foreach ($anaUrunler as $key => $value) { ?>
            <tr>
                <td><?= $value["anaUrunIsim"]; ?></td>
                <td>
                    <div class="form-check form-switch">
                        <input onclick="anaUrunDurumGuncelle(<?= $value['anaUrunId']; ?>)"
                            style="width: 20px; height: 20px;vertical-align: middle;" class="form-check-input"
                            type="checkbox" role="switch" id="durumUrun_<?= $value["anaUrunId"]; ?>"
                            <?php
                            if ($value["anaUrunState"] == true) {
                                echo "checked";
                            }
                            ?>>
                        <label for="durumUrun_<?= $value["anaUrunId"]; ?>">
                            (<span id="urunDurumText_<?= $value["anaUrunId"]; ?>">
                                <?php
                                if ($value["anaUrunState"] == true) {
                                    echo "Aktif";
                                } else {
                                    echo "Pasif";
                                }
                                ?>
                            </span>)
                        </label>
                    </div>
                </td>
                <td>
                    <a href="kategori-duzenle?uid=<?= $value["anaUrunId"]; ?>" class="border border-5 border-secondary rounded-pill p-2 text-secondary">
                        <i class="align-middle fi fi-rr-edit h5"></i>
                    </a>
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