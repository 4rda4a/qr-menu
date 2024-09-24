webHref = window.location.href;
webHrefArray = webHref.split("/");
function deger(degerId) {
    snc = document.getElementById(degerId).value;
    return snc;
}
function acilirMesajKapat() {
    $.ajax({
        url: "./assets/ajax.php",
        type: "POST",
        data: "acilirMesajKapat=" + 1,
        success: function (data) {
            if (data == true) {
                acilirMesajBg.remove();
                acilirMesajModal.remove();
            } else {
                alertDiv(data, "danger");
            }
        }
    });
}
function alertDiv(text, durum) {
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + durum + ' col-sm-6 col-8 m-auto text-center';
    alertDiv.setAttribute('role', 'alert');
    alertDiv.id = "AlertDivCreate";
    alertDiv.style.position = "fixed";
    alertDiv.style.top = "2%";
    alertDiv.style.left = "0";
    alertDiv.style.right = "0";
    alertDiv.style.zIndex = "1";
    alertDiv.innerHTML = text;
    document.body.appendChild(alertDiv);
    timeout = setTimeout(function () {
        document.getElementById("AlertDivCreate").remove();
    }, 4000);
}
if (webHrefArray[4] == "yonet") {
    document.getElementById("giris-yap-yonet").onclick = function () {
        giris();
    };
    function giris() {
        kullaniciAdi = deger("kullaniciAdi");
        sifre = deger("sifre");
        $.ajax({
            url: "./assets/ajax.php",
            type: "POST",
            data: "kullaniciAdi=" + kullaniciAdi + "&sifre=" + sifre,
            success: function (data) {
                if (data == true) {
                    location.href = "./admin";
                } else {
                    alertDiv(data, "danger");
                }
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function () {
        var loginCard = document.querySelector('.login-card');

        loginCard.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && document.getElementById("sifre").value != "") {
                event.preventDefault();
                document.getElementById('giris-yap-yonet').click();
            }
        });
    });
}
if (webHrefArray[4] == "") {
    document.getElementById("sikayetGonder").onclick = function () {
        adSoyadDOM = document.getElementById("ad-soyad-iletisim");
        adSoyad = adSoyadDOM.value;
        telefonDOM = document.getElementById("telefon-iletisim");
        telefon = telefonDOM.value;
        emailDOM = document.getElementById("email-iletisim");
        email = emailDOM.value;
        konuDOM = document.getElementById("konu-iletisim");
        konu = konuDOM.value;
        hataDOM = document.getElementById("hata-iletisim");
        hata = hataDOM.value;
        textIletisim = document.getElementById("text-iletisim");
        textIletisim2 = document.getElementById("text-iletisim2");
        if (adSoyad != "" && telefon != "" && email != "" && konu != 0 && hata != "") {
            $.ajax({
                url: "./assets/ajax.php",
                type: "POST",
                data: "adSoyad=" + adSoyad +
                    "&telefon=" + telefon +
                    "&email=" + email +
                    "&konu=" + konu +
                    "&hata=" + hata,
                success: function (data) {
                    if (data == true) {
                        adSoyadDOM.value = "";
                        telefonDOM.value = "";
                        emailDOM.value = "";
                        konuDOM.value = 0;
                        hataDOM.value = "";
                        textIletisim.innerHTML = "";
                        textIletisim2.innerHTML = "✅ Mesajınız başarılı bir şekilde gönderildi. Geri bildiriminiz için teşekkür ederiz.";
                    } else {
                        textIletisim2.innerHTML = "";
                        textIletisim.innerHTML = "❌ Sorun oluştu!";
                    }
                }
            });
        } else {
            textIletisim.innerHTML = "❌ Lütfen boş alan bırakmayınız!";
        }
    };
}
if (webHrefArray[5] == "profil") {
    document.getElementById("profilKaydetBtn").onclick = function () {
        isim = deger("profilIsim");
        email = deger("profilEmail");
        sifre = deger("profilSifre");
        if (sifre == "") {
            sifre_bildir = "Şifreniz değiştirilmemiştir.";
        } else {
            sifre_bildir = "";
        }
        $.ajax({
            url: "../assets/ajax.php",
            type: "POST",
            data: "profilIsim=" + isim +
                "&email=" + email +
                "&profilSifre=" + sifre,
            success: function (data) {
                if (data == true) {
                    alertDiv("Profil bilgileriniz güncellendi! <br>" + sifre_bildir, "success");
                    topNavbarKullaniciAdi.innerHTML = isim;
                    profilKullaniciAdi.innerHTML = isim;
                    profilSifre.value = "";
                } else {
                    alert(data);
                }
            }
        });
    }
}
if (webHrefArray[5] == "sosyal-medya-ayarlari") {
    sosyalMedyaGuncelleBtn.onclick = function () {
        instagram = deger("instagramInput");
        x = deger("xInput");
        facebook = deger("facebookInput");
        $.ajax({
            url: "../assets/ajax.php",
            type: "POST",
            data: "instagram=" + instagram +
                "&x=" + x +
                "&facebook=" + facebook,
            success: function (data) {
                if (data == true) {
                    alertDiv("Güncelleme işlemi başarılı!", "success");
                } else {
                    alert(data);
                }
            }
        });
    }
}
if (webHrefArray[5] == "iletisim-ayarlari") {
    iletisimGuncelleBtn.onclick = function () {
        firmaUnvani = deger("firmaUnvani");
        firmaTelefon = deger("firmaTelefon");
        firmaSaat = deger("firmaCalismaSaatleri");
        firmaEmail = deger("firmaEmail");
        firmaAdres = deger("firmaAdres");
        $.ajax({
            url: "../assets/ajax.php",
            type: "POST",
            data: "firmaUnvani=" + firmaUnvani +
                "&firmaTelefon=" + firmaTelefon +
                "&firmaEmail=" + firmaEmail +
                "&firmaAdres=" + firmaAdres +
                "&firmaSaat=" + firmaSaat,
            success: function (data) {
                if (data == true) {
                    alertDiv("Güncelleme işlemi başarılı!", "success");
                } else {
                    alert(data);
                }
            }
        });
    }
}
function urunLike(UrunDurum) {
    urunId = deger("urunId");
    $.ajax({
        url: "../assets/ajax.php",
        type: "POST",
        data: "urunId=" + urunId +
            "&UrunDurum=" + UrunDurum,
        success: function (data) {
            if (data == true) {
                document.getElementById("urunLikeOrDislike").innerHTML = "Değerlendirmeniz kaydedilmiştir!";
            } else {
                alert(data);
            }
        }
    });
}
function urunDurumGuncelle(urunId) {
    UrunDurumGuncel = deger("durumUrun_" + urunId);
    $.ajax({
        url: "../assets/ajax.php",
        type: "POST",
        data: "urunId=" + urunId +
            "&UrunDurumGuncel=" + UrunDurumGuncel,
        success: function (data) {
            document.getElementById("urunDurumText_" + urunId).innerHTML = data;
        }
    });
}
function anaUrunDurumGuncelle(urunId) {
    UrunDurumGuncel = deger("durumUrun_" + urunId);
    $.ajax({
        url: "../assets/ajax.php",
        type: "POST",
        data: "urunId=" + urunId +
            "&AnaUrunDurumGuncel=" + UrunDurumGuncel,
        success: function (data) {
            document.getElementById("urunDurumText_" + urunId).innerHTML = data;
        }
    });
}
function haberDurumGuncelle(urunId) {
    UrunDurumGuncel = deger("durumUrun_" + urunId);
    $.ajax({
        url: "../assets/ajax.php",
        type: "POST",
        data: "urunId=" + urunId +
            "&haberUrunDurumGuncel=" + UrunDurumGuncel,
        success: function (data) {
            document.getElementById("urunDurumText_" + urunId).innerHTML = data;
        }
    });
}