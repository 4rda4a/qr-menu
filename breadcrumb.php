<?php
function formatString($input)
{
    if ($input == "urunler") {
        $input = "Ürünler";
    }
    $input = str_replace('-', ' ', $input);
    $formatted = ucwords($input);
    return $formatted;
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= $site["siteLink"]; ?>">Anasayfa</a>
        </li>
        <?php
        if (isset($k[0])) {
            ?>
            <li class="breadcrumb-item">
                <a href="../<?= $k[0]; ?>"><?= formatString($k[0]); ?></a>
            </li>
            <?php
        }
        if (isset($k[1])) {
            ?>
            <li class="breadcrumb-item active" id="active" aria-current="page">
                <a href="../<?= $k[1]; ?>"><?= formatString($k[1]); ?></a>
            </li>
            <?php
        }
        ?>
    </ol>
</nav>