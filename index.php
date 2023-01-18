<?php
spl_autoload_register(function ($class) {
	include 'classes/' . $class . '.php';
});



$PDO = PdoConnect::getInstance();

$result = $PDO->PDO->query("
	SELECT * FROM `goods`");

$resultSearch = $PDO->PDO->query("
	SELECT * FROM `goods` WHERE `name` LIKE '%Курут%'");

$products = array();

$productsSearch = array();


while ($productInfo = $result->fetch()) {
	$products[] = $productInfo;
}

while ($productInfo = $result->fetch()) {
	$productsSearch[] = $productInfo;
}

include 'online_store.php';


