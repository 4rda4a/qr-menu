<?php
$kampanyaSql = $conn->prepare("SELECT * FROM kampanya");
$kampanyaSql->execute();
$kampanyaSql = $kampanyaSql->fetch();
if ($kampanyaSql["kampanyaState"] == true) {
?>
    <hr>
    <h5>Kampanyayı Kaçırma!</h5>
    <div class="alert alert-light text-center" role="alert">
        <?php
        if ($kampanyaSql["kampanyaImg"]) { ?>
            <img src="img/<?= $kampanyaSql["kampanyaImg"]; ?>" class="kampanya-img">
        <?php }
        if ($kampanyaSql["kampanyaText"]) { ?>
            <p class="m-0 mt-3 fw-bold">
                <?= $kampanyaSql["kampanyaText"]; ?>
            </p>
        <?php }
        ?>
    </div>
<?php } ?>