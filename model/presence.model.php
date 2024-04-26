<?php

function genererCSV4($presences)
{
    $presences = listePresence();
    // Ouvrir un fichier CSV en écriture
    $file = fopen('presences.csv', 'w');
    // Ajouter les données des apprenants dans le fichier CSV
    foreach ($presences as $presence) {
        fputcsv($file, $presence);
    }

    // Fermer le fichier
    fclose($file);

    return 'Fichier CSV généré avec succès.';
}

//Fonction pour charger les données des apprenants à partir d'un fichier CSV
function chargerCSV4($file_path)
{
    // Vérifier si le fichier existe
    if (file_exists($file_path)) {
        // Ouvrir le fichier CSV en lecture
        $file = fopen($file_path, 'r');

        // Initialiser un tableau pour stocker les données des apprenants
        $presences = [];

        // Lire le fichier ligne par ligne et ajouter les données dans le tableau
        while (($data = fgetcsv($file)) !== false) {
            $presences[] = [
                "Matricule" => $data[0],
                "Nom" => $data[1],
                "Prenom" => $data[2],
                "Telephone" => $data[3],
                "Referentiel" => $data[4],
                "Date" => $data[5],
                "Heure" => $data[6],
                "status" => $data[7],
                "idPromo" => isset($data[8]) ? $data[8] : null
            ];
        }
        // Fermer le fichier
        fclose($file);
        return $presences;
    } else {
        return 'Le fichier CSV n\'existe pas.';
    }
}

function chargerPresenceFiltres($file_path, $idpromo, $etat, $date, $referentiel)
{
    // Charger toutes les présences à partir du fichier CSV
    $presences = chargerCSV4($file_path);

    // Initialiser un tableau pour stocker les présences filtrées
    $presences_filtrees = [];

    // Filtrer les présences en fonction de l'ID de promotion, de l'état, de la date et du référentiel
    foreach ($presences as $presence) {
        if (
            $presence['idPromo'] == $idpromo &&
            strtolower($presence['status']) == strtolower($etat) &&
            strtolower($presence['Referentiel']) == strtolower($referentiel) &&
            strtolower($presence['Date']) == strtolower($date)
        ) {
            $presences_filtrees[] = $presence;
        }
    }

    return $presences_filtrees;
}





function listePresence()
{
    $Etudiants = [
        [
            "Matricule" => "P1_DEV_Web_2017_129",
            "Nom" => "Balde",
            "Prenom" => "Sidy",
            "Telephone" => "784316538",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 1
        ],
        [
            "Matricule" => "P1_DEV_Web_2017_130",
            "Nom" => "Ndiaye",
            "Prenom" => "Issa",
            "Telephone" => "784316538",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 1
        ],
        [
            "Matricule" => "P6_DEV_DATA_2024_131",
            "Nom" => "Diop",
            "Prenom" => "Aziz",
            "Telephone" => "78322538",
            "Referentiel" => "Dev Data",
            "Date" => "19-04-2024",
            "Heure" => "07:32",
            "status" => "PRESENT",
            'idPromo' => 6
        ],
        [
            "Matricule" => "P6_Hackeuse_2024_132",
            "Nom" => "Seck",
            "Prenom" => "Rama",
            "Telephone" => "76390238",
            "Referentiel" => "Hackeuse",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 6
        ],
        [
            "Matricule" => "P4_DEV_Web_2022_133",
            "Nom" => "Diop",
            "Prenom" => "Fama",
            "Telephone" => "784316538",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "07:20",
            "status" => "PRESENT",
            'idPromo' => 4

        ],
        [
            "Matricule" => "P3_Referent_Digital_2019_134",
            "Nom" => "Lo",
            "Prenom" => "Mansour",
            "Telephone" => "784316538",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 3
        ],
        [
            "Matricule" => "P4_Referent_Digital_2022_135",
            "Nom" => "Ngom",
            "Prenom" => "Amina",
            "Telephone" => "76390238",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4,
        ],
        [
            "Matricule" => "P4_Referent_Digital_2022_136",
            "Nom" => "Ba",
            "Prenom" => "Fatima",
            "Telephone" => "784316538",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "06:20",
            "status" => "PRESENT",
            'idPromo' => 4
        ],
        [
            "Matricule" => "P2_DEV_Web_2018_137",
            "Nom" => "Sy",
            "Prenom" => "Anta",
            "Telephone" => "784316538",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 2
        ],
        [
            "Matricule" => "P2_DEV_Web_2017_138",
            "Nom" => "Mbengue",
            "Prenom" => "Alphonse",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 2,
        ],
        [
            "Matricule" => "P3_Referent_Digital_2019_145",
            "Nom" => "Preira",
            "Prenom" => "Augustin",
            "Telephone" => "784316538",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 3
        ],
        [
            "Matricule" => "P3_Referent_Digital_2019_156",
            "Nom" => "Souare",
            "Prenom" => "Fatou",
            "Telephone" => "784316538",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 3
        ],
        [
            "Matricule" => "P5_DEV_DATA_2023_139",
            "Nom" => "Beye",
            "Prenom" => "Modou",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 5
        ],
        [
            "Matricule" => "P6_AWS_2024_200",
            "Nom" => "Goudiaby",
            "Prenom" => "Alexis",
            "Telephone" => "76390238",
            "Referentiel" => "AWS",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 6
        ],
        [
            "Matricule" => "P6_DEV_DATA_2024_175",
            "Nom" => "Deme",
            "Prenom" => "Khadim",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 6
        ],
        [
            "Matricule" => "P4_AWS_2022_100",
            "Nom" => "Yattassaye",
            "Prenom" => "Issa",
            "Telephone" => "76390238",
            "Referentiel" => "AWS",
            "Date" => "19-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 4
        ],
        [
            "Matricule" => "P5_DEV_DATA_2023_123",
            "Nom" => "Mbaye",
            "Prenom" => "Moustapha",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "21-04-2024",
            "Heure" => "06:49",
            "status" => "PRESENT",
            'idPromo' => 5
        ],

        [
            "Matricule" => "P4_Referent_Digital_2022_190",
            "Nom" => "Ndione",
            "Prenom" => "Pauline",
            "Telephone" => "76390238",
            "Referentiel" => "Referent Digital",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4
        ],

        [
            "Matricule" => "P4_DEV_WEB_2022_201",
            "Nom" => "Mbodj",
            "Prenom" => "Mouhamadou",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Web",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4
        ],
        [
            "Matricule" => "P4_DEV_DATA_2022_111",
            "Nom" => "Traore",
            "Prenom" => "Mouhamed",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "19-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4
        ],

        [
            "Matricule" => "P4_DEV_DATA_2022_188",
            "Nom" => "Mbacke",
            "Prenom" => "Bousso",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "21-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4
        ],

        [
            "Matricule" => "P4_DEV_DATA_2022_166",
            "Nom" => "Diene",
            "Prenom" => "Marlene",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "21-04-2024",
            "Heure" => "06:25",
            "status" => "PRESENT",
            'idPromo' => 4
        ],
        [
            "Matricule" => "P4_Referent_Digital_2022_122",
            "Nom" => "Anne",
            "Prenom" => "Moussa",
            "Telephone" => "76390238",
            "Referentiel" => "Referent Digital",
            "Date" => "21-04-2024",
            "Heure" => "06:35",
            "status" => "PRESENT",
            'idPromo' => 4
        ],

        [
            "Matricule" => "P4_Referent_Digital_2022_109",
            "Nom" => "Monteiro",
            "Prenom" => "Christine",
            "Telephone" => "76390238",
            "Referentiel" => "Referent Digital",
            "Date" => "21-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 4
        ],
        [
            "Matricule" => "P5_AWS_2023_179",
            "Nom" => "Faye",
            "Prenom" => "Youssou",
            "Telephone" => "76390238",
            "Referentiel" => "AWS",
            "Date" => "21-04-2024",
            "Heure" => "07:00",
            "status" => "PRESENT",
            'idPromo' => 5
        ],

        [
            "Matricule" => "P5_AWS_2023_179",
            "Nom" => "Faye",
            "Prenom" => "Youssou",
            "Telephone" => "76390238",
            "Referentiel" => "AWS",
            "Date" => "21-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 5
        ],

        [
            "Matricule" => "P5_Hackeuse_2023_179",
            "Nom" => "Aw",
            "Prenom" => "Absa",
            "Telephone" => "76390238",
            "Referentiel" => "Hackeuse",
            "Date" => "21-04-2024",
            "Heure" => "07:01",
            "status" => "PRESENT",
            'idPromo' => 5
        ],

        [
            "Matricule" => "P5_Hackeuse_2023_179",
            "Nom" => "Aw",
            "Prenom" => "Absa",
            "Telephone" => "76390238",
            "Referentiel" => "Hackeuse",
            "Date" => "21-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 5
        ],
        [
            "Matricule" => "P5_Dev_Web_2023_109",
            "Nom" => "Aw",
            "Prenom" => "Absa",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Web",
            "Date" => "21-04-2024",
            "Heure" => "-",
            "status" => "ABSENT",
            'idPromo' => 5
        ],

        [
            "Matricule" => "P5_Dev_Data_2023_109",
            "Nom" => "Niang",
            "Prenom" => "Nafi",
            "Telephone" => "76390238",
            "Referentiel" => "Dev Data",
            "Date" => "21-04-2024",
            "Heure" => "07:58",
            "status" => "PRESENT",
            'idPromo' => 5
        ]
    ];

    return $Etudiants;
}
