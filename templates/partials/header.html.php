<?php
// Démarrez la session PHP
session_start();

if (isset($_SESSION['user'])) {
    header("Location: www.idrissawade.com:8080");exit(); 
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");exit();
    }

require_once 'model/promo.model.php';
require ('model/login.model.php');

// Vérifier si 'idpromo' est défini dans l'URL
if (isset($_GET['id'])) {
    // Utiliser la valeur de 'idpromo' depuis l'URL
    $idPromo = $_GET['id'];

    // Activer la promotion correspondant à $idPromo
    activerPromo($idPromo);

    // Mettez à jour la variable de session avec l'ID de la promotion activée
    $_SESSION['idPromoActive'] = $idPromo;
} 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css<?= $uri ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/d2ba3c872c.js" crossorigin="anonymous"></script>
</head>

<body>
    <input type="checkbox" id="menu_checkbox">
    <header class="header">
        <div class="flex-left">
            <label for="menu_checkbox">
                <div><i class="fa fa-bars" aria-hidden="true"></i></div>
                <div><i class="fa-solid fa-bars-staggered fa-flip-horizontal"></i></div>
            </label>
            <div class="icons">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z" />
                    </svg>
                </div>
            </div>
            <form action="#" method="post" class="search-form">
                <input type="text" name="search_box" required placeholder="Rechercher par matricule" maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>
        </div>
        <div class="flex-right">
            <input type="date" name="dateofbirth" id="dateofbirth" value="2024-04-01">
            <div class="profil">
                <img src="assets/images/images.jpg" class="image" alt="">
                <div class="info">
                    <!--  -->
                    <small style="font-size: 14px;">Admin <i class="fa fa-angle-down" aria-hidden="true"></i></small>
                </div>
            </div>
            <div class="hoverable">
            <!-- <a href="profile.html" class="btn">Voir profile</a> -->
            <div class="flex-btn">
                <a href="/" class="option-btn">Deconnexion</a>
            </div>
        </div>
        </div>
    </header>
    <div class="side-bar">

        <div id="close-btn">
        </div>

        <div class="profile">
            <img src="/assets/images/Logo-Sonatel-Academy-480_1-1-removebg-preview.png" class="image" alt="" style="height:150px; width:150px;">
            <h3 class="menu">- MENU</h3>
        </div>

        <nav class="navbar">
            <a href="#"><i class="fa-solid fa-bars-staggered fa-flip-horizontal"></i><span>Dashboard</span></a>
            <a href="/apprenant?idpromo=<?php echo $_SESSION['idPromoActive']; ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Apprenants</span></a>
            <a href="/promo"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> <span>Promos</span></a>
            <a href="/referentiel?idpromo=<?php echo $_SESSION['idPromoActive']; ?>"><i class="fas fa-calendar-alt" aria-hidden="true"></i><span>Référentiels</span></a>
            <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Utilisateurs</span></a>
            <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Visiteurs</span></a>
            <a href="/presence?idpromo=<?php echo $_SESSION['idPromoActive']; ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Presence</span></a>
            <a href="#"><i class="fas fa-calendar-alt" aria-hidden="true"></i><span>Événements</span></a>

        </nav>
    </div>
    <section class="home-section">