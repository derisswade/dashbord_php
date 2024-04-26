<?php
require_once 'model/promo.model.php';

// Vérifier si l'ID de la promotion active est défini dans les paramètres GET
if (isset($_GET['idpromo'])) {
    // Charger les apprenants de la promotion active
    $idPromo = $_GET['idpromo'];
    $apprenants = chargerApprenantsFiltres('apprenants.csv', $idPromo);

    // Charger les référentiels spécifiques à la promotion active
    $referentiels_promo = chargerReferentielsFiltres('referentiels.csv', $idPromo);
} else {
    // Charger tous les apprenants si aucun ID de promotion n'est spécifié
    $referentiels_promo = chargerReferentielsFiltres('referentiels.csv', $idPromo);
}

// Filtrer les apprenants par référentiel si une valeur est sélectionnée
if (isset($_GET['reference'])) {
    if ($_GET['reference'] === "") {
        // Charger tous les apprenants de la promotion active
        $apprenants = chargerApprenantsFiltres('apprenants.csv', $_SESSION['idPromoActive']);
    } else {
        $referentiel_selectionne = $_GET['reference'];
        $apprenants = array_filter($apprenants, function ($apprenant) use ($referentiel_selectionne) {
            return strtolower($apprenant['Referentiel']) === strtolower($referentiel_selectionne);
        });
    }
}

if (isset($_GET['reference'])) {
    if ($_GET['reference'] === "") {
        $apprenants = chargerApprenantsFiltres('apprenants.csv', $_SESSION['idPromoActive']);
    } else {
        $referentiel_id = $_GET['reference'];
        // Filtrer les apprenants par référentiel
        $apprenants = array_filter($apprenants, function ($apprenant) use ($referentiel_id) {
            return strtolower($apprenant['Referentiel']) === strtolower($referentiel_id);
        });
    }
}

if (isset($_GET['id'])) {
    activerpromo($_GET['id']);
}

// Pagination
// Calculer le nombre total de pages
$nombre_total_pages = ceil(count($presences) / $elements_par_page);

// Pagination
$elements_par_page = $_GET['elementsParPage'] ?? 10;
$page_courante = $_GET['page'] ?? 1;
$model_url = '?page=%d&elementsParPage=%d';

// Obtenir les données paginées après avoir défini les variables nécessaires
//$apprenants = obtenir_donnees_paginees($nombre_total_pages, $presences, $elements_par_page, $page_courante);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        position: relative;
    }

    .content {
        display: flex;
        justify-content: center;
        height: 70vh;
        margin-top: 45px;
    }


    .conteneur {
        display: flex;
    }

    .contain1 {
        width: 50%;
        height: 100%;
    }

    span {
        font-size: 14px;
    }

    .contain2 {
        width: 50%;
        position: absolute;
        left: 90%;
        top: 5%;
    }

    .side {
        flex: 1;
        position: absolute;
        left: 1.2%;
        top: 16%;
        min-height: 250px;
        height: 60vh;
        /* Hauteur minimale pour la barre verticale */
    }

    .circle {
        width: 30px;
        height: 30px;
        background-color: #038d83;
        border: 1px solid #038d83;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }

    .p-main p {
        position: absolute;
        left: 3%;
        top: 17%;
        font-size: 14px;
    }

    .main {
        flex: 10;
        padding: 10px;
    }

    .btn-grp {
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .btns {
        display: flex;
        justify-content: flex-end;
        /* Boutons alignés à droite */
        align-items: center;
        margin-right: 9.5%;
    }

    .btn-grp button {
        padding: 5px 5px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-new {
        background-color: #038d83;
        color: #fff;
        margin-right: 5px;
        size: 100px;
    }

    .btn-mass {
        background-color: #fa8700;
        color: #fff;
        margin-right: 5px;
    }

    .btn-file {
        background-color: #0182ab;
        color: #fff;
        margin-right: 5px;
    }

    .btn-exclude {
        background-color: #063a92;
        color: #fff;
        margin-right: 5px;
    }

    .search {
        position: relative;
        margin-bottom: 5px;
    }

    .search input {
        padding: 5px 5px;
        width: 100%;
        /* Prend toute la largeur moins la largeur de l'icône */
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .search i {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10px;
        /* Ajoutez ici votre style pour l'icône de recherche */
    }

    .btns label {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    .container-table {
        height: 50vh;
        text-align: center;
        font-size: 14px;
        position: absolute;
    }

    .container-table table {
        width: 70%;
        border-collapse: collapse;
        text-align: center;
    }

    th {
        font-size: 18px;
        background-color: #eee;
        text-align: center;
    }


    .titre {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
    }

    .bloc {
        width: 66vw;
        height: 100%;
        font-size: 10px;
        margin-right: 10px;
        text-align: center;
    }

    .col-bas {
        width: 100%;
        height: 100%;
        font-size: 16px;
        text-align: center;

    }

    #reference {
        height: 1.5em;
        width: 150px;
        font-size: 13px;
        text-align: center;
        font-weight: bold;
        border: none;
        background: #eee;
    }

    .value {
        font-size: 13px;
        text-align: center;
        font-weight: bold;
        border: none;
        background: #eee;
    }
</style>

<body>
    <div class="title">
        <div class="left">Apprenants</div>
        <div class="right">Promos * Liste * Détails - Apprenants</div>
    </div>

    <!-- partie2 lister apprenants -->
    <div id="container">
        <div class="conteneur">
            <div class="contain1">
                <span>Promotion :</span>
                <span style="color: #018f88">promo(<?= $_SESSION['idPromoActive'] ?>)</span>
            </div>
            <div class="contain2">
                <form action="" method="GET">
                    <input type="hidden" name="idpromo" value="<?php echo $_SESSION['idPromoActive']; ?>">
                    <select name="reference" id="reference" onchange="this.form.submit()">
                        <option value="" class="value">Référentiel</option>
                        <?php foreach ($referentiels_promo as $referentiel) : ?>
                            <option value="<?php echo $referentiel['libelle']; ?>" <?php if (isset($_GET['reference'])) {
                                                                                        if ($_GET['reference'] ==  $referentiel['libelle']) echo 'selected';
                                                                                    } ?> class="value"><?php echo $referentiel['libelle']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="side">
                <div class="circle">1</div>
                <hr style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); height: calc(100% - 30px); border-left: 1px solid #ccc;"> <!-- Barre verticale -->
            </div>

            <div class="main">
                <div class="p-main">
                    <p>Apprenants</p>
                </div>
                <div class="btn-grp">
                    <div style="font-size: 16px;">
                        Liste des apprenants <span style="color: #018f88">(13)</span>
                    </div>

                    <div class="btns">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="page2" value="modal-step1">
                            <button type="submit" class="btn-new"><label for="createEtudiant">+nouveau</label></button>
                            <input type="hidden" name="page2" value="modal-add-file">
                            <button class="btn-mass" type="submit" name="btnMasse"><label for="filemodal">Insertion en masse</label></button>
                            <input type="file" name="csvFile" id="csvFileInput" style="display: none;">
                            <button class="btn-file"><label for="filemodal">Fichier modèle</label></button>
                            <button class="btn-exclude"><label for="">Liste des exclus</label></button>
                        </form>
                    </div>

                </div>
                <div class="search">
                    <input type="text" placeholder="     Filtrer" style="padding-right: 50px; font-size : 10px;">
                    <i class="fas fa-search" aria-hidden="true" style="margin-left: 10px;"></i>
                </div>
                <div class="flex-col-left">
                </div>
                <div class="flex-col-right">
                    <div class="line4"><img src="../assets/images/Capture_d_écran_du_2024-04-11_21-13-08-removebg-preview.png" style="width: 30px; height: 30x;"></div>
                    <div class="container-table">
                        <table class="line5">
                            <thead>
                                <tr>
                                    <th class="titre" data-label="Image">Image</th>
                                    <th class="titre" data-label="Nom">Nom</th>
                                    <th class="titre prenom" data-label="Prenom">Prenom</th>
                                    <th class="titre prenom" data-label="Referentiel">Referentiel</th>
                                    <th class="titre email1" data-label="Email">Email</th>
                                    <th class="titre" data-label="Genre">Genre</th>
                                    <th class="titre" data-label="Telephones">Telephones</th>
                                    <th class="titre" data-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($apprenants as $apprenant) : ?>
                                    <tr class="line">
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas"><img src="../assets/images/images.jpg" style="border-radius: 100%;" width="30px"></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $apprenant['Nom'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $apprenant['Prenom'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $apprenant['Referentiel'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas email"><?= $apprenant['Email'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas"><?= $apprenant['Genre'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <div class="col-bas"><?= $apprenant['Telephone'] ?></div>
                                        </td>
                                        <td class="bloc">
                                            <div class="col-haut"></div>
                                            <input type="checkbox" id="my-checkbox-0">
                                            <label for="my-checkbox-0"></label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <!-- Ajoutez d'autres lignes ici si nécessaire -->

                            </tbody>
                        </table>
                        <!--    <?= afficher_pagination($nombre_total_pages, $page_courante, $model_url, $elements_par_page) ?> -->
                    </div>
                </div>
            </div>
        </div>
        </section>

</body>

</html>