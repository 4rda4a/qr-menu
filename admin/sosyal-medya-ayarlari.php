<div class="card col-sm-8 m-auto">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Sosyal Medya Ayarları</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <label class="m-0">Instagram</label>
                    <input class="form-control" id="instagramInput" value="<?= $site["siteInstagram"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">X (Twitter)</label>
                    <input class="form-control" id="xInput" value="<?= $site["siteX"] ?>">
                </div>
                <div class="mb-2">
                    <label class="m-0">Facebook</label>
                    <input class="form-control" id="facebookInput" value="<?= $site["siteFacebook"] ?>">
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary col-sm-3" id="sosyalMedyaGuncelleBtn">
                        Güncelle
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>