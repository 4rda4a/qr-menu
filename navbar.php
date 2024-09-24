<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand text-logo-color1 fs-2" href="<?= $site["siteLink"]; ?>"
            style="text-shadow: 0px 0px 3px #000;">
            <img src="<?= $site["siteLink"] . "/img/" . $site["siteLogo"]; ?>" id="cafe-logo" class="rounded">
            <?= $site["siteAdi"]; ?>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <i class="fi fi-rr-circle-ellipsis fs-2 text-logo-color1"></i>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-logo-color1" id="offcanvasNavbarLabel">
                    <img src="<?= $site["siteLink"] . "/img/" . $site["siteLogo"]; ?>" class="col-3 rounded">
                    <?= $site["siteAdi"]; ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                    <?php if ($site["siteKonum"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link active">
                                <i class="fi fi-sr-home"></i><?= $site["siteKonum"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteSaat"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link">
                                <i class="fi fi-sr-clock"></i><?= $site["siteSaat"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteMail"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="mailto:<?= $site["siteMail"]; ?>">
                                <i class="fi fi-sr-at"></i> <?= $site["siteMail"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteTelefon"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="tel:<?= $site["siteTelefon"]; ?>">
                                <i class="fi fi-sr-phone-flip"></i> <?= $site["siteTelefon"]; ?>
                            </a>
                        </li>
                    <?php }
                    $anaUrunler = $conn->prepare("SELECT * FROM anaUrunler WHERE anaUrunState = 0");
                    $anaUrunler->execute();
                    $anaUrunler = $anaUrunler->fetchAll();
                    foreach ($anaUrunler as $key => $value) { ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="urunler/<?= $value["anaUrunLink"]; ?>">
                                <img class=" col-sm-1 col-2 me-2"
                                    src="<?= $site["siteLink"] . "img/" . $value["anaUrunImg"]; ?>"><?= $value["anaUrunIsim"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteInstagram"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="https://instagram.com/<?= $site["siteInstagram"]; ?>" target="_blank">
                                <i class="fi fi-brands-instagram"></i> <?= $site["siteInstagram"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteX"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="https://x.com/<?= $site["siteX"]; ?>" target="_blank">
                                <i class="fi fi-brands-twitter"></i> <?= $site["siteX"]; ?>
                            </a>
                        </li>
                    <?php }
                    if ($site["siteFacebook"]) {
                    ?>
                        <li class="nav-item border-bottom">
                            <a class="nav-link" href="https://facebook.com/<?= $site["siteFacebook"]; ?>" target="_blank">
                                <i class="fi fi-brands-facebook"></i> <?= $site["siteFacebook"]; ?>
                            </a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>