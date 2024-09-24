<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

@ob_start();
date_default_timezone_set('Europe/Istanbul');

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
	exit(' Erişim Engellendi.');
};
$db_user = "root";
$db_pass = "";
$db_name = "qr_menu";
$host_name = "localhost";

try {
	$conn = new PDO("mysql:host=$host_name;dbname=$db_name", $db_user, $db_pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
session_start();
$conn->query("SET NAMES utf8");
$conn->query("SET CHARACTER SET utf8");
$conn->query("SET COLLATION_CONNECTION = 'utf8mb4_general_ci'");
function clean($x)
{
	$x = htmlspecialchars($x);
	$x = str_replace("'", "''", $x);
	return $x;
}
function SEOLink($seo_link)
{
	$metin_aranan = array("ş", "Ş", "ı", "ü", "Ü", "ö", "Ö", "ç", "Ç", "ğ", "Ğ", "İ");
	$metin_yerine_gelecek = array("s", "S", "i", "u", "U", "o", "O", "c", "C", "g", "G", "I");
	$seo_link = str_replace($metin_aranan, $metin_yerine_gelecek, $seo_link);
	$seo_link = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i", "-", $seo_link);
	$seo_link = strtolower($seo_link);
	$seo_link = preg_replace('/&.+?;/', '', $seo_link);
	$seo_link = preg_replace('|-+|', '-', $seo_link);
	$seo_link = preg_replace('/#/', '', $seo_link);
	$seo_link = str_replace('.', '', $seo_link);
	$seo_link = trim($seo_link, '-');
	return $seo_link;
}
