<?php

require_once '../partials/_header.php';
require_once('../controller/IndexController.php');
require_once ('../controller/ErrorController.php');

// Routeur qui redirige vers les pages demandées sans écrire trop d'info dans l'url

$requestUri = $_SERVER['REQUEST_URI'];

$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace ('ecommerce/public/', '', $uri);
$endUri = ltrim($endUri, '/');

if ($endUri === '') {
    $IndexController = new IndexController();
    $IndexController -> index();

} else {
    $ErrorController = new ErrorController();
    $ErrorController ->notFound();

}

 require_once '../partials/_footer.php';
