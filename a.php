<?php
if (isset($kadi)) {
    header("location: ./");
} else {
    $err = "";
    if (isset($_POST["giris"])) {
        $sifre = $_POST["password"];
        if ($sifre == "") {
            $err = "Entered wrong password!";
        } else {
            $sifre = md5($sifre);
            if ($sifre == $site["pass"]) {
                $cookie_time = time() + (60 * 60 * 24 * 7); # 1 hafta
                $cookie = setcookie("a", $sifre, $cookie_time, "/");
                header("location: ./");
            }
        }
    } ?>
    <style>
        #blok {
            position: absolute;
            height: 100%;
            bottom: 0px;
            top: 0px;
            left: 0;
            right: 0;
        }
    </style>
    <div class="card col-sm-8 m-auto col-12">
        <form class="card-body" method="post">
            <h2>Admin</h2>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" placeholder="Password" autofocus>
                <label for="Password">Password</label>
            </div>
            <label class="text-danger">
                <?php echo $err; ?>
            </label>
            <div class="text-center mt-3">
                <button name="giris" class="btn btn-primary col-6 col-sm-4">Giriş</button>
            </div>
        </form>
    </div>
<?php } ?>