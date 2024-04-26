<?php

function genererCSV2($promos)
{
    // Récupérer les données des apprenants
    // $promos = listePromo();

    // Ouvrir un fichier CSV en écriture
    $file = fopen('promos.csv', 'w');
    // Ajouter les données des apprenants dans le fichier CSV
    foreach ($promos as $promo) {
        fputcsv($file, $promo);
    }

    // Fermer le fichier
    fclose($file);

    return 'Fichier CSV généré avec succès.';
}

//Fonction pour charger les données des apprenants à partir d'un fichier CSV
function chargerCSV2($file_path)
{
    // Vérifier si le fichier existe
    if (file_exists($file_path)) {
        // Ouvrir le fichier CSV en lecture
        $file = fopen($file_path, 'r');

        // Initialiser un tableau pour stocker les données des apprenants
        $promos = [];

        // Lire le fichier ligne par ligne et ajouter les données dans le tableau
        while (($data = fgetcsv($file)) !== false) {
            $promos[] = [
                'nom' => $data[0],
                'datedebut' => $data[1],
                'datefin' => $data[2],
                'id' => $data[3],
                'statut' => $data[4]
            ];
        }

        // Fermer le fichier
        fclose($file);

        return $promos;
    } else {
        return 'Le fichier CSV n\'existe pas.';
    }
}

// Fonction fictive pour obtenir une liste d'apprenants (remplacez-la par votre propre fonction)
function listePromo()
{
    // Vous pouvez implémenter cette fonction selon vos besoins
    // Pour l'exemple, nous renvoyons une liste statique
    return [
        [
            'nom' => "promotion1",
            'datedebut' => "01-02-2017",
            'datefin' => "30-11-2018",
            'id' => 1,
            'statut' => "Desactive",
        ],

        [
            'nom' => "promotion2",
            'datedebut' => "01-01-2000",
            'datefin' => "01-01-2001",
            'id' => 2,
            'statut' => "Desactive",
        ],
        [
            'nom' => "promotion3",
            'datedebut' => "01-01-2000",
            'datefin' => "01-01-2001",
            'id' => 3,
            'statut' => "Desactive",
        ],

        [
            'nom' => "promotion4",
            'datedebut' => "01-01-2000",
            'datefin' => "01-01-2001",
            'id' => 4,
            'statut' => "Desactive",
        ],

        [
            'nom' => "promotion5",
            'datedebut' => "01-01-2000",
            'datefin' => "01-01-2001",
            'id' => 5,
            'statut' => "Desactive",
        ],

        [
            'nom' => "promotion6",
            'datedebut' => "01-01-2000",
            'datefin' => "01-01-2001",
            'id' => 6,
            'statut' => "active",
        ]
    ];
}

function activerpromo($idpromo)
{
    // Charger les promotions actuelles
    $promos = chargerCSV2('promos.csv');

    // Charger les référentiels actuels
    $referentiels = chargerCSV3('referentiels.csv');

    // Activer la promotion correspondant à $idpromo
    foreach ($promos as &$promo) {
        if ($promo['id'] == $idpromo) {
            $promo['statut'] = "active";
        } else {
            $promo['statut'] = "Desactive";
        }
    }

    // Activer les référentiels correspondant à $idpromo
    foreach ($referentiels as &$referentiel) {
        // Vérifier si idPromo est une chaîne de caractères valide
        if (is_string($referentiel['idPromo'])) {
            // Convertir idPromo en tableau en utilisant explode() seulement si c'est une chaîne de caractères non vide
            $idPromoArray = ($referentiel['idPromo'] !== '') ? explode(',', $referentiel['idPromo']) : [];
            // Vérifier si $idpromo est présent dans le tableau
            if (in_array($idpromo, $idPromoArray)) {
                $referentiel['statut'] = "active";
            } else {
                $referentiel['statut'] = "Desactive";
            }
        } elseif (is_array($referentiel['idPromo'])) {
            // Si idPromo est déjà un tableau, vérifier si $idpromo est présent dans le tableau
            if (in_array($idpromo, $referentiel['idPromo'])) {
                $referentiel['statut'] = "active";
            } else {
                $referentiel['statut'] = "Desactive";
            }
        } else {
            // Si idPromo n'est pas une chaîne de caractères ou un tableau, considérer comme inactif
            $referentiel['statut'] = "Desactive";
        }
    }

    // Enregistrer les modifications dans les fichiers CSV
    genererCSV2($promos);
    genererCSV3($referentiels);

    // Stocker l'ID de la promotion active dans une variable de session
    $_SESSION['idPromoActive'] = $idpromo;

    return $promos;
}
