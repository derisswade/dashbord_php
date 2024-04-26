<?php require("/var/www/html/projet/model/login.model.php"); ?>

<?php
// Instanciation de la classe RegisterUser si le formulaire est soumis
if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['email'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/d2ba3c872c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="logo">
        <img src="../assets/images/Logo-Sonatel-Academy-480_1-1-removebg-preview.png" alt="">
    </div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off"> 
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Email address</span>
                    <input type="email" name="email" placeholder="Enter email address*">
                </div>
                
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="Enter password*">
                </div>
            </div>
            <div class="foo">
                <div class="input-checkbox">
                    <input type="checkbox" name="remember">Remember me
                </div>
                <div class="passwordForget">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="Log In" style="position: absolute; left:0; top:0; width:100%; z-index:2; height:100%">
            </div>
            <p class="error"><?php echo isset($user->error) ? $user->error : ''; ?></p>
            <p class="success"><?php echo isset($user->success) ? $user->success : ''; ?></p>
        </form>
    </div>
</body>
</html>
