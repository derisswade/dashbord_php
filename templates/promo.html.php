<style>
    .promoliste {
        position: absolute;
        top: 0;
        right: 0%;
        width: 12%;
        font-weight: bold;
    }

    .promoliste::before {
        content: " Promos";
        opacity: 0.4;
    }

    .container {
        position: relative;
        width: 100%;
        height: auto !important;
        background-color: white;
        border-radius: 1%;
        padding-bottom: 2%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .settings {
        position: fixed;
        bottom: 8%;
        right: 4%;
        width: 3%;
        height: 6%;
        border-radius: 50%;
        background-color: rgb(19, 138, 138);
        display: flex;
        justify-content: center;

        svg {
            width: 50%;
            height: 100%;
        }
    }

    .content {
        width: 96%;
        height: 60%;
        position: relative;
        left: 2%;
        background-color: white;
        box-shadow: 1px 10px 18px 0 rgb(244, 244, 253);
        box-sizing: border-box;
        margin-right: 1%;
        border-radius: 1em;
        margin-top: 2%;
        padding: 2%;
        padding-right: 0;

        table {
            border-collapse: collapse;
            padding: 1%;
            width: 100%;
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        th {
            background-color: rgb(244, 244, 253);
            padding-top: 1%;
            padding-bottom: 1%;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
        }

        td {
            text-align: center;
            font-size: 16px;
            padding-bottom: 5px;

        }

        td:nth-child(1) {
            width: 20%;
            padding: 0;
            position: relative;

            span {
                font-weight: bold;
                position: absolute;
                top: 30%;
                margin-left: 2%;
            }

            .ACTIVE {
                color: green;
            }

            img {
                width: 20%;
            }
        }

        td:nth-child(4) {
            width: 10%;
            height: 100%;
            padding-top: 1%;

            div {
                width: 66%;
                height: 40%;
                padding-bottom: 30%;
                border: none;
                border-radius: 0.2em;
                margin: 6%;
                text-align: center;
                color: rgb(19, 138, 138);
                background-color: rgb(235, 235, 245);
            }
        }

        div i {
            font-size: 100%;
        }
    }


    .cont {
        position: relative;
        margin-top: 4%;
        margin-left: 2%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .promo {
        font-size: 100%;
        font-weight: bold;
        margin-top: -1%;
    }

    .promo .nb {
        color: #008F89;
    }

    .input {
        position: absolute;
        display: flex;
        justify-content: space-around;
        width: 35%;
        right: 5%;
        margin-bottom: 1%;
        z-index: 2;
    }

    .input form {
        position: relative;
        width: 80%;

        input {
            border: none;
            width: 70%;
            padding: 4.5%;
            padding-left: 10%;
            background-color: rgb(246, 247, 251);
            border-radius: 0.5em;
            position: relative;
        }

        button {
            color: rgb(19, 138, 138);
            border: none;
            background-color: transparent;
            font-size: 100%;
            position: absolute;
            top: 25%;
            right: 35%;
        }
    }

    .input input:focus {
        outline: none;
        cursor: pointer;
    }

    .input a {
        width: 30%;
        margin-left: -2%;

        button {
            border: none;
            width: 100%;
            padding: 10%;
            background-color: rgb(19, 138, 138);
            border-radius: 0.5em;
            color: white;
            font-size: 100%;
            font-weight: bold;
            position: relative;
        }
    }

    .input a button:hover {
        background-color: rgb(19, 138, 138);
        color: white;
    }

    .input a button i {
        color: white;
    }

    .container .pages {
        position: relative;
        bottom: 0;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .container .pages .nbitems {
        position: relative;
        width: 20%;

        svg {
            position: absolute;
            bottom: 26%;
            left: 24.6%;
            width: 60%;
            height: 60%;
        }

        a {
            margin-left: 2%;
            text-decoration: none;
            padding-left: 2%;
            padding-right: 2%;
        }

        .active {
            color: white;
        }
    }

    .container .pages select {
        width: 16%;
        border: none;
        background-color: transparent;
        outline: 0;
        font-size: 100%;
        font-weight: bold;
    }

    .container .pagination {
        width: 20%;
        display: flex;
        justify-content: space-around;
        padding-right: 4%;

        svg {
            position: absolute;
            bottom: 2%;
            left: 9.5%;
            width: 2%;
            height: 2%;
        }

        a {
            margin-left: 0.5%;
            text-decoration: none;
            padding-left: 2%;
            padding-right: 2%;
        }

        .act {
            background-color: rgb(18, 126, 126);
            color: white;
            margin-left: 2%;
            text-decoration: none;
            padding-left: 2%;
            padding-right: 2%;
        }
    }
</style>
<?php
if (isset($_GET['id'])) {
    activerpromo($_GET['id']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../public/css/<?= $css ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
</style>

<body>
    <div class="main">
        <div class="Entete">
            <h2>Promotions</h2>
            <div class="promoliste">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                </svg>
                Liste
            </div>
        </div>
        <div class="container">
            <div class="cont">
                <div class="promo">
                    <span style="font-size: 18px; font-weight:bold">Liste des Promotions<span class="nb">(<?= $_SESSION['idPromoActive'] ?>)</span>

                </div>
                <div class="input">
                    <form action="">
                        <input type="text" placeholder="Rechercher ici ..." class="text" style="font-size: 14px;">
                        <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <a href="../templates/Ajouterpromo.html.php">
                        <button style="font-size: 16px;"><i class="fa-solid fa-plus"> </i> Nouvelle</button>
                    </a>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Libelle</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Actions</th>
                    </tr>

                    <form action="" method="post">
                        <?php if (is_array($promos)) : ?>
                            <?php foreach ($promos as $promo) : ?>
                                <tr>
                                    <td>
                                        <img src="../assets/images/imgPromo.png" alt="">
                                        <span class="<?= $promo['statut'] ?>" style="font-size: 14px; text-align :center "><?= $promo['nom'] ?></span>
                                    </td>
                                    <td><?= $promo['datedebut'] ?></td>
                                    <td><?= $promo['datefin'] ?></td>
                                    <td>
                                        <input type="hidden" name="page" value="<?= $promo['id'] ?>">
                                        <input type="checkbox" onclick="uncheckOthers(this)" style="background: green; border:none; padding: 3px;color:white;font-size:14px; font-weight:bold" value="<?= $promo['id'] ?>" <?= $promo['statut'] === 'active' ? 'checked' : '' ?> name="activation" id="<?= $promo['id'] ?>">

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </form>
                </table>
            </div>
        </div>
</body>
<script>
    function uncheckOthers(checkbox) {
        var checkboxes = document.getElementsByName('activation');
        console.log(checkbox.value)
        window.location.href = 'promo?id=' + checkbox.value
        checkboxes.forEach(function(item) {
            if (item !== checkbox) item.checked = false;
        });
    }
</script>

</html>