<?php

require_once '../partials/_header.php';
require_once('../controller/OrderController.php');
require_once ('../controller/ErrorController.php');

// Routeur qui redirige vers les pages demandées sans écrire trop d'info dans l'url

// récupère l'url actuelle
$requestUri = $_SERVER['REQUEST_URI'];


$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace ('ecommerce/public/', '', $uri);
$endUri = ltrim($endUri, '/');

$OrderController = new OrderController();

//pour chaque partie (if, else if, else), en fonction de la valeur de $endUri, on charge le bon controleur
//cela permet d'appeler dans mon url le nom associé
if ($endUri === '') {
    $OrderController->createOrder();

} else if ($endUri === 'add-product') {
    $OrderController->addProduct();

} else if ($endUri === 'remove-product') {
    $OrderController->removeProduct();

} else if ($endUri === 'shipping-address') {
    $OrderController->setShippingAddress();

} else {
    $ErrorController = new ErrorController();
    $ErrorController ->notFound();

}

 require_once '../partials/_footer.php';
