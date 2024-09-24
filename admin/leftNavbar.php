<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $site["siteLink"]; ?>admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $site["siteAdi"]; ?></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= $site["siteLink"]; ?>admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Anasayfa</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        MENÜ
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Site Yönetimi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-1 collapse-inner rounded">
                <a class="collapse-item" href="ayarlar">Genel Ayarlar</a>
                <a class="collapse-item" href="acilir-mesaj">Açılır Mesaj</a>
                <a class="collapse-item" href="iletisim-ayarlari">İletişim Ayarları</a>
                <a class="collapse-item" href="sosyal-medya-ayarlari">Sosyal Medya Ayarları</a>
                <a class="collapse-item" href="site-bakim-modu">Site Bakım Modu</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        İÇERİK YÖNETİMİ
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Ürün Yönetimi</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="urunlerimiz">Ürünlerimiz</a>
                <a class="collapse-item" href="urun-kategorileri">Ürün Kategorileri</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="kampanya">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kampanyayı Düzenle</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="haberler">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Haberler</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="mesajlar">
            <i class="fas fa-fw fa-inbox"></i>
            <span>Mesajlar</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="yoneticiler">
            <i class="fas fa-fw fa-users"></i>
            <span>Yöneticiler</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="qr-kod">
            <i class="fas fa-fw fa-qrcode"></i>
            <span>QR Kod Oluştur</span></a>
    </li>
    <li class="nav-item">
        <a target="_blank" class="nav-link" href="../">
            <i class="fas fa-fw fa-globe"></i>
            <span>Web Sayfası</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>