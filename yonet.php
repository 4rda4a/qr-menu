<?php
if (isset($login)) {
    header("location: ./admin");
} else { ?>
    <div class="card col-sm-4 m-auto login-card col-11">
        <div class="card-header fs-5 fw-bold">Giriş Yap</div>
        <div class="card-body">
            <div class="mb-3">
                <label>Kullanıcı Adı:</label>
                <input class="form-control" placeholder="Kullanıcı Adı" autofocus id="kullaniciAdi" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Şifre:</label>
                <input class="form-control" type="password" placeholder="Şifre" id="sifre">
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-success col-12" id="giris-yap-yonet">Giriş Yap</button>
        </div>
    </div>
<?php }
?>