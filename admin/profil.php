<div class="card col-sm-8 m-auto">
    <div class="card-body">
        <h5>Profil - <span id="profilKullaniciAdi"><?= $user["userAdi"]; ?></span></h5>
        <div class="text-center">
            <img class="rounded-circle col-sm-2" src="img/<?php if ($user["userPhoto"]) {
                echo $user["userPhoto"];
            } else {
                echo "undraw_profile.svg";
            } ?>">
        </div>
        <div class="mb-2">
            <label class="m-0">İsim:</label>
            <input class="form-control" value="<?= $user["userAdi"]; ?>" id="profilIsim">
        </div>
        <div class="mb-2">
            <label class="m-0">E-Mail:</label>
            <input class="form-control" value="<?= $user["userEmail"]; ?>" id="profilEmail">
        </div>
        <div class="mb-2">
            <label class="m-0">Şifre Değiştir:</label>
            <input class="form-control" id="profilSifre">
        </div>
        <div class="text-center">
            <button class="btn btn-primary col-sm-3" id="profilKaydetBtn">Kaydet</button>
        </div>
    </div>
</div>