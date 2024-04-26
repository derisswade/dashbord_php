<?php

function obtenir_donnees_paginees($nombre_total_pages,$donnees, $elements_par_page, $page_courante) {
    if ($page_courante > $nombre_total_pages) {
        $page_courante = $nombre_total_pages;
    }
    $offset = ($page_courante - 1) * $elements_par_page;
    return array_slice($donnees, $offset, $elements_par_page);
}


function afficher_pagination($nombre_total_pages, $page_courante, $model_url, $elements_par_page) {
    echo '<div class="footer-table">';
    echo '<div class="items-per-page">';
    echo '<label>Éléments par page : </label>';

    $url_10 = sprintf($model_url, $page_courante, 10);
    echo "<a href='$url_10'";
    if ($elements_par_page == 10) {
        echo ' class="active"';
    }
    echo '>10</a>';

    $url_20 = sprintf($model_url, $page_courante, 20);
    echo "<a href='$url_20'";
    if ($elements_par_page == 20) {
        echo ' class="active"';
    }
    echo '>20</a>';

    $url_30 = sprintf($model_url, $page_courante, 30);
    echo "<a href='$url_30'";
    if ($elements_par_page == 30) {
        echo ' class="active"';
    }
    echo '>30</a>';

    echo '</div>';
    echo '<div class="pagination">';

    if ($page_courante > 1) {
        $page_precedent = $page_courante - 1;
        $url_precedente = sprintf($model_url, $page_precedent, $elements_par_page);
        echo "<a href='$url_precedente' class='page-link prev'><i class='fas fa-angle-left'></i></a>";
    } else {
        echo "<span class='page-link prev disabled'><i class='fas fa-angle-left'></i></span>";
    }

    for ($i = 1; $i <= $nombre_total_pages; $i++) {
        if ($i == $page_courante) {
            echo "<span class='page-link activem'>$i</span>";
        } else {
            $url_page = sprintf($model_url, $i, $elements_par_page);
            echo "<a href='$url_page 'class='page-link'>$i</a>";
        }
    }

    if ($page_courante < $nombre_total_pages) {
        $page_suivante = $page_courante + 1;
        $url_suivante = sprintf($model_url, $page_suivante, $elements_par_page);
        echo "<a href='$url_suivante' class='page_link next'><i class='fas fa-angle-right'></i></a>";
    } else {
        echo "<span class='page-link next disabled'><i class='fas fa-angle-right'></i></span>";
    }

    echo '</div>';
    echo '</div>';
}


function lireCSV($csv_file) {
    $csv_data = array();

    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        // Ignorer la première ligne (en-tête)
        fgetcsv($handle, 1000, ",");

        // Parcourir le reste du fichier CSV ligne par ligne
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Ajouter les données de chaque ligne au tableau
            $csv_data[] = $data;
        }
        fclose($handle);
    }

    return $csv_data;
}

