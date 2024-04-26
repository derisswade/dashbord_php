<?php

// Fonction pour générer le fichier CSV des référentiels
function genererCSV3($referentiels)
{
    // Ouvrir un fichier CSV en écriture
    $file = fopen('referentiels.csv', 'w');
    // Parcourir tous les référentiels
    foreach ($referentiels as $referentiel) {
        // Convertir le tableau idPromo en une chaîne de caractères
        $idPromoString = implode(',', $referentiel['idPromo']);
        // Écrire les données dans le fichier CSV
        fputcsv($file, [$referentiel['libelle'], $referentiel['id'], $idPromoString, $referentiel['statut']]);
    }
    // Fermer le fichier
    fclose($file);
    return 'Fichier CSV généré avec succès.';
}

// Fonction pour charger les référentiels à partir du fichier CSV
function chargerCSV3($file_path)
{
    // Vérifier si le fichier existe
    if (file_exists($file_path)) {
        // Ouvrir le fichier CSV en lecture
        $file = fopen($file_path, 'r');
        $referentiels = [];
        // Lire le fichier ligne par ligne et ajouter les référentiels dans le tableau
        while (($data = fgetcsv($file)) !== false) {
            // Vérifier si la clé 'statut' existe dans les données
            if (isset($data[3])) {
                $statut = $data[3];
            } else {
                // Définir un statut par défaut si la clé 'statut' n'est pas présente
                $statut = 'active'; // Vous pouvez modifier le statut par défaut selon vos besoins
            }
            // Ajouter le référentiel au tableau
            $referentiels[] = [
                'libelle' => $data[0],
                'id' => $data[1],
                'idPromo' => explode(',', $data[2]), // Maintenant, idPromo est un tableau
                'statut' => $statut // Utiliser le statut par défaut
            ];
        }
        // Fermer le fichier
        fclose($file);
        return $referentiels;
    } else {
        return 'Le fichier CSV n\'existe pas.';
    }
}

function chargerReferentielsFiltres($file_path, $idpromo)
{
    // Charger tous les référentiels à partir du fichier CSV
    $referentiels = chargerCSV3($file_path);

    // Initialiser un tableau pour stocker les référentiels filtrés
    $referentiels_filtres = [];

    // Parcourir tous les référentiels
    foreach ($referentiels as $referentiel) {
        // Vérifier si l'ID de promotion de ce référentiel correspond à l'ID de promotion spécifié
        if (is_array($referentiel['idPromo']) && in_array($idpromo, $referentiel['idPromo'])) {
            // Si l'ID de promotion est trouvé dans le tableau d'ID de promotion du référentiel, l'ajouter aux référentiels filtrés
            $referentiels_filtres[] = $referentiel;
        } elseif ($referentiel['idPromo'] == $idpromo) {
            // Si l'ID de promotion est une chaîne de caractères, vérifier s'il correspond exactement à l'ID de promotion spécifié
            $referentiels_filtres[] = $referentiel;
        }
    }

    return $referentiels_filtres;
}


// Fonction fictive pour obtenir une liste de référentiels (remplacez-la par votre propre fonction)
function listeReferentiel()
{
    return [
        [
            'libelle' => "Dev Web",
            'id' => 1,
            'idPromo' => [1, 2, 3, 4, 5, 6],
            'statut' => "active",
        ],

        [
            'libelle' => "Referent Digital",
            'id' => 2,
            'idPromo' => [3, 4, 5, 6],
            'statut' => "active",
        ],
        [
            'libelle' => "AWS",
            'id' => 3,
            'idPromo' => [5, 6],
            'statut' => "active",
        ],

        [
            'libelle' => "Hackeuse",
            'id' => 4,
            'idPromo' => [5, 6],
            'statut' => "active",
        ],

        [
            'libelle' => "Dev Data",
            'id' => 5,
            'idPromo' => [4, 5, 6],
            'statut' => "active",
        ],
    ];
}
