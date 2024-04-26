<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
require_once 'config/helpers.php';
require_once "model/apprenant.model.php";
require_once "model/presence.model.php";
require_once "model/promo.model.php";
require_once "config/bootstrap.php";
require_once "model/referentiel.model.php";
require_once "model/presence.model.php";

$presences = listePresence(); 
genererCSV4($presences);
genererCSV();
$referentiels = listeReferentiel();
genererCSV3($referentiels);
//Chargement de donnees
$apprenants = chargerCSV('apprenants.csv');
$promos = chargerCSV2('promos.csv');
$referentiels = chargerCSV3('referentiels.csv');
$presences = chargerCSV4('presences.csv');

// Pagination
$elements_par_page = $_GET['elementsParPage'] ?? 10;
$page_courante = $_GET['page'] ?? 1;
$model_url = '?page=%d&elementsParPage=%d';
$nombre_total_pages = ceil(count($presences) / $elements_par_page);
$donnees_paginees = obtenir_donnees_paginees($nombre_total_pages, $presences, $elements_par_page, $page_courante);

$route = [
    '/' => 'login',
    '/apprenant' => 'apprenant',
    '/presence' => 'presence',
    '/promo'    => 'promo',
    '/referentiel'  => 'referentiel'
];

if (array_key_exists($uri, $route)) {
    if ($route[$uri] != 'login') {
        require_once "templates/partials/header.html.php";
        require_once "templates/$uri.html.php";
        require_once "templates/partials/footer.html.php";
    } else {
        require_once "templates/$route[$uri].html.php";
    }
} else {
    require_once "templates/error.html";
}
?>
