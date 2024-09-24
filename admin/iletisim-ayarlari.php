<div class="card col-sm-8 m-auto">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">İletişim Ayarları</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <label class="m-0">Firma Ünvanı</label>
                    <input class="form-control" id="firmaUnvani" value="<?= $site["siteAdi"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Firma Telefon</label>
                    <input class="form-control" id="firmaTelefon" value="<?= $site["siteTelefon"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Firma Çalışma Saatleri</label>
                    <input class="form-control" id="firmaCalismaSaatleri" value="<?= $site["siteSaat"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Firma E-Mail</label>
                    <input class="form-control" id="firmaEmail" value="<?= $site["siteMail"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Firma Adres</label>
                    <input class="form-control" id="firmaAdres" value="<?= $site["siteKonum"] ?>">
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary col-sm-3" id="iletisimGuncelleBtn">
                        Güncelle
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>