<?php
// Inclure les fonctions nécessaires
require_once 'model/referentiel.model.php';
require_once 'model/promo.model.php';

// Vérifier si 'idpromo' est défini dans l'URL
if (isset($_GET['idpromo'])) {
	// Utiliser la valeur de 'idpromo' depuis l'URL
	$idpromo = $_GET['idpromo'];
	// Activer la promotion correspondant à $idpromo
	activerpromo($idpromo);
	// Charger les référentiels filtrés pour cette promotion
	$referentiels_promo = chargerReferentielsFiltres('referentiels.csv', $idpromo);
	// Vérifier si des référentiels ont été trouvés
	if (empty($referentiels_promo)) {
		// Afficher un message si aucun référentiel n'a été trouvé
		echo "<span style='color: red;'>Aucune référentiel trouvée pour cette promotion.</span>";
	} else {
		// Inclure le fichier referentiel.html.php après avoir défini $idpromo
		require_once "templates/referentiel.html.php";
	}
}
?>
		<?php
		// Vérifier si le formulaire a été soumis
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Récupérer les val²eurs du formulaire
			$libelle = $_POST['libelle'];
			$description = $_POST['description'];

			// Utilisation de la fonction pour créer un nouveau référentiel
			$creation_referentiel = creerReferentiel($libelle, $description, "/var/www/html/projet/referentiels.csv");
			echo $creation_referentiel;
		}
		?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

		.promotions {
			margin-top: 1%;
			margin-left: 5%;
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-right: 1em;
			margin-bottom: 10px;
		}

		.containe {
			margin-left: 5%;
			height: 5ovh;
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 30px;
		}

		.img {
			display: flex;
			flex: 1;
			width: 250px;
			height: 400px;
			justify-content: center;
			align-items: center;
			border-radius: 0.5em;
			position: relative;
			top: 0;
			background-color: #fff;
		}

		h4,
		span,
		li {
			font-size: 16px;
			text-align: center;
		}

		.img img {
			width: 10vw;
			height: 10vh;
			block-size: contain;
			cursor: pointer;
			margin-right: 1em;
		}

		.form {
			display: flex;
			flex: 1;
			flex-direction: column;
			align-items: center;
			border-radius: 0.5em;
			background-color: #fff;
			position: relative;
			top: 1%;
			left: -1%;
			margin: 5px;
		}

		.form i {
			position: relative;
			top: 8%;
			left: 10%;
			font-size: 1.8em;
			color: #7E7987;
			cursor: pointer;
			height: 100px;
		}

		.ref {
			position: absolute;
			top: 70%;
			left: 25%;
			font-weight: normal;
		}

		.active {
			color: #008F89;
			margin: 3em;
			cursor: pointer;
		}

		a {
			color: #008F89;
			font-size: 16px;
		}

		.ref {
			line-height: 2em;
			text-align: center;
		}

		.img .points {
			display: flex;
			justify-content: center;
			align-items: center;
			padding-left: -0.8px;
			padding-right: 2px;
		}

		.points ul {
			display: flex;
			position: relative;
			top: -8.5em;
			left: 90%;
			gap: 0.5em;
			cursor: pointer;
		}


		.containeFils {
			display: flex;
			flex: 4;
			height: 400px;
			gap: 0.5em;
			align-items: center;
			justify-content: center;
			border-radius: 0.5em;
			flex-wrap: wrap;
			background-color: #eee;

		}
	</style>
</head>

<body>
	<div class="promotions">
		<h2>Référentiels</h2>
		<span>Référentiels * Création</span>
	</div>


	<!-- Afficher les référentiels filtrés -->
	<div class="containe">

		<div class="containeFils">
			<?php
			if (empty($referentiels_promo)) {
				// Aucun référentiel trouvé pour cette promotion
				echo "<div>Aucun référentiel trouvé pour cette promotion.</div>";
			} else {
				// Afficher les référentiels de la promotion
				foreach ($referentiels_promo as $referentiel) {
					// Construire l'URL avec l'ID de la promotion active et le référentiel
					$url = "apprenant?idpromo={$idpromo}&reference=" . urlencode($referentiel['libelle']);
					// Afficher les informations du référentiel dans votre HTML avec le lien "Active"
					echo "<div class='img'>";
					echo "<span class='points'><ul><li></li><li></li><li></li></ul></span>";
					echo "<img src='../assets/images/referentiel.jpeg' alt=''>";
					echo "<div class='ref'>";
					echo "<span>{$referentiel['libelle']}</span> <br>";
					echo "<span class='active'><a href='{$url}'>Active</a></span>"; // Lien avec l'URL construite
					echo "</div>";
					echo "</div>";
				}
			}
			?>



		</div>


		<!-- Formulaire HTML pour créer un nouveau référentiel -->
		<div class="form">
			<div class="sform">
				<h4>Nouveau Référentiel</h4>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<span style="margin-left: 15px;">Libellé</span> <br>
					<i class="fa-regular fa-user" style="font-size: 14px;"></i>
					<input type="text" name="libelle" placeholder="Entrer le Libellé" style="font-size: 14px; border: 1px solid gray; border-radius: 6px; padding: 10px; width: 14vw;" required> <br>
					<span style="margin-left: 15px;">Description</span> <br>
					<i class="fa-regular fa-user" style="font-size: 14px;"></i>
					<input type="text" name="description" placeholder="Entrer la description" style="font-size: 14px; border: 1px solid gray; border-radius: 6px; padding: 10px; width: 14vw;" required>
					<button type="submit" style="font-size: 14px; margin-left: 4em; width: 250px; cursor: pointer; margin-top: 1em; padding: 1.2em; border-radius: 8px; border: #D5D5D7; background-color: #008F89; color: #fff; font-weight: bold;">Enregistrer</button>
				</form>
			</div>
		</div>

		<!-- <div class="form">
			<div class="sform">
				<h4>Nouveau Référentiel</h4>
				<span style="margin-left: 15px;">Libellé</span> <br>
				<i class="fa-regular fa-user" style="font-size: 14px;"></i>
				<input type="text" placeholder="      Entrer le Libellé" style="font-size: 14px; border: 1px solid gray; border-radius: 6px; padding: 10px; width: 14vw;"> <br>
				<span style="margin-left: 15px;">Description</span> <br>
				<i class="fa-regular fa-user" style="font-size: 14px;"></i>
				<input type="text" placeholder="      Entrer la description" style="font-size: 14px; border: 1px solid gray; border-radius: 6px; padding: 10px; width: 14vw;">
				<button style="font-size: 14px; margin-left: 4em; width: 250px; cursor: pointer;  margin-top: 1em; padding: 1.2em; border-radius: 8px; border: #D5D5D7; background-color: #008F89; color: #fff; font-weight: bold;">Enregistrer</button>
			</div>
		</div>
 -->
	</div>

</body>

</html>