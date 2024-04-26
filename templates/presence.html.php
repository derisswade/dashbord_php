<?php
require_once 'model/promo.model.php';
require_once 'model/presence.model.php';

//dd($_GET);die();
// Charger tous les référentiels
$referentiels_promo = listeReferentiel();

// Vérifier si l'ID de la promotion est défini dans l'URL
if (isset($_GET['idpromo'])) {
    // Utiliser la valeur de 'idpromo' depuis l'URL
    $idpromo = $_GET['idpromo'];

    // Activer la promotion correspondante
    activerpromo($idpromo);
    $_SESSION['idPromoActive'] = $idpromo;
    // Charger les référentiels de la promotion active
    $referentiels_promo = chargerReferentielsFiltres('referentiels.csv', $idpromo);
}

// Vérifier si 'idpromo', 'etat' et 'date' sont définis dans l'URL
if (isset($_GET['idpromo'], $_GET['etat'], $_GET['date'], $_GET['referentiel'])) {
    // Utiliser les valeurs de 'idpromo', 'etat' et 'date' depuis l'URL
    $idpromo = $_GET['idpromo'];
    $etat = $_GET['etat'];
    // Formater la date pour correspondre au format "jour-mois-année"
    $date = date('d-m-Y', strtotime($_GET['date']));
    $referentiel = $_GET['referentiel'];

    // Charger les présences filtrées pour cette promotion, cet état et cette date
    $presences_promo = chargerPresenceFiltres('presences.csv', $idpromo, $etat, $date, $referentiel);

    // Vérifier si des présences ont été trouvées
    if (empty($presences_promo) || empty($referentiels_promo)) {
        // Afficher un message si aucune présence n'a été trouvée
        echo "<span style='color: red;'>Aucune presence trouvée pour cette promotion.</span>";
    } else {
        // Filtrer les présences par statut, date et référentiel
        $presences = array_filter($presences_promo, function ($presence) use ($etat, $date, $referentiel) {
            $status_match = strtolower($presence['status']) === strtolower($etat);
            $date_match = strtolower($presence['Date']) === strtolower($date);
            $referentiel_match = strtolower($presence['Referentiel']) === strtolower($referentiel);
            return $status_match && $date_match && $referentiel_match;
        });

        // Pagination
        // Calculer le nombre total de pages
        $nombre_total_pages = ceil(count($presences) / $elements_par_page);

        // Pagination
        $elements_par_page = $_GET['elementsParPage'] ?? 10;
        $page_courante = $_GET['page'] ?? 1;
        $model_url = '?page=%d&elementsParPage=%d';

        // Obtenir les données paginées après avoir défini les variables nécessaires
        $donnees_paginees = obtenir_donnees_paginees($nombre_total_pages, $presences, $elements_par_page, $page_courante);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .content {
        display: flex;
        justify-content: center;
        height: 70vh;
    }

    .titre {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        padding: 5px;
    }

    .bloc {
        width: 70vw;
        height: 100%;
        font-size: 10px;
        text-align: center;
    }

    .col-bas {
        width: 100%;
        height: 100%;
        font-size: 16px;
        padding-bottom: 10px;

    }

    thead {
        background-color: #eee;
    }

    .promotions {

        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-right: 1em;

    }

    .recherhe {
        margin: 0 0 1% 1%;
        display: flex;
        justify-content: flex-start;
        gap: 2em;
        padding-top: 1em;
        font-weight: bold;
    }

    #etat {
        height: 2em;
        width: 200px;
        border: 0.1em solid #EEEDF0;
        border-radius: 0.5em;
        background-color: #F6F7FB;
        font-size: 16px;
        text-align: center;
        font-weight: bold;
    }

    #reference {
        height: 2em;
        width: 200px;
        border: 0.1em solid #EEEDF0;
        border-radius: 0.5em;
        background-color: #F6F7FB;
        font-size: 16px;
        text-align: center;
        font-weight: bold;
    }

    #date {
        width: 200px;
        border: 0.1em solid #EEEDF0;
        border-radius: 0.5em;
        background-color: #F6F7FB;
        font-size: 16px;
        text-align: center;
        font-weight: bold;
    }

    .value {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .container-table {
        width: 70%;
    }
</style>

<body>
    <div class="title">
        <div class="left">Apprenants</div>
        <div class="right">Promos * Liste * Détails - Apprenants</div>
    </div>

    <div class="content">

        <!-- partie2 lister apprenants -->

        <div id="container-presence">
            <div class="presence">
                <div class="recherhe">
                    <form action="" method="get">
                        <input type="hidden" name="idpromo" value="<?php echo $_SESSION['idPromoActive']; ?>">
                        <select name="etat" id="etat">
                            <option value="statut" class="value">Statut</option>
                            <option value="present" class="value" <?php echo ($_GET['etat'] ?? '') == 'present' ? ' selected' : ''; ?>>Présent</option>
                            <option value="absent" class="value" <?php echo ($_GET['etat'] ?? '') == 'absent' ? ' selected' : ''; ?>>Absent</option>
                        </select>

                        <select name="referentiel" id="reference">
                            <option value="" class="value">Référentiel</option>
                            <?php foreach ($referentiels_promo as $referentiel) : ?>
                                <option value="<?php echo $referentiel['libelle']; ?>" class="value"><?php echo $referentiel['libelle']; ?></option>
                            <?php endforeach; ?>
                        </select>


                        </select>
                        <input type="date" name="date" id="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                        <button type="submit" style="height: 2em; width:150px;border:0.1em solid #EEEDF0;border-radius: 0.5em; background-color: #008F89;font-size:16px;color:#fff;font-weight:bold;cursor:pointer;font-weight:bold;">Rafraichir</button>
                    </form>
                </div>
            </div>
            <div class="line3">

            </div>
            <div class="container-table">
                <table class="line5">
                    <thead>
                        <tr>
                            <th class="titre" data-label="Image">Matricule</th>
                            <th class="titre" data-label="Nom">Nom</th>
                            <th class="titre prenom" data-label="Prenom">Prenom</th>
                            <th class="titre" data-label="Telephones">Telephone</th>
                            <th class="titre" data-label="Telephones">Référenciel</th>
                            <th class="titre" data-label="Telephones">Date</th>
                            <th class="titre" data-label="Telephones">Heure d'arrivée</th>
                            <th class="titre" data-label="Telephones">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donnees_paginees as $presence) : ?>
                            <?php if ($presence['idPromo'] == $_SESSION['idPromoActive']) : ?>
                                <tr class="line">
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas"><?= $presence['Matricule'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $presence['Nom'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $presence['Prenom'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas email"><?= $presence['Telephone'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas"><?= $presence['Referentiel'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas"><?= $presence['Date'] ?></div>
                                    </td>
                                    <td class="bloc">
                                        <div class="col-haut"></div>
                                        <div class="col-bas"><?= $presence['Heure'] ?></div>
                                    </td>
                                    <td class="bloc status">
                                        <div class="col-haut"></div>
                                        <div class="col-bas"><?= $presence['status'] ?></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <!-- Pagination -->
                <?= afficher_pagination($nombre_total_pages, $page_courante, $model_url, $elements_par_page) ?>

            </div>
        </div>
    </div>
    </div>
    </section>




</body>

</html>