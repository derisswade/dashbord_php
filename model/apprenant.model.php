<?php

function genererCSV()
{
  // Récupérer les données des apprenants
  $apprenants = listeApprenant();

  // Ouvrir un fichier CSV en écriture
  $file = fopen('apprenants.csv', 'w');
  // Ajouter les données des apprenants dans le fichier CSV
  foreach ($apprenants as $apprenant) {
    fputcsv($file, $apprenant);
  }

  // Fermer le fichier
  fclose($file);

  return 'Fichier CSV généré avec succès.';
}

// Fonction pour charger les données des apprenants à partir d'un fichier CSV
function chargerCSV($file_path)
{
  // Vérifier si le fichier existe
  if (file_exists($file_path)) {
    // Ouvrir le fichier CSV en lecture
    $file = fopen($file_path, 'r');

    // Initialiser un tableau pour stocker les données des apprenants
    $apprenants = [];

    // Lire le fichier ligne par ligne et ajouter les données dans le tableau
    while (($data = fgetcsv($file)) !== false) {
      $apprenants[] = [
        'Nom' => $data[0],
        'Prenom' => $data[1],
        'Referentiel' => $data[2],
        'Email' => $data[3],
        'Genre' => $data[4],
        'Telephone' => $data[5],
        'idPromo' => $data[6]     
      ];
    }

    // Fermer le fichier
    fclose($file);

    return $apprenants;
  } else {
    return 'Le fichier CSV n\'existe pas.';
  }
}


function chargerApprenantsFiltres($file_path, $idPromo)
{
    // Vérifier si le fichier existe
    if (file_exists($file_path)) {
        // Ouvrir le fichier CSV en lecture
        $file = fopen($file_path, 'r');

        // Initialiser un tableau pour stocker les données des apprenants filtrés
        $apprenants_filtres = [];

        // Lire le fichier ligne par ligne et ajouter les données des apprenants filtrés dans le tableau
        while (($data = fgetcsv($file)) !== false) {
            if ($data[6] == $idPromo) {
                $apprenants_filtres[] = [
                    'Nom' => $data[0],
                    'Prenom' => $data[1],
                    'Referentiel' => $data[2],
                    'Email' => $data[3],
                    'Genre' => $data[4],
                    'Telephone' => $data[5],
                    'idPromo' => $data[6]
                ];
            }
        }

        // Fermer le fichier
        fclose($file);

        return $apprenants_filtres;
    } else {
        return 'Le fichier CSV n\'existe pas.';
    }
}




// Fonction pour obtenir une liste d'apprenants 
function listeApprenant()
{
    return [
    [
        "Nom" => "Balde",
        "Prenom" => "Sidy",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 1
    ],
    [
        "Nom" => "Ndiaye",
        "Prenom" => "Issa",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 1
    ],
    [
        "Nom" => "Diop",
        "Prenom" => "Aziz",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 6
    ],
    [
        "Nom" => "Seck",
        "Prenom" => "Rama",
        "Referentiel" => "Hackeuse",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 6
    ],
    [
        "Nom" => "Diop",
        "Prenom" => "Fama",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Lo",
        "Prenom" => "Mansour",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 3
    ],
    [
        "Nom" => "Ngom",
        "Prenom" => "Amina",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4,
    ],
    [
        "Nom" => "Ba",
        "Prenom" => "Fatima",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Sy",
        "Prenom" => "Anta",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 2
    ],
    [
        "Nom" => "Mbengue",
        "Prenom" => "Alphonse",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 2,
    ],
    [
        "Nom" => "Preira",
        "Prenom" => "Augustin",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 3
    ],
    [
        "Nom" => "Souare",
        "Prenom" => "Fatou",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 3
    ],
    [
        "Nom" => "Beye",
        "Prenom" => "Modou",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],
    [
        "Nom" => "Goudiaby",
        "Prenom" => "Alexis",
        "Referentiel" => "AWS",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 6
    ],
    [
        "Nom" => "Deme",
        "Prenom" => "Khadim",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 6
    ],
    [
        "Nom" => "Yattassaye",
        "Prenom" => "Issa",
        "Referentiel" => "AWS",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Mbaye",
        "Prenom" => "Moustapha",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],

    [
        "Nom" => "Ndione",
        "Prenom" => "Pauline",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],

    [
        "Nom" => "Mbodj",
        "Prenom" => "Mouhamadou",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Traore",
        "Prenom" => "Mouhamed",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],

    [
        "Nom" => "Mbacke",
        "Prenom" => "Bousso",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],

    [
        "Nom" => "Diene",
        "Prenom" => "Marlene",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Anne",
        "Prenom" => "Moussa",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],

    [
        "Nom" => "Monteiro",
        "Prenom" => "Christine",
        "Referentiel" => "Referent Digital",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 4
    ],
    [
        "Nom" => "Faye",
        "Prenom" => "Youssou",
        "Referentiel" => "AWS",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],

    [
        "Nom" => "Faye",
        "Prenom" => "Youssou",
        "Referentiel" => "AWS",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],

    [
        "Nom" => "Aw",
        "Prenom" => "Absa",
        "Referentiel" => "Hackeuse",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],

    [
        "Nom" => "Saleh",
        "Prenom" => "Amina",
        "Referentiel" => "Hackeuse",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],
    [
        "Nom" => "Bah",
        "Prenom" => "Boubabacar",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],

    [
        "Nom" => "Niang",
        "Prenom" => "Nafi",
        "Referentiel" => "Dev Data",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 5
    ],
    
    [
        "Nom" => "Wade",
        "Prenom" => "Idrissa",
        "Referentiel" => "Dev Web",
        "Email" => "exemple@exemple.com",
        "Genre" => "M",
        "Telephone" => "789308563",
        'idPromo' => 6
    ]
];

}
