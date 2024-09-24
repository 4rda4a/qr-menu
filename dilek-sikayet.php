<hr>
<div class="alert alert-light text-center" role="alert">
    <p>İşletmemizle ilgili görüşleriniz bizim için çok önemli...</p>
    <button id="sikayet-btn" type="button" class="btn btn-success col-12" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Dilek, Öneri yada Şikayet Yaz
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-start">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">İletişim Formu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body">
                    <div class="mb-3">
                        <input placeholder="Ad Soyad" class="form-control" id="ad-soyad-iletisim">
                    </div>
                    <div class="mb-3">
                        <input placeholder="Telefon" class="form-control" id="telefon-iletisim">
                    </div>
                    <div class="mb-3">
                        <input placeholder="E-Mail" class="form-control" id="email-iletisim">
                    </div>
                    <div class="mb-3">
                        <select class="form-control" id="konu-iletisim">
                            <option value="0">Konu</option>
                            <option value="1">Şikayet</option>
                            <option value="2">Dilek & Öneri</option>
                            <option value="3">İletişim</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="5"
                            placeholder="Bu alana dilek, şikayet veya öneri talebinizi yazabilirsiniz."
                            id="hata-iletisim"></textarea>
                    </div>
                    <p class="text-danger fw-bold m-0" id="text-iletisim">
                    </p>
                    <p class="text-success fw-bold m-0" id="text-iletisim2">
                    </p>
                </form>
                <form class="modal-footer">
                    <button type="button" class="btn btn-secondary col-sm-3 col-4"
                        data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary col-sm-3 col-4" id="sikayetGonder">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>